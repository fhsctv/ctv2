<?php

namespace Administration;

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
                'Administration\TableGateway\User'       => '\Administration\Service\Factory\TableGateway\User',
                'Administration\TableGateway\Url'        => '\Administration\Service\Factory\TableGateway\Url',
                'Administration\TableGateway\Infoscript' => '\Administration\Service\Factory\TableGateway\Infoscript',
                'Administration\TableGateway\Anzeige'    => '\Administration\Service\Factory\TableGateway\Anzeige',

                'Administration\Table\User'              => '\Administration\Service\Factory\Table\User',
                'Administration\Table\Url'               => '\Administration\Service\Factory\Table\Url',
                'Administration\Table\Infoscript'        => '\Administration\Service\Factory\Table\Infoscript',
                'Administration\Table\Anzeige'           => '\Administration\Service\Factory\Table\Anzeige',
            ),
            'invokables' => array(
                'Administration\Mapper\User'             => '\Administration\Model\Mapper\User',
                'Administration\Mapper\Url'              => '\Administration\Model\Mapper\Url',
                'Administration\Mapper\Infoscript'       => '\Administration\Model\Mapper\Infoscript',
                'Administration\Mapper\Anzeige'          => '\Administration\Model\Mapper\Anzeige',
            )
        );
    }

}
