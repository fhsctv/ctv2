<?php

return array(
    'navigation' => array(
        'default' => array(
            'fachhochschule' => array(
                'label' => 'Fachhochschule',
                'route' => 'fachhochschule',
                'pages' => array(
                    'infoscript' => array(
                        'label' => 'Infoscripte',
                        'route' => 'fachhochschule/default',
                        'controller' => 'infoscript',
                        'action' => 'index',
                        'pages' => array(
                            'details' => array(
                                'label' => 'Details',
                                'route' => 'fachhochschule/default',
                                'controller' => 'infoscript',
                                'action' => 'details',
                            ),
                            'create' => array(
                                'label' => 'Erstellen',
                                'route' => 'base/default',
                                'controller' => 'infoscript',
                                'action' => 'select-template',
                            ),
                        ),
                    ),
                )
            ),
        ),
    )
);
