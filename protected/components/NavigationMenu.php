<?php

class NavigationMenu
{
    private $isGuest;

    private $userId;

    private $viewedUserId;

    private $guestItems = array(
        array('label'=>'Home', 'url'=>array('/front/index')),
        array('label'=>'Register', 'url'=>array('/register')),
        array('label'=>'Login', 'url'=>array('/front/login'))
    );

    private $loggedInItems = array(
        array('label'=>'Home', 'url'=>array('/front/index')),
        array('label'=>'Register', 'url'=>array('/register')),
        array('label'=>'Login', 'url'=>array('/front/login'))
    );

    public function __construct($isGuest = true, $userId = null, $viewedUserId = null)
    {
        $this->isGuest = $isGuest;
        $this->userId = $userId;
        $this->viewedUserId = $viewedUserId;
    }

    public function getMenuItems()
    {
        if ($this->isGuest) {
            return $this->guestItems;
        } else {
            return array();
        }
    }
}
