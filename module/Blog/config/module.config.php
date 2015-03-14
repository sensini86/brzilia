<?php

return array(
    'db' => array(
        'driver'        => 'Pdo',
        'username'      => 'root',
        'password'      => '',
        'dsn'           => 'mysql:dbname=krbrzilia;host=localhost',
        'driver_options'=> array(
            \PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES \'UTF8\''
        ),
    ),
    'form_elements' => array(
        'Blog\Form\PostForm'                => 'Blog\Factory\PostFormFactory',
    ),
    'service_manager' => array(
        'factories' => array(
            'Blog\Mapper\PostMapperInterface'   => 'Blog\Factory\ZendDbSqlMapperFactory',
            'Blog\Mapper\UserMapperInterface'   => 'Blog\Factory\UserZendDbSqlMapperFactory',
            'Blog\Service\PostServiceInterface' => 'Blog\Factory\PostServiceFactory',
            'Blog\Service\UserServiceInterface' => 'Blog\Factory\UserServiceFactory',
            
            'Zend\Db\Adapter\Adapter'           => 'Zend\Db\Adapter\AdapterServiceFactory',
        ),
    ),
    'view_manager' => array(
        'template_path_stack' => array(
            __DIR__ . '/../view'
        ),
    ),
    'controllers' => array(
        'factories' => array(
            'Blog\Controller\List'  => 'Blog\Factory\ListControllerFactory',
            'Blog\Controller\Write' => 'Blog\Factory\WriteControllerFactory',
            'Blog\Controller\Delete'=> 'Blog\Factory\DeleteControllerFactory',
        ),
        /*
         * We cannot use invokables because we have and argument in the constructor of list controller
         * instead we will use factories which can create instance of classes
        'invokables' => array(
            'Blog\Controller\List' => 'Blog\Controller\ListController',
        ),
         */
    ),
    // This lines opens the configuration for the RouteManager
    'router' => array(
        // Open configuration for all possible routes
        'routes' => array(
            // Define a new route called "blog"
            'blog' => array(
                // Define the routes type to be "Zend\Mvc\Router\Http\Literal", which is basically
                'type' => 'literal',
                // Configure the route itself
                'options' => array(
                    // Listen to "/blog" as uri
                    'route' => '/blog',
                    // Define default controller and action to be called when this route is matched
                    'defaults' => array(
                        'controller' => 'Blog\Controller\List',
                        'action'     => 'index',
                    ),
                ),
                'may_terminate' => true,
                'child_routes'  => array(
                    'detail' => array(
                        'type'      => 'segment',
                        'options'   => array(
                            'route' => '/:id',
                            'defaults' => array(
                                'action' => 'detail'
                            ),
                            'constraints' => array(
                                'id' => '[1-9]\d*'
                            ),
                        ),
                    ),
                    'add' => array(
                        'type' => 'literal',
                        'options' => array(
                            'route'     => '/add',
                            'defaults'  => array(
                                'controller'    => 'Blog\Controller\Write',
                                'action'        => 'add',
                            ),
                        ),
                    ),
                    'edit' => array(
                        'type' => 'segment',
                        'options' => array(
                            'route'     => '/edit/:id',
                            'defaults'  => array(
                                'controller' => 'Blog\Controller\Write',
                                'action'     => 'edit'
                            ),
                            'constraints' => array(
                                'id' => '\d+'
                            )
                        )
                    ),
                    'delete' => array(
                        'type' => 'segment',
                        'options' => array(
                            'route' => '/delete/:id',
                            'defaults' => array(
                                'controller' => 'Blog\Controller\Delete',
                                'action'     => 'delete'
                            ),
                            'constraints' => array(
                                'id' => '\d+'
                            )
                        )
                    ),
                ),
            ),
        ),
    ),
);