<?php

namespace app\models;

use yii\data\ActiveDataProvider;


class SellerSearch extends Weather
{

    public function rules(): array
    {
        return [
            [['title', 'juri_address','ogrn'], 'safe'],
            [['title','juri_address'], 'string'],
            [['ogrn'], 'integer'],
            [['title','juri_address'], 'string', 'max' => 100],
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
            'created_at' => 'Дата создания записи'
        ];
    }


    public function search($params): ActiveDataProvider
    {
        $query = Seller::find()->all();

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
        $query->andFilterWhere(['like', 'title', $this->title]);

        return $dataProvider;
    }

}