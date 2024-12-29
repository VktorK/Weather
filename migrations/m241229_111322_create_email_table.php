<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%email}}`.
 */
class m241229_111322_create_email_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%email}}', [
            'id' => $this->primaryKey(),
            'email'=>$this->string(255),
            'weather_id' => $this->integer()->notNull(),
            'is_send' => $this->integer()->notNull(),
            'updated_at'=> $this->timestamp(),
            'created_at' => $this->timestamp(),
        ]);

        $this->addForeignKey(
            'fk_email_weather',
            'email',
            'weather_id',
            'weather',
            'id');

        $this->createIndex(
            'idx_email_weather',
            'email',
            'weather_id');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk_email_weather', 'email');
        $this->dropIndex('idx_email_weather', 'email');
        $this->dropTable('{{%email}}');
    }
}
