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
                    ),
                    array(
                        'actions' => array('finishregistration'),
                        'allow' => true,
                        'roles' => array('@'),
                    )
                ),
            )
        );
    }

    public function actionIndex()
    {
        $user = new \app\models\User();

        if ($user->load($_POST) && $user->save()) {
            if (Yii::$app->getUser()->login($user, 66)) {
                return $this->redirect(array('finishregistration'));
            }
        }

        echo $this->render('base', array('model' => $user));
    }

    public function actionFinishregistration()
    {
        die(var_dump(Yii::$app->getUser()->getIsGuest()));
    }
}
