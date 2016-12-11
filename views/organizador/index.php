<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Organizadors';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="organizador-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Organizador', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'idOrganizador',
            'titular',
            'direccion',
            'telefono',
            'password',
            // 'informacionAdicional',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
