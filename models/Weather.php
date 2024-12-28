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
 * @property string $seller
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
            [['title', 'price','seller'], 'required'],
            [['title','seller'], 'string'],
            [['date_bying'],'date','format'=>'yyyy-MM-dd'],
            [['date_end_warranty'],'date','format'=>'yyyy-MM-dd'],
            [['title'], 'string', 'max' => 100],
            [['check_photo','weather_photo'], 'file', 'extensions' => 'png, jpg, jpeg']
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Описание товара(ов)',
            'price' => 'Цена',
            'seller' => 'Продавец/Импортер',
            'weather' => 'Фотография товара',
            'check' => 'Фотография Чека',
            'date_bying' => 'Дата покупки',
            'date_end_warranty' => 'Дата окончания гарантии',
            'user_id' => 'User ID',
        ];
    }

    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::class,
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['created_at', 'updated_at'],
                    ActiveRecord::EVENT_BEFORE_UPDATE => ['updated_at'],
                ],
                'value' => new \yii\db\Expression('NOW()'),
            ],
        ];
    }
    public static function tableName(): string
    {
        return 'weather';
    }

    public function saveWeather()
    {
        $this->user_id = Yii::$app->user->id;
        if ($this->date_bying) {
        $date_bying = \DateTime::createFromFormat('Y-m-d', $this->date_bying);
        $date_bying->modify('+2 years');
        $this->date_end_warranty = $date_bying->format('Y-m-d');
        } else {
            $this->date_bying = null;
            $this->date_end_warranty = null;
        }

        return $this->save(false);
    }

    public function saveImageCheck($filenameCheck)
    {
        $this->check_photo = $filenameCheck;

        return $this->save(false);
    }

    public function saveImageWeather($filenameWeather)
    {
        $this->weather_photo = $filenameWeather;

        return $this->save(false);
    }

    public function getCheckImage(): string
    {
        return ($this->check_photo) ? '/uploads/check_photo/' . $this->check_photo : '/uploads/no-image.png';
    }

    public function getWeatherImage(): string
    {
        return ($this->check_photo) ? '/uploads/weather_photo/' . $this->weather_photo : '/uploads/no-image.png';
    }



}