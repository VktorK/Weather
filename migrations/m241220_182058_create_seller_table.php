<?php

use yii\db\Migration;

/**
 * Class m241220182058_create_seller_table
 */
class m241220_182058_create_seller_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%seller}}', [
            'id' => $this->primaryKey(),
            'title'=>$this->string(255)->notNull(),
            'juri_address' => $this->string()->null(),
            'ogrn' => $this->string()->null(),
            'updated_at'=> $this->timestamp(),
            'created_at' => $this->timestamp(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {

        $this->dropTable('{{%seller}}');
    }

}
