<?php

namespace app\controllers;

use fpdf\FPDF;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;

class SiteController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
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
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
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

//    public function actionMiindex()
//    {
//        $model = new LoginForm();
//
//        return $this->render('miindex', [
//            'model' => $model,
//        ]);
//    }

    public function actionPdf()
    {
        $pdf = new FPDF();
        $pdf->AddPage();

        $pdf->SetFont('Arial','B',16);
//
//        $file = "filename.jpg";  // Dirección de la imagen
//
//        $imagen = getimagesize($file);    //Sacamos la información
//        $ancho = $imagen[0];              //Ancho
//        $alto = $imagen[1];               //Alto

        $pdf->Image('filename.jpg',10,10,90,50);
        $pdf->AddPage();
        $pdf->Image('imagen2.png',10,10);
        $pdf->Output();
        exit;
    }

    public function actionPrincipal()
    {
        $eventos = new ActiveDataProvider([
            'query' => Evento::find(),
        ]);
        $categorias = new ActiveDataProvider([
            'query' => Categorias::find(),
        ]);
        $medias = new ActiveDataProvider([
            'query' => Multimedia::find(),
        ]);
        return $this->render('index', [
            'eventos' => $eventos, 'categorias' => $categorias, 'medias' => $medias,
        ]);
    }
    /**
     * Login action.
     *
     * @return string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->redirect(['principal']);
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return string
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return string
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
