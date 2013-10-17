<?php

namespace app\controllers;

use Yii;
use yii\web\AccessControl;
use yii\web\Controller;
use yii\web\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;

class RegisterController extends Controller
{
    public $defaultAction = 'index';

    public function behaviors()
    {
        return array(
            'access' => array(
                'class' => AccessControl::className(),
                'rules' => array(
                    array(
                        'actions' => array('index'),
                        'allow' => true,
                        'roles' => array('?'),
                    )
                ),
            )
        );
    }

    public function actionIndex()
    {
        $user = new \app\models\User();

        if ($user->load($_POST) && $user->save()) {
            die('Saved successfully <br />' . print_r($user, true));
        }

        echo $this->render('base', array('model' => $user));
    }
}
