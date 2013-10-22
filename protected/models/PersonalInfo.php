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
 * @property integer $relationship_status_id
 * @property integer $height_id
 * @property integer $weight_id
 * @property integer $hair_color_id
 * @property integer $eye_color_id
 * @property integer $body_type_id
 * @property integer $has_kids
 * @property integer $lives_with_id
 * @property integer $wants_kids_id
 * @property integer $marital_status_id
 * @property integer $education_id
 * @property integer $profession
 * @property integer $smoking_id
 * @property integer $drinking_id
 * @property integer $wants_age
 * @property integer $wants_height_id
 * @property integer $wants_body_type_id
 * @property integer $wants_smoking_id
 * @property integer $wants_drinking_id
 * @property integer $wants_education_id
 * @property integer $wants_marital_status_id
 * @property integer $wants_wants_kids_id
 *
 * @property User $user
 */
class PersonalInfo extends ActiveRecord
{

    const GENDER_MALE = 1;
    const GENDER_FEMALE = 2;

    const RELATIONSHIP_SINGLE = 1;
    const RELATIONSHIP_IN_RELATIONSHIP = 2;
    const RELATIONSHIP_MERRIED = 3;

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
            array('gender, country, relationship_status_id, height_id, weight_id, hair_color_id, eye_color_id, body_type_id, has_kids, lives_with_id, wants_kids_id, marital_status_id, education_id, profession, smoking_id, drinking_id, wants_age, wants_height_id, wants_body_type_id, wants_smoking_id, wants_drinking_id, wants_education_id, wants_marital_status_id, wants_wants_kids_id', 'NumberValidator', 'integerOnly' => true),
            array('first_name, last_name', 'StringValidator', 'max' => 32, 'min' => 2),
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
            'relationship_status_id' => t('Relationship Status'),
            'height_id' => t('Height'),
            'weight_id' => t('Weight'),
            'hair_color_id' => t('Hair Color'),
            'eye_color_id' => t('Eye Color'),
            'body_type_id' => t('Body Type'),
            'has_kids' => t('Has Kids'),
            'lives_with_id' => t('Lives With'),
            'wants_kids_id' => t('Wants Kids'),
            'marital_status_id' => t('Marital Status'),
            'education_id' => t('Education'),
            'profession' => t('Profession'),
            'smoking_id' => t('Smoking'),
            'drinking_id' => t('Drinking'),
            'wants_age' => t('Wants Age'),
            'wants_height_id' => t('Wants Height'),
            'wants_body_type_id' => t('Wants Body Type'),
            'wants_smoking_id' => t('Wants Smoking'),
            'wants_drinking_id' => t('Wants Drinking'),
            'wants_education_id' => t('Wants Education'),
            'wants_marital_status_id' => t('Wants Marital Status'),
            'wants_wants_kids_id' => t('Wants Wants Kids'),
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
