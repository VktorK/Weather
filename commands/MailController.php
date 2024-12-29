<?php

namespace app\commands;

use app\components\AppMailer;
use app\models\Mail;
use app\models\Weather;
use Yii;
use yii\console\Controller;
use yii\filters\AccessControl;

use yii\filters\VerbFilter;

class MailController extends Controller
{
    public function actionSend()
    {
        $threeMonthsAgo = (new \DateTime())->modify('-3 months')->format('Y-m-d');

        $weathers = Weather::find()
            ->where(['<', 'date_end_warranty', $threeMonthsAgo])
            ->with('user')
            ->all();

        if (count($weathers) > 0) {
            foreach ($weathers as $weather) {
                $mailCHeck = Mail::find()
                    ->where(['weather_id' => $weather->id])
                    ->orderBy('created_at')
                    ->one();

                if (is_null($mailCHeck)) {
                    $weather->date_end_warranty = Yii::$app->formatter->asDate($weather->date_end_warranty, 'php:d.m.Y');
                    $to = $weather->user->email;
                    $subject = 'Weather project';
                    $body = 'Срок обращения по товару ' . $weather->title . ' ' . 'оканчивается' . ' ' . $weather->date_end_warranty . '. Необходимо поднять жопу и подать претензию хотя бы.';
                    $mailer = new AppMailer();
                    $result = $mailer->sendEmail($to, $subject, $body);

                    if ($result) {
                        $email = new Mail();
                        $email->email = $weather->user->email;
                        $email->weather_id = $weather->id;
                        $email->is_send = 1;
                        if ($email->validate()) {
                            $email->save(false);
                        }
                    }
                }
            }
        }
        return 'Письмо отправлено успешно';
    }
}
