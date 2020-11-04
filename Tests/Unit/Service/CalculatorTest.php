<?php

/*
 * This file is part of the package jweiland/contributory_calculator.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace JWeiland\ContributoryCalculator\Tests;

use JWeiland\ContributoryCalculator\Domain\Model\Care;
use JWeiland\ContributoryCalculator\Domain\Model\Search;
use JWeiland\ContributoryCalculator\Service\Calculator;
use Nimut\TestingFramework\TestCase\UnitTestCase;

/**
 * Test case
 */
class CalculatorTest extends UnitTestCase
{
    /**
     * @var Calculator
     */
    protected $subject;

    public function setUp()
    {
        $this->subject = new Calculator();
    }

    public function tearDown()
    {
        unset(
            $this->subject
        );
    }

    /**
     * @test
     */
    public function getTotalPerMonthWithoutCareFormResultsInException() {
        $this->expectExceptionMessage('Given care form was not found in our database');
        $this->expectExceptionCode(1604480281);

        $search = new Search();

        $this->subject->getTotalPerMonth($search);
    }

    /**
     * @test
     */
    public function getTotalPerMonthWithoutAgeOfChildResultsInException() {
        $this->expectExceptionMessage('You have chosen an invalid age range for your child');
        $this->expectExceptionCode(1604480406);

        $care = new Care();

        $search = new Search();
        $search->setAgeOfChild(24);
        $search->setCare($care);

        $this->subject->getTotalPerMonth($search);
    }

    /**
     * @test
     */
    public function getTotalPerMonthWithTooYoundChildAndWithoutFactorWillResultInException() {
        $this->expectExceptionMessage('Child is too old for this kind of care form.');
        $this->expectExceptionCode(1604482527);

        $care = new Care();
        $care->setValueBelow3('');
        $care->setValueAbove3('');

        $search = new Search();
        $search->setAgeOfChild(1);
        $search->setCare($care);

        $this->subject->getTotalPerMonth($search);
    }

    public function dataProviderForChildrenBelowThreeYears()
    {
        return [
            'negative income' => [-32000, '4.0', 116.0],
            'too low income' => [3600, '4.0', 90.0],
            'low income' => [25000, '4.0', 90.0],
            'middle income' => [32000, '4.0', 116.0],
            'high income' => [70000, '4.0', 254.0],
            'too high income' => [123456789, '4.0', 254.0],
            'middle income with german factor' => [32000, '4.0', 116.0],
            'middle income with thousands separator factor' => [32000, '1.4,5', 421.0],
        ];
    }

    /**
     * @test
     * @dataProvider dataProviderForChildrenBelowThreeYears
     * @param int $income
     * @param string $factor
     * @param float $expectedResult
     */
    public function getTotalPerMonthWithChildrenYoungerThanThreeYears(
        int $income,
        string $factor,
        float $expectedResult)
    {
        $care = new Care();
        $care->setValueBelow3($factor);
        $care->setValueAbove3('24');

        $search = new Search();
        $search->setChargeableIncome($income);
        $search->setAgeOfChild(1);
        $search->setCare($care);

        self::assertSame(
            $expectedResult,
            $this->subject->getTotalPerMonth($search)
        );
    }

    public function dataProviderForChildrenAboveThreeYears()
    {
        return [
            'negative income' => [-32000, '2.5', 72.0],
            'too low income' => [3600, '2.5', 56.0],
            'low income' => [25000, '2.5', 56.0],
            'middle income' => [32000, '2.5', 72.0],
            'high income' => [70000, '2.5', 159.0],
            'too high income' => [123456789, '2.5', 159.0],
            'middle income with german factor' => [32000, '2,5', 72.0],
            'middle income with thousands separator factor' => [32000, '2.5,8', 750.0],
        ];
    }

    /**
     * @test
     * @dataProvider dataProviderForChildrenAboveThreeYears
     * @param int $income
     * @param string $factor
     * @param float $expectedResult
     */
    public function getTotalPerMonthWithChildrenOlderThanThreeYears(
        int $income,
        string $factor,
        float $expectedResult)
    {
        $care = new Care();
        $care->setValueBelow3('24');
        $care->setValueAbove3($factor);

        $search = new Search();
        $search->setChargeableIncome($income);
        $search->setAgeOfChild(2);
        $search->setCare($care);

        self::assertSame(
            $expectedResult,
            $this->subject->getTotalPerMonth($search)
        );
    }
}
