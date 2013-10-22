<?php

class m131022_162342_add_lists extends CDbMigration
{
    public function safeUp()
    {
        $this->createTable(
            'list_height',
            array(
                'id' => 'TINYINT PRIMARY KEY AUTO_INCREMENT',
                'value' => 'VARCHAR(32) NOT NULL UNIQUE'
            ),
            'engine=InnoDb'
        );
        $this->createTable(
            'list_weight',
            array(
                'id' => 'TINYINT PRIMARY KEY AUTO_INCREMENT',
                'value' => 'VARCHAR(32) NOT NULL UNIQUE'
            ),
            'engine=InnoDb'
        );
        $this->createTable(
            'list_hair_color',
            array(
                'id' => 'TINYINT PRIMARY KEY AUTO_INCREMENT',
                'value' => 'VARCHAR(32) NOT NULL UNIQUE'
            ),
            'engine=InnoDb'
        );
        $this->createTable(
            'list_eye_color',
            array(
                'id' => 'TINYINT PRIMARY KEY AUTO_INCREMENT',
                'value' => 'VARCHAR(32) NOT NULL UNIQUE'
            ),
            'engine=InnoDb'
        );

        //fill with some values
        $this->insert('list_height', array('value' => '162'));
        $this->insert('list_height', array('value' => '172'));
        $this->insert('list_height', array('value' => '182'));
        $this->insert('list_height', array('value' => '192'));
        $this->insert('list_weight', array('value' => '62'));
        $this->insert('list_weight', array('value' => '72'));
        $this->insert('list_weight', array('value' => '82'));
        $this->insert('list_weight', array('value' => '92'));
        $this->insert('list_hair_color', array('value' => 'Red'));
        $this->insert('list_hair_color', array('value' => 'Brown'));
        $this->insert('list_hair_color', array('value' => 'Black'));
        $this->insert('list_hair_color', array('value' => 'Blonde'));
        $this->insert('list_eye_color', array('value' => 'Blue'));
        $this->insert('list_eye_color', array('value' => 'Brown'));
        $this->insert('list_eye_color', array('value' => 'Black'));
        $this->insert('list_eye_color', array('value' => 'Green'));

        //link with personal info
        $this->addForeignKey('fk_person_height', 'personal_info', 'height_id', 'list_height', 'id', 'CASCADE', 'SET NULL');
        $this->addForeignKey('fk_person_weight', 'personal_info', 'weight_id', 'list_weight', 'id', 'CASCADE', 'SET NULL');
        $this->addForeignKey('fk_person_hair_color', 'personal_info', 'hair_color_id', 'list_hair_color', 'id', 'CASCADE', 'SET NULL');
        $this->addForeignKey('fk_person_eye_color', 'personal_info', 'eye_color_id', 'list_eye_color', 'id', 'CASCADE', 'SET NULL');
    }

    public function safeDown()
    {
        $this->dropTable('list_height');
        $this->dropTable('list_weight');
        $this->dropTable('list_hair_color');
        $this->dropTable('list_eye_color');
    }
}