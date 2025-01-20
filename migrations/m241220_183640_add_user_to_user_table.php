<?php

use yii\db\Expression;
use yii\db\Migration;

/**
 * Class m241220_183640_add_user_to_user_table
 */
class m241220_183640_add_user_to_user_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->batchInsert('{{%user}}', ['email', 'password','role'],
            [
                ['user@user','1','user']
            ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->delete('{{%weather}}', ['user_id' => 1]);
        $this->delete('{{%user}}', ['email' => 'user@user']);
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m241220_183640_add_user_to_user_table cannot be reverted.\n";

        return false;
    }
    */
}
