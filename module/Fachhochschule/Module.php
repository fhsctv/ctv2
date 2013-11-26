<?php

namespace Fachhochschule;

use Zend\ModuleManager\Feature\AutoloaderProviderInterface;
use Zend\ModuleManager\Feature\ConfigProviderInterface;
use Zend\ModuleManager\Feature\ServiceProviderInterface;

class Module implements AutoloaderProviderInterface, ConfigProviderInterface, ServiceProviderInterface {

    public function getConfig()
    {

        $configPath = __DIR__ . '/config/';

        return array_merge(include $configPath . 'module.config.php'
                          ,include $configPath . 'module.config.routes.php'
                          ,include $configPath . 'module.config.navigation.php'
                          ,include $configPath . 'module.config.controllers.php'
                          ,include $configPath . 'module.config.constants.php'
        );
    }

    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                ),
            ),
        );
    }

    public function getServiceConfig(){

        return array(
            'factories' => array(
               
            ),
            'invokables' => array(
               
            ),
            'aliases' => array(
                
            )
        );
    }

}
