<?php

namespace Blog\Form;

use Blog\Model\User;
use Zend\Form\Fieldset;
//use Zend\Stdlib\Hydrator\ClassMethods;
use Doctrine\Common\Persistence\ObjectManager;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject as DoctrineHydrator;

class UserFieldset extends Fieldset
{
    public function __construct(ObjectManager $objectManager)
    {
        parent::__construct($objectManager);
        
//        $this->setHydrator(new ClassMethods(false));
        $this->setHydrator(new DoctrineHydrator($objectManager));
        $this->setObject(new User());
        
        $this->add(array(
            'type' => 'hidden',
            'name' => 'uid'
        ));
        
        $this->add(array(
            'type' => 'text',
            'name' => 'uname',
            'options' => array(
                'label' => 'Name'
            ),
        ));
        
        $this->add(array(
            'type' => 'text',
            'name' => 'usurname',
            'options' => array(
                'label' => 'Surname'
            )
        ));

        $this->add(array(
            'type' => 'text',
            'name' => 'uage',
            'options' => array(
                'label' => 'Age'
            )
        ));
    }
}
