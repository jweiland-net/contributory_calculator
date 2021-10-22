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
 * Domain model which represents a calculation base for care forms
 */
class CalculationBase extends AbstractEntity
{
    /**
     * @var int
     */
    protected $yearOfValidity = 0;

    /**
     * @var float
     */
    protected $valueBelow3 = 0.0;

    /**
     * @var float
     */
    protected $valueAbove3 = 0.0;

    /**
     * @var Care
     */
    protected $careForm;

    /**
     * @var int
     */
    protected $minimalIncome = 0;

    /**
     * @var int
     */
    protected $maximumIncome = 0;

    public function getValueForSearch(Search $search): float
    {
        if ($search->getAgeOfChild() === 1) {
            return $this->getValueBelow3();
        }
        if ($search->getAgeOfChild() === 2) {
            return $this->getValueAbove3();
        }
        throw new \Exception('Value for ageOfChild is out of range', 1604480845);
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

    /**
     * @return float
     */
    public function getValueBelow3(): float
    {
        return $this->valueBelow3;
    }

    /**
     * @param float $valueBelow3
     */
    public function setValueBelow3(float $valueBelow3): void
    {
        $this->valueBelow3 = $valueBelow3;
    }

    /**
     * @return float
     */
    public function getValueAbove3(): float
    {
        return $this->valueAbove3;
    }

    /**
     * @param float $valueAbove3
     */
    public function setValueAbove3(float $valueAbove3): void
    {
        $this->valueAbove3 = $valueAbove3;
    }

    /**
     * @return Care
     */
    public function getCareForm(): Care
    {
        return $this->careForm;
    }

    /**
     * @param Care $careForm
     */
    public function setCareForm(Care $careForm): void
    {
        $this->careForm = $careForm;
    }

    public function getMinimalIncome(): int
    {
        return $this->minimalIncome;
    }

    public function setMinimalIncome(int $minimalIncome): void
    {
        $this->minimalIncome = $minimalIncome;
    }

    public function getMaximumIncome(): int
    {
        return $this->maximumIncome;
    }

    public function setMaximumIncome(int $maximumIncome): void
    {
        $this->maximumIncome = $maximumIncome;
    }
}
