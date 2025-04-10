<?php

namespace app\models;

use DateTime;
use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\db\BaseActiveRecord;
use yii\db\Expression;


/**
 * This is the model class for table "mail".
 *
 * @property int $id
 * @property string $email
 * @property integer $weather_id
 * @property integer $is_send
 */

class Mail extends ActiveRecord
{

    public function rules(): array
    {
        return [
            [['email','weather_id','is_send'], 'required'],
            [['email'], 'string'],
            [['weather_id','is_send'],'integer'],
            [['email'], 'string', 'max' => 100],
        ];
    }


    public function behaviors(): array
    {
        return [
            [
                'class' => TimestampBehavior::class,
                'attributes' => [
                    BaseActiveRecord::EVENT_BEFORE_INSERT=>['created_at','updated_at'],
                    BaseActiveRecord::EVENT_BEFORE_UPDATE=>['updated_at']
                ],
                'value' => new Expression('NOW()'),
            ],
        ];
    }
    public static function tableName(): string
    {
        return 'email';
    }

    public function toArrayCustom(): array
    {
        return [
            'id' => $this->id,
            'email' => $this->email,
            'weather_id' => $this->weather_id,
            'is_send' => $this->is_send,
            'updated_at' => $this->updated_at,
            'created_at' => $this->created_at,
        ];
    }

}