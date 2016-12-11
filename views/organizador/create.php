<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\organizador */

$this->title = 'Create Organizador';
$this->params['breadcrumbs'][] = ['label' => 'Organizadors', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="organizador-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
