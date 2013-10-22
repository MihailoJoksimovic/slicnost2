<?php

class Lists
{
    public static function getListValue($list, $key)
    {
        return db()->createCommand()
            ->select('value')
            ->from($list)
            ->where('id = :id', array(':id' => $key))
            ->queryScalar();
    }
}