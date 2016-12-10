<?php
echo $form->field($model, 'coordinatesAttribute')->widget(\msvdev\widgets\mappicker\MapInput::className(), ['apiKey' => 'google_api_key']);