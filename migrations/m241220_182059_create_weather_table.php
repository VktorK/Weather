<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%weather}}`.
 */
class m241220_182059_create_weather_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%weather}}', [
            'id' => $this->primaryKey(),
            'title' => $this->string()->notNull(),
            'price'=> $this->float()->null(),
            'weather_photo' => $this->string()->null(),
            'check_photo' => $this->string()->null(),
            "date_bying" => $this->date()->null(),
            'date_end_warranty' => $this->date()->null(),
            'user_id' => $this->integer()->notNull(),
        ]);

        $this->addForeignKey(
            'fk_weather_user',
            'weather',
            'user_id',
            'user',
            'id');

        $this->createIndex(
            'idx_weather_user',
            'weather',
            'user_id');

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk_weather_user', 'weather');
        $this->dropIndex('idx_weather_user', 'weather');
        $this->dropTable('{{%weather}}');
    }
}
