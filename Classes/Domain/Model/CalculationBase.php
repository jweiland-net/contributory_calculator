<?php

declare(strict_types=1);

/*
 * This file is part of the package jweiland/contributory-calculator.
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
    protected int $yearOfValidity = 0;

    protected float $valueBelow3 = 0.0;

    protected float $valueAbove3 = 0.0;

    protected Care $careForm;

    protected int $minimalIncome = 0;

    protected int $maximumIncome = 0;

    /**
     * @throws \Exception
     */
    public function getValueForSearch(Search $search): float
    {
        if ($search->getAgeOfChild() === 1) {
            return $this->getValueBelow3();
        }

        if ($search->getAgeOfChild() === 2) {
            return $this->getValueAbove3();
        }

        throw new \RuntimeException('Value for ageOfChild is out of range', 1604480845);
    }

    public function getYearOfValidity(): int
    {
        return $this->yearOfValidity;
    }

    public function setYearOfValidity(int $yearOfValidity): void
    {
        $this->yearOfValidity = $yearOfValidity;
    }

    public function getValueBelow3(): float
    {
        return $this->valueBelow3;
    }

    public function setValueBelow3(float $valueBelow3): void
    {
        $this->valueBelow3 = $valueBelow3;
    }

    public function getValueAbove3(): float
    {
        return $this->valueAbove3;
    }

    public function setValueAbove3(float $valueAbove3): void
    {
        $this->valueAbove3 = $valueAbove3;
    }

    public function getCareForm(): Care
    {
        return $this->careForm;
    }

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
