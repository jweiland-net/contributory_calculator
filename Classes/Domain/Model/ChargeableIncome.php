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
use TYPO3\CMS\Extbase\Utility\DebuggerUtility;
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
     * @validate NotEmpty
     */
    protected $minimalIncome = 0;
    
    /**
     * maximalIncome
     *
     * @var int
     * @validate NotEmpty
     */
    protected $maximalIncome = 0;
    
    /**
     * The percentage from parents base module base amount
     *
     * @var int
     * @validate NotEmpty
     */
    protected $discountInPercent = 0;
    
    /**
     * Returns the minimalIncome
     *
     * @return int minimalIncome
     */
    public function getMinimalIncome()
    {
        return $this->minimalIncome;
    }
    
    /**
     * Sets the minimalIncome
     *
     * @param string $minimalIncome
     * @return void
     */
    public function setMinimalIncome($minimalIncome)
    {
        $this->minimalIncome = (int)$minimalIncome;
    }
    
    /**
     * Returns the discountInPercent
     *
     * @return int discountInPercent
     */
    public function getDiscountInPercent()
    {
        return $this->discountInPercent;
    }
    
    /**
     * Sets the discountInPercent
     *
     * @param int $discountInPercent
     * @return void
     */
    public function setDiscountInPercent($discountInPercent)
    {
        $this->discountInPercent = (int)$discountInPercent;
    }
    
    /**
     * Returns the maximalIncome
     *
     * @return int $maximalIncome
     */
    public function getMaximalIncome()
    {
        return $this->maximalIncome;
    }
    
    /**
     * Sets the maximalIncome
     *
     * @param int $maximalIncome
     * @return void
     */
    public function setMaximalIncome($maximalIncome)
    {
        $this->maximalIncome = (int)$maximalIncome;
    }
    
    /**
     * Returns the label
     *
     * @return string
     */
    public function getLabel()
    {
        if ($this->getMaximalIncome() === -1) {
            return $this->translate('chargeableIncome.about') . ' ' .
            $this->getMinimalIncome() . $this->translate('currency');
        } elseif ($this->getMinimalIncome() === 0) {
            return $this->translate('chargeableIncome.until') . ' ' .
            $this->getMaximalIncome() . $this->translate('currency');
        } else {
            return $this->minimalIncome . $this->translate('currency') .
            ' - ' . $this->maximalIncome . $this->translate('currency');
        }
    }
    
    /**
     * Returns the translation for $key
     *
     * @param string $key
     * @return string
     */
    protected function translate($key)
    {
        return LocalizationUtility::translate($key, 'contributory_calculator');
    }
    
}