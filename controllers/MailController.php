<?php

namespace app\controllers;

use app\components\AppMailer;
use app\models\Mail;
use app\models\Weather;
use mysql_xdevapi\Expression;
use Swift_Mailer;
use Swift_Message;
use Swift_SmtpTransport;
use Yii;
use yii\db\Query;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;

class MailController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionSendEmail()
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
                    $to = $weather->user->email;
                    $subject = 'Weather project';
                    $body = 'Срок обращения по товару ' . $weather->title . 'оканчивается' . $weather->date_end_warranty . '. Необходимо поднять жопу и подать претензию хотя бы.';
                    $mailer = new AppMailer();
                    $result = $mailer->sendEmail($to, $subject, $body);

                    if ($result) {
                        Yii::$app->session->setFlash('Письмо отправлено ');
                        $email = new Mail();
                        $email->email = $weather->user->email;
                        $email->weather_id = $weather->id;
                        $email->is_send = 1;
                        if ($email->validate()) {
                            $email->save(false);
                        }
                    }
                }


                Yii::$app->session->setFlash('Письмо отправлено ');
            }
        }
    }
}
