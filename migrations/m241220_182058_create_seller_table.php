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

        $this->batchInsert('{{%seller}}', ['title', 'juri_address', 'ogrn'],
            [
                ['ООО "Купишуз"','г.Москва','345345345345'],
                ['АО "РТК"','г.Сызрань','342342675678634'],
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
