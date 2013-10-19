<?php

class FlashMessage
{

    public static function getFlashSuccessMessage()
    {
        return t('You have successfully updated your profile.');
    }

    public static function getFlashErrorMessage()
    {
        return t('Some error occurred.');
    }
}
