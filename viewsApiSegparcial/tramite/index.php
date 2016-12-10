<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Tramites';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tramite-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <!--        --><?php ///*php==*/ Html::a('Create Tramite', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <h2>Tramites Pendientes</h2>
    <?= GridView::widget([
        'dataProvider' => $dataProviderP,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'idTramite',
            'titulo',
            'fecha',
            'estado',
            'id_Cliente',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
    <h2>Tramites Rechazados</h2>
    <?= GridView::widget([
        'dataProvider' => $dataProviderR,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'idTramite',
            'titulo',
            'fecha',
            'estado',
            'id_Cliente',

//            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
    <h2>Tramites Aprobados</h2>
    <?= GridView::widget([
        'dataProvider' => $dataProviderA,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'idTramite',
            'titulo',
            'fecha',
            'estado',
            'id_Cliente',

//            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
