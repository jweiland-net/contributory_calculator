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
use JWeiland\ContributoryCalculator\Service\Exception\EmptyFactorException;
use TYPO3\CMS\Core\Messaging\FlashMessage;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;
use TYPO3\CMS\Extbase\Utility\LocalizationUtility;

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
        $calculator = $this->objectManager->get(Calculator::class);
        $this->view->assign('careForms', $this->careRepository->findAll());
        $this->view->assign('search', $search);
        try {
            $this->view->assign('result', $calculator->getTotalPerMonth($search));
        } catch (EmptyFactorException $e) {
            $this->addFlashMessage(
                LocalizationUtility::translate('error.childTooYoung.description', 'contributoryCalculator'),
                LocalizationUtility::translate('error.childTooYoung.title', 'contributoryCalculator'),
                FlashMessage::WARNING
            );
            $this->view->assign('result', 0.0);
        }
    }
}
