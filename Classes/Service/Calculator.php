<?php

declare(strict_types=1);

/*
 * This file is part of the package jweiland/contributory_calculator.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace JWeiland\ContributoryCalculator\Service;

use JWeiland\ContributoryCalculator\Domain\Model\Care;
use JWeiland\ContributoryCalculator\Domain\Model\Search;
use JWeiland\ContributoryCalculator\Domain\Repository\CareRepository;

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
     * @var Care
     */
    protected $chargeableIncome;

    /**
     * @var CareRepository
     */
    protected $careRepository;

    /**
     * @param Search $search
     * @param array $settings
     * @param CareRepository $careRepository
     */
    public function __construct(
        Search $search,
        array $settings,
        CareRepository $careRepository
    ) {
        $this->careRepository = $careRepository;
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
