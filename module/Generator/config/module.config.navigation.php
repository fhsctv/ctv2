<?php

return array(
    'navigation' => array(
        'default' => array(
            'generator' => array(
                'label' => 'Generator',
                'route' => 'generator',
                'pages' => array(
                    'generator' => array(
                        'label' => 'Generator',
                        'route' => 'generator/default',
                        'controller' => 'index',
                        'action' => 'index',
                        'pages' => array(
                            'index' => array(
                                'label' => 'Index',
                                'route' => 'generator/default',
                                'controller' => 'index',
                                'action' => 'index',
                            ),
                        ),
                    ),
                )
            ),
        ),
    )
);
