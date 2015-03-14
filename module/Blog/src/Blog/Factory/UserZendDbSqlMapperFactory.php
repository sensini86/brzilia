<?php
namespace Blog\Factory;

use Blog\Mapper\UserZendDbSqlMapper;
use Blog\Model\User;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\Stdlib\Hydrator\ClassMethods;

class UserZendDbSqlMapperFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $dbAdapter = $serviceLocator->get('Zend\Db\Adapter\Adapter');
	$mapperService = new UserZendDbSqlMapper($dbAdapter, new ClassMethods(false), new User());
        // your Mapper has now a really good architecture and no more hidden dependencies.

	return $mapperService;
    }
}