<?php

return [
    'bills' => [
        'title' => 'Счета',
        'states' => [
            'paid' => 'Оплачено',
            'not_paid' => 'Не оплачено'
        ],
        'pay' => 'Оплатить',
        'blankslate' => [
            'text' => 'Счетов нет'
        ],
        'fields' => [
            'number' => 'Номер счета',
            'description' => 'Описание',
            'date_create' => 'Дата создания',
            'state' => 'Статус',
            'price' => 'Сумма'
        ]
    ],
    'nav_profile' => [
        'text' => 'Счета'
    ],
    'choose_provider' => [
        'title' => 'Оплатить',
        'h5' => 'Выберете вариант оплаты:'
    ],
    'providers' => [
        'robokassa' => [
            'title' => 'Robokassa',
            'description' => 'Visa, MasterCard, МИР, Яндекс деньги и др.'
        ]
    ],
    'currency' => [
        'RUB' => 'руб.'
    ],
    'notice' => [
        'error_choose_bill' => 'Выберите счет для оплаты'
    ]
];