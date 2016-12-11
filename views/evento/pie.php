<?php
use sjaakp\gcharts\PieChart;

?>
    ...
<?= PieChart::widget([
    'height' => '400px',
    'dataProvider' => $dataProvider,
    'columns' => [
        'name:string',
        'anger'
    ],
    'options' => [
        'title' => 'Eventos by Emociones'
    ],
]) ?>