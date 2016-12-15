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
        if ($this->getMaximalIncome() === 0 && $this->getMinimalIncome() !== 0) {
            return $this->translate('chargeableIncome.about') . ' ' .
            $this->getMinimalIncome() . $this->translate('currency');
        } elseif ($this->getMinimalIncome() === 0 && $this->getMaximalIncome() !== 0) {
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