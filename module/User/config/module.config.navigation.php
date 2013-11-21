<?php

return array(
    'navigation' => array(
        'default' => array(
            'user' => array(
                'label' => 'User',
                'route' => 'user',
                'pages' => array(
                    'login' => array(
                        'label' => 'Login',
                        'route' => 'user/default',
                        'controller' => 'user',
                        'action' => 'index',
                    ),
                    'register' => array(
                        'label' => 'Registrieren',
                        'route' => 'user/default',
                        'controller' => 'register',
                        'action' => 'index',
                    ),
                )
            ),
        ),
    )
);
