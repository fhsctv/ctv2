<?php

return array(
    'navigation' => array(
        'default' => array(
            'administration' => array(
                'label' => 'Administration',
                'route' => 'administration',
                'pages' => array(
                    'infoscript' => array(
                        'label' => 'Infoscripte',
                        'route' => 'administration/default',
                        'controller' => 'infoscript',
                        'action' => 'index',
                        'pages' => array(
//                            'index' => array(
//                                'label' => 'Index',
//                                'route' => 'administration/default',
//                                'controller' => 'infoscript',
//                                'action' => 'index',
//                            ),
//                            'show' => array(
//                                'label' => 'Anzeigen',
//                                'route' => 'administration/default',
//                                'controller' => 'infoscript',
//                                'action' => 'show',
//                            ),
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
                            'edit' => array(
                                'label' => 'Bearbeiten',
                                'route' => 'administration/default',
                                'controller' => 'infoscript',
                                'action' => 'edit',
                            ),
                            'delete' => array(
                                'label' => 'Löschen',
                                'route' => 'administration/default',
                                'controller' => 'infoscript',
                                'action' => 'delete',
                            ),
                        ),
                    ),
                    'anzeigen' => array(
                        'label' => 'Anzeigen',
                        'route' => 'administration/default',
                        'controller' => 'anzeige',
                        'action' => 'index',
                        'pages' => array(
                            'index' => array(
                                'label' => 'Index',
                                'route' => 'administration/default',
                                'controller' => 'anzeige',
                                'action' => 'index',
                            ),
                            'show' => array(
                                'label' => 'Show',
                                'route' => 'administration/default',
                                'controller' => 'anzeige',
                                'action' => 'show',
//                                'pages' => array(
//                                    'active' => array(
//                                        'label' => 'Active',
//                                        'route' => 'administration/default',
//                                        'controller' => 'anzeige',
//                                        'action' => 'show-active',
//                                        'pages' => array(
//                                            'disp1' => array(
//                                                'label' => 'Display 1',
//                                                'route' => 'administration/default',
//                                                'controller' => 'anzeige',
//                                                'action' => 'show-active-disp1',
//                                            ),
//                                        ),
//                                    ),
//                                    'outdated' => array(
//                                        'label' => 'Outdated',
//                                        'route' => 'administration/default',
//                                        'controller' => 'anzeige',
//                                        'action' => 'show-outdated',
//                                    ),
//                                    'future' => array(
//                                        'label' => 'Future',
//                                        'route' => 'administration/default',
//                                        'controller' => 'anzeige',
//                                        'action' => 'show-future',
//                                    ),
//                                ),
//                            ),
//                            'edit' => array(
//                                'label' => 'Edit',
//                                'route' => 'administration/default',
//                                'controller' => 'anzeige',
//                                'action' => 'edit',
//                            ),
//                            'delete' => array(
//                                'label' => 'Delete',
//                                'route' => 'administration/default',
//                                'controller' => 'anzeige',
//                                'action' => 'delete',
                            ),
                        ),
                    ),
                )
            ),
        ),
    )
);
