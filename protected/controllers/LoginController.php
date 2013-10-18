<?php

namespace app\controllers;

use Yii;
use yii\web\AccessControl;
use yii\web\Controller;
use yii\web\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;

class LoginController extends Controller
{
    public function actionLogin()
    {
        $model = new LoginForm();
        if ($model->load($_POST) && $model->login()) {
            return $this->goBack();
        } else {
            return $this->render('login', array(
                'model' => $model,
            ));
        }
    }

    public function actionLogout()
    {
        Yii::$app->user->logout();
        return $this->goHome();
    }
}
