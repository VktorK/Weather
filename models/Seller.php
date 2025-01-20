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
 * @property float $juri_address
 * @property string $ogrn
 */

class Seller extends ActiveRecord
{

    public function rules(): array
    {
        return [
            [['title'], 'required'],
            [['title','juri_address'], 'string'],
            [['ogrn'], 'integer'],
            [['title'], 'string', 'max' => 100],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels(): array
    {
        return [
            'id' => 'ID',
            'title' => 'Наименование продавца/импортера',
            'juri_address' => 'Юридический адрес',
            'ogrn' => 'ОГРН',
        ];
    }

    /**
     * @throws \DateMalformedStringException
     */
    public function afterFind(): void
    {
        $this->id = $this->getAttribute('ID');
        $this->title = $this->getAttribute('title');
        $this->juri_address = $this->getAttribute('juri_address');
        $this->ogrn = $this->getAttribute('ogrn');
        $this->created_at = new \DateTimeImmutable($this->getAttribute('created_at'));
        $this->created_at = $this->created_at->format('d.m.Y H:i:s');

        parent::afterFind();
    }

    public function getSellers(): array
    {
        return Seller::find()->all();
    }

    public function toArrayCustom(): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'juri_address' => $this->juri_address,
            'ogrn' => $this->ogrn,
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
        return 'seller';
    }

    public function saveSeller(): bool
    {

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
        return $this->check_photo ? '/uploads/check_photo/' . Yii::$app->user->id . '/' . $this->check_photo : '/uploads/no-image.png';
    }

    public function getWeatherImage(): string
    {

        return $this->check_photo ? '/uploads/weather_photo/' . Yii::$app->user->id . '/'  . $this->weather_photo : '/uploads/no-image.png';
    }

    public function getUser()
    {
        return $this->hasOne(User::class,['id'=>'user_id']);
    }


    public function saveUpdate($dateOfBying)
    {
        if($this->date_bying != $dateOfBying)
        {
            $date_bying = DateTime::createFromFormat('Y-m-d', $this->date_bying);
            $date_bying->modify('+2 years');
            $this->date_end_warranty = $date_bying->format('Y-m-d');
            return $this->save(false);
        }
    }

    public function getWeathers()
    {
        return $this->hasMany(Weather::class, ['seller_id' => 'id']);
    }

}