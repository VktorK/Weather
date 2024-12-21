<?php

namespace app\controllers;

use app\models\Weather;
use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

class WeatherController extends Controller
{


    public function actionIndex()
    {

        $weathers = Weather::find()->where(['user_id' => Yii::$app->user->id])->all();

        return $this->render('index', ['weathers'=> $weathers]);
    }

    public function actionUpdate()
    {
           var_dump('11111111111');
    }

    public function actionDestroy($id)
    {
        $weather = Weather::find()->where(['id' => $id])->one();
        $weather->delete();
        return $this->redirect(['index']);
    }

    public function actionView($id)
    {
        $weather = Weather::find()->where(['id'=>$id])->one();
//        echo '<pre>';var_dump($weather);echo '<pre>';die();
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    public function actionCreate()
    {
        $weather = new Weather();

        if ($this->request->isPost) {
            if ($weather->load($this->request->post()) && $weather->validate()) {
                if($weather->saveWeather()) {
                    return $this->redirect(['view', 'id' => $weather->id]);
                }
            }
        } else {
            $weather->loadDefaultValues();
        }

        return $this->render('create', [
            'weather' => $weather,
        ]);
    }

    protected function findModel($id)
    {
        if (($model = Weather::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}