<?php

declare(strict_types=1);

/*
 * This file is part of the package jweiland/contributory_calculator.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace JWeiland\ContributoryCalculator\Domain\Model;

use TYPO3\CMS\Extbase\Utility\LocalizationUtility;

/**
 * ChargeableIncome
 */
class ChargeableIncome extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity
{
    /**
     * e.g. 2000€ - 4000€
     *
     * @var int
     * @TYPO3\CMS\Extbase\Annotation\Validate("NotEmpty")
     */
    protected $minimalIncome = 0;

    /**
     * maximalIncome
     *
     * @var int
     * @TYPO3\CMS\Extbase\Annotation\Validate("NotEmpty")
     */
    protected $maximalIncome = 0;

    /**
     * The percentage from parents base module base amount
     *
     * @var int
     * @TYPO3\CMS\Extbase\Annotation\Validate("NotEmpty")
     */
    protected $discountInPercent = 0;

    /**
     * Returns the minimalIncome
     *
     * @return int minimalIncome
     */
    public function getMinimalIncome(): int
    {
        return $this->minimalIncome;
    }

    /**
     * Sets the minimalIncome
     *
     * @param int $minimalIncome
     */
    public function setMinimalIncome(int $minimalIncome): void
    {
        $this->minimalIncome = $minimalIncome;
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

    /**
     * Returns the maximalIncome
     *
     * @return int $maximalIncome
     */
    public function getMaximalIncome(): int
    {
        return $this->maximalIncome;
    }

    /**
     * Sets the maximalIncome
     *
     * @param int $maximalIncome
     */
    public function setMaximalIncome(int $maximalIncome): void
    {
        $this->maximalIncome = $maximalIncome;
    }

    /**
     * Returns the label
     *
     * @return string
     */
    public function getLabel(): string
    {
        if ($this->getMaximalIncome() === 0 && $this->getMinimalIncome() !== 0) {
            return $this->translate('chargeableIncome.about') . ' ' .
            $this->getMinimalIncome() . $this->translate('currency');
        }
        if ($this->getMinimalIncome() === 0 && $this->getMaximalIncome() !== 0) {
            return $this->translate('chargeableIncome.until') . ' ' .
            $this->getMaximalIncome() . $this->translate('currency');
        }
        return $this->minimalIncome . $this->translate('currency') .
            ' - ' . $this->maximalIncome . $this->translate('currency');
    }

    /**
     * Returns the translation for $key
     *
     * @param string $key
     * @return string|null
     */
    protected function translate(string $key): ?string
    {
        return LocalizationUtility::translate($key, 'contributory_calculator');
    }
}
