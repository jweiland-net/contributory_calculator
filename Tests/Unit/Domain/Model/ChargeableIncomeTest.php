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

use JWeiland\ContributoryCalculator\Domain\Model\ChargeableIncome;

/**
 * Test case for class \JWeiland\ContributoryCalculator\Domain\Model\ChargeableIncome.
 *
 * @copyright Copyright belongs to the respective authors
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 * @author Pascal Rinker <projects@jweiland.net>
 */
class ChargeableIncomeTest extends \TYPO3\CMS\Core\Tests\UnitTestCase
{
    /**
     * @var \JWeiland\ContributoryCalculator\Domain\Model\ChargeableIncome
     */
    protected $subject = null;
    
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
        $this->assertSame(
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
        
        $this->assertSame(
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
        
        $this->assertSame(
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
        
        $this->assertSame(
            1,
            $this->subject->getMinimalIncome()
        );
    }
    
    /**
     * @test
     */
    public function getMaximalIncomeInitiallyReturnsZero()
    {
        $this->assertSame(
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
        
        $this->assertSame(
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
        
        $this->assertSame(
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
        
        $this->assertSame(
            1,
            $this->subject->getMaximalIncome()
        );
    }
    
    /**
     * @test
     */
    public function getDiscountInPercentInitiallyReturnsZero()
    {
        $this->assertSame(
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
        
        $this->assertSame(
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
        
        $this->assertSame(
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
        
        $this->assertSame(
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
        $subject = $this->getMock(ChargeableIncome::class, array('translate'));
        $subject
            ->expects($this->at(0))
            ->method('translate')
            ->with($this->equalTo('currency'))
            ->willReturn('€');
        $subject
            ->expects($this->at(1))
            ->method('translate')
            ->with($this->equalTo('currency'))
            ->willReturn('€');
        
        $this->assertSame(
            '0€ - 0€',
            $subject->getLabel()
        );
    }
    
    /**
     * @return array
     */
    public function getLabelDataProvider()
    {
        $income = array();
        $income['negative value'] = array(-11, '1€ - -11€');
        $income['positive edgecase'] = array(1, '1€ - 1€');
        $income['positive value'] = array(40, '1€ - 40€');
        
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
        $subject = $this->getMock(ChargeableIncome::class, array('translate'));
        $subject->setMinimalIncome(1);
        $subject->setMaximalIncome($maximalIncome);
        $subject
            ->expects($this->exactly(2))
            ->method('translate')
            ->with($this->equalTo('currency'))
            ->willReturn('€');
        $this->assertSame(
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
        $subject = $this->getMock(ChargeableIncome::class, array('translate'));
        $subject->setMinimalIncome(100);
        $subject->setMaximalIncome(0);
        $subject
            ->expects($this->at(0))
            ->method('translate')
            ->with($this->equalTo('chargeableIncome.about'))
            ->willReturn('about');
        $subject
            ->expects($this->at(1))
            ->method('translate')
            ->with($this->equalTo('currency'))
            ->willReturn('€');
        
        $this->assertSame(
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
        $subject = $this->getMock(ChargeableIncome::class, array('translate'));
        $subject->setMaximalIncome(100);
        $subject
            ->expects($this->at(0))
            ->method('translate')
            ->with($this->equalTo('chargeableIncome.until'))
            ->willReturn('until');
        $subject
            ->expects($this->at(1))
            ->method('translate')
            ->with($this->equalTo('currency'))
            ->willReturn('€');
        
        $this->assertSame(
            'until 100€',
            $subject->getLabel()
        );
    }
}
