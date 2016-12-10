<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Login';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-login">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>Please fill out the following fields to login:</p>

    <?php $form = ActiveForm::begin([
        'id' => 'login-form',
        'layout' => 'horizontal',
        'fieldConfig' => [
            'template' => "{label}\n<div class=\"col-lg-3\">{input}</div>\n<div class=\"col-lg-8\">{error}</div>",
            'labelOptions' => ['class' => 'col-lg-1 control-label'],
        ],
    ]); ?>

    <?= $form->field($model, 'username')->textInput(['autofocus' => true]) ?>

        <?= $form->field($model, 'password')->passwordInput() ?>

        <?= $form->field($model, 'rememberMe')->checkbox([
            'template' => "<div class=\"col-lg-offset-1 col-lg-3\">{input} {label}</div>\n<div class=\"col-lg-8\">{error}</div>",
        ]) ?>

        <div class="form-group">
            <div class="col-lg-offset-1 col-lg-11">
                <?= Html::submitButton('Login', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
            </div>
        </div>

    <?php ActiveForm::end(); ?>

    <div class="col-lg-offset-1" style="color:#999;">
        You may login with <strong>admin/admin</strong> or <strong>demo/demo</strong>.<br>
        To modify the username/password, please check out the code <code>app\models\User::$users</code>.
    </div>
</div>
<?php //$form = ActiveForm::begin([
//    'id' => 'login-form',
//    'layout' => 'horizontal',
//    'fieldConfig' => [
//        'template' => "{label}\n<div class=\"col-lg-3\">{input}</div>\n<div class=\"col-lg-8\">{error}</div>",
//        'labelOptions' => ['class' => 'col-lg-1 control-label'],
//    ],
//]); ?>
<!---->
<? //= $form->field($model, 'username')->widget(
//    \msvdev\widgets\mappicker\MapInput::className(),
//    [
//        'language' => 'en-Us', // map language, default is the same as in the app
//        'service' => 'google', // map service provider, "google" or "yandex", default "google"
//        'apiKey' => 'AIzaSyC32nFjHqKDyKf7haV9OFNeHqUXPj0i7po', // required google maps
////            'coordinatesDelimiter' => '@', // attribute coordinate string delimiter, default "@" (lat@lng)
//        'mapWidth' => '800px', // width map container, default "500px"
//        'mapHeight' => '500px', // height map container, default "500px"
//        'mapZoom' => '14', // map zoom value, default "10"
//        'mapCenter' => [55.753338, 37.622861], // coordinates center map with an empty attribute, default Moscow
//    ]
//); ?>
<!---->
<? //= $form->field($model, 'password')->passwordInput() ?>
<!---->
<? //= $form->field($model, 'rememberMe')->checkbox([
//    'template' => "<div class=\"col-lg-offset-1 col-lg-3\">{input} {label}</div>\n<div class=\"col-lg-8\">{error}</div>",
//]) ?>
<!---->
<!--<div class="form-group">-->
<!--    <div class="col-lg-offset-1 col-lg-11">-->
<!--        --><? //= Html::submitButton('Login', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
<!--    </div>-->
<!--</div>-->
<!---->
<?php //ActiveForm::end(); ?>
