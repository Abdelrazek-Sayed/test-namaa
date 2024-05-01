<?php

use Modules\Transactions\Contexts\DataProviderXStatus;
use Modules\Transactions\Contexts\DataProviderYStatus;

return [
    'providers' => [
        'DataProviderX' => [
            'fields' => [
                'amount' => 'parentAmount',
                'provider' => 'provider',
                'currency' => 'Currency',
                'email' => 'parentEmail',
                'status' => 'statusCode',
                'registrationDate' => 'registerationDate',
                'identification' => 'parentIdentification',
            ],
            'statusCodes' => [
                DataProviderXStatus::AUTHORISED => 'authorised',
                DataProviderXStatus::DECLINE => 'decline',
                DataProviderXStatus::REFUNDED => 'refunded',
            ]
        ],
        'DataProviderY' => [
            'fields' => [
                'amount' => 'balance',
                'provider' => 'provider',
                'currency' => 'currency',
                'email' => 'email',
                'status' => 'status',
                'registrationDate' => 'created_at',
                'identification' => 'id',
            ],
            'statusCodes' => [
                DataProviderYStatus::AUTHORISED => 'authorised',
                DataProviderYStatus::DECLINE => 'decline',
                DataProviderYStatus::REFUNDED => 'refunded',
            ]
        ],
        // Additional providers can be added here following the same structure
    ]
];
