<?php

namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;


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
//    public $check_photo;
    public static function tableName()
    {
        return 'weather';
    }

    public function rules()
    {
        return [
            [['title', 'price'], 'required'],
            [['title','weather_photo','check_photo'], 'string'],
            [['date_bying','date_end_warranty'],'date','format'=>'yyyy-MM-dd'],
            [['title'], 'string', 'max' => 100],
            [['weather_photo','check_photo','date_bying','date_end_warranty'],'safe'],
            [['weather_photo','check_photo'],'file', 'extensions' => 'jpg,png'],
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
                    ActiveRecord::EVENT_BEFORE_INSERT => ['created_at', 'updated_at'],
                    ActiveRecord::EVENT_BEFORE_UPDATE => ['updated_at'],
                ],
                'value' => new \yii\db\Expression('NOW()'),
            ],
        ];
    }

    public function saveWeather(): bool
    {
        $this->user_id = Yii::$app->user->id;
        $this->dateOfByingFormated();
        $this->checkPhotoNullable();
        $this->weatherPhotoNullable();
        return $this->save(false);
    }

    public function dateOfByingFormated(): ?string
    {
        $date_bying = \DateTime::createFromFormat('Y-m-d', $this->date_bying);
        if ($date_bying) {
            $date_bying->modify('+2 years');
            $this->date_end_warranty = $date_bying->format('Y-m-d');
            return $this->date_end_warranty;
        }
        return null;
    }

    public function weatherPhotoNullable(): ?string
    {
       $this->weather_photo = $this->weather_photo ? $this->weather_photo : null;
       return $this->check_photo;
    }
    public function checkPhotoNullable(): ?string
    {
       $this->check_photo = $this->check_photo ? $this->check_photo : null;
       return $this->check_photo;
    }

    public function saveImageCheck($filename)
    {
        $this->check_photo = $filename;

        return $this->save(false);
    }

}