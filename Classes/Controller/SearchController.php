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
use JWeiland\ContributoryCalculator\Domain\Repository\CareRepository;
use JWeiland\ContributoryCalculator\Service\Calculator;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;

/**
 * Controller to show search form and search results.
 */
class SearchController extends ActionController
{
    /**
     * @var CareRepository
     */
    protected $careRepository;

    public function __construct(CareRepository $chargeableIncomeRepository)
    {
        $this->careRepository = $chargeableIncomeRepository;
    }

    public function searchAction(): void
    {
        $this->view->assign('careForms', $this->careRepository->findAll());
        $this->view->assign('search', GeneralUtility::makeInstance(Search::class));
    }

    /**
     * @param Search $search
     */
    public function resultAction(Search $search): void
    {
        $calculator = $this->objectManager->get(Calculator::class, $search, $this->settings);
        $this->view->assign('careForms', $this->careRepository->findAll());
        $this->view->assign('search', $search);
        $this->view->assign('result', $calculator->getTotalAmount());
    }
}
