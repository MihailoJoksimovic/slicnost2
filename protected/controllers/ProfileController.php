<?php

namespace app\controllers;

use Yii;
use yii\web\AccessControl;
use yii\web\Controller;
use app\models\User;
use app\models\PersonalInfo;

class ProfileController extends Controller
{
    public $defaultAction = 'view';

    public function behaviors()
    {
        return array(
            'access' => array(
                'class' => AccessControl::className(),
                'rules' => array(
                    array(
                        'actions' => array('view'),
                        'allow' => true,
                        'roles' => array('@'),
                    )
                ),
            )
        );
    }

    public function actionView($id)
    {
        $user = User::find($id);

        return $this->render('view', array('user' => $user));
    }

    public function actionEdit()
    {
        return $this->render('index');
    }
}
