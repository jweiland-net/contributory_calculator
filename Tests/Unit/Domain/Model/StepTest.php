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
 * Test case for class \JWeiland\ContributoryCalculator\Domain\Model\Step.
 *
 * @copyright Copyright belongs to the respective authors
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 * @author Pascal Rinker <projects@jweiland.net>
 */
class StepTest extends \TYPO3\CMS\Core\Tests\UnitTestCase
{
    /**
     * @var \JWeiland\ContributoryCalculator\Domain\Model\Step
     */
    protected $subject = null;
    
    public function setUp()
    {
        $this->subject = new \JWeiland\ContributoryCalculator\Domain\Model\Step();
    }
    
    public function tearDown()
    {
        unset($this->subject);
    }
    
    /**
     * @test
     */
    public function getNameInitiallyReturnsEmptyString()
    {
        $this->assertSame(
            '',
            $this->subject->getName()
        );
    }
    
    /**
     * @test
     */
    public function setNameSetsName()
    {
        $this->subject->setName('foo bar');
    
        $this->assertSame(
            'foo bar',
            $this->subject->getName()
        );
    }
    
    /**
     * @test
     */
    public function setNameWithIntegerResultsInString()
    {
        $this->subject->setName(123);
        $this->assertSame('123', $this->subject->getName());
    }
    
    /**
     * @test
     */
    public function setNameWithBooleanResultsInString()
    {
        $this->subject->setName(TRUE);
        $this->assertSame('1', $this->subject->getName());
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
}
