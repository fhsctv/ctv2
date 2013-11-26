<?php

return array(
    'navigation' => array(
        'default' => array(
            'ctvuser' => array(
                'label' => 'Ctvuser',
                'route' => 'ctvuser',
                'pages' => array(
                    'login' => array(
                        'label' => 'Login',
                        'route' => 'zfcuser/login',
                        'controller' => 'ctvuser',
                        'action' => 'index',
                    ),
                    'register' => array(
                        'label' => 'Registrieren',
                        'route' => 'ctvuser/default',
                        'controller' => 'register',
                        'action' => 'index',
                    ),
                )
            ),
        ),
    )
);
