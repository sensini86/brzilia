<?php
namespace Blog\Mapper;

use Blog\Model\UserInterface;

interface UserMapperInterface
{
    /**
     * 
     * @param int $id
     * @return UserInterface
     * @throws \InvalidArgumentException
     */
    public function find($id);
    
    /**
     * @return array|UserInterface[]
     */
    public function findAll();
    
    /**
     * 
     * @param \Blog\Model\UserInterface $userObject
     * @return UserInterface
     * @throws \Exception
     */
    public function save(UserInterface $userObject);
    
    /**
     * @param UserInterface $userObject
     * 
     * @return bool
     * @throws \Exception
     */
    public function delete(UserInterface $userObject);
}
