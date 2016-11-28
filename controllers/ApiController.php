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
            return "PARAMETROS_INVALIDOS2";
        }
    }

    public function actionUploadimages3()
    {
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

        unlink($file);
        return $this->interpretar($result->info()['textAnnotations']);

//        return $result->info();


    }

    public function actionGettramites()
    {
        $req = Yii::$app->request;
        $tramites = Tramite::find()->where(['idTramite' => $req->get('idtramite')])->all();
        return json_encode($tramites);
    }

    public function interpretar($resultado)
    {
        if (!isset($resultado)) {
            return null;
        }
        $return = [];
        $estado = 0;
        $preReturn = [];
        foreach ($resultado as $r) {
            $rContent = $r['description'];
//            $rContent = preg_replace("ó|Ó", "o");
//                $rContent = strtolower($rContent);
            if ($estado == 3 || $estado == 0) {
                if (strpos($rContent, 'fotogra')) {
                    if ($estado == 3) {
                         array_push($return, $preReturn);
                    }
                    $estado = 1;
                } elseif (strpos($rContent, 'A:')) {
                    if ($estado == 3) {
                         array_push($return, $preReturn);
                    }
                    $estado = 2;
                } elseif (strpos($rContent, 'Nacido')) {
                    if ($estado == 3) {
                         array_push($return, $preReturn);
                    }
                    $estado = 0;

                } elseif (strpos($rContent, 'En')) {
                    if ($estado == 3) {
                         array_push($return, $preReturn);
                    }
                    $estado = 2;
                } elseif (strpos($rContent, 'Estado')) {
                    if ($estado == 3) {
                         array_push($return, $preReturn);
                    }
                    $estado = 0;

                } elseif (strpos($rContent, 'civil')) {
                    if ($estado == 3) {
                         array_push($return, $preReturn);
                    }
                    $estado = 1;
                } elseif (strpos($rContent, 'Profesi')) {
                    if ($estado == 3) {
                         array_push($return, $preReturn);
                    }
                    $estado = 2;
                } elseif (strpos($rContent, 'Domicilio')) {
                    if ($estado == 3) {
                         array_push($return, $preReturn);
                    }
                    break;
                }
            } elseif ($estado == 1) {
                array_push($return, $r['description']);
                $estado = 0;
            } elseif ($estado == 2) {
                array_push($preReturn, $r['description']);
                $estado = 3;
            }
        }


        return $return;
    }
}
