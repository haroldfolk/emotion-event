<?php
use voime\GoogleMaps\Map;

echo Map::widget([
    'apiKey' => 'VIza7yBgBzYEbKx09V566DhM8Ylc3NjWsJ0ps-2',
    'zoom' => 16,
    'center' => 'Red Square',
    'width' => '700px',
    'height' => '400px',
    'mapType' => Map::MAP_TYPE_SATELLITE,
]);
