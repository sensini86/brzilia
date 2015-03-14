<?php

namespace Blog\Form;

use Zend\Form\Form;
use Zend\Stdlib\Hydrator\ClassMethods;
use Doctrine\Common\Persistence\ObjectManager;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject as DoctrineHydrator;
// http://stackoverflow.com/questions/23281724/how-to-extend-a-fieldset-in-zf2-to-work-with-doctrine-s-class-table-inheritance
class PostForm extends Form
{
    public function __construct(ObjectManager $objectManager)
    {
        parent::__construct($objectManager);
//        $this->setHydrator(new ClassMethods());
        // The form will hydrate an object of type "BlogPost"
        $this->setHydrator(new DoctrineHydrator($objectManager));

        // Add the user fieldset, and set it as the base fieldset
        $blogPostFieldset = new PostFieldset($objectManager);
        $blogPostFieldset->setUseAsBaseFieldset(true);
        $this->add($blogPostFieldset);

        /*$blogPostFieldset = new PostFieldset($objectManager);
        $blogPostFieldset->setUseAsBaseFieldset(true);
        $this->add($blogPostFieldset);

        $userFieldset = new UserFieldset($objectManager);
        $userFieldset->setLabel('User label');
        $userFieldset->setName('user');
        $this->add($userFieldset);*/

        /*$this->add(array(
            'name' => 'post-fieldset',
            'type' => 'Blog\Form\PostFieldset',
            'options' => array(
                'use_as_base_fieldset' => true
            )
        ));*/
        
        $this->add(array(
            'type' => 'submit',
            'name' => 'submit',
            'attributes' => array(
                'value' => 'Insert new Post',
            ),
        ));
    }
}
