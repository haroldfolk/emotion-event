<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\evento */

$this->title = $model->idEvento;
$this->params['breadcrumbs'][] = ['label' => 'Eventos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="evento-view">

    <h1><?= Html::encode($this->title) ?></h1>


    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [

            'nombre',
            'detalle',
            'fechaInicio',
            'fechaFin',
            'id_Organizador',

            'id_Categoria',
        ],
    ]) ?>
    <iframe
        src="https://www.google.com/maps/embed?pb=!1m10!1m8!1m3!1d15191.212525139186!2d<?= $model->ubicacionLongitud ?>!3d<?= $model->ubicacionLatitud ?>!3m2!1i1024!2i768!4f13.1!5e0!3m2!1ses!2s!4v1481522446783"
        width="600" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>
    <div class="container" style="margin-top:10px;">
        <div class="row form-group ">
            <?php foreach ($fotos as $doc) {
                ?>

                <div class="col-xs-6 col-md-4">

                    <div class="panel-heading">
                        <h3 class="panel-title"><?= $doc->nombre ?></h3>
                    </div>
                    <a href="<?= $doc->url ?>">
                        <img width="230" height="200" src="<?= $doc->url ?>">
                    </a>


                </div>
            <?php }
            ?>
        </div>
    </div>
</div>
