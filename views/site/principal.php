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
                             src="https://s3-us-west-2.amazonaws.com/fotowebhd/3perfilChilindrina.png3" width=500
                             height=100>
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
                             src="https://s3-us-west-2.amazonaws.com/fotowebhd/familia-1.jpg" width=500
                             height=100>
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
                             src="https://s3-us-west-2.amazonaws.com/fotowebhd/2perfilChavo.jpg2" width=500
                             height=100>
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
            <!--            <div class="panel panel-default">-->
            <!--                <div class="panel-heading">-->
            <!--                    <h3 class="panel-title">-->
            <!--                        Panel title-->
            <!--                    </h3>-->
            <!--                </div>-->
            <!--                <div class="panel-body">-->
            <!--                    Panel content-->
            <!--                </div>-->
            <!--                <div class="panel-footer">-->
            <!--                    Panel footer-->
            <!--                </div>-->
            <!--            </div>-->

            <h2><p class="bg-info">

                    Eventos a los que asistire!
                </p></h2>
            <div class="list-group">
                <?php foreach ($eventos as $evento) { ?>
                    <!--                    <a href="#" class="list-group-item">Home</a>-->
                <div class="list-group-item">
                    <?= $evento->nombre ?>
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
            <a id="modal-702504" href="#modal-container-702504" role="button" class="btn" data-toggle="modal">Launch
                demo modal</a>

            <div class="modal fade" id="modal-container-702504" role="dialog" aria-labelledby="myModalLabel"
                 aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">

                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                                ×
                            </button>
                            <h4 class="modal-title" id="myModalLabel">
                                Modal title
                            </h4>
                        </div>
                        <div class="modal-body">
                            ...
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

            <div class="media">
                <a href="#" class="pull-left"><img alt="Bootstrap Media Preview" src="http://lorempixel.com/64/64/"
                                                   class="media-object"></a>
                <div class="media-body">
                    <h4 class="media-heading">
                        Nested media heading
                    </h4> Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin
                    commodo. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis.
                    <div class="media">
                        <a href="#" class="pull-left"><img alt="Bootstrap Media Another Preview"
                                                           src="http://lorempixel.com/64/64/" class="media-object"></a>
                        <div class="media-body">
                            <h4 class="media-heading">
                                Nested media heading
                            </h4> Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante
                            sollicitudin commodo. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis.
                        </div>
                    </div>
                </div>
            </div>
            <h2>
                Heading
            </h2>
            <p>
                Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris
                condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna mollis
                euismod. Donec sed odio dui.
            </p>
            <p>
                <a class="btn" href="#">View details »</a>
            </p>
        </div>
        <div class="col-md-3">
            <div class="list-group">
                <h2><p class="bg-primary" align="right">

                        Categorias!
                    </p></h2>
                <div class="list-group">
                    <?php foreach ($eventos as $evento) { ?>
                        <div class="list-group-item">
                            <?= $evento->nombre ?>
                        </div>
                    <?php } ?>

                </div>
            </div>
            <h2>
                Heading
            </h2>
            <p>
                Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris
                condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna mollis
                euismod. Donec sed odio dui.
            </p>
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

