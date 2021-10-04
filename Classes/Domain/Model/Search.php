<?php

declare(strict_types=1);

/*
 * This file is part of the package jweiland/contributory_calculator.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace JWeiland\ContributoryCalculator\Domain\Model;

use TYPO3\CMS\Extbase\DomainObject\AbstractEntity;

/**
 * Domain model which represents the values of user request from FE context
 */
class Search extends AbstractEntity
{
    /**
     * This values will be filled by the customer from the website
     *
     * @var int
     */
    protected $chargeableIncome = 0;

    /**
     * This values will be filled by FlexForm settings of plugin
     *
     * @var int
     */
    protected $minChargeableIncome = 0;

    /**
     * This values will be filled by FlexForm settings of plugin
     *
     * @var int
     */
    protected $maxChargeableIncome = 0;

    /**
     * Below 3 years: 1
     * Above 3 years: 2
     *
     * @var int
     */
    protected $ageOfChild = 1;

    /**
     * @var int
     */
    protected $yearOfValidity = 0;

    /**
     * @var \JWeiland\ContributoryCalculator\Domain\Model\Care
     * @TYPO3\CMS\Extbase\Annotation\Validate("NotEmpty")
     */
    protected $care;

    public function getChargeableIncome(): int
    {
        return $this->chargeableIncome;
    }

    public function setChargeableIncome(int $chargeableIncome): void
    {
        $this->chargeableIncome = abs($chargeableIncome);
    }

    public function getMinChargeableIncome(): int
    {
        return $this->minChargeableIncome;
    }

    public function setMinChargeableIncome(int $minChargeableIncome): void
    {
        $this->minChargeableIncome = $minChargeableIncome;
    }

    public function getMaxChargeableIncome(): int
    {
        return $this->maxChargeableIncome;
    }

    public function setMaxChargeableIncome(int $maxChargeableIncome): void
    {
        $this->maxChargeableIncome = $maxChargeableIncome;
    }

    public function getAgeOfChild(): int
    {
        return $this->ageOfChild;
    }

    public function setAgeOfChild(int $ageOfChild): void
    {
        $this->ageOfChild = $ageOfChild;
    }

    public function getCare(): ?Care
    {
        return $this->care;
    }

    public function setCare(?Care $care): void
    {
        $this->care = $care;
    }

    /**
     * @return int
     */
    public function getYearOfValidity(): int
    {
        return $this->yearOfValidity;
    }

    /**
     * @param int $yearOfValidity
     */
    public function setYearOfValidity(int $yearOfValidity): void
    {
        $this->yearOfValidity = $yearOfValidity;
    }
}
