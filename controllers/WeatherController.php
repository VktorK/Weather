<?php

namespace app\controllers;

use app\models\CheckPhotoImage;
use app\models\Weather;
use app\models\WeatherPhotoImage;
use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\UploadedFile;

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

        $model = new Weather();
        $check_photo = new CheckPhotoImage();
        $weather_photo = new WeatherPhotoImage();

        if ($model->load(Yii::$app->request->post())) {

            if ($model->validate()) {
                $model->saveWeather();

                $fileWeather = UploadedFile::getInstance($weather_photo, 'weather_photo');
                $fileCheck = UploadedFile::getInstance($check_photo, 'check_photo');
                if (!is_null($fileWeather)) {
                    $model->saveImageCheck($check_photo->uploadFile($fileCheck, $model->check_photo));
                }
                if (!is_null($fileCheck)){
                    $model->saveImageWeather($weather_photo->uploadFile($fileWeather, $model->weather_photo));
                }

                    return $this->redirect(['view',
                        'id' => $model->id,
                    ]);

            } else {
                $model->loadDefaultValues('user_id');
            }
        }

        return $this->render('create', [
            'model' => $model,
            'check_photo' => $check_photo,
            'weather_photo'=>$weather_photo]);
    }


    protected function findModel($id)
    {
        if (($model = Weather::findOne(['id' => $id])) !== null) {
            return $model;
        }
        throw new NotFoundHttpException('The requested page does not exist.');
    }
}