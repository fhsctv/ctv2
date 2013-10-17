<?php

namespace Company;

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
                'Company\TableGateway\User'       => '\Company\Service\Factory\TableGateway\User',
                'Company\TableGateway\Infoscript' => '\Company\Service\Factory\TableGateway\Infoscript',
                'Company\TableGateway\Url'        => '\Company\Service\Factory\TableGateway\Url',
                'Company\Table\User'              => '\Company\Service\Factory\Table\User',
                'Company\Table\Infoscript'        => '\Company\Service\Factory\Table\Infoscript',
                'Company\Table\Url'               => '\Company\Service\Factory\Table\Url',
            ),
            'invokables' => array(
                'Company\Mapper\User'             => '\Company\Model\Mapper\User',
                'Company\Mapper\Infoscript'       => '\Company\Model\Mapper\Infoscript',
                'Company\Mapper\Url'              => '\Company\Model\Mapper\Url',
            )
        );
    }

}
