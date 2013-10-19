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
                $password = $user->password;
                $user->save();
                $personalInfo->user_id = $user->id;
                $personalInfo->save();
                //login and redirect
                $userIdentity = new UserIdentity($user->email, $password);
                $userIdentity->authenticate();
                u()->login($userIdentity, 0);
                $this->redirect(array('profile/view', 'id' => $user->id));
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
