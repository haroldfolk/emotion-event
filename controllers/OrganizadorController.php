<?php

namespace app\controllers;

use app\models\Evento;
use app\models\OrganizadorForm;
use Yii;
use app\models\Organizador;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * OrganizadorController implements the CRUD actions for organizador model.
 */
class OrganizadorController extends Controller
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
     * Lists all organizador models.
     * @return mixed
     */
    public function actionIndex()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->render('error');
        }
        $model = new OrganizadorForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {

            return $this->redirect(['view', 'id' => $model->id]);
        }
        return $this->render('index', [
            'model' => $model,
        ]);
    }

    public function actionUpload($idEvento, $idOrg)
    {
        if (!Yii::$app->user->isGuest) {
            return $this->render('error');
        }

        return $this->redirect(['/evento/upload', 'idEvento' => $idEvento, 'idOrg' => $idOrg]);
    }
    /**
     * Displays a single organizador model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $eventos = Evento::findAll(['id_Organizador' => $id]);
        $model = $this->findModel($id);
        return $this->render('view', [
            'eventos' => $eventos, 'model' => $model,
        ]);
    }

    /**
     * Creates a new organizador model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Organizador();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->idOrganizador]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing organizador model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->idOrganizador]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing organizador model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
//    public function actionDelete($id)
//    {
//        $this->findModel($id)->delete();
//
//        return $this->redirect(['index']);
//    }
    public function actionError()
    {
        return $this->render(['error']);
    }
    /**
     * Finds the organizador model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return organizador the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Organizador::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
