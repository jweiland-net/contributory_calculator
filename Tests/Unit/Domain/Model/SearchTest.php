<?php

/*
 * This file is part of the package jweiland/contributory_calculator.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace JWeiland\ContributoryCalculator\Tests\Unit\Domain\Model;

use JWeiland\ContributoryCalculator\Domain\Model\Care;
use JWeiland\ContributoryCalculator\Domain\Model\Search;
use Nimut\TestingFramework\TestCase\UnitTestCase;

/**
 * Test case
 */
class SearchTest extends UnitTestCase
{
    /**
     * @var Search
     */
    protected $subject;

    public function setUp()
    {
        $this->subject = new Search();
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
    public function getChargeableIncomeInitiallyReturns0()
    {
        self::assertSame(
            0,
            $this->subject->getChargeableIncome()
        );
    }

    /**
     * @test
     */
    public function setChargeableIncomeSetsChargeableIncome()
    {
        $this->subject->setChargeableIncome(36000);

        self::assertSame(
            36000,
            $this->subject->getChargeableIncome()
        );
    }

    /**
     * @test
     */
    public function getMinChargeableIncomeInitiallyReturnsZero()
    {
        self::assertSame(
            0,
            $this->subject->getMinChargeableIncome()
        );
    }

    /**
     * @test
     */
    public function setMinChargeableIncomeSetsMinChargeableIncome()
    {
        $this->subject->setMinChargeableIncome(123456);

        self::assertSame(
            123456,
            $this->subject->getMinChargeableIncome()
        );
    }

    /**
     * @test
     */
    public function setMinChargeableIncomeWithStringResultsInInteger()
    {
        $this->subject->setMinChargeableIncome('123Test');

        self::assertSame(
            123,
            $this->subject->getMinChargeableIncome()
        );
    }

    /**
     * @test
     */
    public function setMinChargeableIncomeWithBooleanResultsInInteger()
    {
        $this->subject->setMinChargeableIncome(true);

        self::assertSame(
            1,
            $this->subject->getMinChargeableIncome()
        );
    }

    /**
     * @test
     */
    public function getMaxChargeableIncomeInitiallyReturnsZero()
    {
        self::assertSame(
            0,
            $this->subject->getMaxChargeableIncome()
        );
    }

    /**
     * @test
     */
    public function setMaxChargeableIncomeSetsMaxChargeableIncome()
    {
        $this->subject->setMaxChargeableIncome(123456);

        self::assertSame(
            123456,
            $this->subject->getMaxChargeableIncome()
        );
    }

    /**
     * @test
     */
    public function setMaxChargeableIncomeWithStringResultsInInteger()
    {
        $this->subject->setMaxChargeableIncome('123Test');

        self::assertSame(
            123,
            $this->subject->getMaxChargeableIncome()
        );
    }

    /**
     * @test
     */
    public function setMaxChargeableIncomeWithBooleanResultsInInteger()
    {
        $this->subject->setMaxChargeableIncome(true);

        self::assertSame(
            1,
            $this->subject->getMaxChargeableIncome()
        );
    }

    /**
     * @test
     */
    public function getAgeOfChildInitiallyReturnsOne()
    {
        self::assertSame(
            1,
            $this->subject->getAgeOfChild()
        );
    }

    /**
     * @test
     */
    public function setAgeOfChildSetsAgeOfChild()
    {
        $this->subject->setAgeOfChild(123456);

        self::assertSame(
            123456,
            $this->subject->getAgeOfChild()
        );
    }

    /**
     * @test
     */
    public function setAgeOfChildWithStringResultsInInteger()
    {
        $this->subject->setAgeOfChild('123Test');

        self::assertSame(
            123,
            $this->subject->getAgeOfChild()
        );
    }

    /**
     * @test
     */
    public function setAgeOfChildWithBooleanResultsInInteger()
    {
        $this->subject->setAgeOfChild(true);

        self::assertSame(
            1,
            $this->subject->getAgeOfChild()
        );
    }

    /**
     * @test
     */
    public function getCareInitiallyReturnsNull()
    {
        self::assertNull($this->subject->getCare());
    }

    /**
     * @test
     */
    public function setCareSetsCare()
    {
        $instance = new Care();
        $this->subject->setCare($instance);

        self::assertSame(
            $instance,
            $this->subject->getCare()
        );
    }
}
