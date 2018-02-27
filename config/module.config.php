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
                 'may_terminate' => true,
                'child_routes' => [
                    'provider' => [
                        'type' => Segment::class,
                        'options' => [
                            'route' => ':identifier[/]',
                            'defaults' => [
                                'controller' => Controller\ProviderController::class,
                                'action' => 'index'
                            ]
                        ]
                    ],
                    'authenticate' => [
                        'type' => Segment::class,
                        'options' => [
                            'route' => 'authenticate[/]',
                            'defaults' => [
                                'controller' => Controller\ProviderController::class,
                                'action' => 'authenticate'
                            ]
                        ],
                        'may_terminate' => true,
                    ],
                ],
            ],
        ],
    ],

    'controllers' => [
        'factories' => [
            Controller\ProviderController::class =>
                InvokableFactory::class
        ],
    ],
];
