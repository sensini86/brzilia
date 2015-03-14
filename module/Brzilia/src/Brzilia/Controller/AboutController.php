<?php
namespace Brzilia\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class AboutController extends AbstractActionController
{
    public function indexAction()
    {
//        die('zanas');
        
        return new ViewModel();
    }
}
