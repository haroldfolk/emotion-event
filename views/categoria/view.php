<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Categoria */


$this->params['breadcrumbs'][] = ['label' => 'Categorias', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="categoria-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="list-group">
        <?php foreach ($eventos as $evento) { ?>
            <!--                    <a href="#" class="list-group-item">Home</a>-->
            <div class="list-group-item">
                <div class="media">
                    <a href="#" class="pull-left"><img alt="EN ALMACENAMIENTO EXTERNO S3"
                                                       src="<?= $evento->url ?>"
                                                       class="media-object"></a>
                    <div class="media-body">
                        <h4 class="media-heading">
                            <?= $evento->nombre ?>
                        </h4> "<?= $evento->detalle ?>"

                    </div>
                </div>

                <a id="modal-702504" href="#<?= $evento->idEvento ?>" role="button" class="btn"
                   data-toggle="modal">Suscribirme</a>
            </div>
            <div class="modal fade" id="<?= $evento->idEvento ?>" role="dialog" aria-labelledby="myModalLabel"
                 aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">

                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                                ×
                            </button>
                            <h4 class="modal-title" id="myModalLabel">
                                Informacion del Evento <?= $evento->idEvento ?>
                            </h4>
                        </div>
                        <div class="modal-body">
                            <h1><?= $evento->nombre ?></h1>
                            <h3><?= $evento->nombre ?></h3>
                            <h4><?= $evento->detalle ?></h4>
                            <h4><?= $evento->fechaInicio ?></h4>
                            <h4><?= $evento->fechaFin ?></h4>
                        </div>
                        <div class="modal-footer">

                            <button type="button" class="btn btn-default" data-dismiss="modal">
                                Cerrar
                            </button>
                            <button type="button" class="btn btn-primary">
                                OK
                            </button>
                        </div>
                    </div>

                </div>

            </div>
        <?php } ?>

    </div>

</div>
