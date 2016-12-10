<?php
use voime\GoogleMaps\Map;

echo Map::widget([
    'apiKey' => 'VIza7yBgBzYEbKx09V566DhM8Ylc3NjWsJ0ps-2',
    'zoom' => 3,
    'center' => [20, 40.555],
    'width' => '700px',
    'height' => '400px',
    'mapType' => Map::MAP_TYPE_HYBRID,
]);
