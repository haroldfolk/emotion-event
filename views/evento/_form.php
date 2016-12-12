<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\evento */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="evento-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'nombre')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'detalle')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'fechaInicio')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'fechaFin')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'id_Organizador')->hiddenInput() ?>
    <?= $form->field($model, 'ubicacionLongitud')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'ubicacionLatitud')->textInput(['maxlength' => true]) ?>
    <iframe width="400" height="400" src="//jsfiddle.net/eB2RX/1/embedded/result/" allowfullscreen="allowfullscreen"
            frameborder="0"></iframe>

    <?= $form->field($model, 'id_Categoria')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
