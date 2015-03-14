<?php
namespace Blog\Mapper;

use Blog\Model\UserInterface;
use Zend\Db\Adapter\AdapterInterface;
use Zend\Db\Adapter\Driver\ResultInterface;
use Zend\Db\ResultSet\HydratingResultSet;
use Zend\Db\Sql\Sql;
use Zend\Db\Sql\Insert;
use Zend\Db\Sql\Update;
use Zend\Db\Sql\Delete;
use Zend\Stdlib\Hydrator\HydratorInterface;

class UserZendDbSqlMapper implements UserMapperInterface
{
    /**
     * @var \Zend\Db\Adapter\AdapterInterface
     */
    protected $dbAdapter;
    
    /**
     *
     * @var \Zend\Stdlib\Hydrator\HydratorInterface
     */
    protected $hydrator;
    
    /**
     *
     * @var \Blog\Model\UserInterface
     */
    protected $userPrototype;

    /**
     * 
     * @param \Zend\Db\Adapter\AdapterInterface $dbAdapter
     * @param \Zend\Stdlib\Hydrator\HydratorInterface $hydrator
     * @param \Blog\Model\UserInterface $userPrototype
     */
    public function __construct(AdapterInterface $dbAdapter, HydratorInterface $hydrator, UserInterface $userPrototype)
    {
        $this->dbAdapter    = $dbAdapter;
        $this->hydrator     = $hydrator;
        $this->userPrototype= $userPrototype;
    }
    
    /**
     * 
     * @param int|string $id
     * 
     * @return PostInterface
     * @throws \InvalidArgumentException
     */
    public function find($id)
    {
        $sql    = new Sql($this->dbAdapter);
        $select = $sql->select('users');
        $select->where(array('uid = ?' => $id));
        
        $stmt   = $sql->prepareStatementForSqlObject($select);
        $result = $stmt->execute();
        
        if ($result instanceof ResultInterface && $result->isQueryResult() && $result->getAffectedRows())
        {
            return $this->hydrator->hydrate($result->current(), $this->userPrototype);
        }
        
        throw new \InvalidArgumentException("User with given ID:{$id} not found.");
    }
    
    /**
     * @return array|UserInterface[]
     */
    public function findAll()
    {
        $sql    = new Sql($this->dbAdapter);
        $select = $sql->select('users');
        
        $stmt   = $sql->prepareStatementForSqlObject($select);
        $result = $stmt->execute();
        
        if ($result instanceof ResultInterface && $result->isQueryResult())
        {
            $resultSet = new HydratingResultSet($this->hydrator, $this->userPrototype);
            
            return $resultSet->initialize($result);
        }
        
        return array();
    }
    
    public function save(UserInterface $userObject)
    {
        $userData = $this->hydrator->extract($userObject);
        unset($userData['uid']); // Neither Insert nor Update needs the ID in the array
        
        if ($userObject->getId())
        {
            // ID present, it's an Update
            $action = new Update('users');
            $action->set($userData);
            $action->where(array('uid = ?' => $userObject->getUid()));
        }
        else
        {
            // ID NOT present, it's and Insert
            $action = new Insert('users');
            $action->values($userData);
        }
        
        $sql    = new Sql($this->dbAdapter);
        $stmt   = $sql->prepareStatementForSqlObject($action);
        $result = $stmt->execute();
        
        if ($result instanceof ResultInterface)
        {
            if ($newId = $result->getGeneratedValue())
            {
                // When a value has been generated, set it on the object
                $userObject->setUid($newId);
            }
            
            return $userObject;
        }
        
        throw new \Exception("Database error");
    }
    
    /**
     * {@inheritDoc}
     */
    public function delete(UserInterface $userObject)
    {
        $action = new Delete('users');
        $action->where(array('uid = ?' => $userObject->getUid()));
        
        $sql    = new Sql($this->dbAdapter);
        $stmt   = $sql->prepareStatementForSqlObject($action);
        $result = $stmt->execute();
        
        return (bool)$result->getAffectedRows();
    }
}
