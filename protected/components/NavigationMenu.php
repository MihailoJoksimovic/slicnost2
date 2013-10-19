<?php

class NavigationMenu
{
    private $isGuest;

    private $userId;

    private $viewedUserId;

    private $guestItems = array(
        array('label' => 'Home', 'url' => array('/front/index')),
        array('label' => 'Register', 'url' => array('/register')),
        array('label' => 'Login', 'url' => array('/front/login'))
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
            return $this->getLoggedInMenuItems();
        }
    }

    private function getLoggedInMenuItems()
    {
        return array(
            array('label' => 'Home', 'url' => array('/front/index')),
            array('label' => 'Profile', 'url' => array('/profile/view', 'id' => $this->userId)),
            array('label' => 'Logout', 'url' => array('/front/logout'))
        );
    }
}
