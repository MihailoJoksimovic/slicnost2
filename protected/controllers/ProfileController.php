<?php

class ProfileController extends Controller
{
    public function actionView($id)
    {
        if (isGuest() || $id != uid()) {
            $this->viewOthers($id);
        } else {
            $this->viewMine();
        }
    }

    private function viewMine()
    {
        $user = User::model()->with('personalInfo')->find(uid());

        $this->render('view_mine', array('user' => $user, 'personalInfo' => $user->personalInfo));
    }

    private function viewOthers($id)
    {
        //if can view
    }

    public function actionEdit()
    {
        $user = User::model()->with('personalInfo')->find(uid());

        $this->render('edit', array('user' => $user));
    }

    public function actionAjaxEditField()
    {
        $personalInfo = PersonalInfo::model()->find(uid());

        if ($personalInfo->hasAttribute($_POST['id'])) {
            $personalInfo->$_POST['id'] = $_POST['value'];
            if ($personalInfo->validate() && $personalInfo->update(array($_POST['id']))) {
                echo $personalInfo->$_POST['id'];
            } else {
                //print error
                //p($personalInfo->errors);
            }
        }
    }
}
