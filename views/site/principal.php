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
                    <a class="navbar-brand" href="#">What's going on SC?</a>
                </div>

                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <ul class="nav navbar-nav">
                        <li class="active">
                            <a href="#">Link</a>
                        </li>
                        <li>
                            <a href="#">Link</a>
                        </li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">Dropdown<strong
                                    class="caret"></strong></a>
                            <ul class="dropdown-menu">
                                <li>
                                    <a href="#">Action</a>
                                </li>
                                <li>
                                    <a href="#">Another action</a>
                                </li>
                                <li>
                                    <a href="#">Something else here</a>
                                </li>
                                <li class="divider">
                                </li>
                                <li>
                                    <a href="#">Separated link</a>
                                </li>
                                <li class="divider">
                                </li>
                                <li>
                                    <a href="#">One more separated link</a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                    <form class="navbar-form navbar-left" role="search">
                        <div class="form-group">
                            <input type="text" class="form-control">
                        </div>
                        <button type="submit" class="btn btn-default">
                            Submit
                        </button>
                    </form>
                    <ul class="nav navbar-nav navbar-right">
                        <li>
                            <a href="#">Link</a>
                        </li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">Dropdown<strong
                                    class="caret"></strong></a>
                            <ul class="dropdown-menu">
                                <li>
                                    <a href="#">Action</a>
                                </li>
                                <li>
                                    <a href="#">Another action</a>
                                </li>
                                <li>
                                    <a href="#">Something else here</a>
                                </li>
                                <li class="divider">
                                </li>
                                <li>
                                    <a href="#">Separated link</a>
                                </li>
                            </ul>
                        </li>
                    </ul>
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
                             src="https://s3-us-west-2.amazonaws.com/fotowebhd/3perfilChilindrina.png3"
                             style="width:500px;height:250px">
                        <div class="carousel-caption">
                            <h4>
                                MI EVENTO CHILINDRINA
                            </h4>
                            <p>
                                Mi portada la chilindrina
                            </p>
                        </div>
                    </div>
                    <div class="item">
                        <img alt="Carousel Bootstrap Second"
                             src="https://s3-us-west-2.amazonaws.com/fotowebhd/familia-1.jpg"
                             style="width:500px;height:250px">
                        <div class="carousel-caption">
                            <h4>
                                MI EVENTO Familia FELIZ
                            </h4>
                            <p>
                                Mi portada la Familia
                            </p>
                        </div>
                    </div>
                    <div class="item">
                        <img alt="Carousel Bootstrap Third"
                             src="https://s3-us-west-2.amazonaws.com/fotowebhd/2perfilChavo.jpg2"
                             style="width:500px;height:250px">
                        <div class="carousel-caption">
                            <h4>
                                MI EVENTO CHAVO
                            </h4>
                            <p>
                                Mi portada del chavo
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

            <h3><p class="bg-info">

                    Eventos suscritos
                </p></h3>
            <div class="list-group">
                <?php foreach ($eventos as $evento) { ?>
                    <!--                    <a href="#" class="list-group-item">Home</a>-->
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

                                    <button type="button" class="btn btn-default" data-dismiss="modal">
                                        Close
                                    </button>
                                    <button type="button" class="btn btn-primary">
                                        Save changes
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
                    <!--                    <a href="#" class="list-group-item">Home</a>-->
                    <div class="list-group-item">
                        <div class="media">
                            <a href="#" class="pull-left"><img alt="Bootstrap Media Preview"
                                                               src="http://lorempixel.com/200/200/"
                                                               class="media-object"></a>
                            <div class="media-body">
                                <h4 class="media-heading">
                                    <?= $evento->nombre ?>
                                </h4> La presentacion se realizara el 12 de diciembre de 2016 a las 15:15 con el
                                Ing.Martinez

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
                                    <h4><?= $evento->fechaInicio ?></h4>
                                    <h4><?= $evento->fechaFin ?></h4>
                                </div>
                                <div class="modal-footer">

                                    <button type="button" class="btn btn-default" data-dismiss="modal">
                                        Close
                                    </button>
                                    <button type="button" class="btn btn-primary">
                                        Save changes
                                    </button>
                                </div>
                            </div>

                        </div>

                    </div>
                <?php } ?>

            </div>
        </div>

        <!--        //////////////////////////////////////////////////////////////////-->
        <div class="col-md-6">
            <h2>
                <p class="bg-success" align="center">

                    NOTICIAS
                </p>
            </h2>


            <div class="media">
                <a href="#" class="pull-left"><img alt="Bootstrap Media Preview" src="http://lorempixel.com/200/200/"
                                                   class="media-object"></a>
                <div class="media-body">
                    <h4 class="media-heading">
                        Evento Presentacion de Software!
                    </h4> La presentacion se realizara el 12 de diciembre de 2016 a las 15:15 con el Ing.Martinez

                </div>
            </div>
            <p>
                <a class="btn-block" href="#">Subscribirme »</a>
            </p>
        </div>


        <div class="col-md-3">
            <div class="list-group">
                <h3><p class="bg-primary">

                        Categorias!
                    </p></h3>
                <div class="list-group">
                    <?php foreach ($categorias as $categoria) { ?>
                        <div class="list-group-item">
                            <a class="btn" href="#"><?= $categoria->nombre ?></a>
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

