<?php
namespace JWeiland\ContributoryCalculator\Service;

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
use JWeiland\ContributoryCalculator\Domain\Model\ChargeableIncome;
use JWeiland\ContributoryCalculator\Domain\Model\Search;
use JWeiland\ContributoryCalculator\Domain\Model\Step;
use JWeiland\ContributoryCalculator\Domain\Repository\ChargeableIncomeRepository;
use JWeiland\ContributoryCalculator\Domain\Repository\StepRepository;

/**
 * Class Calculator
 *
 * @package JWeiland\ContributoryCalculator\Service
 */
class Calculator
{
    /**
     * Search object
     *
     * @var Search
     */
    protected $search;
    
    /**
     * Hourly rate
     *
     * @var float
     */
    protected $hourlyRate = 0.0;
    
    /**
     * Opening time in weeks
     *
     * @var int
     */
    protected $openingTimeInWeeksPerYear = 0;
    
    /**
     * Subscriptions per year
     *
     * @var int
     */
    protected $subscriptionsPerYear = 0;
    
    /**
     * @var Step
     */
    protected $step;
    
    /**
     * @var ChargeableIncome
     */
    protected $chargeableIncome;
    
    /**
     * Step repository
     *
     * @var StepRepository
     */
    protected $stepRepository;
    
    /**
     * Chargeable income repository
     *
     * @var ChargeableIncomeRepository
     */
    protected $chargeableIncomeRepository;
    
    /**
     * Injects the stepRepository
     *
     * @param StepRepository $stepRepository
     * @return void
     */
    public function injectStepRepository(StepRepository $stepRepository)
    {
        $this->stepRepository = $stepRepository;
    }
    
    /**
     * Injects the chargeable income repository
     *
     * @param ChargeableIncomeRepository $chargeableIncomeRepository
     * @return void
     */
    public function injectChargeableIncomeRepository(ChargeableIncomeRepository $chargeableIncomeRepository)
    {
        $this->chargeableIncomeRepository = $chargeableIncomeRepository;
    }
    
    /**
     * Calculator constructor.
     *
     * @param Search $search
     * @param array $settings
     */
    public function __construct($search, $settings)
    {
        $this->search = $search;
        $this->settings = $settings;
        if ($search->getChildAge() === Search::CHILD_UNDER_3_YEARS) {
            $this->hourlyRate = $settings['hourlyRateUnder3Years'];
        } else {
            $this->hourlyRate = $settings['hourlyRateAbove3Years'];
        }
        $this->openingTimeInWeeksPerYear = $settings['openingTimeInWeeksPerYear'];
        $this->subscriptionsPerYear = $settings['subscriptionsPerYear'];
        if ($this->search->getHoursOfChildcare() > 50) {
            $this->search->setHoursOfChildcare(50);
        }
    }
    
    /**
     * Initializes the objects step and chargeable income
     *
     * @return void
     */
    public function initializeObject()
    {
        $this->step = $this->stepRepository->findByUid($this->search->getStep());
        $this->chargeableIncome = $this->chargeableIncomeRepository->findByUid($this->search->getChargeableIncome());
    }
    
    /**
     * Returns the total amount
     *
     * @return float
     */
    public function getTotalAmount()
    {
        // calculate total amount
        return $this->getChargeableIncomeDiscount()  * $this->getPercentFromHundred($this->step->getDiscountInPercent());
    }
    
    /**
     * Returns the regular fee multiplied with chargeable income discount
     *
     * @return float
     */
    protected function getChargeableIncomeDiscount()
    {
        return $this->getRegularFee() * $this->getPercentFromHundred($this->chargeableIncome->getDiscountInPercent());
    }
        
    /**
     * Returns the regular fee
     *
     * @return float
     */
    protected function getRegularFee()
    {
        $result = $this->hourlyRate * $this->search->getHoursOfChildcare() * $this->openingTimeInWeeksPerYear;
        $result /= $this->subscriptionsPerYear;
        return $result;
    }
    
    /**
     * Returns percent from hundred like 0.8 if
     * discount in percent equals 20(%)
     *
     * @param float $discountInPercent
     * @return float
     */
    protected function getPercentFromHundred($discountInPercent)
    {
        return (100 - $discountInPercent) / 100;
    }
}