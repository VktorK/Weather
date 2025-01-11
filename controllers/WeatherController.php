<?php

namespace app\controllers;

use app\models\CheckPhotoImage;
use app\models\Weather;
use app\models\WeatherPhotoImage;
use app\models\WeatherSearch;
// ошибка в namespace стоила мне часа мытарства!!!! АААА
use app\helpers\ArrayHelper;
use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\Response;
use yii\web\UploadedFile;

class WeatherController extends Controller
{


//    public function actionIndex()
//    {
//
//        $weathers = Weather::find()->where(['user_id' => Yii::$app->user->id])->all();
//
//        return $this->render('index', ['weathers'=> $weathers]);
//    }

    public function actionIndex(): string
    {
        $weathers = Weather::find()->where(['user_id' => Yii::$app->user->id])->all();
        $weathersJs = ArrayHelper::toJson($weathers);
        $searchModel = new WeatherSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'weathers'=>$weathers,
            'weathersJs' => $weathersJs
        ]);
    }

    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $dateOfBying = $model->date_bying;


        if ($model->load(Yii::$app->request->post()) && $model->saveUpdate($dateOfBying)) {
            return $this->redirect(['index']);
        }

        return $this->render('update', [
            'model' => $model,
        ]);

    }

    public function actionDestroy($id): Response
    {
        Weather::findOne($id)->delete();
        return $this->redirect(['index']);
    }

    public function actionView($id): string
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


    /**
     * @throws NotFoundHttpException
     */
    protected function findModel($id): ?Weather
    {
        if (($model = Weather::findOne(['id' => $id])) !== null) {
            return $model;
        }
        throw new NotFoundHttpException('The requested page does not exist.');
    }
}