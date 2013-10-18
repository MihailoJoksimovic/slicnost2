<?php

class m131018_125900_addPersonalInfo extends \yii\db\Migration
{
    public function up()
    {
        $transaction = $this->db->beginTransaction();
        try {
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
                    'about_me' => 'VARCHAR(128)'
                ),
                'engine=InnoDb'
            );

            $this->addForeignKey('fk_personal_user', 'personal_info', 'user_id', 'user', 'id', 'CASCADE', 'CASCADE');

            $transaction->commit();
        } catch (Exception $e) {
            echo "Exception: ".$e->getMessage()."\n";
            $transaction->rollback();
            return false;
        }
    }

    public function down()
    {
        $this->dropTable('personal_info');
    }
}
