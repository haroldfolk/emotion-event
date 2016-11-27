<?php
use yii\httpclient\Client;

/* @var $this yii\web\View */

$this->title = 'My Yii Application';
?>
<div class="site-index">

    <div class="body-content">
        <?php
        $im = file_get_contents('filename.jpg');
        $imdata = base64_encode($im);

        //        echo $imdata;
        //        echo "<img src='data:image/jpg;base64,".$imdata."' />";
        $data = '{
            "requests":[
    {
        "image":{
        "content":"' . $imdata . '"
      },
      "features":[
        {
            "type":"TEXT_DETECTION",
          "maxResults":1
        }
      ]
    }
  ]
}';


        //prueba de api vision de google

//        $client = new Client();
//        $response = $client->createRequest()
//            ->setMethod('post')
//            ->addHeaders(['content-type' => 'application/json'])
//            ->setUrl('https://vision.googleapis.com/v1/images:annotate?key=AIzaSyDSTRujOfmCPu0B3iZF-0wFFpLhVfDYBOk')
//            ->setContent($data)
//            ->send();
//        if ($response->isOk) {
////           $decode=json_decode($response->content,true);
//           echo $response->getData()->toString();
//        }
//        ?>




    </div>
</div>
