


<?php

if(isset($_FILES['fileToUpload'])){
	$target_file = $_FILES['fileToUpload']['tmp_name'];
}

function encodeImages($images){
	$encoded_images = array();
	foreach($images as $image){
		$encoded_images[] = base64_encode(file_get_contents($image));
	}
	return $encoded_images;
}
function identifyPlants($file_names){
	$encoded_images = encodeImages($file_names);
	$api_key = "fJqOnwaI5QFVRZnHYOl8WDNNLiEKTYmLIg6OFXlRdbxq5JMvPG";
	$params = array(
		"api_key" => $api_key,
		"images" => $encoded_images,
		// modifiers docs: https://github.com/flowerchecker/Plant-id-API/wiki/Modifiers
		"modifiers" => ["crops_fast", "similar_images", "health_all", "disease_similar_images"],
		"plant_language" => "en",
		// plant details docs: https://github.com/flowerchecker/Plant-id-API/wiki/Plant-details
		"plant_details" => array("common_names",
							"url",
							"name_authority",
							"wiki_description",
							"taxonomy",
							"synonyms"),
		// disease details docs: https://github.com/flowerchecker/Plant-id-API/wiki/Disease-details
        "disease_details" => array("common_names", "url", "description"),
		);
	$params = json_encode($params);
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, "https://api.plant.id/v2/identify");
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_POST, true);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $params);
	curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type:application/json"));
	$result = curl_exec($ch);
	curl_close($ch);
	return $result;
}
// print_r(identifyPlants(['C:\xampp\htdocs\Laravel_Project\public\images\62487aaeafc46-Sample Blog.jpg']));
$returnedData = identifyPlants([$target_file]);
// echo $returnedData;
$data2 = json_decode($returnedData, true);

// echo count($data2['suggestions'][0]);


if(sizeof($data2['suggestions']) !== 0){
foreach( $data2['suggestions'] as $suggestion)
{
    print "<h1>" . $suggestion['plant_name'] . "</h1>";
    print "<h1>Common Name: " . $suggestion['plant_details']['common_names'][0] . "</h1>";
    print "<img src = " . $suggestion['similar_images'][0]['url'] . " />";
            
            
    //     </div>
    // </div>";
}
}
?>