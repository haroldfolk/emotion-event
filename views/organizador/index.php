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
    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'idEvento')->textInput() ?>


    <div class="form-group">
        <?= "<br>" . Html::submitButton(Yii::t('app', 'Entrar como organizador'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>
    <p>
        <?= Html::a('Registrarse como Organizador', ['create'], ['class' => 'btn btn-warning']) ?>
    </p>

</div>
