<?php

namespace app\controllers;

use app\models\Emocion;
use app\models\Multimedia;
use app\models\Promedio;
use app\models\UploadForm;
use app\models\Usuarioevento;
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

        $eventosDelUsuario = UsuarioEvento::find()->addSelect(["id_Evento"])->where(["id_Usuario" => Yii::$app->user->getId()]);
        $eventos = Evento::findAll($eventosDelUsuario);

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


    public function actionPie($id)
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Promedio::find()->where(['id_Evento' => $id]),
            'pagination' => false
        ]);
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
            return $this->render('errorc', ['c' => "Udyaesta suscrito a este evento"]);
        }
        $userEven = new Usuarioevento();
        $userEven->id_Evento = $idEv;
        $userEven->id_Usuario = $idUs;
        $userEven->save();
        return $this->goBack();
    }
    public function actionReport($id)
    {
        return $this->goBack();
    }























}
