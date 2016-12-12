<?php
/**
 * Created by PhpStorm.
 * User: harold
 * Date: 09-10-16
 * Time: 06:44 AM
 */

use yii\widgets\ActiveForm;

//use kartik\widgets\Spinner;
?>
    <h1>Subir Imagenes</h1>
<?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]) ?>


<?= $form->field($model, 'imageFiles[]')->fileInput(['multiple' => true, 'accept' => 'image/*']) ?>

    <button class="btn-primary">Subir</button>
?>
<?php ActiveForm::end() ?>