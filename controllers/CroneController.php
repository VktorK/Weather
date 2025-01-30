<?php

namespace app\controllers;

use app\components\AppMailer;
use app\models\Mail;
use app\Services\ParserService;
use Yii;
use yii\web\Controller;

class CroneController extends Controller
{
    public function actionSendEmail()
    {
        //Получаем массив данных
        $mails = Mail::find()->asArray()->all();
        //Получаем таблицу
        $table = ParserService::toTable($mails);
        //Получаем Excel файл
        $filePath = ParserService::toXl($mails);

        // Заполняем данные для отправки письма
        $to = 'p.olenev@nextcontact.ru';
        $subject = 'Отчет о наличии писем в таблице';
        $mailer = new AppMailer();
        $mailer->sendEmail($to, $subject, $table, $filePath);
    }

    public function actionMailsFindWeather()
    {
        $mailsFromWeather = Mail::find()->all();

        $emailsFromProduct = \Yii::$app->product->createCommand('SELECT * FROM email')->queryAll();

        $combinedMails = [];

// Добавляем объекты Mail из массива emailsFromProduct
        foreach ($emailsFromProduct as $emailData) {
            $combinedMails[] = new Mail([
                'id' => $emailData['id'],
                'email' => $emailData['email'],
                'weather_id' => $emailData['weather_id'],
                'is_send' => $emailData['is_send'],
            ]);
        }

// Добавляем существующие объекты Mail из массива mailsFromWeather
        foreach ($mailsFromWeather as $mail) {
            $combinedMails[] = $mail;
        }

        foreach ($combinedMails as $mail) {
            var_dump($mail);die();
        }

        return $combinedMails;

//        foreach ($mails as $mail) {
//            echo '<pre>';var_dump($mail); echo '<pre>';die();
//        }

//        return $mails;
    }

}
