<?php

use yii\db\Schema;
use yii\db\Migration;

class m150226_173252_cteate_table_post_category extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') 
        {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
        }

        /* Категорії */
        $this->createTable('{{%category}}',
        [
            'id'    => Schema::TYPE_PK,
            'title' => Schema::TYPE_STRING .' NOT NULL',

        ],$tableOptions);

        /* Пости */
        $this->createTable('{{%post}}',
        [
            'id'             => Schema::TYPE_PK,
            'title'          => Schema::TYPE_STRING .' NOT NULL',
            'anons'          => Schema::TYPE_TEXT,
            'content'        => Schema::TYPE_TEXT,
            'category_id'    => Schema::TYPE_INTEGER .' DEFAULT NULL',
            'author_id'      => Schema::TYPE_INTEGER. ' DEFAULT NULL',
            'publish_status' => Schema::TYPE_INTEGER.' DEFAULT NULL',
            'publish_date'   => Schema::TYPE_DATETIME .' NOT NULL',       
        ],$tableOptions);

        $this->addForeignKey('fk_post_category','{{%post}}','category_id','{{%category}}','id', 'SET NULL', 'CASCADE');
        $this->addForeignKey('fk_post_author','{{%post}}','author_id','{{%user}}','id', 'SET NULL', 'CASCADE');

    }

    public function down()
    {
        echo "m150226_173252_cteate_table_post_category cannot be reverted.\n";
        $this->dropTable('{{%category}}');
        $this->dropTable('{{%post}}');

        return false;
    }
}
