<?php

/*
 * This file is part of the package jweiland/contributory_calculator.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace JWeiland\ContributoryCalculator\Tests\Unit\Domain\Model;

use JWeiland\ContributoryCalculator\Domain\Model\ChargeableIncome;
use Nimut\TestingFramework\TestCase\UnitTestCase;

/**
 * Test case for class \JWeiland\ContributoryCalculator\Domain\Model\ChargeableIncome.
 *
 * @copyright Copyright belongs to the respective authors
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 * @author Pascal Rinker <projects@jweiland.net>
 */
class ChargeableIncomeTest extends UnitTestCase
{
    /**
     * @var \JWeiland\ContributoryCalculator\Domain\Model\ChargeableIncome
     */
    protected $subject;

    public function setUp()
    {
        $this->subject = new \JWeiland\ContributoryCalculator\Domain\Model\ChargeableIncome();
    }

    public function tearDown()
    {
        unset($this->subject);
    }

    /**
     * @test
     */
    public function getMinimalIncomeInitiallyReturnsZero()
    {
        self::assertSame(
            0,
            $this->subject->getMinimalIncome()
        );
    }

    /**
     * @test
     */
    public function setMinimalIncomeSetsMinimalIncome()
    {
        $this->subject->setMinimalIncome(123456);

        self::assertSame(
            123456,
            $this->subject->getMinimalIncome()
        );
    }

    /**
     * @test
     */
    public function setMinimalIncomeWithStringResultsInInteger()
    {
        $this->subject->setMinimalIncome('123Test');

        self::assertSame(
            123,
            $this->subject->getMinimalIncome()
        );
    }

    /**
     * @test
     */
    public function setMinimalIncomeWithBooleanResultsInInteger()
    {
        $this->subject->setMinimalIncome(true);

        self::assertSame(
            1,
            $this->subject->getMinimalIncome()
        );
    }

    /**
     * @test
     */
    public function getMaximalIncomeInitiallyReturnsZero()
    {
        self::assertSame(
            0,
            $this->subject->getMaximalIncome()
        );
    }

    /**
     * @test
     */
    public function setMaximalIncomeSetsMaximalIncome()
    {
        $this->subject->setMaximalIncome(123456);

        self::assertSame(
            123456,
            $this->subject->getMaximalIncome()
        );
    }

    /**
     * @test
     */
    public function setMaximalIncomeWithStringResultsInInteger()
    {
        $this->subject->setMaximalIncome('123Test');

        self::assertSame(
            123,
            $this->subject->getMaximalIncome()
        );
    }

    /**
     * @test
     */
    public function setMaximalIncomeWithBooleanResultsInInteger()
    {
        $this->subject->setMaximalIncome(true);

        self::assertSame(
            1,
            $this->subject->getMaximalIncome()
        );
    }

    /**
     * @test
     */
    public function getDiscountInPercentInitiallyReturnsZero()
    {
        self::assertSame(
            0,
            $this->subject->getDiscountInPercent()
        );
    }

    /**
     * @test
     */
    public function setDiscountInPercentSetsDiscountInPercent()
    {
        $this->subject->setDiscountInPercent(123456);

        self::assertSame(
            123456,
            $this->subject->getDiscountInPercent()
        );
    }

    /**
     * @test
     */
    public function setDiscountInPercentWithStringResultsInInteger()
    {
        $this->subject->setDiscountInPercent('123Test');

        self::assertSame(
            123,
            $this->subject->getDiscountInPercent()
        );
    }

    /**
     * @test
     */
    public function setDiscountInPercentWithBooleanResultsInInteger()
    {
        $this->subject->setDiscountInPercent(true);

        self::assertSame(
            1,
            $this->subject->getDiscountInPercent()
        );
    }

    /**
     * @test
     */
    public function getLabelInitiallyReturnsString()
    {
        /** @var ChargeableIncome|\PHPUnit_Framework_MockObject_MockObject $subject */
        $subject = $this->createPartialMock(ChargeableIncome::class, ['translate']);
        $subject
            ->expects(self::at(0))
            ->method('translate')
            ->with(self::equalTo('currency'))
            ->willReturn('€');
        $subject
            ->expects(self::at(1))
            ->method('translate')
            ->with(self::equalTo('currency'))
            ->willReturn('€');

        self::assertSame(
            '0€ - 0€',
            $subject->getLabel()
        );
    }

    /**
     * @return array
     */
    public function getLabelDataProvider()
    {
        $income = [];
        $income['negative value'] = [-11, '1€ - -11€'];
        $income['positive edgecase'] = [1, '1€ - 1€'];
        $income['positive value'] = [40, '1€ - 40€'];

        return $income;
    }

    /**
     * @test
     * @param int $maximalIncome
     * @param string $expectedReturn
     * @dataProvider getLabelDataProvider
     */
    public function getLabelWithDifferentMaximalIncomes($maximalIncome, $expectedReturn)
    {
        /** @var ChargeableIncome|\PHPUnit_Framework_MockObject_MockObject $subject */
        $subject = $this->createPartialMock(ChargeableIncome::class, ['translate']);
        $subject->setMinimalIncome(1);
        $subject->setMaximalIncome($maximalIncome);
        $subject
            ->expects(self::exactly(2))
            ->method('translate')
            ->with(self::equalTo('currency'))
            ->willReturn('€');
        self::assertSame(
            $expectedReturn,
            $subject->getLabel()
        );
    }

    /**
     * @test
     */
    public function getLabelWithZero()
    {
        /** @var ChargeableIncome|\PHPUnit_Framework_MockObject_MockObject $subject */
        $subject = $this->createPartialMock(ChargeableIncome::class, ['translate']);
        $subject->setMinimalIncome(100);
        $subject->setMaximalIncome(0);
        $subject
            ->expects(self::at(0))
            ->method('translate')
            ->with(self::equalTo('chargeableIncome.about'))
            ->willReturn('about');
        $subject
            ->expects(self::at(1))
            ->method('translate')
            ->with(self::equalTo('currency'))
            ->willReturn('€');

        self::assertSame(
            'about 100€',
            $subject->getLabel()
        );
    }

    /**
     * @test
     */
    public function getLabelWithZeroMinimalIncome()
    {
        /** @var ChargeableIncome|\PHPUnit_Framework_MockObject_MockObject $subject */
        $subject = $this->createPartialMock(ChargeableIncome::class, ['translate']);
        $subject->setMaximalIncome(100);
        $subject
            ->expects(self::at(0))
            ->method('translate')
            ->with(self::equalTo('chargeableIncome.until'))
            ->willReturn('until');
        $subject
            ->expects(self::at(1))
            ->method('translate')
            ->with(self::equalTo('currency'))
            ->willReturn('€');

        self::assertSame(
            'until 100€',
            $subject->getLabel()
        );
    }
}
