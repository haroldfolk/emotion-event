<?php
// [START text_detection]
use Google\Cloud\Vision\VisionClient;
 $apiKey = 'AIzaSyDSTRujOfmCPu0B3iZF-0wFFpLhVfDYBOk';
 $path = 'image.jpg';

$vision = new VisionClient([
    'keyFilePath' => 'myOCRKey.json',
    'projectId'=>'myOCR-149908'
]);

$image = $vision->image(file_get_contents($path), ['TEXT_DETECTION']);
$result = $vision->annotate($image);
if (!isset($result->info()['textAnnotations'])) {
    return;
}
foreach ($result->info()['textAnnotations'] as $annotation) {
    print("TEXT\n");
    if (isset($annotation['locale'])) {
        print("  locale: $annotation[locale]\n");
    }
    print("  description: $annotation[description]\n");
    if (isset($annotation['boundingPoly'])) {
        print("  BOUNDING POLY\n");
        foreach ($annotation['boundingPoly']['vertices'] as $vertex) {
            print("    x:$vertex[x]\ty:$vertex[y]\n");
        }
    }
}