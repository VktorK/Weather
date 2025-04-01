<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%PETITION}}`.
 */
class m250401_113242_create_PETITION_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%PETITION}}', [
            'id' => $this->primaryKey(),
            'title' => $this->string(255)->notNull(),
            'body' => $this->text()->notNull(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%PETITION}}');
    }
}
