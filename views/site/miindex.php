<?php
use voime\GoogleMaps\Map;

echo Map::widget([
    'apiKey' => 'AIzaSyC32nFjHqKDyKf7haV9OFNeHqUXPj0i7po',
    'zoom' => 16,
    'center' => 'Red Square',
    'width' => '700px',
    'height' => '400px',
    'mapType' => Map::MAP_TYPE_SATELLITE,
]);
