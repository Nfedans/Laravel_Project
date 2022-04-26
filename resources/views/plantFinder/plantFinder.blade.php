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
    <label class="w-100 flex flex-col items-center px-2 py-3 bg-white-rounded-lg shadow-lg tracking-wide uppercase border border-blue cursor-pointer">
        
		
		
		
		{{-- <span class="mt-2 text-base leading-normal">
            Select a file
        </span>
        <input 
            type="file"
            name="image"
            class="hidden"
            >             --}}


			<form action="/identify" method="post" enctype="multipart/form-data">
				Select image to upload:
				<input type="file" name="fileToUpload" id="fileToUpload">
				<input type="submit" value="Upload Image" name="submit">
				@csrf
			</form>
			  
    </label>









    
    <div class="w-4/5 m-auto text-left">
        <div class="py-15">
            
            
        </div>
    </div>
</div>

@endsection


