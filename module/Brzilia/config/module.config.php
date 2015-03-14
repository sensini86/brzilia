<?php
namespace Brzilia;

return array(
   'controllers' => array(
        'invokables' => array(
            'Brzilia\Controller\Index' => 'Brzilia\Controller\IndexController',
            'Brzilia\Controller\About' => 'Brzilia\Controller\AboutController',
            'Brzilia\Controller\Menu' => 'Brzilia\Controller\MenuController',
        ),
    ),
//    'service_manager' => array(
//        'factories' => array(
//            'navigation' => 'Zend\Navigation\Service\DefaultNavigationFactory',
//        )
//    ),
    'view_manager' => array(
        'template_map' => array(
            'layout/brzilia'           => __DIR__ . '/../view/layout/brzilia.phtml',
            'brzilia/index/index' => __DIR__ . '/../view/brzilia/index/index.phtml',
        ),
        // needed to display custom templates
        'template_path_stack' => array(
            'brzilia' => __DIR__ . '/../view',
        ),
    ),
);
