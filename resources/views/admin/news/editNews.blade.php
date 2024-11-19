@extends('layouts.adminLayout')
@section('heading', 'News and Updates')
@section('subheading', 'Edit existing news')
@section('title', 'Edit News and Updates')
@section('content')
    {{-- @if ($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
            <strong class="font-bold">Whoops!</strong>
            <span class="block sm:inline">There were some problems with your input.</span>
            <ul class="mt-3 list-disc list-inside text-sm text-red-600">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif --}}
    @php
        $coverPhoto = null;
        $otherPhotos = [];

        // Separate cover photo from other photos
        foreach ($news->photos as $photo) {
            if ($photo->is_cover) {
                $coverPhoto = $photo;
            } else {
                $otherPhotos[] = $photo;
            }
        }
    @endphp
    <form action="{{ route('news.update', ['news' => $news]) }}" method="POST" enctype="multipart/form-data"
        class="flex flex-col px-4 pt-3 pb-4 mt-2 gap-y-3">
        @csrf
        @method('PUT')

        <div class="flex flex-col">
            <label for="title" class="block text-gray-700 text-sm font-bold mb-2">
                Headline
                <span style="color: rgb(255, 72, 0);">*</span>
            </label>
            <input type="text" name="title" id="title" value="{{ $news->title }}" required autocomplete="off"
                class="border rounded-md py-2 px-3 text-gray-700 mt-1 mb-1 focus:outline-none focus:ring focus:ring-blue-400">
        </div>
        <div class="flex flex-row gap-x-10">
            <div class="flex flex-col">
                <label for="type" class="block text-gray-700 text-sm font-bold mb-2">Type</label>
                <select name="type" id="type"
                    class="border rounded-md py-2 px-3 text-gray-700 mt-1 mb-1 focus:outline-none focus:ring focus:ring-blue-400 capitalize">
                    <option value="{{ $news->type }}" selected>{{ $news->type }}</option>
                </select>
            </div>
            <div class="flex flex-col">
                <label for="author" class="block text-gray-700 text-sm font-bold mb-2">
                    News Author
                    <span style="color: rgb(255, 72, 0);">*</span>
                </label>
                <input type="text" name="author" id="author" placeholder="Enter news author"
                    value="{{ $news->author }}" required autocomplete="off"
                    class="border rounded-md py-2 px-3 text-gray-700 mt-1 mb-1 focus:outline-none focus:ring focus:ring-blue-400">
            </div>
        </div>
        <div class="flex flex-col">
            <label for="description" class="block text-gray-700 text-sm font-bold mb-2">
                News Description
                <span style="color: rgb(255, 72, 0);">*</span>
            </label>
            <span style="color: rgb(143, 135, 132);font-size:13px;">
                Include min. 260 characters to make it easier for readers to understand
            </span>
            <textarea name="description" id="description" cols="30" rows="10" required autocomplete="off"
                class="border rounded-md py-2 px-3 text-gray-700 mt-1 mb-1 focus:outline-none focus:ring focus:ring-blue-400">{{ $news->description }}</textarea>
        </div>





        <div class="flex flex-col">
            <label for="coverPhoto" id="coverPhoto" class="block text-gray-700 text-sm font-bold mb-2">Cover Photo</label>
            <div id="preview">
                <img src="{{ asset('storage/' . $coverPhoto->photo_path) }}" alt="" height="200px"
                    width="200px">
            </div>
            
            <label for="upload" id="chooseFile"
                class="cursor-pointer w-fit my-4 bg-sky-500 hover:bg-sky-600 text-white py-2 px-4 rounded-md shadow-md inline-block">
                Choose File
            </label>
            <input type="file" name="coverPhoto" accept="image/*" id="upload" class="hidden">
            @if ($news->type === 'career')
            <p id="oldFilename">{{ substr($coverPhoto->photo_path, 5) }}</p>
            @endif
        </div>

        <div class="flex flex-col" id="additionalPhotosSection">
            <label for="otherPhotos" class="block text-gray-700 text-sm font-bold mb-2">Additional Photos</label>
            <div id="previews" style="display: flex; flex-direction:row; flex-wrap:wrap;">


                @forelse ($otherPhotos as $photo)
                    <div class="relative h-10">
                        <img src="{{ asset('storage/' . $photo->photo_path) }}" alt="" height="200px" width="200px"
                            style="padding:10px;">
                        <button class="remove-btn absolute top-0 right-0 bg-red-500 text-black px-2 py-1"
                            data-photo-id="{{ $photo->id }}" onclick="removePhoto(this,'abc')">
                            X
                        </button>
                    </div>

                @empty
                @endforelse
            </div>
            <label for="uploads"
                class="cursor-pointer w-fit my-4 bg-sky-500 hover:bg-sky-600 text-white py-2 px-4 rounded-md shadow-md inline-block">
                Choose File
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
        document.addEventListener('DOMContentLoaded', function() {
            const typeSelect = document.getElementById('type');
            const fileLabel = document.getElementById('coverPhoto');
            const additionalPhotosSection = document.getElementById('additionalPhotosSection');
            const uploadInput = document.getElementById('upload');
            const previewSection = document.getElementById('preview');
            const chooseFile = document.getElementById('chooseFile');
            const input = document.getElementById('upload');

            function updateFileLabelAndInput() {
                if (typeSelect.value === 'career') {
                    fileLabel.textContent = 'Upload PDF *';
                    additionalPhotosSection.style.display = 'none';
                    uploadInput.setAttribute('accept', 'application/pdf');
                    chooseFile.style.display = "none";
                    input.style.display = "block";
                    // Remove the preview section if it exists
                    if (previewSection) {
                        previewSection.remove();
                    }
                } else {
                    fileLabel.textContent = 'Cover Photo *';
                    fileLabel.style.color = 'inherit'; // Reset text color
                    additionalPhotosSection.style.display = 'flex';
                    uploadInput.setAttribute('accept', 'image/*');
                }
            }

            // Initial call to update elements based on initial select value
            updateFileLabelAndInput();

            // Add event listener for select change
            typeSelect.addEventListener('change', function() {
                updateFileLabelAndInput();
            });
        });
        document.getElementById('upload').addEventListener('change', function(event) {
            const oldFilename = document.getElementById("oldFilename");
            oldFilename.style.display = "none";
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
