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
    <iframe
        src="https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d3799.1796096012686!2d-63.184096035674806!3d-17.783253937842463!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e0!3m2!1ses!2s!4v1481531252999"
        width="400" height="300" frameborder="0" style="border:0" allowfullscreen></iframe>
    <?= $form->field($model, 'ubicacionLongitud')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ubicacionLatitud')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'id_Categoria')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
