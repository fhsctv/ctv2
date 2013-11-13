<?php

return array(
    'router' => array(
        'routes' => array(
            /*
             * überschreibt das Verhalten beim Aufruf der Wurzel der Internetseite
             * dabei wird dieses Modul als Start- Aufruf- Modul festgelegt.
             */

//            'home' => array(
//                'type' => 'Zend\Mvc\Router\Http\Literal',
//                'options' => array(
//                    'route'    => '/',
//                    'defaults' => array(
//                        'controller' => 'Administration\Controller\Index',
//                        'action'     => 'index',
//                    ),
//                ),
//            ),
//            
            // The following is a route to simplify getting started creating
            // new controllers and actions without needing to create a new
            // module. Simply drop new controllers in, and you can access them
            // using the path /administration/:controller/:action
            'administration' => array(
                'type' => 'Literal',
                'options' => array(
                    'route' => '/administration',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Administration\Controller',
                        'controller' => 'Index',
                        'action' => 'index',
                    ),
                ),
                'may_terminate' => true,
                'child_routes' => array(
                    'default' => array(
                        'type' => 'Segment',
                        'options' => array(
                            'route' => '/[:controller[/:action[/id=:id[/display=:display]]]]',
                            'constraints' => array(
                                'controller' => '[a-zA-Z][a-zA-Z0-9_-]*',
                                'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                            ),
                            'defaults' => array(
                            ),
                        ),
                    ),
                ),
            ),
        ),
    ),
);
