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
        <?= Html::a('Create Tramite', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
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
</div>
