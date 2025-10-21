<?php

declare(strict_types=1);

/*
 * This file is part of the package jweiland/contributory-calculator.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace JWeiland\ContributoryCalculator\Tests;

use JWeiland\ContributoryCalculator\Domain\Model\CalculationBase;
use JWeiland\ContributoryCalculator\Domain\Model\Care;
use JWeiland\ContributoryCalculator\Domain\Model\Search;
use JWeiland\ContributoryCalculator\Service\Calculator;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Test;
use TYPO3\CMS\Extbase\Persistence\ObjectStorage;
use TYPO3\TestingFramework\Core\Unit\UnitTestCase;

/**
 * Test case
 */
class CalculatorTest extends UnitTestCase
{
    protected Calculator $subject;

    protected function setUp(): void
    {
        $this->subject = new Calculator();
    }

    protected function tearDown(): void
    {
        unset(
            $this->subject,
        );
    }

    #[Test]
    public function getTotalPerMonthWithoutCareFormResultsInException(): void
    {
        $this->expectExceptionMessage('Given care form was not found in our database');
        $this->expectExceptionCode(1604480281);

        $search = new Search();
        $search->setChargeableIncome(36000);

        $this->subject->getTotalPerMonth($search);
    }

    #[Test]
    public function getTotalPerMonthWithoutAgeOfChildResultsInException(): void
    {
        $this->expectExceptionMessage('You have chosen an invalid age range for your child');
        $this->expectExceptionCode(1604480406);

        $care = new Care();

        $search = new Search();
        $search->setCare($care);
        $search->setChargeableIncome(36000);
        $search->getCare()->setCalculationBases(new ObjectStorage());
        $search->getCare()->getCalculationBases()->attach(new CalculationBase());
        $search->getCare()->getCalculationBases()[0]->setMinimalIncome(25000);
        $search->getCare()->getCalculationBases()[0]->setMaximumIncome(70000);
        $search->setAgeOfChild(24);

        $this->subject->getTotalPerMonth($search);
    }

    #[Test]
    public function getTotalPerMonthWithTooYoundChildAndWithoutFactorWillResultInException(): void
    {
        $this->expectExceptionMessage('Child is too old for this kind of care form.');
        $this->expectExceptionCode(1604482527);

        $calculationBase = new CalculationBase();
        $calculationBase->setValueBelow3(0.0);
        $calculationBase->setValueAbove3(0.0);
        $calculationBase->setYearOfValidity(2021);

        $care = new Care();
        $care->getCalculationBases()->attach($calculationBase);

        $search = new Search();
        $search->setCare($care);
        $search->setChargeableIncome(36000);
        $search->getCare()->getCalculationBases()[0]->setMinimalIncome(25000);
        $search->getCare()->getCalculationBases()[0]->setMaximumIncome(70000);
        $search->setAgeOfChild(1);
        $search->setYearOfValidity(2021);

        $this->subject->getTotalPerMonth($search);
    }

    public static function dataProviderForChildrenBelowThreeYears(): array
    {
        return [
            'negative income' => [-32000, 4.0, 116.0],
            'too low income' => [3600, 4.0, 0.0],
            'low income' => [25000, 4.0, 90.0],
            'middle income' => [32000, 4.0, 116.0],
            'high income' => [70000, 4.0, 254.0],
            'too high income' => [123456789, 4.0, 254.0],
        ];
    }

    #[Test]
    #[DataProvider('dataProviderForChildrenBelowThreeYears')]
    public function getTotalPerMonthWithChildrenYoungerThanThreeYears(
        int $income,
        float $factor,
        float $expectedResult,
    ): void {
        $calculationBase = new CalculationBase();
        $calculationBase->setValueBelow3($factor);
        $calculationBase->setValueAbove3(24.0);
        $calculationBase->setYearOfValidity(2021);

        $care = new Care();
        $care->getCalculationBases()->attach($calculationBase);

        $search = new Search();
        $search->setCare($care);
        $search->getCare()->getCalculationBases()[0]->setMinimalIncome(25000);
        $search->getCare()->getCalculationBases()[0]->setMaximumIncome(70000);
        $search->setChargeableIncome($income);
        $search->setAgeOfChild(1);
        $search->setYearOfValidity(2021);

        self::assertSame(
            $expectedResult,
            $this->subject->getTotalPerMonth($search),
        );
    }

    public static function dataProviderForChildrenAboveThreeYears(): array
    {
        return [
            'negative income' => [-32000, 2.5, 72.0],
            'too low income' => [3600, 2.5, 0.0],
            'low income' => [25000, 2.5, 56.0],
            'middle income' => [32000, 2.5, 72.0],
            'high income' => [70000, 2.5, 159.0],
            'too high income' => [123456789, 2.5, 159.0],
        ];
    }

    #[Test]
    #[DataProvider('dataProviderForChildrenAboveThreeYears')]
    public function getTotalPerMonthWithChildrenOlderThanThreeYears(
        int $income,
        float $factor,
        float $expectedResult,
    ): void {
        $calculationBase = new CalculationBase();
        $calculationBase->setValueBelow3(24.0);
        $calculationBase->setValueAbove3($factor);
        $calculationBase->setYearOfValidity(2021);

        $care = new Care();
        $care->getCalculationBases()->attach($calculationBase);

        $search = new Search();
        $search->setCare($care);
        $search->getCare()->getCalculationBases()[0]->setMinimalIncome(25000);
        $search->getCare()->getCalculationBases()[0]->setMaximumIncome(70000);
        $search->setChargeableIncome($income);
        $search->setAgeOfChild(2);
        $search->setYearOfValidity(2021);

        self::assertSame(
            $expectedResult,
            $this->subject->getTotalPerMonth($search),
        );
    }
}
