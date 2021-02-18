<?php

return [
    'ncanode.fast_router' => [
        'shared' => true,
        'init' => function(\Perfumer\Component\Container\Container $container) {
            return \FastRoute\simpleDispatcher(function(\FastRoute\RouteCollector $r) {
                $r->addRoute('POST',   '/signature', 'signature.post');
            });
        }
    ],

//    'ncanode.router' => [
//        'shared' => true,
//        'class' => 'Perfumer\\Framework\\Router\\Http\\DefaultRouter',
//        'arguments' => ['#gateway.http', '#ncanode.fast_router', [
//            'data_type' => 'json',
//            'allowed_actions' => ['get', 'post', 'delete', 'patch'],
//        ]]
//    ],

    'ncanode.router' => [
        'shared' => true,
        'class' => 'Perfumer\\Framework\\Router\\Http\\FastRouteRouter',
        'arguments' => ['#gateway.http', '#ncanode.fast_router', [
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
