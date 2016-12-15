<?php
namespace JWeiland\ContributoryCalculator\Controller;

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

use JWeiland\ContributoryCalculator\Domain\Model\Search;
use JWeiland\ContributoryCalculator\Domain\Repository\ChargeableIncomeRepository;
use JWeiland\ContributoryCalculator\Domain\Repository\StepRepository;
use JWeiland\ContributoryCalculator\Service\Calculator;
use TYPO3\CMS\Core\Utility\GeneralUtility;

/**
 * SearchController
 */
class SearchController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController
{
    /**
     * ChargeableIncomeRepository
     *
     * @var ChargeableIncomeRepository
     */
    protected $chargeableIncomeRepository;
    
    /**
     * StepRepository
     *
     * @var StepRepository
     */
    protected $stepRepository;
    
    /**
     * inject chargeableIncomeRepository
     *
     * @param ChargeableIncomeRepository $chargeableIncomeRepository
     * @return void
     */
    public function injectChargeableIncomeRepository(ChargeableIncomeRepository $chargeableIncomeRepository)
    {
        $this->chargeableIncomeRepository = $chargeableIncomeRepository;
    }
    
    /**
     * inject stepRepository
     *
     * @param StepRepository $stepRepository
     * @return void
     */
    public function injectStepRepository(StepRepository $stepRepository)
    {
        $this->stepRepository = $stepRepository;
    }
    
    /**
     * action search
     *
     * @return void
     */
    public function searchAction()
    {
        /** @var Search $search */
        $search = GeneralUtility::makeInstance('JWeiland\\ContributoryCalculator\\Domain\\Model\\Search');
        $this->addBaseKeysToView($search);
    }
    
    /**
     * action result
     *
     * @param Search $search
     * @return void
     */
    public function resultAction(Search $search)
    {
        $this->addBaseKeysToView($search);
        /** @var Calculator $calculator */
        $calculator = $this->objectManager->get(
            'JWeiland\\ContributoryCalculator\\Service\\Calculator',
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
    protected function addBaseKeysToView(Search $search)
    {
        $this->view->assign('search', $search);
        $this->view->assign('maximalHoursOfChildCare', $this->settings['maximalHoursOfChildcare']);
        $this->view->assign('chargeableIncomeTypes', $this->chargeableIncomeRepository->findAll());
        $this->view->assign('steps', $this->stepRepository->findAll());
    }
}