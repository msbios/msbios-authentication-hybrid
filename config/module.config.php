<?php
/**
 * @access protected
 * @author Judzhin Miles <info[woof-woof]msbios.com>
 */
namespace MSBios\Authentication\Hybrid;

use Zend\Router\Http\Segment;
use Zend\ServiceManager\Factory\InvokableFactory;

return [

    'router' => [
        'routes' => [
            'hybridauth' => [
                'options' => [
                    'defaults' => [
                        'controller' => Controller\HybridController::class,
                    ]
                ],
                'may_terminate' => true,
                'child_routes' => [
                    'provider' => [
                        'type' => Segment::class,
                        'options' => [
                            'route' => ':identifier[/]',
                            'defaults' => [
                                'action' => 'provider'
                            ]
                        ],
                        'may_terminate' => true,
                        'child_routes' => [
                            'authenticate' => [
                                'type' => Segment::class,
                                'options' => [
                                    'route' => 'authenticate[/]',
                                    'defaults' => [
                                        'action' => 'authenticate'
                                    ]
                                ],
                            ],
                            'add' => [
                                'type' => Segment::class,
                                'options' => [
                                    'route' => 'add[/]',
                                    'defaults' => [
                                        'action' => 'add'
                                    ]
                                ],
                            ],
                        ],
                    ],
                    'logout' => [
                        'type' => Segment::class,
                        'options' => [
                            'route' => 'logout[/]',
                            'defaults' => [
                                'action' => 'logout'
                            ]
                        ],
                    ],
                ],
            ],
        ],
    ],

    'controllers' => [
        'factories' => [
            Controller\HybridController::class =>
                Factory\HybridControllerFactory::class
        ],
    ],

    'service_manager' => [
        'factories' => [
            ProviderManager::class =>
                InvokableFactory::class
        ]
    ]
];
