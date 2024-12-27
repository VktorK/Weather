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

                $model->saveImageCheck($check_photo->uploadFile($fileCheck, $model->check_photo));
                $model->saveImageWeather($weather_photo->uploadFile($fileWeather, $model->weather_photo));

                    return $this->redirect(['view', 'id' => $model->id]);




                // Сохраняем изображение
//                if ($model->check) {
//                    $path = '/uploads/check/' . $model->check->baseName . '.' . $model->check->extension;
//                    $model->check->saveAs($path);
//                    // Здесь вы можете сохранить путь изображения в базе данных
//                    $model->check_photo_path = $path;
//                }
//                if ($model->weather) {
//                    $path = '/uploads/weather/' . $model->weather->baseName . '.' . $model->weather->extension;
//                    $model->weather->saveAs($path);
//                    // Здесь вы можете сохранить путь изображения в базе данных
//                    // Например, $model->image_path = $path;
//                }

                // Сохраняем пост в базе данных

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