<?php

return array(
    'navigation' => array(
        'default' => array(
            'administration' => array(
                'label' => 'Administration',
                'route' => 'administration',
                'pages' => array(
                    'user' => array(
                        'label' => 'Benutzer',
                        'route' => 'administration/default',
                        'controller' => 'user',
                        'action' => 'index',
                    ),
                    'infoscript' => array(
                        'label' => 'Infoscripte',
                        'route' => 'administration/default',
                        'controller' => 'infoscript',
                        'action' => 'index',
                        'pages' => array(
                            'details' => array(
                                'label' => 'Details',
                                'route' => 'administration/default',
                                'controller' => 'infoscript',
                                'action' => 'details',
                            ),
                            'create' => array(
                                'label' => 'Erstellen',
                                'route' => 'administration/default',
                                'controller' => 'infoscript',
                                'action' => 'create',
                            ),
                        ),
                    ),
                )
            ),
        ),
    )
);
