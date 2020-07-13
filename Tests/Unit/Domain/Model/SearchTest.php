<?php

/*
 * This file is part of the package jweiland/contributory_calculator.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace JWeiland\ContributoryCalculator\Tests\Unit\Domain\Model;

use Nimut\TestingFramework\TestCase\UnitTestCase;

/**
 * Test case for class \JWeiland\ContributoryCalculator\Domain\Model\Search.
 *
 * @copyright Copyright belongs to the respective authors
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 * @author Pascal Rinker <projects@jweiland.net>
 */
class SearchTest extends UnitTestCase
{
    /**
     * @var \JWeiland\ContributoryCalculator\Domain\Model\Search
     */
    protected $subject;

    public function setUp()
    {
        $this->subject = new \JWeiland\ContributoryCalculator\Domain\Model\Search();
    }

    public function tearDown()
    {
        unset($this->subject);
    }

    /**
     * @test
     */
    public function getChildAgeInitiallyReturnsOne()
    {
        self::assertSame(
            1,
            $this->subject->getChildAge()
        );
    }

    /**
     * @test
     */
    public function setChildAgeSetsChildAge()
    {
        $this->subject->setChildAge(123456);

        self::assertSame(
            123456,
            $this->subject->getChildAge()
        );
    }

    /**
     * @test
     */
    public function setChildAgeWithStringResultsInInteger()
    {
        $this->subject->setChildAge('123Test');

        self::assertSame(
            123,
            $this->subject->getChildAge()
        );
    }

    /**
     * @test
     */
    public function setChildAgeWithBooleanResultsInInteger()
    {
        $this->subject->setChildAge(true);

        self::assertSame(
            1,
            $this->subject->getChildAge()
        );
    }

    /**
     * @test
     */
    public function getChargeableIncomeInitiallyReturnsZero()
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
        $this->subject->setChargeableIncome(123456);

        self::assertSame(
            123456,
            $this->subject->getChargeableIncome()
        );
    }

    /**
     * @test
     */
    public function setChargeableIncomeWithStringResultsInInteger()
    {
        $this->subject->setChargeableIncome('123Test');

        self::assertSame(
            123,
            $this->subject->getChargeableIncome()
        );
    }

    /**
     * @test
     */
    public function setChargeableIncomeWithBooleanResultsInInteger()
    {
        $this->subject->setChargeableIncome(true);

        self::assertSame(
            1,
            $this->subject->getChargeableIncome()
        );
    }

    /**
     * @test
     */
    public function getStepInitiallyReturnsZero()
    {
        self::assertSame(
            0,
            $this->subject->getStep()
        );
    }

    /**
     * @test
     */
    public function setStepSetsStep()
    {
        $this->subject->setStep(123456);

        self::assertSame(
            123456,
            $this->subject->getStep()
        );
    }

    /**
     * @test
     */
    public function setStepWithStringResultsInInteger()
    {
        $this->subject->setStep('123Test');

        self::assertSame(
            123,
            $this->subject->getStep()
        );
    }

    /**
     * @test
     */
    public function setStepWithBooleanResultsInInteger()
    {
        $this->subject->setStep(true);

        self::assertSame(
            1,
            $this->subject->getStep()
        );
    }

    /**
     * @test
     */
    public function getHoursOfChildcareInitiallyReturnsZero()
    {
        self::assertSame(
            0.0,
            $this->subject->getHoursOfChildcare()
        );
    }

    /**
     * @test
     */
    public function setHoursOfChildcareSetsHoursOfChildcare()
    {
        $this->subject->setHoursOfChildcare(1234.56);

        self::assertSame(
            1234.56,
            $this->subject->getHoursOfChildcare()
        );
    }
}
