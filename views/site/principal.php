<?php use yii\helpers\Html; ?>
<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/html">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Mi portada!</title>

    <meta name="description" content="Source code generated using layoutit.com">
    <meta name="author" content="LayoutIt!">

    <!--    <link href="css/bootstrap.min.css" rel="stylesheet">-->
    <!--    <link href="css/style.css" rel="stylesheet">-->

</head>
<body>

<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <nav class="navbar navbar-default" role="navigation">
                <div class="navbar-header">

                    <button type="button" class="navbar-toggle" data-toggle="collapse"
                            data-target="#bs-example-navbar-collapse-1">
                        <span class="sr-only">Toggle navigation</span><span class="icon-bar"></span><span
                            class="icon-bar"></span><span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="#">Buscar Eventos</a>
                </div>
            </nav>
            <div class="carousel slide" id="carousel-140385">
                <ol class="carousel-indicators">
                    <li class="active" data-slide-to="0" data-target="#carousel-140385">
                    </li>
                    <li data-slide-to="1" data-target="#carousel-140385">
                    </li>
                    <li data-slide-to="2" data-target="#carousel-140385">
                    </li>
                </ol>
                <div class="carousel-inner">
                    <div class="item active">
                        <img alt="Carousel Bootstrap First"
                             src="http://fmbellaitalia.com/web/wp-content/uploads/2015/11/publicite_aqui_2.png"
                             style="width:500px;height:250px">
                        <div class="carousel-caption">
                            <h4>
                                Nombre de Evento
                            </h4>
                            <p>
                                Portada de Evento
                            </p>
                        </div>
                    </div>
                    <div class="item">
                        <img alt="Carousel Bootstrap Second"
                             src="http://fmbellaitalia.com/web/wp-content/uploads/2015/11/publicite_aqui_2.png"
                             style="width:500px;height:250px">
                        <div class="carousel-caption">
                            <h4>
                                Nombre de Evento
                            </h4>
                            <p>
                                Portada de Evento
                            </p>
                        </div>
                    </div>
                    <div class="item">
                        <img alt="Carousel Bootstrap Third"
                             src="http://fmbellaitalia.com/web/wp-content/uploads/2015/11/publicite_aqui_2.png"
                             style="width:500px;height:250px">
                        <div class="carousel-caption">
                            <h4>
                                Nombre de Evento
                            </h4>
                            <p>
                                Portada de Evento
                            </p>
                        </div>
                    </div>
                </div>
                <a class="left carousel-control" href="#carousel-140385" data-slide="prev"><span
                        class="glyphicon glyphicon-chevron-left"></span></a> <a class="right carousel-control"
                                                                                href="#carousel-140385"
                                                                                data-slide="next"><span
                        class="glyphicon glyphicon-chevron-right"></span></a>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-3">

            <h3><p>
                    <?= Html::a('Eventos suscritos', ['/evento'], ['class' => 'btn btn-success']) ?>

                </p></h3>
            <div class="list-group">
                <?php

                foreach ($eventos as $evento) { ?>

                    <div class="list-group-item">
                        <a id="modal-702504" href="#<?= $evento->idEvento ?>" role="button" class="btn"
                           data-toggle="modal"><?= $evento->nombre ?></a>
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
                                    <h4><?= $evento->fechaInicio ?></h4>
                                    <h4><?= $evento->fechaFin ?></h4>
                                </div>
                                <div class="modal-footer">
                                    <?= Html::a('Ver Evento', ['/evento/view', 'id' => $evento->idEvento], ['class' => 'btn btn-success']) ?>
                                    <button type="button" class="btn btn-default" data-dismiss="modal">
                                        Close
                                    </button>

                                </div>
                            </div>

                        </div>

                    </div>
                <?php } ?>

            </div>


            <p>
                <a class="btn" href="#">########## »</a>
            </p>
        </div>


        <div class="col-md-6">
            <h2>
                <p class="bg-success" align="center">
                    NOTICIAS
                </p>
            </h2>

            <div class="list-group">
                <?php foreach ($eventosALL as $evento) { ?>
                    <div class="list-group-item">
                        <div class="media">
                            <a id="modal-702504" role="button" href="#<?= $evento->idEvento ?>" class="pull-left"><img
                                    alt="EN ALMACENAMIENTO EXTERNO S3"
                                    src="<?= $evento->url ?>"
                                    class="media-object"
                                    style="width:200px;height:200px"></a>
                            <div class="media-body">
                                <h4 class="media-heading">
                                    <?= $evento->nombre ?>
                                </h4> "<?= $evento->detalle ?>"

                            </div>
                        </div>

                        <a id="modal-702504" href="#<?= $evento->idEvento ?>" role="button" class="btn"
                           data-toggle="modal">Ver Detalles</a>
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
                                    <h4><?= $evento->fechaInicio ?></h4>
                                    <h4><?= $evento->fechaInicio ?></h4>
                                    <h4><?= $evento->fechaFin ?></h4>
                                </div>
                                <div class="modal-footer">
                                    <?= Html::a('Ver Evento', ['/evento/view', 'id' => $evento->idEvento], ['class' => 'btn btn-success']) ?>
                                    <button type="button" class="btn btn-default" data-dismiss="modal">
                                        Close
                                    </button>

                                </div>
                            </div>

                        </div>

                    </div>
                <?php } ?>

            </div>
        </div>

        <!--        //////////////////////////////////////////////////////////////////-->


        <div class="col-md-3">
            <div class="list-group">
                <h3><p class="bg-primary">

                        Categorias!
                    </p></h3>
                <div class="list-group">
                    <?php foreach ($categorias as $categoria) { ?>
                        <div class="list-group-item">
                            <a class="btn"
                               href="/evento/viewcatego?id=<?= $categoria->idCategoria ?>"><?= $categoria->nombre ?></a>
                        </div>
                    <?php } ?>

                </div>
            </div>

            <p>
                <a class="btn" href="#">#################</a>
            </p>
        </div>
    </div>
</div>

<!--<script src="js/jquery.min.js"></script>-->
<!--<script src="js/bootstrap.min.js"></script>-->
<!--<script src="js/scripts.js"></script>-->
</body>
</html>

