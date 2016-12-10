<?php
use voime\GoogleMaps\Map;

echo Map::widget([
    'apiKey' => 'AIzaSyCA5DAyiiDSD8IJuQLnIpRDmkgGM-wZLfc',
    'zoom' => 3,
    'center' => [20, 40.555],
    'width' => '700px',
    'height' => '400px',
    'mapType' => Map::MAP_TYPE_ROADMAP,
]);
