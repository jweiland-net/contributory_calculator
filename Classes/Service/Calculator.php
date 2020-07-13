<?php

declare(strict_types=1);

/*
 * This file is part of the package jweiland/contributory_calculator.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace JWeiland\ContributoryCalculator\Service;

use JWeiland\ContributoryCalculator\Domain\Model\ChargeableIncome;
use JWeiland\ContributoryCalculator\Domain\Model\Search;
use JWeiland\ContributoryCalculator\Domain\Model\Step;
use JWeiland\ContributoryCalculator\Domain\Repository\ChargeableIncomeRepository;
use JWeiland\ContributoryCalculator\Domain\Repository\StepRepository;

/**
 * Class Calculator
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
     * @param Search $search
     * @param array $settings
     * @param StepRepository $stepRepository
     * @param ChargeableIncomeRepository $chargeableIncomeRepository
     */
    public function __construct(
        Search $search,
        array $settings,
        StepRepository $stepRepository,
        ChargeableIncomeRepository $chargeableIncomeRepository
    ) {
        $this->stepRepository = $stepRepository;
        $this->chargeableIncomeRepository = $chargeableIncomeRepository;
        $this->search = $search;
        if ($search->getChildAge() === Search::CHILD_UNDER_3_YEARS) {
            $this->hourlyRate = $settings['hourlyRateUnder3Years'];
        } else {
            $this->hourlyRate = $settings['hourlyRateAbove3Years'];
        }
        $this->openingTimeInWeeksPerYear = $settings['openingTimeInWeeksPerYear'];
        $this->subscriptionsPerYear = $settings['subscriptionsPerYear'];
        $maxHoursOfChildcare = $settings['maximalHoursOfChildcare'];
        if (!$maxHoursOfChildcare) {
            $maxHoursOfChildcare = 50;
        }
        if ($this->search->getHoursOfChildcare() > $maxHoursOfChildcare) {
            $this->search->setHoursOfChildcare($maxHoursOfChildcare);
        }
    }

    /**
     * Initializes the objects step and chargeable income
     */
    public function initializeObject(): void
    {
        $this->step = $this->stepRepository->findByUid($this->search->getStep());
        $this->chargeableIncome = $this->chargeableIncomeRepository->findByUid($this->search->getChargeableIncome());
    }

    /**
     * Returns the total amount
     *
     * @return float
     */
    public function getTotalAmount(): float
    {
        // calculate total amount
        return $this->getChargeableIncomeDiscount() * $this->getPercentFromHundred($this->step->getDiscountInPercent());
    }

    /**
     * Returns the regular fee multiplied with chargeable income discount
     *
     * @return float
     */
    protected function getChargeableIncomeDiscount(): float
    {
        return $this->getRegularFee() * $this->getPercentFromHundred($this->chargeableIncome->getDiscountInPercent());
    }

    /**
     * Returns the regular fee
     *
     * @return float
     */
    protected function getRegularFee(): float
    {
        $result = $this->hourlyRate * $this->search->getHoursOfChildcare() * $this->openingTimeInWeeksPerYear;
        $result /= $this->subscriptionsPerYear;
        return (float)$result;
    }

    /**
     * Returns percent from hundred like 0.8 if
     * discount in percent equals 20(%)
     *
     * @param float $discountInPercent
     * @return float
     */
    protected function getPercentFromHundred($discountInPercent): float
    {
        return (float)((100 - $discountInPercent) / 100);
    }
}
