<?php

class ListLoaderController extends Controller
{
    public function actionLoadList($listName)
    {
        $list = db()->createCommand()
        ->select('id, value')
        ->from($listName)
        ->queryAll();
        $new = array();
        foreach ($list as $key => $value) {
            $new[$value['id']] = $value['value'];
        }

        echo json_encode($new);
    }
}