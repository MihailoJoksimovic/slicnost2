<?php

class m131022_151610_add_more_personal_info extends CDbMigration
{
    public function safeUp()
    {
        $this->addColumn('personal_info', 'height_id', 'TINYINT');
        $this->addColumn('personal_info', 'weight_id', 'TINYINT');
        $this->addColumn('personal_info', 'hair_color_id', 'TINYINT');
        $this->addColumn('personal_info', 'eye_color_id', 'TINYINT');
        $this->addColumn('personal_info', 'body_type_id', 'TINYINT');
        $this->addColumn('personal_info', 'has_kids', 'TINYINT');
        $this->addColumn('personal_info', 'lives_with_id', 'TINYINT');
        $this->addColumn('personal_info', 'wants_kids_id', 'TINYINT');
        $this->addColumn('personal_info', 'marital_status_id', 'TINYINT');
        $this->addColumn('personal_info', 'education_id', 'TINYINT');
        $this->addColumn('personal_info', 'profession', 'TINYINT');
        $this->addColumn('personal_info', 'smoking_id', 'TINYINT');
        $this->addColumn('personal_info', 'drinking_id', 'TINYINT');
        $this->addColumn('personal_info', 'wants_age', 'TINYINT');
        $this->addColumn('personal_info', 'wants_height_id', 'TINYINT');
        $this->addColumn('personal_info', 'wants_body_type_id', 'TINYINT');
        $this->addColumn('personal_info', 'wants_smoking_id', 'TINYINT');
        $this->addColumn('personal_info', 'wants_drinking_id', 'TINYINT');
        $this->addColumn('personal_info', 'wants_education_id', 'TINYINT');
        $this->addColumn('personal_info', 'wants_marital_status_id', 'TINYINT');
        $this->addColumn('personal_info', 'wants_wants_kids_id', 'TINYINT');
    }

    public function safeDown()
    {
    }
}