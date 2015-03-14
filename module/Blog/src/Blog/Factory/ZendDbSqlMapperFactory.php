<?php
namespace Blog\Factory;

use Blog\Mapper\ZendDbSqlMapper;
use Blog\Model\Post;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\Stdlib\Hydrator\ClassMethods;

class ZendDbSqlMapperFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $dbAdapter = $serviceLocator->get('Zend\Db\Adapter\Adapter');
	$mapperService = new ZendDbSqlMapper($dbAdapter, new ClassMethods(false), new Post());
        // your Mapper has now a really good architecture and no more hidden dependencies.

	return $mapperService;
    }
}