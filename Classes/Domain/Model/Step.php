<?php

declare(strict_types=1);

/*
 * This file is part of the package jweiland/contributory_calculator.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace JWeiland\ContributoryCalculator\Domain\Model;

/**
 * Step
 */
class Step extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity
{

    /**
     * The name of the child
     *
     * @var string
     * @TYPO3\CMS\Extbase\Annotation\Validate("NotEmpty")
     */
    protected $name = '';

    /**
     * Discount for this child
     *
     * @var int
     */
    protected $discountInPercent = 0;

    /**
     * Returns the name
     *
     * @return string $name
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * Sets the name
     *
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * Returns the discountInPercent
     *
     * @return int discountInPercent
     */
    public function getDiscountInPercent(): int
    {
        return $this->discountInPercent;
    }

    /**
     * Sets the discountInPercent
     *
     * @param int $discountInPercent
     */
    public function setDiscountInPercent(int $discountInPercent): void
    {
        $this->discountInPercent = $discountInPercent;
    }
}
