<?php
use sjaakp\gcharts\PieChart;

?>
    ...
<?= PieChart::widget([
    'height' => '400px',
    'dataProvider' => $dataProvider,
    'columns' => [
        'idEmocion:number',
        'anger'
    ],
    'options' => [
        'title' => 'Eventos by Emociones'
    ],
]) ?>