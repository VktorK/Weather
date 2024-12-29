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
                    BaseActiveRecord::EVENT_BEFORE_INSERT,
                    BaseActiveRecord::EVENT_BEFORE_UPDATE
                ],
                'value' => new Expression('NOW()'),
            ],
        ];
    }
    public static function tableName(): string
    {
        return 'email';
    }

}