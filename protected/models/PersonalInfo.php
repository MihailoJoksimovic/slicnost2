<?php

namespace app\models;

/**
 * This is the model class for table "personal_info".
 *
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
class PersonalInfo extends \yii\db\ActiveRecord
{
	const GENDER_MALE = 1;
	const GENDER_FEMALE = 2;

	/**
	 * @inheritdoc
	 */
	public static function tableName()
	{
		return 'personal_info';
	}

	/**
	 * @inheritdoc
	 */
	public function rules()
	{
		return array(
			array('first_name, last_name, gender', 'required'),
			array('gender, country', 'integer'),
			array('date_of_birth', 'safe'),
			array('first_name, last_name', 'string', 'max' => 32, 'min' => 2),
			array('full_name', 'string', 'max' => 65, 'min' => 2),
			array('city, address', 'string', 'max' => 64),
			array('about_me', 'string', 'max' => 128)
		);
	}

	/**
	 * @inheritdoc
	 */
	public function attributeLabels()
	{
		return array(
			'user_id' => 'User ID',
			'first_name' => 'First Name',
			'last_name' => 'Last Name',
			'full_name' => 'Full Name',
			'date_of_birth' => 'Date Of Birth',
			'gender' => 'Gender',
			'country' => 'Country',
			'city' => 'City',
			'address' => 'Address',
			'about_me' => 'About Me',
		);
	}

	public function beforeSave()
	{
		//TODO trim everything
		$this->full_name = $this->first_name . ' ' . $this->last_name;
		return true;
	}

	/**
	 * @return \yii\db\ActiveRelation
	 */
	public function getUser()
	{
		return $this->hasOne('User', array('id' => 'user_id'));
	}

	public function getGenderString()
	{
		return $this->gender == self::GENDER_FEMALE ? 'Female' : 'Male';
	}
}
