@extends('layouts.app')

@section('content')
@if (session()->has('message'))
    <div class="w-4/5 m-auto mt-10 pl-2">
        <p class="w-2/6 mb-4 text-gray-50 bg-green-500 rounded-2xl py-4">
            {{ session()->get('message') }}
        </p>
    </div>
@endif
<div class="bg-grey-lighter pt-15">
    <label class="w-44 flex flex-col items-center px-2 py-3 bg-white-rounded-lg shadow-lg tracking-wide uppercase border border-blue cursor-pointer">
        <span class="mt-2 text-base leading-normal">
            Select a file
        </span>
        <input 
            type="file"
            name="image"
            class="hidden"
            >            
    </label>
<?php
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
$returnedData = identifyPlants(['C:\xampp\htdocs\Laravel_Project\public\images\6256040c81a1c-Lobelias.jpg']);
// echo $returnedData;
$data2 = json_decode($returnedData, true);


foreach( $data2['suggestions'] as $suggestion)
{
    print "<h1>" . $suggestion['plant_name'] . "</h1>";
    print "<h1>Common Name: " . $suggestion['plant_details']['common_names'][0] . "</h1>";
    print "<img src = " . $suggestion['similar_images'][0]['url'] . " />";
            // <h1 class="text-6xl">
            //     {{ $data2['suggestions'][1]['plant_name']; }}
            // </h1>
            // <h1 class="text-6xl">
            //     {{ $data2['suggestions'][2]['plant_name']; }}
            // </h1>
            
    //     </div>
    // </div>";
}
?>
    
    <div class="w-4/5 m-auto text-left">
        <div class="py-15">
            
            
        </div>
    </div>
</div>

@endsection


