<?php
//use yii\httpclient\Client;
//
///* @var $this yii\web\View */
//
//$this->title = 'My Yii Application';
//?>
<!--<div class="site-index">-->
<!---->
<!--    <div class="body-content">-->
<!--        --><?php
//        $im = file_get_contents('filename.jpg');
//        $imdata = base64_encode($im);
//
//        //        echo $imdata;
//        //        echo "<img src='data:image/jpg;base64,".$imdata."' />";
//        $data = '{
//            "requests":[
//    {
//        "image":{
//        "content":"' . $imdata . '"
//      },
//      "features":[
//        {
//            "type":"TEXT_DETECTION",
//          "maxResults":1
//        }
//      ]
//    }
//  ]
//}';
//
//
//        //prueba de api vision de google
//
////        $client = new Client();
////        $response = $client->createRequest()
////            ->setMethod('post')
////            ->addHeaders(['content-type' => 'application/json'])
////            ->setUrl('https://vision.googleapis.com/v1/images:annotate?key=AIzaSyDSTRujOfmCPu0B3iZF-0wFFpLhVfDYBOk')
////            ->setContent($data)
////            ->send();
////        if ($response->isOk) {
//////           $decode=json_decode($response->content,true);
////           echo $response->getData()->toString();
////        }
////        ?>
<!---->
<!---->
<!---->
<!---->
<!--    </div>-->
<!--</div>-->
<?php

///* @var $this yii\web\View */

$this->title = 'My Yii Application';
?>
<div class="site-index">

    <div class="jumbotron">
        <h1>What's going on SC?</h1>

        <p class="lead">Bienvenido a What's going on SC?</p>

        <p><a href="/site/login"><img src="https://s3-us-west-2.amazonaws.com/fotowebhd/miportadaproyfinal.png"
                                      alt=""></a></p>
    </div>
    <div class="jumbotron">
        <h1>Entrar como organizador</h1>
        <p>...</p>
        <p><a class="btn btn-primary btn-lg" href="/organizador/index" role="button">Ingresar</a></p>
    </div>

</div>

