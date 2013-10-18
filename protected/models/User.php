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
 *
 * @property PersonalInfo $personalInfo
 */
class User extends \yii\db\ActiveRecord implements \yii\web\IdentityInterface
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
            array('email, password', 'required'),
            array('email', 'string', 'max' => 256),
            // array('email', 'email'),
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
        $this->type = self::TYPE_MEMBER;
        $this->status = self::STATUS_ACTIVE;
        $this->verified = self::VERIFIED_NO;
        $this->language = 'en';
        $this->created = time();

        //fancy code name
        $this->username = $this->generateCodeName();
        $this->username_canonical = strtolower($this->username);

        //improve encryptions
        $this->salt = md5(sha1(time() . 'salty') . 'very_salty');
        $this->email_hash = md5($this->salt);
        $this->password = $this->encryptPassword($this->password, $this->salt);
    }

    public function getId()
    {
        return $this->id;
    }

    public static function findIdentity($id)
    {
        return self::find(array('id' => $id));
    }

    public static function findByEmail($email, $onlyActive = true) 
    {
        $conditions = array(
            'email' => $email
        );

        if ($onlyActive) {
            $conditions['status'] = self::STATUS_ACTIVE;
        }

        return self::find($conditions);
    }

    public function getAuthKey()
    {
        return $this->email_hash;
    }

    public function validateAuthKey($authKey)
    {
        return $this->email_hash == $authKey;
    }

    private function encryptPassword($password, $salt)
    {
        return hash_hmac('md5', $password, $salt);
    }

    public function validatePassword($password)
    {
        return $this->password === $this->encryptPassword($password, $this->salt);
    }

    private function generateCodeName()
    {
        //TODO
        return sha1($this->email); 
    }
    
    /**
     * @return \yii\db\ActiveRelation
     */
    public function getPersonalInfo()
    {
        return $this->hasOne('PersonalInfo', array('user_id' => 'id'));
    }
}
