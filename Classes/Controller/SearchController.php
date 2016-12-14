<?php
namespace JWeiland\ContributoryCalculator\Controller;

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