<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\organizador */

$this->title = 'Update Organizador: ' . $model->idOrganizador;
$this->params['breadcrumbs'][] = ['label' => 'Organizadors', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->idOrganizador, 'url' => ['view', 'id' => $model->idOrganizador]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="organizador-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
