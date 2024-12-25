<?php

namespace app\controllers;

use app\models\CheckPhoto;
use app\models\Weather;
use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\UploadedFile;

class WeatherController extends Controller
{
//    protected WeatherService $weatherService;
//    public function __construct(WeatherService $weatherService)
//    {
//        $this->weatherService = $weatherService;
//
//    }
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
        Weather::findOne($id)->delete();
        return $this->redirect(['index']);
    }

    public function actionView($id)
    {
        $weather = Weather::find()->where(['id'=>$id])->one();
        $weather->date_bying = Yii::$app->formatter->asDate($weather->date_bying, 'php:d-m-Y');
        $weather->date_end_warranty = Yii::$app->formatter->asDate($weather->date_end_warranty, 'php:d-m-Y');
        return $this->render('view', [
            'weather' => $weather,
        ]);
    }

    public function actionCreate()
    {
        if(Yii::$app->user->isGuest)
        {
            return $this->redirect(['/site/login']);
        }

        $weather = new Weather();

        if ($weather->load(Yii::$app->request->post())) {
            $weather->check_photo = UploadedFile::getInstance($weather, 'imageFile');

            if ($weather->upload() && $weather->save()) {
                return $this->redirect(['view', 'id' => $weather->id]);
            }
        }

        return $this->render('create', [
            'weather' => $weather,
        ]);

//        if ($this->request->isPost) {
//            if ($weather->load($this->request->post()) && $weather->validate())  {
//                echo '<pre>';var_dump($weather);echo '<pre>';die();
//                $weather->check_photo = UploadedFile::getInstance($weather, 'check_photo');
//                    $weather->saveCheckPhotoChek($weather->uploadFile($weather->check_photo, $weather->check_photo));
//
//                if($weather->saveWeather()) {
//                    return $this->redirect(['view', 'id' => $weather->id]);
//                }
//            }
//        } else {
//            $weather->loadDefaultValues();
//        }

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