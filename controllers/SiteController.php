<?php

namespace app\controllers;

use Swift_Mailer;
use Swift_Message;
use Swift_SmtpTransport;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;

class SiteController extends Controller
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
    public function actionIndex()
    {
        return $this->render('index');
    }

    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }

        $model->password = '';
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    public function actionContactt()
    {
//////        require_once '/path/to/vendor/autoload.php';
        $transport = (new Swift_SmtpTransport('smtp.rambler.ru', 587))->setUsername('viktorkorochanskiy@rambler.ru')
            ->setPassword('Sherlock011')
        ;

// Create the Mailer using your created Transport
        $mailer = new Swift_Mailer($transport);

// Create a message
        $message = (new Swift_Message('Wonderful Subject'))
            ->setFrom('viktorkorochanskiy@rambler.ru')
            ->setTo('4you.19885@mail.ru.ru')
            ->setBody('Here is the message itself');

// Send the message
        $mailer->send($message);

        echo '112312321';
//
//        var_dump($resutl);
//        $result = Yii::$app->mailer->compose()
//            ->setFrom('4you.19885@mail.ru') // Отправитель
//            ->setTo('gg.shmarkova@mail.ru') // Получатель4you.19885@mail.ru
//            ->setSubject('Эль пидрильо') // Тема письма
//            ->setTextBody('Вот тебе и НА') // Текстовое сообщение
////            ->setHtmlBody('<b>HTML-контент сообщения</b>') // HTML-содержимое
//            ->send();
//
//
        var_dump($result);die();
        return '11111111111';
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return Response|string
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionAbout()
    {
        return $this->render('about');
    }

}
