<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%user}}`.
 */
class m241220_182047_create_user_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%user}}', [
            'id' => $this->primaryKey(),
            'email' => $this->string()->notNull()->unique(),
            'password' => $this->string()->notNull(),
            'role' => $this->string()->notNull()->defaultValue('user'),
            'updated_at' => $this->timestamp()->null(),
            'created_at' => $this->timestamp()->null(),
        ]);

//        $this->batchInsert('{{%user}}', ['email','password','role'],['Vktork@mail.ru','lok1','admin']);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%user}}');
    }
}
