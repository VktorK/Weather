<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%weather}}`.
 */
class m241221_202115_add_created_at_column_to_weather_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('weather','created_at','datetime');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('weather','created_at');
    }
}
