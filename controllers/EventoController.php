<?php

namespace app\controllers;

use app\models\Emocion;
use app\models\Multimedia;
use app\models\Promedio;
use app\models\UploadForm;
use app\models\Usuarioevento;
use fpdf\FPDF;
use Yii;
use app\models\Evento;
use yii\data\ActiveDataProvider;
use yii\data\ArrayDataProvider;
use yii\db\ActiveQuery;
use yii\db\Query;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
use kartik\mpdf\Pdf;
/**
 * EventoController implements the CRUD actions for evento model.
 */
class EventoController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all evento models.
     * @return mixed
     */
    public function actionIndex()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(['/site/index']);
        }

//        $eventosDelUsuario = UsuarioEvento::find()->addSelect(["id_Evento"])->where(["id_Usuario" => Yii::$app->user->getId()]);
//        $eventos = Evento::findAll($eventosDelUsuario);
        $eventos = Evento::find()->all();
        return $this->render('index', [
            'eventos' => $eventos,
        ]);
    }

    /**
     * Displays a single evento model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    public function actionViewcatego($id)
    {
        $eventos = Evento::findAll(['id_Categoria' => $id]);
        return $this->render('index', [
            'eventos' => $eventos,
        ]);
    }
    public function actionViewuser($id)
    {
        $fotos = Multimedia::findAll(['id_Evento' => $id]);
        return $this->render('viewuser', [
            'model' => $this->findModel($id), 'fotos' => $fotos,
        ]);
    }
    /**
     * Creates a new evento model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($idOrg = null)
    {
        if ($idOrg == null) {
            return $this->redirect(['/evento/error']);
        }
        $model = new Evento();
        $model->id_Organizador = $idOrg;
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->idEvento]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing evento model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->idEvento]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing evento model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    public function actionError()
    {
        return $this->render(['error']);
    }

    public function actionUpload($idEvento, $idOrg, $idUser = null)
    {
        if ($idUser == null) $idUser = 101010;
        $model = new UploadForm();
        $model->evento = $idEvento;
        $model->idUser = $idUser;
        if (Yii::$app->request->isPost) {
            $model->imageFiles = UploadedFile::getInstances($model, 'imageFiles');
            if ($model->upload()) {
                Yii::$app->session->setFlash('success', "<script languaje='javascript'>alert('Fotos subidas correctamente ;)')</script>");
                return $this->redirect(['organizador/view', 'id' => $idOrg]);
            }
        }

        return $this->render('upload', ['model' => $model]);
    }
    /**
     * Finds the evento model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return evento the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Evento::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }


    public function actionPie($id, $tipo = null)
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Promedio::find()->where(['id_Evento' => $id]),
            'pagination' => false
        ]);
        if ($tipo == 1) {
            return $this->render('grapbar', [
                'dataProvider' => $dataProvider, 'idEvento' => $id,
            ]);
        } elseif ($tipo == 2) {
            return $this->render('grapscatter', [
                'dataProvider' => $dataProvider, 'idEvento' => $id,
            ]);
        } elseif ($tipo == 3) {
            return $this->render('grapline', [
                'dataProvider' => $dataProvider, 'idEvento' => $id,
            ]);
        }
        return $this->render('pie', [
            'dataProvider' => $dataProvider, 'idEvento' => $id,
        ]);
    }

    public function actionSubscribir($idEv, $idUs)
    {
        if (Yii::$app->user->isGuest) {
            return $this->render('error');
        }
        $sus = Usuarioevento::findOne(['id_Usuario' => $idUs, 'id_Evento' => $idEv]);
        if ($sus != null) {
            return $this->render('errorc', ['c' => "Ud ya esta suscrito a este evento"]);
        }
        $userEven = new Usuarioevento();
        $userEven->id_Evento = $idEv;
        $userEven->id_Usuario = $idUs;
        $userEven->save();
        return $this->goBack();
    }

    public function actionReport()
    {

        $pdf = new FPDF();
        /////////////////////////////////

        $tamaño = getimagesize("https://s3-us-west-2.amazonaws.com/fotowebhd/caratula.jpg");

        $ancho = $tamaño[0];
        $alto = $tamaño[1];
        if ($ancho > $alto) {
            $relacion = (bcdiv($alto, $ancho, 7));

            if ($ancho > 750) {
                $ancho = 700;
                $alto = $ancho * $relacion;
            }
        } else {
            $relacion = (bcdiv($ancho, $alto, 7));

            if ($alto > 1090) {
                $alto = 1000;
                $ancho = $alto * $relacion;
            }
        }

        $pdf->AddPage();
        $pdf->SetFont('Arial', 'B', 16);
        $pdf->Cell(10, 0);
//            Ancho: 793px
//Alto: 1122px
//            Oficio/Legal	216 x 356 mm	8,5 x 14,0 pulg	1:1,6471
        $pdf->Image("https://s3-us-west-2.amazonaws.com/fotowebhd/caratula.jpg", 10, 15, $ancho * 0.264583333, $alto * 0.264583333, 'JPG');

        $tamaño = getimagesize("https://s3-us-west-2.amazonaws.com/fotowebhd/pdf1.jpg");

        $ancho = $tamaño[0];
        $alto = $tamaño[1];
        if ($ancho > $alto) {
            $relacion = (bcdiv($alto, $ancho, 7));

            if ($ancho > 750) {
                $ancho = 700;
                $alto = $ancho * $relacion;
            }
        } else {
            $relacion = (bcdiv($ancho, $alto, 7));

            if ($alto > 1090) {
                $alto = 1000;
                $ancho = $alto * $relacion;
            }
        }

        $pdf->AddPage();
        $pdf->SetFont('Arial', 'B', 16);
        $pdf->Cell(10, 0, "Grafico 1");
//            Ancho: 793px
//Alto: 1122px
//            Oficio/Legal	216 x 356 mm	8,5 x 14,0 pulg	1:1,6471
        $pdf->Image("https://s3-us-west-2.amazonaws.com/fotowebhd/pdf1.jpg", 10, 15, $ancho * 0.264583333, $alto * 0.264583333, 'JPG');

/////////////////////////////////

        $tamaño = getimagesize("https://s3-us-west-2.amazonaws.com/fotowebhd/pdf2.jpg");

        $ancho = $tamaño[0];
        $alto = $tamaño[1];
        if ($ancho > $alto) {
            $relacion = (bcdiv($alto, $ancho, 7));

            if ($ancho > 750) {
                $ancho = 700;
                $alto = $ancho * $relacion;
            }
        } else {
            $relacion = (bcdiv($ancho, $alto, 7));

            if ($alto > 1090) {
                $alto = 1000;
                $ancho = $alto * $relacion;
            }
        }

        $pdf->AddPage();
        $pdf->SetFont('Arial', 'B', 16);
        $pdf->Cell(10, 0, "Grafico 2");
//            Ancho: 793px
//Alto: 1122px
//            Oficio/Legal	216 x 356 mm	8,5 x 14,0 pulg	1:1,6471
        $pdf->Image("https://s3-us-west-2.amazonaws.com/fotowebhd/pdf2.jpg", 10, 15, $ancho * 0.264583333, $alto * 0.264583333, 'JPG');

/////////////////////////////////

        $tamaño = getimagesize("https://s3-us-west-2.amazonaws.com/fotowebhd/pdf3.jpg");

        $ancho = $tamaño[0];
        $alto = $tamaño[1];
        if ($ancho > $alto) {
            $relacion = (bcdiv($alto, $ancho, 7));

            if ($ancho > 750) {
                $ancho = 700;
                $alto = $ancho * $relacion;
            }
        } else {
            $relacion = (bcdiv($ancho, $alto, 7));

            if ($alto > 1090) {
                $alto = 1000;
                $ancho = $alto * $relacion;
            }
        }

        $pdf->AddPage();
        $pdf->SetFont('Arial', 'B', 16);
        $pdf->Cell(10, 0, "Grafica 3");
//            Ancho: 793px
//Alto: 1122px
//            Oficio/Legal	216 x 356 mm	8,5 x 14,0 pulg	1:1,6471
        $pdf->Image("https://s3-us-west-2.amazonaws.com/fotowebhd/pdf3.jpg", 10, 15, $ancho * 0.264583333, $alto * 0.264583333, 'JPG');
/////////////////////////////////

        $tamaño = getimagesize("https://s3-us-west-2.amazonaws.com/fotowebhd/pdf4.jpg");

        $ancho = $tamaño[0];
        $alto = $tamaño[1];
        if ($ancho > $alto) {
            $relacion = (bcdiv($alto, $ancho, 7));

            if ($ancho > 750) {
                $ancho = 700;
                $alto = $ancho * $relacion;
            }
        } else {
            $relacion = (bcdiv($ancho, $alto, 7));

            if ($alto > 1090) {
                $alto = 1000;
                $ancho = $alto * $relacion;
            }
        }

        $pdf->AddPage();
        $pdf->SetFont('Arial', 'B', 16);
        $pdf->Cell(10, 0, "Grafico 4");
//            Ancho: 793px
//Alto: 1122px
//            Oficio/Legal	216 x 356 mm	8,5 x 14,0 pulg	1:1,6471
        $pdf->Image("https://s3-us-west-2.amazonaws.com/fotowebhd/pdf4.jpg", 10, 15, $ancho * 0.264583333, $alto * 0.264583333, 'JPG');


        $pdf->Output();
    }

    public function actionReportb()
    {

        $pdf = new FPDF();
        /////////////////////////////////


        $pdf->AddPage();
        $pdf->SetFont('Arial', 'B', 16);
        $pdf->Cell(0, 0);

        $pdf->Image("https://s3-us-west-2.amazonaws.com/fotowebhd/caratula.jpg", null, null, 300, 200, '', ''););


        $pdf->AddPage();
        $pdf->SetFont('Arial', 'B', 16);
        $pdf->Cell(0, 0, "Grafico 1");

        $pdf->Image("https://s3-us-west-2.amazonaws.com/fotowebhd/pdf1.jpg", null, null, 300, 200, '', '');

/////////////////////////////////


        $pdf->AddPage();
        $pdf->SetFont('Arial', 'B', 16);
        $pdf->Cell(0, 0, "Grafico 2");

        $pdf->Image("https://s3-us-west-2.amazonaws.com/fotowebhd/pdf2.jpg", null, null, 300, 200, '', ''););

/////////////////////////////////

        $pdf->AddPage();
        $pdf->SetFont('Arial', 'B', 16);
        $pdf->Cell(0, 0, "Grafica 3");
//
        $pdf->Image("https://s3-us-west-2.amazonaws.com/fotowebhd/pdf3.jpg", null, null, 300, 200, '', ''););
/////////////////////////////////


        $pdf->AddPage();
        $pdf->SetFont('Arial', 'B', 16);
        $pdf->Cell(0, 0, "Grafico 4");

        $pdf->Image("https://s3-us-west-2.amazonaws.com/fotowebhd/pdf4.jpg", null, null, 300, 200, '', ''););


        $pdf->Output();
    }






















}
