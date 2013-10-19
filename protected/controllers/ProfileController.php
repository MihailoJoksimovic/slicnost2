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

        $this->render('view_mine', array('user' => $user));
    }

    private function viewOthers($id)
    {

    }
}
