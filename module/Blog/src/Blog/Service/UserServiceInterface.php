<?php
namespace Blog\Service;

use Blog\Model\UserInterface;

interface UserServiceInterface
{
    /**
     * Should return a set of all usersthat we can iterate over. Single entries of the array
     * implementing \Blog\Model\UserInterface
     * 
     * @return array|UserInterface[]
     */
    public function findAllUsers();
    
    /**
     * Should return a single user
     * 
     * @param int $id Identifier of the User that should be returned
     * @return UserInterface
     */
    public function findUser($id);
    
    /**
     * Should save a given implementation of the UserInterface and return it. If it is an existing
     * should be updated, if it's a new User it should be created.
     * 
     * @param \Blog\Model\UserInterface $user
     * @return UserInterface
     */
    public function saveUser(UserInterface $user);
    
    /**
     * Should delete a given implementation of the UserInterface and return true if the deletion
     * has been successful or false if not
     * 
     * @param \Blog\Model\UserInterface $user
     * @return bool
     */
    public function deleteUser(UserInterface $user);
}
