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
    public $defaultAction = 'register';

    public function behaviors()
    {
        return array(
            'access' => array(
                'class' => AccessControl::className(),
                'rules' => array(
                    array(
                        'actions' => array('register'),
                        'allow' => true,
                        'roles' => array('?'),
                    )
                ),
            )
        );
    }

    public function actionRegister()
    {
        $user = new \app\models\User();

        if ($user->load($_POST) && $user->save()) {
            if (Yii::$app->getUser()->login($user, 66)) {
                return $this->goHome();
            }
        }

        echo $this->render('register', array('user' => $user));
    }
}
