<?php
use sjaakp\gcharts\PieChart;
use sjaakp\gcharts\BarChart;
use sjaakp\gcharts\ScatterChart;
use sjaakp\gcharts\LineChart;

?>
<a class="btn btn-primary btn-lg" href="/evento/report" role="button">Exportar a PDF</a>

<a class="btn btn-danger" href="/evento/pie?id=<?= $idEvento ?>" role="button">Graficos de Torta</a>
<a class="btn btn-danger" href="/evento/pie?id=<?= $idEvento ?>&tipo=1" role="button">Graficos de Barras</a>

<a class="btn btn-primary" href="/evento/pie?id=<?= $idEvento ?>&tipo=3" role="button">Graficos de linea</a>
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

