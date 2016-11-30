<?php

namespace app\controllers;

use app\models\Imagen;
use fpdf\FPDF;
use Yii;
use app\models\Tramite;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * TramiteController implements the CRUD actions for Tramite model.
 */
class TramiteController extends Controller
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
     * Lists all Tramite models.
     * @return mixed
     */
    public function actionIndex()
    {
        $dataProviderP = new ActiveDataProvider([
            'query' => Tramite::find()->where(['estado'=>0]),
        ]);
        $dataProviderR = new ActiveDataProvider([
            'query' => Tramite::find()->where(['estado'=>-1]),
        ]);
        $dataProviderA = new ActiveDataProvider([
            'query' => Tramite::find()->where(['estado'=>1]),
        ]);
        return $this->render('index', [
            'dataProviderP' => $dataProviderP,'dataProviderA' => $dataProviderA,'dataProviderR' => $dataProviderR,
        ]);
    }
    public function actionPdf($id= null)
    {
        $documentos = null;
        $documentos = Imagen::findAll(['id_Tramite' => $id]);

        $pdf = new FPDF();

        foreach ($documentos as $doc) {
            $tamaño = getimagesize($doc->url);

            $ancho=$tamaño[0];
            $alto=$tamaño[1];
            if ($ancho>$alto){
                $relacion=(bcdiv($alto,$ancho,7));

                if ($ancho>750){
                    $ancho=700;
                    $alto=$ancho*$relacion;
                }
            }else{
                $relacion=(bcdiv($ancho,$alto,7));

                if ($alto>1090){
                    $alto=1000;
                    $ancho=$alto*$relacion;
                }
            }

            $pdf->AddPage();
            $pdf->SetFont('Arial', 'B', 16);
            $pdf->Cell(10,0,$doc->nombre);
//            Ancho: 793px
//Alto: 1122px
//            Oficio/Legal	216 x 356 mm	8,5 x 14,0 pulg	1:1,6471
            $pdf->Image($doc->url, 10, 15,$ancho*0.25, $alto*0.25,'JPEG');

        }

        $pdf->Output();

    }
    /**
     * Displays a single Tramite model.
     * @param integer $id
     * @return mixed
     */
//    public function actionView($id)
//    {
//        return $this->render('view', [
//            'model' => $this->findModel($id),
//        ]);
//    }
    public function actionView($id,$action=null)
    {
        if ($action!=null){

            $doc = Tramite::findOne($id);
            $doc->estado=$action;
            if ($doc->save()){
                return $this->redirect(['index']);
            }

        }
        return $this->render('view', [
            'model' => $this->findModel($id),'documents'=>Imagen::find()->where(['id_Tramite'=>$id])->all(),
        ]);
    }
    /**
     * Creates a new Tramite model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
//    public function actionCreate()
//    {
//        $model = new Tramite();
//
//        if ($model->load(Yii::$app->request->post()) && $model->save()) {
//            return $this->redirect(['view', 'id' => $model->idTramite]);
//        } else {
//            return $this->render('create', [
//                'model' => $model,
//            ]);
//        }
//    }

    /**
     * Updates an existing Tramite model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->idTramite]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Tramite model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Tramite model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Tramite the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Tramite::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
