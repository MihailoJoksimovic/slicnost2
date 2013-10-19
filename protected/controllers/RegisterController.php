<?php

class RegisterController extends Controller
{
    public function actionIndex()
    {
        $user = new User;
        $personalInfo = new PersonalInfo;

        if (isset($_POST['User'], $_POST['PersonalInfo'])) {
            $user->attributes = $_POST['User'];
            $personalInfo->attributes = $_POST['PersonalInfo'];

            if ($user->validate() & $personalInfo->validate()) {
                $user->save();
                $personalInfo->user_id = $user->id;
                $personalInfo->save();
                //login and redirect
                $userIdentity = new UserIdentity($user->email, '');
                $userIdentity->authenticate(TRUE);
                u()->login($userIdentity, 60 * 60 * 24 * 30);
            }
        }

        $this->render(
            'index',
            array(
                'user' => $user,
                'personalInfo' => $personalInfo
            )
        );
    }
}
