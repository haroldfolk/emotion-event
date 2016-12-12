<?php
use sjaakp\gcharts\PieChart;
use sjaakp\gcharts\BarChart;
use sjaakp\gcharts\ScatterChart;
use sjaakp\gcharts\LineChart;
?>
<a class="btn btn-primary btn-lg" href="/evento/reportb" role="button">Exportar a PDF</a>
<a class="btn btn-danger" href="/evento/pie?id=<?= $idEvento ?>&tipo=1" role="button">Graficos de Barras</a>
<a class="btn btn-warning" href="/evento/pie?id=<?= $idEvento ?>&tipo=2" role="button">Graficos de Dispersion</a>
<a class="btn btn-primary" href="/evento/pie?id=<?= $idEvento ?>&tipo=3" role="button">Graficos de linea</a>
<?= PieChart::widget([
    'height' => '400px',
    'dataProvider' => $dataProvider,
    'columns' => [
        'nombre:string',
        'valor'
    ],
    'options' => [
        'title' => 'Eventos by Emociones'

    ],
]) ?>

<?= BarChart::widget([
    'height' => '400px',
    'dataProvider' => $dataProvider,
    'columns' => [
        'nombre:string',
        'valor'
    ],
    'options' => [
        'title' => 'Eventos by Emociones'

    ],
]) ?>

<?= ScatterChart::widget([
    'height' => '400px',
    'dataProvider' => $dataProvider,
    'columns' => [
        'nombre:string',
        'valor'
    ],
    'options' => [
        'title' => 'Eventos by Emociones'

    ],
]) ?>

<?= LineChart::widget([
    'height' => '400px',
    'dataProvider' => $dataProvider,
    'columns' => [
        'nombre:string',
        'valor'
    ],
    'options' => [
        'title' => 'Eventos by Emociones'

    ],
]) ?>
