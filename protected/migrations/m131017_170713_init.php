<?php

class m131017_170713_init extends \yii\db\Migration
{
    public function up()
    {
        $transaction = $this->db->beginTransaction();
        try {
            $this->createTable(
                'user',
                array(
                    'id' => 'pk',
                    'username' => 'VARCHAR(32) NOT NULL UNIQUE',
                    'username_canonical' => 'VARCHAR(32) NOT NULL UNIQUE',
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

            $transaction->commit();
        } catch (Exception $e) {
            echo "Exception: ".$e->getMessage()."\n";
            $transaction->rollback();
            return false;
        }
    }

    public function down()
    {
        $this->dropTable('user');
    }
}
