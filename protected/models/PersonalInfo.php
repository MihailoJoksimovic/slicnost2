<?php

/**
 * This is the model class for table "personal_info".
 *
 * The followings are the available columns in table 'personal_info':
 * @property integer $user_id
 * @property string $first_name
 * @property string $last_name
 * @property string $full_name
 * @property string $date_of_birth
 * @property integer $gender
 * @property integer $country
 * @property string $city
 * @property string $address
 * @property string $about_me
 *
 * @property User $user
 */
class PersonalInfo extends ActiveRecord
{

    const GENDER_MALE = 1;
    const GENDER_FEMALE = 2;

    /**
     * Returns the static model of the specified AR class.
     * @return PersonalInfo the static model class
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
        return 'personal_info';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        return array(
            array('first_name, last_name, gender', 'required'),
            array('gender, country', 'NumberValidator', 'integerOnly' => true),
            array('first_name, last_name', 'StringValidator', 'max' => 32),
            array('date_of_birth', 'safe'),
            array('city, address', 'StringValidator', 'max' => 64),
            array('about_me', 'StringValidator', 'max' => 128),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations()
    {
        return array(
            'user' => array(self::BELONGS_TO, 'User', 'user_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'user_id' => t('User'),
            'first_name' => t('First Name'),
            'last_name' => t('Last Name'),
            'full_name' => t('Full Name'),
            'date_of_birth' => t('Date Of Birth'),
            'gender' => t('Gender'),
            'country' => t('Country'),
            'city' => t('City'),
            'address' => t('Address'),
            'about_me' => t('About Me'),
        );
    }

    protected function beforeSave()
    {
        //TODO trim everything
        if ($this->isNewRecord) {
            $this->full_name = $this->first_name . ' ' . $this->last_name;
        }

        return parent::beforeSave();
    }

    public function getGenderString()
    {
        return $this->gender == self::GENDER_FEMALE ? t('Female') : t('Male');
    }

    public static function getGenderStringStatic($gender)
    {
        return $gender == self::GENDER_FEMALE ? t('Female') : t('Male');
    }
}
