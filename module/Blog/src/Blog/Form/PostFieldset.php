<?php

namespace Blog\Form;

use Blog\Model\Post;
use Zend\Form\Fieldset;
//use Zend\Stdlib\Hydrator\ClassMethods;
use Doctrine\Common\Persistence\ObjectManager;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject as DoctrineHydrator;

class PostFieldset extends Fieldset
{
    public function __construct(ObjectManager $objectManager)
    {
        parent::__construct($objectManager);
        
//        $this->setHydrator(new ClassMethods(false));
        $this->setHydrator(new DoctrineHydrator($objectManager));
        $this->setObject(new Post());
        
        $this->add(array(
            'type' => 'hidden',
            'name' => 'id'
        ));
        
        $this->add(array(
            'type' => 'text',
            'name' => 'text',
            'options' => array(
                'label' => 'The Text'
            ),
        ));
        
        $this->add(array(
            'type' => 'text',
            'name' => 'title',
            'options' => array(
                'label' => 'Blog Title'
            )
        ));

        $userFieldset = new UserFieldset($objectManager);
        $this->add($userFieldset);
        
        /*$this->add(array(
            'type'    => 'Zend\Form\Element\Collection',
            'name'    => 'tags',
            'options' => array(
                'count'           => 2,
                'target_element' => $userFieldset
            )
        ));*/
        
        /*$this->add(array(
            'type' => 'Blog\Form\UserFieldset',
            'name' => 'user',
            'options' => array(
                'label' => 'User'
            )
        ));*/
    }
}
// https://github.com/doctrine/DoctrineModule/blob/master/docs/hydrator.md
