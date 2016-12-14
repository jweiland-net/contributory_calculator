<?php
namespace JWeiland\ContributoryCalculator\Domain\Model;
    
    /***************************************************************
     *  Copyright notice
     *  (c) 2016 Pascal Rinker <projects@jweiland.net>, jweiland.net
     *  All rights reserved
     *  This script is part of the TYPO3 project. The TYPO3 project is
     *  free software; you can redistribute it and/or modify
     *  it under the terms of the GNU General Public License as published by
     *  the Free Software Foundation; either version 3 of the License, or
     *  (at your option) any later version.
     *  The GNU General Public License can be found at
     *  http://www.gnu.org/copyleft/gpl.html.
     *  This script is distributed in the hope that it will be useful,
     *  but WITHOUT ANY WARRANTY; without even the implied warranty of
     *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
     *  GNU General Public License for more details.
     *  This copyright notice MUST APPEAR in all copies of the script!
     ***************************************************************/

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
     * @var int
     */
    protected $hoursOfChildcare = 0;
    
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
        $this->chargeableIncome = $chargeableIncome;
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
        $this->step = $step;
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
        $this->childAge = $childAge;
    }
    
    /**
     * Returns the hoursOfChildcare
     *
     * @return int $hoursOfChildcare
     */
    public function getHoursOfChildcare()
    {
        return $this->hoursOfChildcare;
    }
    
    /**
     * Sets the hoursOfChildcare
     *
     * @param int $hoursOfChildcare
     * @return void
     */
    public function setHoursOfChildcare($hoursOfChildcare)
    {
        $this->hoursOfChildcare = $hoursOfChildcare;
    }
    
}