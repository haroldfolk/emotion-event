<script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?sensor=false"></script><input type="text"
                                                                                                         id="address"
                                                                                                         size="30"><br>
<input type="text" id="lat" size="10"><input type="text" id="lng" size="10">
<div id="map_canvas"></div>
<?php $this->registerJsFile('/js/js.js', ['depends' => [\yii\web\JqueryAsset::className()]]); ?>
