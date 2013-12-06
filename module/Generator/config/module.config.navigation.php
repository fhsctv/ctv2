<?php

return array(
    'navigation' => array(
        'default' => array(
            'generator' => array(
                'label' => 'Generator',
                'route' => 'generator/default',
                'controller' => 'infoscript',
                'pages' => array(
                    'generator' => array(
                        'label' => 'Generator',
                        'route' => 'generator/default',
                        'controller' => 'infoscript',
                        'action' => 'index',
                        'pages' => array(
                            'index' => array(
                                'label' => 'Index',
                                'route' => 'generator/default',
                                'controller' => 'infoscript',
                                'action' => 'index',
                            ),
                        ),
                    ),
                )
            ),
        ),
    )
);
