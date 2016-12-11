<?php

namespace app\controllers;

use app\models\Emocion;
use app\models\UploadForm;
use app\models\Usuarioevento;
use Yii;
use app\models\Evento;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

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

    /**
     * Creates a new evento model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
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

    public function actionUpload($idEvento, $idOrg, $idUser = null)
    {
        if ($idUser = null) $idUser = 101010;
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
            'query' => Emocion::find()->where(['id_Evento' => $id])->addGroupBy('nombre'),
            'pagination' => false
        ]);

        return $this->render('pie', [
            'dataProvider' => $dataProvider
        ]);
    }



























}
