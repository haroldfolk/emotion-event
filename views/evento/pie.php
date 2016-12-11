<?php
use sjaakp\gcharts\ColumnChart;

?>
    ...
<?= ColumnChart::widget([
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