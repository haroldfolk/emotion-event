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
            'query' => Imagen::find(),
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

    public function actionUploadimages3()
    {
<<<<<<< HEAD

=======
        $req = Yii::$app->request;
        $data = base64_decode($req->post('data'));
        $file = uniqid() . '.jpg';
        $success = file_put_contents($file, $data);
        $storage = Yii::$app->storage;
        $url = $storage->uploadFile($file, "OCR-" . date("Ymd") . time() . "-sw1");
        $imagenADB = new Imagen();
        $imagenADB->url = $url;
        $imagenADB->id_Tramite = $req->get('idtramite');
        $imagenADB->save();
        return "OK";
>>>>>>> 9ab2e0a1cefac722f717fbcb5e944d457d7fc864
    }

    public function actionExecuteocr()
    {


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
<<<<<<< HEAD
        return \GuzzleHttp\json_decode($result->info(),true);
=======
        unlink($file);
        return $result->info();
>>>>>>> 9ab2e0a1cefac722f717fbcb5e944d457d7fc864

    }

    public function actionGettramites()
    {
        $req = Yii::$app->request;
        $tramites = Tramite::find()->where(['idTramite' => $req->get('idtramite')])->all();
<<<<<<< HEAD
=======

>>>>>>> 9ab2e0a1cefac722f717fbcb5e944d457d7fc864
        return json_encode($tramites);
    }
}
