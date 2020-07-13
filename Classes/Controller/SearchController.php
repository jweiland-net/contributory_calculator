<?php

declare(strict_types=1);

/*
 * This file is part of the package jweiland/contributory_calculator.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace JWeiland\ContributoryCalculator\Controller;

use JWeiland\ContributoryCalculator\Domain\Model\Search;
use JWeiland\ContributoryCalculator\Domain\Repository\ChargeableIncomeRepository;
use JWeiland\ContributoryCalculator\Domain\Repository\StepRepository;
use JWeiland\ContributoryCalculator\Service\Calculator;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;

/**
 * SearchController
 */
class SearchController extends ActionController
{
    /**
     * @var ChargeableIncomeRepository
     */
    protected $chargeableIncomeRepository;

    /**
     * @var StepRepository
     */
    protected $stepRepository;

    /**
     * @param ChargeableIncomeRepository $chargeableIncomeRepository
     * @param StepRepository $stepRepository
     */
    public function __construct(ChargeableIncomeRepository $chargeableIncomeRepository, StepRepository $stepRepository)
    {
        $this->chargeableIncomeRepository = $chargeableIncomeRepository;
        $this->stepRepository = $stepRepository;
    }

    /**
     * action search
     */
    public function searchAction(): void
    {
        /** @var Search $search */
        $search = GeneralUtility::makeInstance(Search::class);
        $this->addBaseKeysToView($search);
    }

    /**
     * @param Search $search
     */
    public function resultAction(Search $search): void
    {
        $this->addBaseKeysToView($search);
        /** @var Calculator $calculator */
        $calculator = $this->objectManager->get(
            Calculator::class,
            $search,
            $this->settings
        );
        $this->view->assign('result', $calculator->getTotalAmount());
    }

    /**
     * Adds the base keys to current view
     *
     * @param Search $search
     */
    protected function addBaseKeysToView(Search $search): void
    {
        $this->view->assign('search', $search);
        $this->view->assign('maximalHoursOfChildCare', $this->settings['maximalHoursOfChildcare']);
        $this->view->assign('chargeableIncomeTypes', $this->chargeableIncomeRepository->findAllSortedByMaximalIncome());
        $this->view->assign('steps', $this->stepRepository->findAll());
    }
}
