<?php
namespace Blog\Model;

interface UserInterface
{
    /**
     * Will return the ID of the user
     * 
     * @return int
     */
    public function getUid();
    
    /**
     * Will return the name of the user
     * 
     * @return string
     */
    public function getUname();

    /**
     * Will return the surname of the
     * 
     * @return string
     */
    public function getUsurename();

    /**
     * Will return the age of the
     * 
     * @return int
     */
    public function getUage();
}
