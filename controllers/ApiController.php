<?php

namespace app\controllers;

use app\models\Imagen;
use app\models\Tramite;
use Google\Cloud\Vision\VisionClient;
use Yii;
use yii\data\ActiveDataProvider;
use yii\rest\Controller;

class ApiController extends Controller
{
//    public $modelClass = 'app\models\Imagen';
    public function actionIndex()
    {
        return new ActiveDataProvider([
            'query' => Tramite::find(),
        ]);
    }

    public function actionImageninsert()
    {
        $req = Yii::$app->request;
        $id_tramite = $req->get('idtramite');
        $url = $req->get('url');
        $image = new Imagen();
        $image->url = $url;
        $image->id_Tramite = $id_tramite;
//        return $url.'+'.$id_tramite;
        if ($image->validate()) {
            if ($image->save()) {
                return "OK";
            } else {
                return "ERROR_NO_SAVE";
            }
        } else {
            return "PARAMETROS_INVALIDOS";
        }
    }

    public function actionVision()
    {

    }

    public function actionExecuteocr()
    {

        $apiKey = 'AIzaSyDSTRujOfmCPu0B3iZF-0wFFpLhVfDYBOk';
        $path = 'image.jpg';

        $vision = new VisionClient([
            'keyFilePath' => 'myOCRKey.json',
            'projectId' => 'myOCR-149908'
        ]);
        $req = Yii::$app->request;
        $data = base64_decode($req->post('data'));
        $file = uniqid() . '.jpg';
        $success = file_put_contents($file, $data);
        $image = $vision->image(file_get_contents($file), ['TEXT_DETECTION']);
        $result = $vision->annotate($image);
        return \GuzzleHttp\json_decode($result->info(),true);

    }

    public function actionGettramites()
    {
        $req = Yii::$app->request;
        $tramites = Tramite::find()->where(['idTramite' => $req->get('idtramite')])->all();
        return json_encode($tramites);
    }
}
