<?php
if (\TYPO3\CMS\Core\Utility\GeneralUtility::compat_version('7.6')) {
    $ttContentLanguageFile = 'LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf';
} else {
    $ttContentLanguageFile = 'LLL:EXT:cms/locallang_ttc.xlf';
}
return [
    'ctrl' => [
        'title' => 'LLL:EXT:contributory_calculator/Resources/Private/Language/locallang_db.xlf:tx_contributorycalculator_domain_model_chargeableincome',
        'label' => 'minimal_income',
        'tstamp' => 'tstamp',
        'crdate' => 'crdate',
        'cruser_id' => 'cruser_id',
        'dividers2tabs' => TRUE,
        'versioningWS' => 2,
        'versioning_followPages' => TRUE,

        'languageField' => 'sys_language_uid',
        'transOrigPointerField' => 'l10n_parent',
        'transOrigDiffSourceField' => 'l10n_diffsource',
        'delete' => 'deleted',
        'enablecolumns' => [
            'disabled' => 'hidden',
            'starttime' => 'starttime',
            'endtime' => 'endtime',
        ],
        'searchFields' => 'minimal_income,maximal_income,discount_in_percent,',
        'iconfile' => 'EXT:contributory_calculator/Resources/Public/Icons/tx_contributorycalculator_domain_model_chargeableincome.gif'
    ],
    'interface' => [
        'showRecordFieldList' => 'sys_language_uid, l10n_parent, l10n_diffsource, hidden, minimal_income, maximal_income, discount_in_percent',
    ],
    'types' => [
        '1' => ['showitem' => 'sys_language_uid;;;;1-1-1, l10n_parent, l10n_diffsource, hidden;;1, minimal_income, maximal_income, discount_in_percent,--div--;' . $ttContentLanguageFile . ':tabs.access,starttime, endtime'],
    ],
    'palettes' => [
        '1' => ['showitem' => ''],
    ],
    'columns' => [
        'sys_language_uid' => [
            'exclude' => 1,
            'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.language',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectSingle',
                'special' => 'languages',
                'items' => [
                    [
                        'LLL:EXT:lang/locallang_general.xlf:LGL.allLanguages',
                        -1,
                        'flags-multiple'
                    ],
                ],
                'default' => 0,
            ]
        ],
        'l10n_parent' => [
            'exclude' => 1,
            'displayCond' => 'FIELD:sys_language_uid:>:0',
            'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.l18n_parent',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectSingle',
                'items' => [
                    [
                        '',
                        0
                    ]
                ],
                'foreign_table' => 'tt_content',
                'foreign_table_where' => 'AND tt_content.pid=###CURRENT_PID### AND tt_content.sys_language_uid IN (-1,0)',
                'default' => 0
            ]
        ],
        'l10n_diffsource' => [
            'config' => [
                'type' => 'passthrough',
                'default' => ''
            ]
        ],
        't3ver_label' => [
            'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.versionLabel',
            'config' => [
                'type' => 'input',
                'size' => '30',
                'max' => '255'
            ]
        ],
        'hidden' => [
            'exclude' => 1,
            'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.hidden',
            'config' => [
                'type' => 'check',
                'items' => [
                    '1' => [
                        '0' => 'LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:hidden.I.0'
                    ]
                ]
            ]
        ],
        'starttime' => [
            'exclude' => 1,
            'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.starttime',
            'config' => [
                'type' => 'input',
                'size' => '13',
                'eval' => 'datetime',
                'default' => 0
            ],
            'l10n_mode' => 'exclude',
            'l10n_display' => 'defaultAsReadonly'
        ],
        'endtime' => [
            'exclude' => 1,
            'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.endtime',
            'config' => [
                'type' => 'input',
                'size' => '13',
                'eval' => 'datetime',
                'default' => 0,
                'range' => [
                    'upper' => mktime(0, 0, 0, 1, 1, 2038)
                ]
            ],
            'l10n_mode' => 'exclude',
            'l10n_display' => 'defaultAsReadonly'
        ],
        'minimal_income' => [
            'exclude' => 1,
            'label' => 'LLL:EXT:contributory_calculator/Resources/Private/Language/locallang_db.xlf:tx_contributorycalculator_domain_model_chargeableincome.minimal_income',
            'config' => [
                'type' => 'input',
                'size' => 4,
                'eval' => 'num,required'
            ]
        ],
        'maximal_income' => [
            'exclude' => 1,
            'label' => 'LLL:EXT:contributory_calculator/Resources/Private/Language/locallang_db.xlf:tx_contributorycalculator_domain_model_chargeableincome.maximal_income',
            'config' => [
                'type' => 'input',
                'size' => 4,
                'eval' => 'num,required',
            ]
        ],
        'discount_in_percent' => [
            'exclude' => 1,
            'label' => 'LLL:EXT:contributory_calculator/Resources/Private/Language/locallang_db.xlf:tx_contributorycalculator_domain_model_chargeableincome.discount_in_percent',
            'config' => [
                'type' => 'input',
                'size' => 4,
                'eval' => 'num, required'
            ]
        ],

    ],
];
