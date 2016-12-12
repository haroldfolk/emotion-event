<?php
/**
 * Created by PhpStorm.
 * User: harold
 * Date: 09-10-16
 * Time: 06:41 AM
 */
namespace app\models;

use Yii;
use Faker\Provider\Image;
use yii\base\Model;
use yii\helpers\Json;
use yii\httpclient\Client;
use yii\web\UploadedFile;
use app\models\Multimedia;
class UploadForm extends Model
{
    /**
     * @var UploadedFile[]
     */
    public $imageFiles;
    public $evento;
    public $idUser;

    public function rules()
    {
        return [
            [['imageFiles'], 'file', 'skipOnEmpty' => false, 'extensions' => 'png, jpg,gif', 'maxFiles' => 5],

        ];
    }

    public function upload()
    {
        $storage = Yii::$app->storage;
        $ev = $this->evento;
        if ($this->validate()) {

            foreach ($this->imageFiles as $file) {

                $path = 'fotos/' . $file->baseName . '.' . $file->extension;

                $file->saveAs($path);
                $url = $storage->uploadFile($path, "ProyFinalH" . date("Ymd") . time() . "");
                $modelFoto = new Multimedia();
                $modelFoto->nombre = "Foto";
                $modelFoto->path = $url;
                $modelFoto->id_Usuario = $this->idUser;
                $modelFoto->id_Evento = $ev;
                if ($modelFoto->save()) {
                    unlink($path);
                    $json = $this->ejecutarEmocionApi($url);
                    $this->reconocerEmocionesDeJSON($json, $ev);
                }

            }
            return true;
        } else {
            return false;
        }
    }

    public function identificarMicrosoft($urlToMicrosoft)
    {
        $client = new Client();
        $response = $client->createRequest()
            ->setMethod('post')
            ->setUrl('https://api.projectoxford.ai/face/v1.0/detect?returnFaceId=true&subscription-key=58f5d9bbbc2c4e15be44f5d4ce29c0d0')
            ->addHeaders(['content-type' => 'application/json'])
            ->setContent('{url:"' . $urlToMicrosoft . '"}')
            ->send();
        if ($response->isOk) {
            return $response->content;
        }
        return null;
    }

    public function ejecutarEmocionApi($urlToMicrosoft = null)
    {
        $client = new Client();
        $response = $client->createRequest()
            ->setMethod('post')
            ->setUrl('https://api.projectoxford.ai/emotion/v1.0/recognize?subscription-key=0231135c1da34cc5970fa55a50ede63f')
            ->addHeaders(['content-type' => 'application/json'])
//            ->setContent('{"url":"' . $urlToMicrosoft . '"}')
            ->setContent('{"url":"' . $urlToMicrosoft . '"}')
            ->send();
        if ($response->isOk) {

            return $response->content;
        } else {
            print_r("la Error en la EmocionAPI nofunciona");
            exit();
        }
        return null;
    }

    public function reconocerEmocionesDeJSON($json, $idEv)
    {
        $decode = json_decode($json, true);
        if ($decode != null) {
            foreach ($decode as $js) {
                if (isset($js["scores"])) {
                    $emociones = $js["scores"];
                    foreach ($emociones as $nombreEmo => $valorEmo) {
                        $model = new Emocion();
                        $model->nombre = $nombreEmo;
                        $model->valor = $valorEmo * 100;
                        $model->id_Evento = $idEv;
                        if ($model->validate()) {
                            $model->save();
                            $prom = Promedio::findOne(['id_Evento' => $model->id_Evento, 'nombre' => $model->nombre]);
                            $nuevaC = $prom->cant + $model->valor;
                            $prom->cant = $nuevaC;
                            $nuevaT = $prom->numTuplas + 1;
                            $prom->numTuplas = $nuevaT;
                            $nuevaV = $prom->cant / $prom->numTuplas;
                            $prom->valor = $nuevaV;
                            $prom->save();
                        }
                    }
                }

            }
            return false;
        } else {
            return false;
        }
    }

