<?php

namespace app\controllers;


use app\models\Message;
use app\models\MessageForm;
use app\models\RegForm;
use app\models\User;
use Yii;
use yii\data\Pagination;
use app\models\LoginForm;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\Controller;


class SiteController extends Controller
{

    public function behaviors()
    {

        return [

            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['message','logout'],
                        'roles' => ['admin','user'],

                    ],
                    [
                        'allow' => true,
                        'actions' => ['index','reg','login'],
                        'roles' => ['?','admin','user'],

                    ],
                ],
                'denyCallback' => function($rule, $action){
                    Yii::$app->session->setFlash('warning', 'Войдите или зарегестрируйтесь!');
                    return $this->goHome();
                }
            ],

        ];
    }

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
    public function actionIndex()
    {
        $permission  = Yii::$app->user->can('admin');
        $model = new MessageForm();
        $queryMessage = new Message();
        $message = Message::find();
        $pagination = new Pagination([
            'defaultPageSize' => 5,
            'totalCount' => $message->count(),
        ]);
        if(!$permission){
            $queryMessage = $queryMessage->setMesaage(Message::STATUS_ACTIV,$message,$pagination); // получаем без блокированых сообщений для показа всем
        }
        else{
             $queryMessage = $queryMessage->setMesaageall($message,$pagination);
        }
        $queryUser = User::find();// Отправляет запрос в БД (User название таблицы)
        $queryUser = $queryUser->orderBy('id')->all();

        return $this->render('index', compact(['queryMessage','queryUser','model','permission','pagination']));
    }

    public function actionReg()
    {
        $model = new RegForm();
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('success', 'Спасибо за регистрацию.');
            return $this->redirect('index');
        }
        return $this->render('reg', [
            'model' => $model,
        ]);
    }
    public function actionLogin()
    {
        $model = new LoginForm(); // создать модель
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->redirect('index');
        }
        $model->password = '';
        return $this->render('login', [
            'model' => $model,
        ]);
    }
    public function actionMessage()
    {
        $model = new MessageForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            // данные в $model удачно проверены
            $model->save();// Записываем в БД
            return $this->goHome();
        }

   }
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->redirect('index');
    }
    public function actionTest()
    {
        $query = new Message();
        $query = $query->setMesaage(Message::STATUS_BLOCK);

        return $this->render('test', compact('query'));
    }


}
