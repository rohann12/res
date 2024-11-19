@extends('layouts.adminLayout')
@section('heading', 'Company Services')
@section('subheading', 'Create new service')
@section('title', 'Create Service')
@section('content')
<form action="{{ route('service.store') }}" method="post" enctype="multipart/form-data"
 class="flex flex-col px-4 pt-3 pb-4 mt-2 gap-y-3">
    @csrf
    @method('post')
    <div class="mb-4">
        <label for="title" class="block text-gray-700 text-sm font-bold mb-2">
            Service Title
            <span style="color: #ff4800;">*</span>
        </label>
        <input type="text" name="title" id="title" placeholder="Enter service title" autocomplete="off"
            value="{{old('title')}}" class="shadow appearance-none border rounded w-full py-2 px-3 
            text-gray-700 leading-tight focus:outline-none focus:shadow-outline 
            @error('title') border-red-500 @enderror">
        @error('title')
        <p class="text-red-500 text-xs italic">{{ $message }}</p>
        @enderror
    </div>

    <div class="mb-4">
        <label for="description" class="block text-gray-700 text-sm font-bold mb-2">
            Service Description
            <span style="color: #ff4800;">*</span>
        </label>
        <span style="color: rgb(143, 135, 132);font-size:13px;">
            Include min. 260 characters to make it easier for readers to understand
        </span></label>
        <textarea name="description" id="description" cols="40" rows="10" placeholder="Enter service description"
            autocomplete="off" class="shadow appearance-none border rounded w-full py-2 px-3
                 text-gray-700 leading-tight focus:outline-none focus:shadow-outline
                 @error('description') border-red-500 @enderror
                 " value="{{ old('description') }}"></textarea>
        @error('description')
        <p class="text-red-500 text-xs italic">{{ $message }}</p>
        @enderror
    </div>

    <div class="mb-4">
        <label for="coverPhoto" class="block text-gray-700 text-sm font-bold mb-2">Cover Photo
            <span style="color: #ff4800;">*</span>
        </label>
        <div id="preview"></div>
        <label for="upload"
            class="cursor-pointer w-fit my-4 bg-sky-500 hover:bg-sky-600 text-white py-2 px-4 rounded-md shadow-md inline-block">
            Choose File
        </label>
        @error('coverPhoto')
        <p class="text-red-500 text-xs italic">{{ $message }}</p>
        @enderror
        <input type="file" name="coverPhoto" accept="image/*" id="upload" class="hidden">
    </div>

    <div class="mb-4">
        <label for="otherPhotos" class="block text-gray-700 text-sm font-bold mb-2">Additional Photos</label>
        <div id="previews"></div>
        <label for="uploads"
            class="cursor-pointer w-fit my-4 bg-sky-500 hover:bg-sky-600 text-white py-2 px-4 rounded-md shadow-md inline-block">
            Choose Files
        </label>
        <input type="file" name="otherPhotos[]" accept="image/*" id="uploads" multiple class="hidden">
    </div>

    <div class="flex flex-row gap-x-3">
        <button onclick="window.history.back()"
            class="w-1/2 border border-grey-400 text-black py-2 px-4 rounded-md hover:border-gray-700 cursor-pointer">
            Cancel
        </button>

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
        document.getElementById('uploads').addEventListener('change', function(event) {
            const files = event.target.files; // Get the selected files
            const previewsContainer = document.getElementById('previews');
            previewsContainer.innerHTML = ''; // Clear previous previews

            // Apply flexbox styling to the previews container
            Object.assign(previewsContainer.style, {
                display: 'flex',
                flexWrap: 'wrap',
                justifyContent: 'flex-start',
                alignItems: 'flex-start',
            });

            for (let i = 0; i < files.length; i++) {
                const file = files[i];
                const reader = new FileReader(); // Create a FileReader object

                reader.onload = function(e) {
                    const img = document.createElement('img');
                    img.src = e.target.result; // Set the source of the image to the result of FileReader
                    // Apply styles to the image element
                    Object.assign(img.style, {
                        maxWidth: '200px',
                        maxHeight: '200px',
                        margin: '0 10px 10px 0', // Add margin between images
                    });

                    // Append the image to the main previews container
                    previewsContainer.appendChild(img);
                }

                reader.readAsDataURL(file); // Read the selected file as a Data URL
            }
        });
        
        ClassicEditor
                     .create(document.querySelector('#description'))
                     .catch(error => {
                         console.error(error);
                     });
     
</script>

@endsection