    protected function findPromedio($id)
    {
        if (($model = Promedio::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function hayCara($json)
    {
        $decode = json_decode($json, true);
        if ($decode != null) {
            foreach ($decode as $js) {
                if (!isset($js["faceId"])) {

                    return false;
                }
                return true;
            }
            return false;
        } else {
            return false;
        }
    }

    function insertarmarcadeagua($imagen, $marcadeagua, $margen)
    {
        //Se supone que la marca de agua tiene menor tamaño que la imagen
        //$imagen es la ruta de la imagen. Ej.: "carpeta/imagen.jpg"
        //&marcadeagua es la ruta de la imagen marca de agua. Ej.: "marca.png"
        //$margen determina el margen que quedará entre la marca y los bordes de la imagen

        //Averiguamos la extensión del archivo de imagen
        $trozos_nombre_imagen = explode(".", $imagen);
        $extension_imagen = $trozos_nombre_imagen[count($trozos_nombre_imagen) - 1];

        //Creamos la imagen según la extensión leída en el nombre del archivo
        if (preg_match('/jpg|jpeg|JPG|JPEG/', $extension_imagen))
            $img = ImageCreateFromJPEG($imagen);
        if (preg_match('/png|PNG/', $extension_imagen))
            $img = ImageCreateFromPNG($imagen);
        if (preg_match('/gif|GIF/', $extension_imagen))
            $img = ImageCreateFromGIF($imagen);

        //declaramos el fondo como transparente
        ImageAlphaBlending($img, true);

        //Ahora creamos la imagen de la marca de agua
        $marcadeagua = ImageCreateFromPNG($marcadeagua);

        //Hallamos las dimensiones de ambas imágenes para alinearlas
        $Xmarcadeagua = imagesx($marcadeagua);
        $Ymarcadeagua = imagesy($marcadeagua);
        $Ximagen = imagesx($img);
        $Yimagen = imagesy($img);

        //Copiamos la marca de agua encima de la imagen (alineada abajo a la derecha)
        imagecopy($img, $marcadeagua, $Ximagen - $Xmarcadeagua - $margen, $Yimagen - $Ymarcadeagua - $margen, 0, 0, $Xmarcadeagua, $Ymarcadeagua);

        //Guardamos la imagen sustituyendo a la original, en este caso con calidad 100
        ImageJPEG($img, $imagen, 100);

        //Eliminamos de memoria las imágenes que habíamos creado
        imagedestroy($img);
        imagedestroy($marcadeagua);
    }


    public function encontrarSubscriptor($getId, $idFoto)
    {
        $userFaceId = Perfil::findOne(['id_Usuario' => $getId]);
        $fotoDelEvento = Foto::findOne(['idFoto' => $idFoto]);
        if ($userFaceId->faceId != "NULL") {

            $faceIdsDeFoto = $fotoDelEvento->faceIds;
            if ($faceIdsDeFoto != "NULL") {
                $Jsons = json_decode($faceIdsDeFoto, true);
                $faces = '';
                foreach ($Jsons as $json) {
                    $faceId = $json["faceId"];
                    $faces = $faces . '"' . $faceId . '",';
                }
                $jsonAEnviar = '{"faceIds":[' . $faces . '"' . $userFaceId->faceId . '"' . ']}';
                $jsonConGrupos = $this->encontrarGruposMicrosoft($jsonAEnviar);
                $arrayConGrupos = json_decode($jsonConGrupos, true);
                if (isset($arrayConGrupos["messyGroup"])) {
                    if (!$this->estaEnEsteGrupo($userFaceId->faceId, $arrayConGrupos["messyGroup"])) {
                        $fotoUser = new FotoUsuario();
                        $fotoUser->id_Foto = $fotoDelEvento->idFoto;
                        $fotoUser->id_Usuario = $getId;
                        $fotoUser->save();
                    }
                }
            }

        } else {
            echo "suba una foto de perfil para encontrar sus fotos en el evento";
            return;
        }


    }

    public function encontrarGruposMicrosoft($jsonAMandar)
    {
        $client = new Client();
        $response = $client->createRequest()
            ->setMethod('post')
            ->setUrl('https://api.projectoxford.ai/face/v1.0/group?subscription-key=58f5d9bbbc2c4e15be44f5d4ce29c0d0')
            ->addHeaders(['content-type' => 'application/json'])
            ->setContent($jsonAMandar)
            ->send();
        if ($response->isOk) {
            return $response->content;
        }
        return null;
    }

    private function estaEnEsteGrupo($faceId, $messyGroup)
    {
        if (in_array($faceId, $messyGroup)) {
            return true;
        }
        return false;
    }
}