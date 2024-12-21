<?php

namespace app\controllers;

use app\models\Weather;
use yii\web\Controller;

class WeatherController extends Controller
{
    public function actionIndex()
    {
        $weathers = Weather::find()->all();
        return $this->render('index', ['weathers'=> $weathers]);
    }
}