<?php

return [
    'ncanode.router' => [
        'shared' => true,
        'class' => 'Perfumer\\Framework\\Router\\Http\\DefaultRouter',
        'arguments' => ['#gateway.http', [
            'data_type' => 'json',
            'allowed_actions' => ['get', 'post', 'delete', 'patch'],
        ]]
    ],

    'ncanode.request' => [
        'class' => 'Perfumer\\Framework\\Proxy\\Request',
        'arguments' => ['$0', '$1', '$2', '$3', [
            'prefix' => 'Ncanode\\Controller',
            'suffix' => 'Controller'
        ]]
    ]
];
