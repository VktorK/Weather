<?php

namespace app\models;

use DateTime;
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

    public function rules(): array
    {
        return [
            [['title', 'price','seller','date_bying'], 'required'],
            [['title','seller'], 'string'],
            [['date_bying','date_end_warranty'],'date','format'=>'yyyy-MM-dd'],
            [['title'], 'string', 'max' => 100],
            [['check_photo','weather_photo'], 'file', 'extensions' => 'png, jpg, jpeg']
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels(): array
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

    public function toArrayCustom(): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'price' => $this->price,
            'seller' => $this->seller,
            'weather_photo' => $this->weather_photo,
            'check_photo' => $this->check_photo,
            'date_bying' => $this->date_bying,
            'date_end_warranty' => $this->date_end_warranty,
            'user_id' => $this->user_id,
            'updated_at' => $this->updated_at,
            'created_at' => $this->created_at,
        ];
    }

    public function behaviors(): array
    {
        return [
            [
                'class' => TimestampBehavior::class,
                'attributes' => [
                    BaseActiveRecord::EVENT_BEFORE_INSERT,
                    BaseActiveRecord::EVENT_BEFORE_UPDATE
                ],
                'value' => new Expression('NOW()'),
            ],
        ];
    }
    public static function tableName(): string
    {
        return 'weather';
    }

    public function saveWeather(): bool
    {
        $this->user_id = Yii::$app->user->id;
        if ($this->date_bying) {
        $date_bying = DateTime::createFromFormat('Y-m-d', $this->date_bying);
        $date_bying->modify('+2 years');
        $this->date_end_warranty = $date_bying->format('Y-m-d');
        } else {
            $this->date_bying = new Expression('NOW()');
            $this->date_end_warranty = new Expression('NOW() + 2 years');
        }

        return $this->save(false);
    }

    public function saveImageCheck($filenameCheck): bool
    {
        $this->check_photo = $filenameCheck;

        return $this->save(false);
    }

    public function saveImageWeather($filenameWeather): bool
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

    public function getUser()
    {
        return $this->hasOne(User::class,['id'=>'user_id']);
    }


}