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
        $mails = Mail::find()->asArray()->all();


        $table = ParserService::toTable($mails);

        $filePath = ParserService::toXl($mails);

        $to = '4you.19885@mail.ru';
        $subject = 'Отчет о наличии писем в таблице';
        $mailer = new AppMailer();
        $result = $mailer->sendEmail($to, $subject, $table, $filePath);
        if($result)
        {
             unlink($filePath);
             return 'Письмо отправлено';
        }

        return 'Письмо не отправлено';
    }
}
