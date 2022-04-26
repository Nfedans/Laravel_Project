
@extends('layouts.app')

@section('content')
@if (session()->has('message'))
    <div class="w-4/5 m-auto mt-10 pl-2">
        <p class="w-2/6 mb-4 text-gray-50 bg-green-500 rounded-2xl py-4">
            {{ session()->get('message') }}
        </p>
    </div>
@endif

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
	$api_key = "zLJpBPEtygPeJVTiW7ZbVa3neMSKtP9J9S2dPTS7v37y4Un0Vo";
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
$returnedData = identifyPlants([$target_file]);

$data2 = json_decode($returnedData, true);
?>
@if(sizeof($data2['suggestions']) !== 0)
@endif
<div class="flex flex-col items-center justify-center p-10">`
	

	<h1>Results Found...</h1>
	<br>
@foreach( $data2['suggestions'] as $suggestion)
<div class="w-2/5 flex flex-col items-center text-center justify-center text-4xl border-4 border-indigo-200 border-b-indigo-500 p-10">
	
	
	
	@if($suggestion['similar_images'][0])
      <img src ={{$suggestion['similar_images'][0]['url']}} />
	   
    @endif

	@if( $suggestion['plant_name'] != null)
	
		<h1>{{$suggestion['plant_name']}}</h1>
	
    @endif
	
	@if( $suggestion['plant_details']['common_names'] != null)
	
	  <h1>Common Name: {{$suggestion['plant_details']['common_names'][0]}}</h1>
	
    @endif

	
	
</div>
<br>
@endforeach
</div>





@endsection
