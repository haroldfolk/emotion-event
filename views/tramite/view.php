<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Tramite */

$this->title = $model->titulo.':Pendiente';
$this->params['breadcrumbs'][] = ['label' => 'Tramites', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tramite-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Aprobar', ['view', 'id' => $model->idTramite,'action'=>1], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Rechazar', ['view', 'id' => $model->idTramite,'action'=>-1], ['class' => 'btn btn-danger']) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'idTramite',
            'titulo',
            'fecha',
            'estado',
            'id_Cliente',
        ],
    ]) ?>
    <div class="container" style="margin-top:10px;">
        <div class="row form-group ">
            <?php foreach ($documents as $doc) {
                ?>

                <div class="col-xs-6 col-md-4">

                    <div class="panel-heading">
                        <h3 class="panel-title"><?= $doc->nombre ?></h3>
                    </div>
                    <a href="<?= $doc->url ?>" >
                        <img  width="230" height="200"  src="<?= $doc->url ?>">
                    </a>


                </div>
            <?php }
            ?>
        </div>
    </div>


</div>
