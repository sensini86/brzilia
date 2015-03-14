<?php
namespace Blog\Factory;

use Blog\Form\PostForm;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class PostFormFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        return new PostForm($serviceLocator->get('Doctrine\Common\Persistence\ObjectManager'));
    }
}
