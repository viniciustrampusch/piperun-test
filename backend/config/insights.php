<?php

declare(strict_types=1);

return [
    'preset' => 'laravel',
    'exclude' => [
        'app/Http/Middleware/RedirectIfAuthenticated.php',
        'app/Providers/RouteServiceProvider.php',
        'app/Providers/AppServiceProvider.php',
        'app/Providers/AuthServiceProvider.php',
        'app/Providers/EventServiceProvider.php',
        'app/Console/Kernel.php',
        'app/Http/Middleware/Authenticate.php',
        'app/Http/Middleware/RedirectIfAuthenticated.php'
    ],
    'add' => [
        //  ExampleMetric::class => [
        //      ExampleInsight::class,
        //  ]
    ],
    'remove' => [
        //  ExampleInsight::class,
    ],
    'config' => [
        //  ExampleInsight::class => [
        //      'key' => 'value',
        //  ],
    ],
];
