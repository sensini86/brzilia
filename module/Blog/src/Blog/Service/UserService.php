<?php
namespace Blog\Service;

use Blog\Mapper\UserMapperInterface;
use Blog\Model\UserInterface;

class UserService implements UserServiceInterface
{
    /**
     *
     * @var \Blog\Mapper\UserMapperInterface
     */
    protected $userMapper;
    
    /**
     * 
     * @param \Blog\Mapper\UserMapperInterface $userMapper
     */
    public function __construct(UserMapperInterface $userMapper)
    {
        $this->userMapper = $userMapper;
    }
    
    /**
     * {@inheritDoc}
     */
    public function findAllUsers()
    {
        return $this->userMapper->findAll();
    }
    
    /**
     * {@inheritDoc}
     */
    public function findUser($id)
    {
        return $this->userMapper->find($id);
    }
    
    /**
     * {@inheritDoc}
     */
    public function saveUser(UserInterface $user)
    {
        return $this->userMapper->save($user);
    }
    
    /**
     * {@inheritDoc}
     */
    public function deleteUser(UserInterface $user)
    {
        return $this->userMapper->delete($user);
    }
}
