<?php

namespace app\controllers;

use Yii;
use yii\web\AccessControl;
use yii\web\Controller;
use yii\web\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;

class FrontController extends Controller
{
    public function behaviors()
    {
        return array(
            'access' => array(
                'class' => AccessControl::className(),
                'only' => array('login', 'logout'),
                'rules' => array(
                    array(
                        'actions' => array('login'),
                        'allow' => true,
                        'roles' => array('?'),
                    ),
                    array(
                        'actions' => array('logout'),
                        'allow' => true,
                        'roles' => array('@'),
                    ),
                ),
            ),
            'verbs' => array(
                'class' => VerbFilter::className(),
                'actions' => array(
                    'logout' => array('post'),
                ),
            ),
        );
    }

    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionContact()
    {
        $model = new ContactForm;
        if ($model->load($_POST) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');
            return $this->refresh();
        } else {
            return $this->render('contact', array(
                'model' => $model,
            ));
        }
    }

    public function actionAbout()
    {
        return $this->render('about');
    }
}
