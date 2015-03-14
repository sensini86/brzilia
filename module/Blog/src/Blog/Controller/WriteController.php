<?php

namespace Blog\Controller;

use Blog\Service\PostServiceInterface;
use Zend\Form\FormInterface;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Blog\Form\PostForm;

class WriteController extends AbstractActionController
{
    protected $postService;
    
    protected $postForm;
    
    public function __construct(PostServiceInterface $postService, FormInterface $postForm)
    {
        $this->postService  = $postService;
        $this->postForm     = $postForm;
    }
    
    public function addAction()
    {
        // Get your ObjectManager from the ServiceManager
        $objectManager = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');
//        $objectManager = $this->getServiceLocator()->get('Doctrine\Common\Persistence\ObjectManager');

        // Create the form and inject the ObjectManager
        $form = new PostForm($objectManager);
        // Create a new, empty entity and bind it to the form
        $blogPost = new BlogPost();
        $form->bind($blogPost);

        if ($this->request->isPost()) {
            $form->setData($this->request->getPost());

            if ($form->isValid()) {
                $objectManager->persist($blogPost);
                $objectManager->flush();
            }
        }

        return array('form' => $form);

    
        /*$request = $this->getRequest();
        
        if ($request->isPost())
        {
            $this->postForm->setData($request->getPost());
            
            if ($this->postForm->isValid())
            {
                try {
                    \Zend\Debug\Debug::dump($this->postForm->getData());die();
                    $this->postService->savePost($this->postForm->getData());
                    
                    return $this->redirect()->toRoute('blog');
                } catch (\Exception $e) {
                    // Some DB Error happened, log it and let the user know
                }
            }
        }
        
        return new ViewModel(array(
            'form' => $this->postForm
        ));*/
    }
    
    public function editAction()
    {
        $request = $this->getRequest();
        $post    = $this->postService->findPost($this->params('id'));
        
        $this->postForm->bind($post);
        
        if ($request->isPost())
        {
            $this->postForm->setData($request->getPost());
            
            if ($this->postForm->isValid())
            {
                try {
                    $this->postService->savePost($post);
                    
                    return $this->redirect()->toRoute('blog');
                } catch (\Exception $ex) {
                    die($ex->getMessage());
                    // Some DB Error happened, log it and let the user know
                }
            }
        }
        
        return new ViewModel(array(
            'form' => $this->postForm
        ));
    }
}
