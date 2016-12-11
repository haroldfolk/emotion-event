<?php
use sjaakp\gcharts\PieChart;

?>
    ...
<?= PieChart::widget([
    'height' => '400px',
    'dataProvider' => $dataProvider,
    'columns' => [
        'idEmocion:string',
        'anger',
        'contempt',
        'disgust'
    ],
    'options' => [
        'title' => 'Eventos by Emociones'
    ],
]) ?>