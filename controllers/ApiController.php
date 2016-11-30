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
//        return $this->getData($result->info()['textAnnotations']);
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
                if (strpos($rContent, 'fotogra') !== false) {
                    if ($estado == 3) {
                        array_push($return, $preReturn);
                        $preReturn = [];
                    }
                    $estado = 1;
//                } elseif (strpos($rContent, 'A:')!== false) {
                } elseif ($rContent == "A:") {
                    if ($estado == 3) {
                        array_push($return, $preReturn);
                        $preReturn = [];
                    }
                    $estado = 2;
                } elseif (strpos($rContent, 'Nacido') !== false) {
                    if ($estado == 3) {
                        array_push($return, $preReturn);
                        $preReturn = [];
                    }
                    $estado = 0;
                } elseif (strpos($rContent, 'el') !== false) {
                    if ($estado == 3) {
                        array_push($return, $preReturn);
                        $preReturn = [];
                    }
                    $estado = 2;

                } elseif (strpos($rContent, 'En') !== false) {
                    if ($estado == 3) {
                        array_push($return, $preReturn);
                        $preReturn = [];
                    }
                    $estado = 2;
                } elseif (strpos($rContent, 'Estado') !== false) {
                    if ($estado == 3) {
                        array_push($return, $preReturn);
                        $preReturn = [];
                    }
                    $estado = 0;

                } elseif (strpos($rContent, 'Civil') !== false) {
                    if ($estado == 3) {
                        array_push($return, $preReturn);
                        $preReturn = [];
                    }
                    $estado = 1;
                } elseif (strpos($rContent, 'Profesi') !== false) {
                    if ($estado == 3) {
                        array_push($return, $preReturn);
                        $preReturn = [];
                    }
                    $estado = 2;
                } elseif (strpos($rContent, 'Domicilio') !== false) {
                    if ($estado == 3) {
                        array_push($return, $preReturn);
                        $preReturn = [];
                    }
                    break;
                }
                if ($estado == 3) {
                    array_push($preReturn, $r['description']);
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

    public function getData($imgPath)
    {
//        $textArray = $this->OCR($imgPath);
        $textArray = $imgPath;
        $state = 0;
        $AC = "";
        $data = [];
        foreach ($textArray as $text) {
            $word = $text['description'];
            switch ($state) {
                case 0: // Caso base
                    if ($word === 'firma' || $word === 'firma,')
                        $state = 1; // Para Confirmar
                    else if ($word === 'fotografia')
                        $state = 2;
                    else if ($word === 'impresion')
                        $state = 3;
                    else if ($word === 'Civil')
                        $state = 10;
                    else if (strpos($word, "Profesion") !== false && count($data) > 0)
                        $state = 11;
                    break;
                case 1: // Confirmar carnet
                    if ($word === 'fotografia')
                        $state = 2;
                    break;
                case 2: // Carnet
                    if (is_numeric($word))
                        $data['CI'] = intval($word);
                    $AC = "";
                    $state = 0;
                    break;
                case 3: // Despues de impresion
                    if (!is_numeric($word) && $word !== "A" && $word !== "A:" && $word !== "pertenece") {
                        $AC = $word . " ";
                        $state = 4;
                    }
                    break;
                case 4: // Concatenar el Nombre
                    if ($word === 'Nacido') {
                        $state = 5;
                        $data['NAME'] = substr($AC, 0, -1);
                        $AC = "";
                    } else {
                        $AC = $AC . $word . " ";
                    }
                    break;
                case 5: // Revisar dia
                    if (is_numeric($word)) { //Dia
                        $AC = $word . ',';
                        $state = 6;
                    }
                    break;
                case 6: // Revisar mes
                    if ($word !== 'de') {
                        $AC = $AC . $this->getMonth($word) . ',';
                        $state = 7;
                    }
                    break;
                case 7: // Revisar year
                    if ($word !== 'de') {
                        $AC = $AC . $word;
                        $dateArray = explode(",", $AC);
                        $data['BIRTHDAY'] = $dateArray[2] . "-" . $dateArray[1] . "-" . $dateArray[0];
                        $state = 8;
                    }
                    break;
                case 8: // Revisar Lugar de nacimiento
                    if ($word !== "En") {
                        $AC = $word . " ";
                        $state = 9;
                    }
                    break;
                case 9: // Concatenar Lugar de Nacimiento
                    if ($word !== "Estado")
                        $AC = $AC . $word . " ";
                    else {
                        $data['BIRTHPLACE'] = substr($AC, 0, -1);
                        $state = 0;
                        $AC = "";
                    }
                    break;
                case 10: // Estado Civil
                    $data['CIVIL_STATUS'] = $word;
                    $AC = "";
                    $state = 0;
                    break;
                case 11:
                    if ($word !== "Domicilio")
                        $AC = $AC . $word . " ";
                    else {
                        $data['OCCUPATION'] = substr($AC, 0, -1);
                        $state = 0;
                        $AC = "";
                    }
                    break;
                default:
                    break;
            }
        }
        return $data;
    }

    private function getMonth($word)
    {
        $month = "";
        switch ($word) {
            case 'Enero':
                $month = "01";
                break;
            case 'Febrero':
                $month = "02";
                break;
            case 'Marzo':
                $month = "03";
                break;
            case 'Abril':
                $month = "04";
                break;
            case 'Mayo':
                $month = "05";
                break;
            case 'Junio':
                $month = "06";
                break;
            case 'Julio':
                $month = "07";
                break;
            case 'Agosto':
                $month = "08";
                break;
            case 'Septiembre':
                $month = "09";
                break;
            case 'Octubre':
                $month = "10";
                break;
            case 'Noviembre':
                $month = "11";
                break;
            case 'Diciembre':
                $month = "12";
                break;
        }
        return $month;
    }
}
