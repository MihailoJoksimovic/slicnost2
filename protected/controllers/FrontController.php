<?php

class FrontController extends Controller
{
    public function actionIndex()
    {
        $this->render('index');
    }

    public function actionError()
    {
        if ($error=Yii::app()->errorHandler->error) {
            if (Yii::app()->request->isAjaxRequest) {
                echo $error['message'];
            } else {
                $this->render('error', $error);
            }
        }
    }

    public function actionLogin()
    {
        $loginForm = new LoginForm;

        if (isset($_POST['LoginForm'])) {
            $loginForm->attributes=$_POST['LoginForm'];

            if ($loginForm->validate() && $loginForm->login()) {
                if (u()->returnUrl == a()->getRequest()->scriptUrl || u()->returnUrl == url('/user/logout')) {
                    //default redirect
                    $this->redirect(array('/front'));
                } else {
                    $this->redirect(u()->returnUrl);
                }
            }
        }

        $this->render('login', array('loginForm'=>$loginForm));
    }

    public function actionLogout()
    {
        u()->logout();
        $this->redirect(a()->homeUrl);
    }
}
