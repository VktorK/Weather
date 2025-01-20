<?php

namespace app\controllers;

use app\models\CheckPhotoImage;
use app\models\Mail;
use app\models\Seller;
use app\models\Weather;
use app\models\WeatherPhotoImage;
use app\models\WeatherSearch;
use app\helpers\ArrayHelper;
use Yii;
use yii\helpers\Json;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\Response;
use yii\web\UploadedFile;

class SellerController extends Controller
{

    public function actionIndex(): string
    {
        $sellers = Seller::find()->all();
        $sellersJs = ArrayHelper::toJson($sellers);
        $searchModel = new WeatherSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'sellers' => $sellers,
            'sellersJs' => $sellersJs
        ]);
    }

    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            return $this->redirect(['index']);
        }

        return $this->render('update', [
            'model' => $model,
        ]);

    }

    public function actionDestroy($id): Response
    {
        Seller::findOne($id)->delete();
        return $this->redirect(['index']);
    }

    public function actionView($id): string
    {
        $weather = Weather::find()->where(['id' => $id])->one();
        $weather->date_bying = Yii::$app->formatter->asDate($weather->date_bying, 'php:d-m-Y');
        $weather->date_end_warranty = Yii::$app->formatter->asDate($weather->date_end_warranty, 'php:d-m-Y');
        return $this->render('view', [
            'weather' => $weather,
        ]);
    }

    public function actionCreate()
    {

        if (Yii::$app->user->isGuest) {
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
                    $model->saveImageWeather($weather_photo->uploadFile($fileWeather, $model->weather_photo));
                }
                if (!is_null($fileCheck)) {
                    $model->saveImageCheck($check_photo->uploadFile($fileCheck, $model->check_photo));
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
            'weather_photo' => $weather_photo]);
    }

    public function actionCreateDir($id)
    {
//        var_dump($id);die();
        $userId = Yii::$app->user->id;
        $makeDIr = Yii::getAlias('@web') . 'uploads/weather_photo/' . $id . '/' . $userId . '/';
        if (!is_dir($makeDIr)) {
            mkdir($makeDIr, 0777, true);
            echo 'Директория создана';
        } else {
            echo 'Директория уже существует';
        }
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

    public function actionInput()
    {
        $model = new Mail();
        $weather = new Weather();

        // Получаем все посты из базы данных
        $posts = Mail::find()->all();
        $postsJs = ArrayHelper::toJson($posts);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            // Логика после сохранения поста
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('input', [
            'model' => $model,
            'posts' => $posts,
            'postsJs' => $postsJs,
            'weather' => $weather
        ]);
    }

    public function actionSearchSellers()
    {
        if(!Yii::$app->request->isAjax){
            throw new NotFoundHttpException('The requested page does not exist.');
        }
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $query = Yii::$app->request->get('q'); // Получаем параметр запроса 'q'

        // Выполненине запроса в БД
        return Seller::find()
            ->select(['ID', 'TITLE']) // Поля для возврата
            ->where(['like', 'TITLE', $query]) // Поиск по столбцу
            ->limit(10)
            ->asArray()
            ->all();
    }
}