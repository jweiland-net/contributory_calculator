<?php

declare(strict_types=1);

/*
 * This file is part of the package jweiland/contributory-calculator.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace JWeiland\ContributoryCalculator\Domain\Model;

use TYPO3\CMS\Extbase\Annotation as Extbase;
use TYPO3\CMS\Extbase\DomainObject\AbstractEntity;

/**
 * Domain model which represents the values of user request from FE context
 */
class Search extends AbstractEntity
{
    /**
     * This values will be filled by the customer from the website
     */
    protected int $chargeableIncome = 0;

    /**
     * Below 3 years: 1
     * Above 3 years: 2
     */
    protected int $ageOfChild = 1;

    protected int $yearOfValidity = 0;

    #[Extbase\Validate(['validator' => 'NotEmpty'])]
    protected ?Care $care = null;

    public function getChargeableIncome(): int
    {
        return $this->chargeableIncome;
    }

    public function setChargeableIncome(int $chargeableIncome): void
    {
        $this->chargeableIncome = abs($chargeableIncome);
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

    public function getYearOfValidity(): int
    {
        return $this->yearOfValidity;
    }

    public function setYearOfValidity(int $yearOfValidity): void
    {
        $this->yearOfValidity = $yearOfValidity;
    }
}
