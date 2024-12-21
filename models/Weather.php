<?php

namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\db\BaseActiveRecord;
use yii\db\Expression;

/**
 * This is the model class for table "weather".
 *
 * @property int $id
 * @property string $title
 * @property float $price
 * @property string|null $weather_photo
 * @property string|null $check_photo
 * @property string|null $date_bying
 * @property string|null $date_end_warranty
 * @property int|null $user_id
 */

class Weather extends ActiveRecord
{

    public function rules()
    {
        return [
            [['title', 'price'], 'required'],
            [['title','weather_photo','check_photo'], 'string'],
            [['date_bying'],'date','format'=>'yyyy-MM-dd'],
            [['date_end_warranty'],'date','format'=>'yyyy-MM-dd'],
            [['title'], 'string', 'max' => 100],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'price' => 'Price',
            'weather_photo' => 'Weather Photo',
            'check_photo' => 'Check Photo',
            'date_bying' => 'Date of Buying',
            'date_end_warranty' => 'Date of Warranty',
            'user_id' => 'User ID',
        ];
    }

    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::class,
                'attributes' => [
                    BaseActiveRecord::EVENT_BEFORE_INSERT => [['updated_at','created_at' => new Expression('NOW()')],
                    BaseActiveRecord::EVENT_BEFORE_UPDATE => ['updated_at' => new Expression('NOW()')],
                ],
                ]
            ]];
    }
    public static function tableName(): string
    {
        return 'weather';
    }

    public function saveWeather()
    {
        $this->user_id = Yii::$app->user->id;
        return $this->save(false);
    }

}