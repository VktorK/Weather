<?php

namespace app\models;

use DateTime;
use Yii;
use yii\behaviors\TimestampBehavior;
use yii\data\ActiveDataProvider;
use yii\db\ActiveRecord;
use yii\db\BaseActiveRecord;
use yii\db\Expression;


class WeatherSearch extends Weather
{

    public function rules(): array
    {
        return [
            [['title', 'price','seller_id','date_bying','date_end_warranty','created_at'], 'safe'],
            [['title'], 'string'],
            [['seller_id'], 'integer'],
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
            'seller_id' => 'Идентификатор Продавца/Импортера',
            'weather' => 'Фотография товара',
            'check' => 'Фотография Чека',
            'date_bying' => 'Дата покупки',
            'date_end_warranty' => 'Дата окончания гарантии',
            'user_id' => 'User ID',
            'created_at' => 'Дата создания записи'
        ];
    }




    public function search($params): ActiveDataProvider
    {
        $query = Weather::find();

        // Создаем новый ActiveDataProvider
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        // Загружаем параметры из формы
        $this->load($params);

        // Если параметры невалидные, не применяем фильтрацию
        if (!$this->validate()) {
            return $dataProvider;
        }

        // Добавляем условия фильтрации
        $query->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'seller_id', $this->seller_id])
            ->andFilterWhere(['like', 'date_end_warranty', $this->date_end_warranty])
            ->andFilterWhere(['like', 'created_at', $this->created_at]);

        return $dataProvider;
    }

}