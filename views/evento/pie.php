<?php
use sjaakp\gcharts\PieChart;

?>
    ...
<?= PieChart::widget([
    'height' => '400px',
    'dataProvider' => $dataProvider,
    'columns' => [
        'anger',
        'contempt',
        'disgust'
    ],
    'options' => [
        'title' => 'Eventos by Emociones'
    ],
]) ?>