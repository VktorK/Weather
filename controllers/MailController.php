<?php

namespace app\controllers;

use app\components\AppMailer;
use app\models\Weather;
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
//        $records = Yii::$app->db->createCommand()
//            ->select('*')
//            ->from('weather')
//            ->where(['<', 'date_end_warranty', $threeMonthsAgo])
//            ->queryAll();

        $query = new Query();
        $query->select('*')->from('weather')->where(['<', 'date_end_warranty', $threeMonthsAgo]);
        $command = $query->createCommand();
        $records = $command->queryAll();
        var_dump($records);die();
        $mailer = new AppMailer();
        foreach ($records as $record)
        {

        }

        $mailer->sendEmail('gg.shmarkova@mail.ru', 'Weather project', 'Weather Project');

        Yii::$app->session->setFlash('Письмо отправлено ');
    }

}
