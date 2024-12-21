<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%weather}}`.
 */
class m241221_202128_add_updated_at_column_to_weather_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('weather','updated_at','datetime');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('weather','updated_at');
    }
}
