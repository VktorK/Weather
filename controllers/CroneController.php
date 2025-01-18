<?php

namespace app\controllers;

use app\components\AppMailer;
use app\models\Mail;
use app\Services\ParserService;
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
        $to = '4you.19885@mail.ru';
        $subject = 'Отчет о наличии писем в таблице';
        $mailer = new AppMailer();
        $mailer->sendEmail($to, $subject, $table, $filePath);
    }
}
