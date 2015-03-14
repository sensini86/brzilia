<?php
namespace ChecklistTest\Controller;

use Zend\Test\PHPUnit\Controller\AbstractHttpControllerTestCase;

class TaskControllerTest extends AbstractHttpControllerTestCase
{
//    protected $traceError = true;
    protected $traceError = true;
    public function setUp()
    {
        
        $this->setApplicationConfig(include 'd:/xampp/htdocs/brzilia/config/application.config.php');
        parent::setUp();
    }
    
    public function testIndexActionCanBeAccessed()
    {
        $checklistTableMock = $this->getMockBuilder('Checklist\Model\TaskMapper')
                ->disableOriginalConstructor()
                ->getMock();
        $checklistTableMock->expects($this->once())
                ->method('fetchAll')
                ->will($this->returnValue(array()));
        
        $serviceManager = $this->getApplicationServiceLocator();
        $serviceManager->setAllowOverride(true);
        $serviceManager->setService('Checklist\Model\TaskMapper',$checklistTableMock);
        
        
        
        $this->dispatch('/task');
        $this->assertResponseStatusCode(200);
        
        $this->assertModuleName('Checklist');
        $this->assertControllerName('Checklist\Controller\Task');
        $this->assertControllerClass('TaskController');
        $this->assertMatchedRouteName('task');
    }
}