<?php
/**
 * Таблица БД
 */
$config['$root$']['db']['table']['payment_payment_product'] = '___db.table.prefix___payment_product';
$config['$root$']['db']['table']['payment_payment_bill'] = '___db.table.prefix___payment_bill';

/**
 * Роутинг
 */
$config['$root$']['router']['page']['payment'] = 'PluginPayment_ActionPayment';

$config['products'] = [
    'per_page' => 5,
    'view_page_count' => 5
];



$config['providers'] = [
    'robokassa' => [
        'merchant' => '',
        'pass1' => '',
        'pass2' => ''
    ]
];

$config['$root$']['block']['userProfilePayment'] = array(
    'action' => array(
        'payment' => [
            '{settings}'
        ]
    ),
    'blocks' => array(
        'left' => array(
            'component@user.block-photo'    => array('priority' => 100),
            'menuProfile'      => array('priority' => 99),
            'component@user.block-actions'  => array('priority' => 98),
        )
    )
);

return $config;