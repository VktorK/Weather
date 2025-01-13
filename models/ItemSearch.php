<?php
namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Mail;
use app\models\Weather;

class ItemSearch extends Model
{
    public $query;

    public function __construct($query)
    {
        $this->query = $query;
    }

    public function rules()
    {
        return [
            [['query'], 'string'],
        ];
    }

    public function search($params)
    {

        $this->load($params);

        $query = Weather::find()->where(['like', 'title', $this->query]);

        $dataProvider = new ActiveDataProvider([
                        'query' => $query,
    ]);
        return $dataProvider;
    }
}
