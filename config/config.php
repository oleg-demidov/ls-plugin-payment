<?php
/**
 * Таблица БД
 */
$config['$root$']['db']['table']['payment_payment'] = '___db.table.prefix___payment';

/**
 * Роутинг
 */
$config['$root$']['router']['page']['payment'] = 'PluginPayment_ActionPayment';


$config['providers'] = [
    'robokassa' => [
        'merchant' => '',
        'pass1' => '',
        'pass2' => ''
    ]
];

return $config;