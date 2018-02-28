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
                        ],
                    ],
                    'clear' => [
                        'type' => Segment::class,
                        'options' => [
                            'route' => 'clear[/]',
                            'defaults' => [
                                'action' => 'clear'
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
                InvokableFactory::class
        ],
    ],
];
