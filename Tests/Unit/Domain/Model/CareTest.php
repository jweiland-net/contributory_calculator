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
use TYPO3\TestingFramework\Core\Unit\UnitTestCase;

/**
 * Test case
 */
class CareTest extends UnitTestCase
{
    /**
     * @var Care
     */
    protected $subject;

    protected function setUp(): void
    {
        $this->subject = new Care();
    }

    protected function tearDown(): void
    {
        unset(
            $this->subject,
        );
    }

    /**
     * @test
     */
    public function getTitleInitiallyReturnsEmptyString(): void
    {
        self::assertSame(
            '',
            $this->subject->getTitle(),
        );
    }

    /**
     * @test
     */
    public function setTitleSetsTitle(): void
    {
        $this->subject->setTitle('foo bar');

        self::assertSame(
            'foo bar',
            $this->subject->getTitle(),
        );
    }
}
