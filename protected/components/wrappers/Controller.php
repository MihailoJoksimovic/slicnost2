<?php

class Controller extends CController
{
    public $layout = '//layouts/column1';

    public $menu = array();

    public function init()
    {
        $navigationMenu = new NavigationMenu(isGuest());
        $this->menu = $navigationMenu->getMenuItems();
    }
}
