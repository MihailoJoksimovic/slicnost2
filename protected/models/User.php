<?php

namespace app\models;

/**
 * This is the model class for table "user".
 *
 * @property integer $id
 * @property string $username
 * @property string $username_canonical
 * @property string $email
 * @property string $password
 * @property string $salt
 * @property integer $type
 * @property integer $status
 * @property integer $created
 * @property string $email_hash
 * @property string $language
 * @property integer $verified
 */
class User extends \yii\db\ActiveRecord
{
    const TYPE_MEMBER = 1;
    const TYPE_ADMIN = 2;

    const STATUS_ACTIVE = 1;
    const STATUS_BLOCKED = 2;

    const VERIFIED_YES = 1;
    const VERIFIED_NO = 2;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return array(
            array('username, email, password', 'required'),
            array('username', 'string', 'max' => 32),
            array('email', 'string', 'max' => 256),
            array('password', 'string', 'max' => 128)
        );
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return array(
            'id' => 'ID',
            'username' => 'Username',
            'username_canonical' => 'Username Canonical',
            'email' => 'Email',
            'password' => 'Password',
            'salt' => 'Salt',
            'type' => 'Type',
            'status' => 'Status',
            'created' => 'Created',
            'email_hash' => 'Email Hash',
            'language' => 'Language',
            'verified' => 'Verified',
        );
    }

    public function beforeSave()
    {
        if ($this->getIsNewRecord()) {
            $this->fillInitial();
        }
        return true;
    }

    private function fillInitial()
    {
        $this->username_canonical = strtolower($this->username);
        $this->type = self::TYPE_MEMBER;
        $this->status = self::STATUS_ACTIVE;
        $this->verified = self::VERIFIED_NO;
        $this->language = 'en';

        //improve encryptions
        $this->salt = md5(sha1(time() . 'salty') . 'very_salty');
        $this->email_hash = md5($this->salt);
        $this->password = hash_hmac('md5', $this->password, $this->salt);
        $this->created = time();
    }
}
