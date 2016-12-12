<?php
use sjaakp\gcharts\PieChart;

?>
    ...
<?= PieChart::widget([
    'height' => '400px',
    'dataProvider' => $dataProvider,
    'columns' => [
        'nombre:string',
        'AVG( valor )'
    ],
    'options' => [
        'title' => 'Eventos by Emociones'

    ],
]) ?>