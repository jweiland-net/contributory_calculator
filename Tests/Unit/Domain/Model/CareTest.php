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
class CareTest extends UnitTestCase
{
    /**
     * @var Care
     */
    protected $subject;

    public function setUp()
    {
        $this->subject = new Care();
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
    public function getTitleInitiallyReturnsEmptyString()
    {
        self::assertSame(
            '',
            $this->subject->getTitle()
        );
    }

    /**
     * @test
     */
    public function setTitleSetsTitle()
    {
        $this->subject->setTitle('foo bar');

        self::assertSame(
            'foo bar',
            $this->subject->getTitle()
        );
    }

    /**
     * @test
     */
    public function setTitleWithIntegerResultsInString()
    {
        $this->subject->setTitle(123);
        self::assertSame('123', $this->subject->getTitle());
    }

    /**
     * @test
     */
    public function setTitleWithBooleanResultsInString()
    {
        $this->subject->setTitle(true);
        self::assertSame('1', $this->subject->getTitle());
    }

    /**
     * @test
     */
    public function getValueBelow3InitiallyReturns0AsString()
    {
        self::assertSame(
            '0',
            $this->subject->getValueBelow3()
        );
    }

    /**
     * @test
     */
    public function setValueBelow3SetsValueBelow3()
    {
        $this->subject->setValueBelow3('foo bar');

        self::assertSame(
            'foo bar',
            $this->subject->getValueBelow3()
        );
    }

    /**
     * @test
     */
    public function setValueBelow3WithIntegerResultsInString()
    {
        $this->subject->setValueBelow3(123);
        self::assertSame('123', $this->subject->getValueBelow3());
    }

    /**
     * @test
     */
    public function setValueBelow3WithBooleanResultsInString()
    {
        $this->subject->setValueBelow3(true);
        self::assertSame('1', $this->subject->getValueBelow3());
    }

    /**
     * @test
     */
    public function getValueAbove3InitiallyReturns0AsString()
    {
        self::assertSame(
            '0',
            $this->subject->getValueAbove3()
        );
    }

    /**
     * @test
     */
    public function setValueAbove3SetsValueAbove3()
    {
        $this->subject->setValueAbove3('foo bar');

        self::assertSame(
            'foo bar',
            $this->subject->getValueAbove3()
        );
    }

    /**
     * @test
     */
    public function setValueAbove3WithIntegerResultsInString()
    {
        $this->subject->setValueAbove3(123);
        self::assertSame('123', $this->subject->getValueAbove3());
    }

    /**
     * @test
     */
    public function setValueAbove3WithBooleanResultsInString()
    {
        $this->subject->setValueAbove3(true);
        self::assertSame('1', $this->subject->getValueAbove3());
    }

    /**
     * @test
     */
    public function getValueForSearchReturnsValueBelow3()
    {
        $search = new Search();
        $search->setAgeOfChild(1);

        $this->subject->setValueBelow3('12');
        $this->subject->setValueAbove3('24');

        self::assertSame(
            '12',
            $this->subject->getValueForSearch($search)
        );
    }

    /**
     * @test
     */
    public function getValueForSearchReturnsValueAbove3()
    {
        $search = new Search();
        $search->setAgeOfChild(2);

        $this->subject->setValueBelow3('12');
        $this->subject->setValueAbove3('24');

        self::assertSame(
            '24',
            $this->subject->getValueForSearch($search)
        );
    }

    /**
     * @test
     */
    public function getValueForSearchWithInvalidAgeOfChildResultsInException()
    {
        $this->expectExceptionMessage('Value for ageOfChild is out of range');
        $this->expectExceptionCode(1604480845);

        $search = new Search();
        $search->setAgeOfChild(25);

        $this->subject->setValueBelow3('12');
        $this->subject->setValueAbove3('24');

        $this->subject->getValueForSearch($search);
    }
}
