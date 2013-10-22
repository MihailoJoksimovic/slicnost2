<?php

class m131019_155824_user extends CDbMigration
{
    public function safeUp()
    {
        $this->createTable(
            'user',
            array(
                'id' => 'pk',
                'code_name' => 'VARCHAR(32) NOT NULL UNIQUE',
                'email' => 'VARCHAR(256) NOT NULL UNIQUE',
                'password' => 'VARCHAR(128) NOT NULL',
                'salt' => 'VARCHAR(128) NOT NULL',
                'type' => 'TINYINT NOT NULL',
                'status' => 'TINYINT NOT NULL',
                'created' => 'INT NOT NULL',
                'email_hash' => 'VARCHAR(128) NOT NULL',
                'language' => 'VARCHAR(2) NOT NULL',
                'verified' => 'TINYINT NOT NULL',
            ),
            'engine=InnoDb'
        );

        $this->createTable(
            'personal_info',
            array(
                'user_id' => 'INT NOT NULL PRIMARY KEY',
                'first_name' => 'VARCHAR(32) NOT NULL',
                'last_name' => 'VARCHAR(32) NOT NULL',
                'full_name' => 'VARCHAR(65) NOT NULL',
                'date_of_birth' => 'DATE',
                'gender' => 'TINYINT NOT NULL',
                'country' => 'SMALLINT',
                'city' => 'VARCHAR(64)',
                'address' => 'VARCHAR(64)',
                'about_me' => 'VARCHAR(128)',
                'relationship_status_id' => 'TINYINT'
            ),
            'engine=InnoDb'
        );

        $this->addForeignKey('fk_personal_user', 'personal_info', 'user_id', 'user', 'id', 'CASCADE', 'CASCADE');
    }

    public function safeDown()
    {
        $this->dropTable('personal_info');
        $this->dropTable('user');
    }
}
