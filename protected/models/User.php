<?php

/**
 * This is the model class for table "user".
 *
 * The followings are the available columns in table 'user':
 * @property integer $id
 * @property string $code_name
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
class User extends ActiveRecord
{
    const TYPE_MEMBER = 1;
    const TYPE_ADMIN = 2;

    const STATUS_ACTIVE = 1;
    const STATUS_BLOCKED = 2;

    const VERIFIED_YES = 1;
    const VERIFIED_NO = 2;

    /**
     * Returns the static model of the specified AR class.
     * @return User the static model class
     */
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 'user';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        return array(
            array('email, password', 'required'),
            array('email', 'StringValidator', 'max' => 256),
            // array('email', 'email', 'checkMx' => true),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations()
    {
        return array(
            'personalInfo' => array(self::HAS_ONE, 'PersonalInfo', 'user_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'id' => t('ID'),
            'code_name' => t('Code name'),
            'email' => t('Email'),
            'password' => t('Password'),
            'salt' => t('Salt'),
            'type' => t('Type'),
            'status' => t('Status'),
            'created' => t('Created'),
            'email_hash' => t('Email Hash'),
            'language' => t('Language'),
            'verified' => t('Verified'),
        );
    }

    protected function beforeSave()
    {
        if ($this->isNewRecord) {
            $this->fillInitial();
        }

        return parent::beforeSave();
    }

    private function fillInitial()
    {
        $this->type = self::TYPE_MEMBER;
        $this->status = self::STATUS_ACTIVE;
        $this->verified = self::VERIFIED_NO;
        $this->language = 'en';
        $this->created = time();

        //TODO fancy code name
        $this->code_name = $this->generateCodeName();

        //TODO improve encryptions
        $this->salt = md5(sha1(time() . 'salty') . 'very_salty');
        $this->email_hash = md5($this->salt);
        $this->password = $this->encryptPassword($this->password, $this->salt);
    }

    private function generateCodeName()
    {
        //TODO
        return sha1($this->email);
    }

    public function encryptPassword($password, $salt)
    {
        return hash_hmac('md5', $password, $salt);
    }

    public function validatePassword($password)
    {
        return $this->password === $this->encryptPassword($password, $this->salt);
    }
}
