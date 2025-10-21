<?php

declare(strict_types=1);

/*
 * This file is part of the package jweiland/contributory-calculator.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace JWeiland\ContributoryCalculator\Tests\Unit\Domain\Model;

use JWeiland\ContributoryCalculator\Domain\Model\Care;
use JWeiland\ContributoryCalculator\Domain\Model\Search;
use PHPUnit\Framework\Attributes\Test;
use TYPO3\TestingFramework\Core\Unit\UnitTestCase;

/**
 * Test case
 */
class SearchTest extends UnitTestCase
{
    protected Search $subject;

    protected function setUp(): void
    {
        $this->subject = new Search();
    }

    protected function tearDown(): void
    {
        unset(
            $this->subject,
        );
    }

    #[Test]
    public function getChargeableIncomeInitiallyReturns0(): void
    {
        self::assertSame(
            0,
            $this->subject->getChargeableIncome(),
        );
    }

    #[Test]
    public function setChargeableIncomeSetsChargeableIncome(): void
    {
        $this->subject->setChargeableIncome(36000);

        self::assertSame(
            36000,
            $this->subject->getChargeableIncome(),
        );
    }

    #[Test]
    public function getAgeOfChildInitiallyReturnsOne(): void
    {
        self::assertSame(
            1,
            $this->subject->getAgeOfChild(),
        );
    }

    #[Test]
    public function setAgeOfChildSetsAgeOfChild(): void
    {
        $this->subject->setAgeOfChild(123456);

        self::assertSame(
            123456,
            $this->subject->getAgeOfChild(),
        );
    }

    #[Test]
    public function getCareInitiallyReturnsNull(): void
    {
        self::assertNull($this->subject->getCare());
    }

    #[Test]
    public function setCareSetsCare(): void
    {
        $instance = new Care();
        $this->subject->setCare($instance);

        self::assertSame(
            $instance,
            $this->subject->getCare(),
        );
    }
}
