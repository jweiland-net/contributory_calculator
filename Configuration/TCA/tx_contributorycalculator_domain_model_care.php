<?php

/*
 * This file is part of the package jweiland/contributory-calculator.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

return [
    'ctrl' => [
        'title' => 'LLL:EXT:contributory_calculator/Resources/Private/Language/locallang_db.xlf:tx_contributorycalculator_domain_model_care',
        'label' => 'title',
        'tstamp' => 'tstamp',
        'crdate' => 'crdate',
        'sortby' => 'sorting',
        'versioningWS' => true,
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
        'searchFields' => 'title',
        'iconfile' => 'EXT:contributory_calculator/Resources/Public/Icons/tx_contributorycalculator_domain_model_care.svg',
    ],
    'types' => [
        '1' => [
            'showitem' => '--palette--;;languageHidden,
            title,calculation_bases,
            --div--;LLL:EXT:frontend/Resources/Private/Language/locallang_tca.xlf:pages.tabs.access,
            --palette--;LLL:EXT:frontend/Resources/Private/Language/locallang_tca.xlf:pages.palettes.access;access',
        ],
    ],
    'palettes' => [
        'languageHidden' => ['showitem' => 'sys_language_uid, l10n_parent, hidden'],
        'access' => [
            'showitem' => 'starttime;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:starttime_formlabel,endtime;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:endtime_formlabel',
        ],
    ],
    'columns' => [
        'title' => [
            'exclude' => true,
            'label' => 'LLL:EXT:contributory_calculator/Resources/Private/Language/locallang_db.xlf:tx_contributorycalculator_domain_model_care.title',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim',
                'default' => '',
            ],
        ],
        'calculation_bases' => [
            'label' => 'LLL:EXT:contributory_calculator/Resources/Private/Language/locallang_db.xlf:tx_contributorycalculator_domain_model_care.calculation_bases',
            'config' => [
                'type' => 'inline',
                'foreign_table' => 'tx_contributorycalculator_domain_model_calculationbase',
                'foreign_field' => 'care_form',
                'default' => 0,
            ],
        ],
    ],
];
