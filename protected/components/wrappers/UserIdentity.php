<?php

/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */
class UserIdentity extends CUserIdentity
{
    const ERROR_EMAIL_INVALID = 3;

    private $_email;

    private $_password;

    private $_id;

    public function __construct($email, $password)
    {
        $this->_email = $email;
        $this->_password = $password;
    }

    public function getId()
    {
        return $this->_id;
    }

    /**
     * Authenticates a user.
     * The example implementation makes sure if the username and password
     * are both 'demo'.
     * In practical applications, this should be changed to authenticate
     * against some persistent user identity storage (e.g. database).
     * @return boolean whether authentication succeeds.
     */
    public function authenticate()
    {
        $user = User::model()->find(
            'LOWER(email) = :email',
            array(':email' => strtolower($this->_email))
        );

        if (!isset($user)) {
            $this->errorCode = self::ERROR_EMAIL_INVALID;
        } else if ($user->password !== $user->encryptPassword($this->_password, $user->salt)) {
            $this->errorCode = self::ERROR_PASSWORD_INVALID;
        } else {
            $this->errorCode=self::ERROR_NONE;
            $this->_id = $user->id;
            $this->updateSession();
        }
        return !$this->errorCode;
    }

    private function updateSession()
    {
        // $this->setState('key', 'value');
    }
}
