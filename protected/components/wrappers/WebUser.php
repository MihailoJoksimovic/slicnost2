<?php

/**
 * Description of WebUser
 *
 * @author Zarko Stankovic <stankovic.zarko@gmail.com>
 */
class WebUser extends CWebUser
{

    protected function afterLogin($fromCookie)
    {
        //TODO log user logins
    }

    /**
     * Sometimes there is some unwanted ajax call, and that must be ignored
     * because we will lost flash messages (Yii have bug with flash messages)
     */
    protected function updateFlash()
    {
        if (!isAjax()) {
            parent::updateFlash();
        }
    }
}
