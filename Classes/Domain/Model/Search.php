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
 * Search
 */
class Search extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity
{
    /**
     * Integer for child under 3 years
     */
    const CHILD_UNDER_3_YEARS = 1;

    /**
     * Integer for child above 3 years
     */
    const CHILD_ABOVE_3_YEARS = 2;

    /**
     * childAge
     *
     * @var int
     */
    protected $childAge = 1;

    /**
     * chargeableIncome
     *
     * @var int
     */
    protected $chargeableIncome = 0;

    /**
     * step
     *
     * @var int
     */
    protected $step = 0;

    /**
     * hoursOfChildcare
     *
     * @var float
     */
    protected $hoursOfChildcare = 0.0;

    /**
     * Returns the chargeableIncome
     *
     * @return int $chargeableIncome
     */
    public function getChargeableIncome(): int
    {
        return $this->chargeableIncome;
    }

    /**
     * Sets the chargeableIncome
     *
     * @param int $chargeableIncome
     */
    public function setChargeableIncome(int $chargeableIncome): void
    {
        $this->chargeableIncome = $chargeableIncome;
    }

    /**
     * Returns the step
     *
     * @return int $step
     */
    public function getStep(): int
    {
        return $this->step;
    }

    /**
     * Sets the step
     *
     * @param int $step
     */
    public function setStep(int $step): void
    {
        $this->step = $step;
    }

    /**
     * Returns the childAge
     *
     * @return int $childAge
     */
    public function getChildAge(): int
    {
        return $this->childAge;
    }

    /**
     * Sets the childAge
     *
     * @param int $childAge
     */
    public function setChildAge(int $childAge): void
    {
        $this->childAge = $childAge;
    }

    /**
     * Returns the hoursOfChildcare
     *
     * @return float $hoursOfChildcare
     */
    public function getHoursOfChildcare(): float
    {
        return $this->hoursOfChildcare;
    }

    /**
     * Sets the hoursOfChildcare
     *
     * @param float $hoursOfChildcare
     */
    public function setHoursOfChildcare(float $hoursOfChildcare): void
    {
        $this->hoursOfChildcare = $hoursOfChildcare;
    }
}
