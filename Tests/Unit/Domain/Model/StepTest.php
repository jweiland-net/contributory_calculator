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
 * Test case for class \JWeiland\ContributoryCalculator\Domain\Model\Step.
 *
 * @copyright Copyright belongs to the respective authors
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 * @author Pascal Rinker <projects@jweiland.net>
 */
class StepTest extends UnitTestCase
{
    /**
     * @var \JWeiland\ContributoryCalculator\Domain\Model\Step
     */
    protected $subject;

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
        self::assertSame(
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

        self::assertSame(
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
        self::assertSame('123', $this->subject->getName());
    }

    /**
     * @test
     */
    public function setNameWithBooleanResultsInString()
    {
        $this->subject->setName(true);
        self::assertSame('1', $this->subject->getName());
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
}
