<?php

namespace JWeiland\ContributoryCalculator\Tests\Unit\Domain\Model;
    
/*
 * This file is part of the TYPO3 CMS project.
 *
 * It is free software; you can redistribute it and/or modify it under
 * the terms of the GNU General Public License, either version 2
 * of the License, or any later version.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 * The TYPO3 project - inspiring people to share!
 */

/**
 * Test case for class \JWeiland\ContributoryCalculator\Domain\Model\Search.
 *
 * @copyright Copyright belongs to the respective authors
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 * @author Pascal Rinker <projects@jweiland.net>
 */
class SearchTest extends \TYPO3\CMS\Core\Tests\UnitTestCase
{
    /**
     * @var \JWeiland\ContributoryCalculator\Domain\Model\Search
     */
    protected $subject = null;
    
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
        $this->assertSame(
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
    
        $this->assertSame(
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
    
        $this->assertSame(
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
    
        $this->assertSame(
            1,
            $this->subject->getChildAge()
        );
    }
    
    /**
     * @test
     */
    public function getChargeableIncomeInitiallyReturnsZero()
    {
        $this->assertSame(
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
    
        $this->assertSame(
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
    
        $this->assertSame(
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
    
        $this->assertSame(
            1,
            $this->subject->getChargeableIncome()
        );
    }
    
    /**
     * @test
     */
    public function getStepInitiallyReturnsZero()
    {
        $this->assertSame(
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
    
        $this->assertSame(
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
    
        $this->assertSame(
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
    
        $this->assertSame(
            1,
            $this->subject->getStep()
        );
    }
    
    /**
     * @test
     */
    public function getHoursOfChildcareInitiallyReturnsZero()
    {
        $this->assertSame(
            0,
            $this->subject->getHoursOfChildcare()
        );
    }
    
    /**
     * @test
     */
    public function setHoursOfChildcareSetsHoursOfChildcare()
    {
        $this->subject->setHoursOfChildcare(123456);
    
        $this->assertSame(
            123456,
            $this->subject->getHoursOfChildcare()
        );
    }
    
    /**
     * @test
     */
    public function setHoursOfChildcareWithStringResultsInInteger()
    {
        $this->subject->setHoursOfChildcare('123Test');
    
        $this->assertSame(
            123,
            $this->subject->getHoursOfChildcare()
        );
    }
    
    /**
     * @test
     */
    public function setHoursOfChildcareWithBooleanResultsInInteger()
    {
        $this->subject->setHoursOfChildcare(true);
    
        $this->assertSame(
            1,
            $this->subject->getHoursOfChildcare()
        );
    }
}
