<?php
/**
 * Created by PhpStorm.
 * User: harold
 * Date: 09-10-16
 * Time: 06:44 AM
 */

use yii\widgets\ActiveForm;

?>

<?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]) ?>

<?= $form->field($model, 'imageFiles[]')->fileInput(['multiple' => true, 'accept' => 'image/*']) ?>

    <button>Subir</button>

<?php ActiveForm::end() ?>