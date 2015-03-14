<?php
namespace Application;

use Zend\Mvc\ModuleRouteListener;
use Zend\Mvc\MvcEvent;

class Module
{
    public function onBootstrap(MvcEvent $e)
    {
        $eventManager        = $e->getApplication()->getEventManager();
        $moduleRouteListener = new ModuleRouteListener();
        $moduleRouteListener->attach($eventManager);
    }

    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
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

    public function getViewHelperConfig()
    {
       return array(
             'factories' => array(
                'ControllerName' => function ($sm) {
                    // we get current controller name
                   $match = $sm->getServiceLocator()->get('application')->getMvcEvent()->getRouteMatch();
                   $viewHelper = new \Application\View\Helper\ControllerName($match);
                   return $viewHelper;
                },
             ),
       );
    }
}
