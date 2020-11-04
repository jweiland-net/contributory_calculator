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
     * @var int
     */
    protected $chargeableIncome = 25000;

    /**
     * Below 3 years: 1
     * Above 3 years: 2
     *
     * @var int
     */
    protected $ageOfChild = 1;

    /**
     * @var \JWeiland\ContributoryCalculator\Domain\Model\Care
     * @validate NotEmpty
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
}
