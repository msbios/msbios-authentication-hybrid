<?php
/**
 * @access protected
 * @author Judzhin Miles <info[woof-woof]msbios.com>
 */

namespace MSBios\Authentication\Hybrid;

use Zend\ServiceManager\Factory\InvokableFactory;

return [

    'controllers' => [
        'factories' => [
            Controller\IndexController::class =>
                InvokableFactory::class,
        ],
        'aliases' => [
            \MSBios\Application\Controller\IndexController::class =>
                Controller\IndexController::class
        ]
    ],

    'view_manager' => [
        'template_path_stack' => [
            __DIR__ . '/../../view',
        ],
    ],

    \MSBios\Assetic\Module::class => [
        'paths' => [
            __DIR__ . '/../../vendor/msbios/application/themes/default/public/',
        ],
    ],

    \MSBios\Hybridauth\Module::class => [

        "base_url" => "http://0.0.0.0:3107",

        "providers" => [
            "Facebook" => [
                "enabled" => true,
                "keys" => ["id" => "", "secret" => ""], // in development.local.php
                "scope"   => ['email', 'user_about_me', 'user_birthday', 'user_hometown'], // optional
                "photo_size" => 200, // optional
            ],
            "Google" => [
                "enabled" => true,
                "keys" => ["id" => "", "secret" => ""], // in development.local.php
            ],
            "Twitter" => [
                "enabled" => true,
                "keys" => ["id" => "", "secret" => ""], // in development.local.php
            ],
        ],

        // If you want to enable logging, set 'debug_mode' to true.
        // You can also set it to
        // - "error" To log only error messages. Useful in production
        // - "info" To log info and error messages (ignore debug messages)
        "debug_mode" => true,

        // Path to file writable by the web server. Required if 'debug_mode' is not false
        "debug_file" => "./data/logs/hybridauth.log",
    ]
];
