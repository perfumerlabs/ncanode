<?php

return [
    'ncanode.request' => [
        'class' => 'Perfumer\\Framework\\Proxy\\Request',
        'arguments' => ['$0', '$1', '$2', '$3', [
            'prefix' => 'Ncanode\\Command',
            'suffix' => 'Command'
        ]]
    ]
];
