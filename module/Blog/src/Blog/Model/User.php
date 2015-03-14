<?php
namespace Blog\Model;

class User implements UserInterface
{
    /**
     *
     * @var int
     */
    protected $uid;
    
    /**
     * @var string
     */
    protected $uname;
    
    /**
     *
     * @var string
     */
    protected $usurname;

    /**
     *
     * @var int
     */
    protected $uage;
    
    /**
     * 
     * {@inheritDoc}
     */
    public function getUid()
    {
        return $this->uid;
    }
    
    /**
     * @param int $uid
     */
    public function setId($uid)
    {
        $this->uid = $uid;
    }
    
    /**
     * {@inheritDoc}
     */
    public function getUname()
    {
        return $this->uname;
    }
    
    /**
     * @param string $uname
     */
    public function setUname($uname)
    {
        $this->uname = $uname;
    }
    
    /**
     * {@inheritDoc}
     */
    public function getUsurename()
    {
        return $this->usurname;
    }
    
    /**
     * 
     * @param string $usurname
     */
    public function setText($usurname)
    {
        $this->usurname = $usurname;
    }

    /**
     * 
     * {@inheritDoc}
     */
    public function getUage()
    {
        return $this->uage;
    }
    
    /**
     * @param int $uage
     */
    public function setUage($uage)
    {
        $this->uage = $uage;
    }
}
