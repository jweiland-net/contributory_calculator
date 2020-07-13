<?php
return [
    'ctrl' => [
        'title' => 'LLL:EXT:contributory_calculator/Resources/Private/Language/locallang_db.xlf:tx_contributorycalculator_domain_model_chargeableincome',
        'label' => 'minimal_income',
        'tstamp' => 'tstamp',
        'crdate' => 'crdate',
        'cruser_id' => 'cruser_id',
        'dividers2tabs' => true,
        'versioningWS' => 2,
        'versioning_followPages' => true,

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
        '1' => [
            'showitem' => 'sys_language_uid;;;;1-1-1, l10n_parent, l10n_diffsource, hidden;;1, minimal_income, 
            maximal_income, discount_in_percent,
            --div--;LLL:EXT:frontend/Resources/Private/Language/locallang_tca.xlf:pages.tabs.access, 
            --palette--;LLL:EXT:frontend/Resources/Private/Language/locallang_tca.xlf:pages.palettes.access;access'
        ],
    ],
    'palettes' => [
        'access' => [
            'showitem' => 'starttime;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:starttime_formlabel,endtime;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:endtime_formlabel',
        ]
    ],
    'columns' => [
        'sys_language_uid' => [
            'exclude' => true,
            'label' => 'LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.language',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectSingle',
                'special' => 'languages',
                'items' => [
                    [
                        'LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.allLanguages',
                        -1,
                        'flags-multiple'
                    ],
                ],
                'default' => 0,
            ]
        ],
        'l10n_parent' => [
            'displayCond' => 'FIELD:sys_language_uid:>:0',
            'exclude' => true,
            'label' => 'LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.l18n_parent',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectSingle',
                'items' => [
                    ['', 0],
                ],
                'foreign_table' => 'tx_contributorycalculator_domain_model_chargeableincome',
                'foreign_table_where' => 'AND tx_contributorycalculator_domain_model_chargeableincome.pid=###CURRENT_PID### AND tx_contributorycalculator_domain_model_chargeableincome.sys_language_uid IN (-1,0)',
                'showIconTable' => false,
                'default' => 0,
            ]
        ],
        'l10n_diffsource' => [
            'config' => [
                'type' => 'passthrough',
                'default' => ''
            ]
        ],
        't3ver_label' => [
            'label' => 'LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.versionLabel',
            'config' => [
                'type' => 'input',
                'size' => '30',
                'max' => '255'
            ]
        ],
        'hidden' => [
            'exclude' => true,
            'label' => 'LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.hidden',
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
            'exclude' => true,
            'label' => 'LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.starttime',
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
            'exclude' => true,
            'label' => 'LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.endtime',
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
            'exclude' => true,
            'label' => 'LLL:EXT:contributory_calculator/Resources/Private/Language/locallang_db.xlf:tx_contributorycalculator_domain_model_chargeableincome.minimal_income',
            'config' => [
                'type' => 'input',
                'size' => 4,
                'eval' => 'num,required'
            ]
        ],
        'maximal_income' => [
            'exclude' => true,
            'label' => 'LLL:EXT:contributory_calculator/Resources/Private/Language/locallang_db.xlf:tx_contributorycalculator_domain_model_chargeableincome.maximal_income',
            'config' => [
                'type' => 'input',
                'size' => 4,
                'eval' => 'num,required',
            ]
        ],
        'discount_in_percent' => [
            'exclude' => true,
            'label' => 'LLL:EXT:contributory_calculator/Resources/Private/Language/locallang_db.xlf:tx_contributorycalculator_domain_model_chargeableincome.discount_in_percent',
            'config' => [
                'type' => 'input',
                'size' => 4,
                'eval' => 'num, required'
            ]
        ]
    ]
];
