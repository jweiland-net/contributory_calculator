<?php

/*
 * This file is part of the package jweiland/contributory-calculator.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

return [
    'ctrl' => [
        'title' => 'LLL:EXT:contributory_calculator/Resources/Private/Language/locallang_db.xlf:tx_contributorycalculator_domain_model_calculationbase',
        'label' => 'year_of_validity',
        'tstamp' => 'tstamp',
        'crdate' => 'crdate',
        'sortby' => 'sorting',
        'origUid' => 't3_origuid',
        'languageField' => 'sys_language_uid',
        'transOrigPointerField' => 'l10n_parent',
        'transOrigDiffSourceField' => 'l10n_diffsource',
        'delete' => 'deleted',
        'enablecolumns' => [
            'disabled' => 'hidden',
            'starttime' => 'starttime',
            'endtime' => 'endtime',
        ],
        'searchFields' => 'year_of_validity',
        'iconfile' => 'EXT:contributory_calculator/Resources/Public/Icons/tx_contributorycalculator_domain_model_calculationbase.svg',
    ],
    'types' => [
        '1' => [
            'showitem' => '--palette--;;languageHidden,
            care_form,year_of_validity,minimal_income,maximum_income,
            --palette--;;valuesPercent,
            --div--;LLL:EXT:frontend/Resources/Private/Language/locallang_tca.xlf:pages.tabs.access,
            --palette--;LLL:EXT:frontend/Resources/Private/Language/locallang_tca.xlf:pages.palettes.access;access',
        ],
    ],
    'palettes' => [
        'languageHidden' => ['showitem' => 'sys_language_uid, l10n_parent, hidden'],
        'valuesPercent' => ['showitem' => 'value_below_3, value_above_3'],
        'access' => [
            'showitem' => 'starttime;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:starttime_formlabel,endtime;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:endtime_formlabel',
        ],
    ],
    'columns' => [
        'care_form' => [
            'label' => 'LLL:EXT:contributory_calculator/Resources/Private/Language/locallang_db.xlf:tx_contributorycalculator_domain_model_calculationbase.care_form',
            'config' => [
                'type' => 'group',
                'allowed' => 'tx_contributorycalculator_domain_model_care',
                'maxitems' => 1,
                'minitems' => 1,
                'size' => 1,
            ],
        ],
        'year_of_validity' => [
            'label' => 'LLL:EXT:contributory_calculator/Resources/Private/Language/locallang_db.xlf:tx_contributorycalculator_domain_model_calculationbase.year_of_validity',
            'config' => [
                'type' => 'number',
                'size' => 5,
                'eval' => 'trim',
                'range' => [
                    'lower' => 1970,
                    'upper' => 2100,
                ],
                'default' => (static fn() => (new DateTime())->format('Y'))(),
                'slider' => [
                    'step' => 1,
                    'width' => 200,
                ],
            ],
        ],
        'value_below_3' => [
            'exclude' => true,
            'label' => 'LLL:EXT:contributory_calculator/Resources/Private/Language/locallang_db.xlf:tx_contributorycalculator_domain_model_calculationbase.value_below_3',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim',
                'range' => [
                    'lower' => 0,
                    'upper' => 100,
                ],
                'slider' => [
                    'step' => 0.1,
                    'width' => 200,
                ],
            ],
        ],
        'value_above_3' => [
            'exclude' => true,
            'label' => 'LLL:EXT:contributory_calculator/Resources/Private/Language/locallang_db.xlf:tx_contributorycalculator_domain_model_calculationbase.value_above_3',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim',
                'range' => [
                    'lower' => 0,
                    'upper' => 100,
                ],
                'slider' => [
                    'step' => 0.1,
                    'width' => 200,
                ],
            ],
        ],
        'minimal_income' => [
            'label' => 'LLL:EXT:contributory_calculator/Resources/Private/Language/locallang_db.xlf:tx_contributorycalculator_domain_model_calculationbase.minimal_income',
            'description' => 'LLL:EXT:contributory_calculator/Resources/Private/Language/locallang_db.xlf:tx_contributorycalculator_domain_model_calculationbase.minimal_income.description',
            'config' => [
                'type' => 'number',
                'size' => 30,
                'eval' => 'trim',
                'default' => 25000,
            ],
        ],
        'maximum_income' => [
            'label' => 'LLL:EXT:contributory_calculator/Resources/Private/Language/locallang_db.xlf:tx_contributorycalculator_domain_model_calculationbase.maximum_income',
            'description' => 'LLL:EXT:contributory_calculator/Resources/Private/Language/locallang_db.xlf:tx_contributorycalculator_domain_model_calculationbase.maximum_income.description',
            'config' => [
                'type' => 'number',
                'size' => 30,
                'eval' => 'trim',
                'default' => 70000,
            ],
        ],
    ],
];
