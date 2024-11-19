@extends('layouts.adminLayout')
@section('heading', 'Employees')
@section('subheading', 'Create new employee')
@section('title', 'Create Employees')
@section('content')
@if (session('success'))
<div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-4" role="alert">
    {{ session('success') }}
</div>
@endif

<form method="POST" action="{{ route('employees.store') }}" enctype="multipart/form-data"
    class="flex flex-col px-4 pt-3 pb-4 mt-2 gap-y-3">
    @csrf

    <div class="flex flex-col">
        <label for="photo_url" class="block text-gray-700 text-sm font-bold mb-2">
            Employee profile picture
            <span style="color: #ff4800;">*</span>
        </label>
        <span style="color: #8f8784;font-size:13px;">
            Image format .jpg .jpeg .png and minimum size 300 x 300px
        </span>
        <div class="flex flex-col items-center">
            <div id="preview"></div>
            <label for="upload"
                class="cursor-pointer w-fit my-4 bg-sky-500 hover:bg-sky-600 text-white py-2 px-4 rounded-md shadow-md inline-block">
                Choose File
            </label>
            <input id="upload" type="file" class="hidden @error('photo_url') border-red-500 @enderror" name="photo_url">
            @error('photo_url')
            <p class="text-red-500 text-xs italic">{{ $message }}</p>
            @enderror
        </div>
    </div>

    <div class="flex flex-row  gap-x-3">
        <div class="w-1/2">
            <label for="name" class="block text-gray-700 text-sm font-bold mb-2">
                Employee full name
                <span style="color: #ff4800;">*</span>
            </label>
            <input id="name" type="text"
                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('name') border-red-500 @enderror"
                name="name" value="{{ old('name') }}">
            @error('name')
            <p class="text-red-500 text-xs italic">{{ $message }}</p>
            @enderror
        </div>
        <div class="w-1/2">
            <label for="position" class="block text-gray-700 text-sm font-bold mb-2">
                Position
                <span style="color: #ff4800;">*</span>
            </label>
            <input id="position" type="text"
                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('position') border-red-500 @enderror"
                name="position" value="{{ old('position') }}">
            @error('position')
            <p class="text-red-500 text-xs italic">{{ $message }}</p>
            @enderror
        </div>
    </div>
    <div class="flex flex-col mb-4">
        <label for="description" class="block text-gray-700 text-sm font-bold mb-2">
            Description
            <span style="color: #ff4800;">*</span>
        </label>
        <span style="color: #8f8784;font-size:13px;">
            Include min. 260 characters to make it easier for readers to understand
        </span>
        <textarea id="description"
            class="border rounded-md py-2 px-3 text-gray-700 mt-1 focus:outline-none focus:ring focus:ring-blue-400 @error('description') border-red-500 @enderror"
            name="description" value="{{ old('description') }}"></textarea>
    </div>
    <div class="flex flex-row  gap-x-3">
        <div class="w-1/2">
            <label for="email" class="block text-gray-700 text-sm font-bold mb-2">
                Email
                <span style="color: #ff4800;">*</span>
            </label>
            <input id="email" type="text"
                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('email') border-red-500 @enderror"
                name="email" value="{{ old('email') }}">
            @error('email')
            <p class="text-red-500 text-xs italic">{{ $message }}</p>
            @enderror
        </div>
        <div class="w-1/2">
            <label for="phone" class="block text-gray-700 text-sm font-bold mb-2">
                Phone Number
                <span style="color: #ff4800;">*</span>
            </label>
            <input id="phone" type="text" value="{{old('phone')}}"
                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('phone') border-red-500 @enderror"
                name="phone">
            @error('phone')
            <p class="text-red-500 text-xs italic">{{ $message }}</p>
            @enderror
        </div>

    </div>
    <div class="flex flex-row gap-x-4">
        <div class="w-2/3">
            <label for="address" class="block text-gray-700 text-sm font-bold mb-2">Address
                <span style="color: #ff4800;">*</span>
            </label>
            <input id="address" type="text" value="{{old('address')}}"
                class="w-full py-2 px-3 shadow appearance-none border rounded  text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('address') border-red-500 @enderror"
                name="address">
            @error('address')
            <p class="text-red-500 text-xs italic">{{ $message }}</p>
            @enderror
        </div>
        <div class="mb-0">
            <label for="joined_date" class="block text-gray-700 text-sm font-bold mb-2">Joined Date
                <span style="color: #ff4800;">*</span>
            </label>
            <input id="joined_date" type="date" value="{{old('joined_date')}}"
                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('joined_date') border-red-500 @enderror"
                name="joined_date">
            @error('joined_date')
            <p class="text-red-500 text-xs italic">{{ $message }}</p>
            @enderror
        </div>
    </div>

    <div class="flex flex-row gap-x-4">

        <div class="mb-0">
            <label for="linkedin_link" class="block text-gray-700 text-sm font-bold mb-2">LinkedIn Link</label>
            <input id="linkedin_link" type="text" value="{{old('linkedin_link')}}"
                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('linkedin_link') border-red-500 @enderror"
                name="linkedin_link">
            @error('linkedin_link')
            <p class="text-red-500 text-xs italic">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-0">
            <label for="fb_link" class="block text-gray-700 text-sm font-bold mb-2">Facebook Link</label>
            <input id="fb_link" type="text" value="{{old('fb_link')}}"
                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('fb_link') border-red-500 @enderror"
                name="fb_link">
            @error('fb_link')
            <p class="text-red-500 text-xs italic">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-0">
            <label for="insta_link" class="block text-gray-700 text-sm font-bold mb-2">Instagram Link</label>
            <input id="insta_link" type="text" value="{{old('insta_link')}}"
                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('insta_link') border-red-500 @enderror"
                name="insta_link">
            @error('insta_link')
            <p class="text-red-500 text-xs italic">{{ $message }}</p>
            @enderror
        </div>
        <div class="mb-0">
            <label for="order" class="block text-gray-700 text-sm font-bold mb-2">Display Order
                <span style="color: #ff4800;">*</span>
            </label>
            <input id="order" type="number" min="1" step="1" value="{{old('order')}}" required
                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('insta_link') border-red-500 @enderror"
                name="order">
            @error('order')
            <p class="text-red-500 text-xs italic">{{ $message }}</p>
            @enderror
        </div>
    </div>
    <div class="mb-0">
        <label for="active" class="block text-gray-700 text-sm font-bold">
            <input type="checkbox" id="active" name="active" value="active">
            Employee active status
        </label><br>
    </div>

    <div class="flex flex-row gap-x-3">
        <a href="javascript:void(0)" onclick="goBack()"
        class="w-1/2 border border-grey-400 text-black py-2 px-4 rounded-md hover:border-gray-700 cursor-pointer text-center inline-block">
        Cancel
    </a>

        <input type="submit" value="Save"
            class="w-1/2 bg-sky-500 text-white py-2 px-4 rounded-md hover:bg-sky-600 cursor-pointer">

    </div>
</form>

<script>
    
    document.getElementById('upload').addEventListener('change', function(event) {
            const file = event.target.files[0]; // Get the selected file
            const reader = new FileReader(); // Create a FileReader object

            reader.onload = function(e) {
                const preview = document.getElementById('preview');
                preview.innerHTML = ''; // Clear previous previews
                const img = document.createElement('img');
                img.src = e.target.result; // Set the source of the image to the result of FileReader
                // Apply styles to the image element
                Object.assign(img.style, {
                    maxWidth: '200px',
                    maxHeight: '200px',
                    display: 'block',
                });
                // Apply styles to the preview container
                Object.assign(preview.style, {
                    marginTop: '20px',
                    padding: '10px',
                });
                preview.appendChild(img); // Append the image to the preview div
            }

            reader.readAsDataURL(file); // Read the selected file as a Data URL
        });
        
        ClassicEditor
                     .create(document.querySelector('#description'))
                     .catch(error => {
                         console.error(error);
                     });
     
</script>

@endsection