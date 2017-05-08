<?php
namespace JWeiland\ContributoryCalculator\Domain\Model;

/*
 * This file is part of the TYPO3 CMS project.
 *
 * It is free software; you can redistribute it and/or modify it under
 * the terms of the GNU General Public License, either version 2
 * of the License, or any later version.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 * The TYPO3 project - inspiring people to share!
 */

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
    public function getChargeableIncome()
    {
        return $this->chargeableIncome;
    }

    /**
     * Sets the chargeableIncome
     *
     * @param int $chargeableIncome
     * @return void
     */
    public function setChargeableIncome($chargeableIncome)
    {
        $this->chargeableIncome = (int)$chargeableIncome;
    }

    /**
     * Returns the step
     *
     * @return int $step
     */
    public function getStep()
    {
        return $this->step;
    }

    /**
     * Sets the step
     *
     * @param int $step
     * @return void
     */
    public function setStep($step)
    {
        $this->step = (int)$step;
    }

    /**
     * Returns the childAge
     *
     * @return int $childAge
     */
    public function getChildAge()
    {
        return $this->childAge;
    }

    /**
     * Sets the childAge
     *
     * @param int $childAge
     * @return void
     */
    public function setChildAge($childAge)
    {
        $this->childAge = (int)$childAge;
    }

    /**
     * Returns the hoursOfChildcare
     *
     * @return float $hoursOfChildcare
     */
    public function getHoursOfChildcare()
    {
        return $this->hoursOfChildcare;
    }

    /**
     * Sets the hoursOfChildcare
     *
     * @param float $hoursOfChildcare
     * @return void
     */
    public function setHoursOfChildcare($hoursOfChildcare)
    {
        $this->hoursOfChildcare = (float)$hoursOfChildcare;
    }

}