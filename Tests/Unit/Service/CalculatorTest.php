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
use JWeiland\ContributoryCalculator\Domain\Repository\CareRepository;
use JWeiland\ContributoryCalculator\Service\Calculator;
use Nimut\TestingFramework\TestCase\UnitTestCase;
use TYPO3\TestingFramework\Core\AccessibleObjectInterface;

/**
 * Test case for class \JWeiland\ContributoryCalculator\Service\Calculator.
 *
 * @copyright Copyright belongs to the respective authors
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 * @author Pascal Rinker <projects@jweiland.net>
 */
class CalculatorTest extends UnitTestCase
{
    /**
     * @var Calculator|\PHPUnit_Framework_MockObject_MockObject|AccessibleObjectInterface
     */
    protected $subject;

    public function setUp()
    {
        $this->subject = $this->getAccessibleMock(Calculator::class, null, [], '', false);
    }

    public function tearDown()
    {
        unset($this->subject);
    }

    /**
     * sets the dummy data for $this->subject for testing with data for child under 3 years
     */
    public function setDummyDataForChildUnder3Years()
    {
        // initialize step
        $step = new Step();
        $step->setDiscountInPercent(10); // equals 2 child
        // initialize chargeable income
        $chargeableIncome = new Care();
        $chargeableIncome->setDiscountInPercent(10); // equals 2101€ - 2500€ ; step a
        // initialize search
        $search = new Search();
        $search->setHoursOfChildcare(30);
        $search->setChildAge(1); // under 3 years
        // set settings
        $settings = [
            'hourlyRateUnder3Years' => 1.79,
            'openingTimeInWeeksPerYear' => 46,
            'subscriptionsPerYear' => 11
        ];
        $this->subject->__construct(
            $search,
            $settings,
            $this->createMock(CareRepository::class)
        );
        $this->subject->_set('step', $step);
        $this->subject->_set('chargeableIncome', $chargeableIncome);
    }

    /**
     * sets the dummy data for $this->subject for testing with data for child above 3 years
     */
    public function setDummyDataForChildAbove3Years()
    {
        // initialize step
        $step = new Step();
        $step->setDiscountInPercent(10); // equals 2 child
        // initialize chargeable income
        $chargeableIncome = new Care();
        $chargeableIncome->setDiscountInPercent(10); // equals 2101€ - 2500€ ; step a
        // initialize search
        $search = new Search();
        $search->setHoursOfChildcare(30);
        $search->setChildAge(2); // above 3 years
        // set settings
        $settings = [
            'hourlyRateAbove3Years' => 1.09,
            'openingTimeInWeeksPerYear' => 46,
            'subscriptionsPerYear' => 11
        ];
        $this->subject->__construct(
            $search,
            $settings,
            $this->createMock(CareRepository::class)
        );
        $this->subject->_set('step', $step);
        $this->subject->_set('chargeableIncome', $chargeableIncome);
    }

    /**
     * @test
     */
    public function getTotalAmountForChildUnder3Years()
    {
        $this->setDummyDataForChildUnder3Years();
        self::assertRegExp(
            '/^(181.8965){1}(\d)+/',
            trim($this->subject->getTotalAmount()),
            'result of total amount child under 3 years'
        );
    }

    /**
     * @test
     */
    public function getTotalAmountForChildAbove3Years()
    {
        $this->setDummyDataForChildAbove3Years();
        self::assertRegExp(
            '/^(110.7638){1}(\d)+/',
            trim($this->subject->getTotalAmount()),
            'result of total amount child above 3 years'
        );
    }

    /**
     * @test
     */
    public function getRegularFeeForChildUnder3Years()
    {
        $this->setDummyDataForChildUnder3Years();
        self::assertRegExp(
            '/^(224.5636){1}(\d)+/',
            trim($this->subject->_call('getRegularFee')),
            'result of regular fee child under 3 years'
        );
    }

    /**
     * @test
     */
    public function getRegularFeeForChildAbove3Years()
    {
        $this->setDummyDataForChildAbove3Years();
        self::assertRegExp(
            '/^(136.7454){1}(\d)+/',
            trim($this->subject->_call('getRegularFee')),
            'result of regular fee child above 3 years'
        );
    }

    /**
     * @test
     */
    public function getChargeableIncomeDiscountForChildUnder3Years()
    {
        $this->setDummyDataForChildUnder3Years();
        self::assertRegExp(
            '/^202.1072{1}(\d)+/',
            trim($this->subject->_call('getChargeableIncomeDiscount'))
        );
    }

    /**
     * @test
     */
    public function getChargeableIncomeDiscountForChildAbove3Years()
    {
        $this->setDummyDataForChildAbove3Years();
        self::assertRegExp(
            '/^123.0709{1}(\d)+/',
            trim($this->subject->_call('getChargeableIncomeDiscount'))
        );
    }
}
