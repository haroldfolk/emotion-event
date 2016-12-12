<?php
use sjaakp\gcharts\PieChart;

?>
    ...
<?= PieChart::widget([
    'height' => '400px',
    'dataProvider' => $dataProvider,
    'columns' => [
        'nombre:string',
        'promedio'
    ],
    'options' => [
        'title' => 'Eventos by Emociones'

    ],
]) ?>