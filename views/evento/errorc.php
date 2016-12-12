<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Eventos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="evento-index">

    <h1><?= $c ?></h1>

    <p>
        <?= Html::a('Ver Eventos', ['index'], ['class' => 'btn btn-success']) ?>
    </p>

</div>
