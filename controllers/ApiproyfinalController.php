<?php

namespace app\controllers;

use app\models\Categoria;
use app\models\Cliente;
use app\models\Evento;
use app\models\Imagen;
use app\models\Multimedia;
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
        $activeDataProvider = new ActiveDataProvider([
            'query' => Evento::find()->where(['idEvento' => $param]),
        ]);
        if ($activeDataProvider->getCount() == 0) {
            return ['estado' => '2', 'contenido' => "Error"];

        } else {
            return ['estado' => '1', 'contenido' => $activeDataProvider->getModels()[0]];
        }
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
        if ($activeDataProvider == null) {
            return ['estado' => '2', 'contenido' => "Error"];

        } else {
            return ['estado' => '1', 'contenido' => $activeDataProvider->getModels()];
        }
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
        $activeDataProvider = new ActiveDataProvider([
            'query' => Usuario::find()->where(['username' => $param, 'password' => $param2]),
        ]);
        if ($activeDataProvider->getCount() == 0) {
            return ['estado' => '2', 'contenido' => "Error"];

        } else {
            return ['estado' => '1', 'contenido' => $activeDataProvider->getModels()[0]];
        }
    }


    public function actionGetcategorias()
    {
        return new ActiveDataProvider([
            'query' => Categoria::find(),
        ]);
    }

    public function actionImageninsert()
    {
        $req = Yii::$app->request;
        $idEvento = $req->get('idEvento');
        $idUsuario = $req->get('idUsuario');
        $url = $req->get('url');
        $image = new Multimedia();
        $image->nombre = "Foto";
        $image->path = $url;
        $image->id_Evento = $idEvento;
        $image->id_Usuario = $idUsuario;
//        return $url.'+'.$id_tramite;
        if ($image->validate()) {
            if ($image->save()) {
                return ['estado' => '2', 'contenido' => "Error"];
            } else {
                return ['estado' => '1', 'contenido' => "Imagenes Subidas Correctamente"];
            }
        }
    }


}
