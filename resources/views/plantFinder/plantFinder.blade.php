@extends('layouts.app')

@section('content')
@if (session()->has('message'))
    <div class="w-4/5 m-auto mt-10 pl-2">
        <p class="w-2/6 mb-4 text-gray-50 bg-green-500 rounded-2xl py-4">
            {{ session()->get('message') }}
        </p>
    </div>
@endif








    
    <div class="w-4/5 m-auto text-center">
        <div class="py-15">
            
	
			<form action="/identify" method="post" enctype="multipart/form-data">
				Select image to upload:
				<br>
				<br>
				<br>
				<input type="file" name="fileToUpload" id="fileToUpload">
				<br>
				<br>
				<br>
				<input class="bg-gray-600 text-gray-100 font-bold py-2 px-4 rounded" type="submit" value="Upload Image" name="submit">
				@csrf
			</form>
        </div>
    </div>

@endsection


