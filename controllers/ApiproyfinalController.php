<?php

namespace app\controllers;

use app\models\Categoria;
use app\models\Cliente;
use app\models\Evento;
use app\models\Imagen;
use app\models\Organizador;
use app\models\Tramite;
use app\models\Usuario;
use app\models\Usuarioevento;
use Google\Cloud\Vision\VisionClient;
use Yii;
use yii\data\ActiveDataProvider;
use yii\httpclient\Client;
use yii\rest\Controller;

class ApiproyfinalController extends Controller
{

//    public $modelClass = 'app\models\Imagen';
//    public function actionIndex()
//    {
//        return new ActiveDataProvider([
//            'query' => Evento::find(),
//        ]);
//    }
    public function actionIndex()
    {
        return "Debes ingresar la action \n EJ.: apiproyfinal/geteventos";
    }

    public function actionGeteventosconid()
    {
        $req = Yii::$app->request;
        $param = $req->get('id');
        return new ActiveDataProvider([
            'query' => Evento::find()->where(['idEvento' => $param]),
        ]);
    }

    public function actionGeteventosconidcategoria()
    {
        $req = Yii::$app->request;
        $param = $req->get('id_Categoria');
        return new ActiveDataProvider([
            'query' => Evento::find()->where(['id_Categoria' => $param]),
        ]);
    }

    public function actionGeteventosconidorganizador()
    {
        $req = Yii::$app->request;
        $param = $req->get('id_Organizador');
        return new ActiveDataProvider([
            'query' => Evento::find()->where(['id_Organizador' => $param]),
        ]);
    }

    public function actionGetorganizadores()
    {
        return new ActiveDataProvider([
            'query' => Organizador::find(),
        ]);
    }

    public function actionGeteventos()
    {
//        $req = Yii::$app->request;
//        $param = $req->get('id_Organizador');

        $activeDataProvider = new ActiveDataProvider([
            'query' => Evento::find(),
        ]);
        return ['estado' => '1', 'contenido' => $activeDataProvider->getModels()];
    }

    public function actionGetusuarios()
    {
//        $req = Yii::$app->request;
//        $param = $req->get('id_Organizador');
        return new ActiveDataProvider([
            'query' => Usuario::find(),
        ]);
    }

    public function actionGetlogin()
    {
        $req = Yii::$app->request;
        $param = $req->get('username');
        $param2 = $req->get('password');
        return new ActiveDataProvider([
            'query' => Usuario::find()->where(['username' => $param, 'password' => $param2]),
        ]);
    }


    public function actionGetcategorias()
    {
        return new ActiveDataProvider([
            'query' => Categoria::find(),
        ]);
    }

}
