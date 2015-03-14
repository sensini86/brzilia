<?php
namespace Checklist\Model;

class TaskEntity
{
    protected $id;
    protected $title;
    protected $completed = 0;
    protected $created;
    
    public function __construct()
    {
        $this->created = date('Y-m-d H:i:s');
    }
    
    public function getId()
    {
        return $this->id;
    }
    
    public function setId($value)
    {
        $this->id = $value;
    }
    
    public function getTitle()
    {
        return $this->title;
    }
    
    public function setTitle($value)
    {
        $this->title = $value;
    }
    
    public function getCompleted()
    {
        return $this->completed;
    }
    
    public function setCompleted($value)
    {
        $this->completed = $value;
    }
    
    public function getCreated()
    {
        return $this->created;
    }
    
    public function setCreated($value)
    {
        $this->created = $value;
    }
}