<?php

use yii\db\Schema;
use yii\db\Migration;

class m150224_211254_create_base_table extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') 
        {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
        }

        /* Користувачі*/
        $this->createTable('{{%user}}',
        [
            'id'                   => Schema::TYPE_PK,
            'username'             => Schema::TYPE_STRING . ' NOT NULL',
            'auth_key'             => Schema::TYPE_STRING . '(32) DEFAULT NULL',
            'password_hash'        => Schema::TYPE_STRING . ' NOT NULL',
            'password_reset_token' => Schema::TYPE_STRING . ' NULL DEFAULT NULL',
            'email'                => Schema::TYPE_STRING . ' NOT NULL',
            'email_confirm_token'  => Schema::TYPE_STRING . ' NULL DEFAULT NULL',
            'status'               => Schema::TYPE_SMALLINT . ' NOT NULL DEFAULT 0',
            'created_at'           => Schema::TYPE_INTEGER . ' NOT NULL',
            'updated_at'           => Schema::TYPE_INTEGER . ' NOT NULL',
        ], $tableOptions);

        $this->createIndex('idx_user_username','{{%user}}','username');
        $this->createIndex('idx_user_email'   ,'{{%user}}','email');
        $this->createIndex('idx_user_status'   ,'{{%user}}','status');


    }

    public function down()
    {

        $this->dropTable('{{%user}}');
        return false;
    }
}
