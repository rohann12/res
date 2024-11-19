@extends('layouts.adminLayout')
@section('heading', 'News and Updates')
@section('subheading', 'Create new news')
@section('title', 'Create News and Updates')
@section('content')

    <form action="{{ route('news.store') }}" method="post" enctype="multipart/form-data"
        class="flex flex-col px-4 pt-3 pb-4 mt-2 gap-y-3">
        @csrf
        @method('post')
        <div class="flex flex-col">
            <label for="title" class="block text-gray-700 text-sm font-bold mb-1">
                Headline
                <span style="color: #ff4800;">*</span>
            </label>
            <input type="text" name="title" id="title" placeholder="Enter news title" autocomplete="off"
                value="{{ old('title') }}"
                class="border rounded-md py-2 px-3 text-gray-700 mt-1 mb-1 focus:outline-none 
            focus:ring focus:ring-blue-400 @error('title') border-red-500 @enderror">
            @error('title')
                <p class="text-red-500 text-xs italic">{{ $message }}</p>
            @enderror
        </div>
        <div class="flex flex-row gap-x-10">
            <div class="flex flex-col">
                <label for="type" class="block text-gray-700 text-sm font-bold mb-1">Category</label>
                <select name="type" id="type"
                    class="border rounded-md py-2 px-3 text-gray-700 mt-1 mb-1 focus:outline-none focus:ring focus:ring-blue-400"
                    onchange="toggleFileLabel()">
                    <option value="news">News</option>
                    <option value="article">Article</option>
                    <option value="blog">Blog</option>
                    <option value="career">Careers</option>
                </select>
            </div>

            <div class="flex flex-col">
                <label for="author" class="block text-gray-700 text-sm font-bold mb-1">
                    News Author
                    <span style="color: #ff4800;">*</span>
                </label>
                <input type="text" name="author" id="author" placeholder="Enter news author" autocomplete="off"
                    value="{{ old('author') }}"
                    class="border rounded-md py-2 px-3 text-gray-700 mt-1 mb-1 focus:outline-none focus:ring 
                focus:ring-blue-400 @error('author') border-red-500 @enderror">
                @error('author')
                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                @enderror
            </div>
        </div>
        <div class="flex flex-col">
            <label for="description" class="block text-gray-700 text-sm font-bold mb-1">
                Description
                <span style="color: #ff4800;">*</span>
            </label>
            <span style="color: rgb(143, 135, 132);font-size:13px;">
                Include min. 260 characters to make it easier for readers to understand
            </span>
            <textarea name="description" id="description" cols="40" rows="10" placeholder="Enter news description"
                autocomplete="off"
                class="border rounded-md py-2 px-3 
            text-gray-700 mt-1 mb-1 focus:outline-none focus:ring focus:ring-blue-400
            @error('description') border-red-500 @enderror">{{ old('description') }}</textarea>
            @error('description')
                <p class="text-red-500 text-xs italic">{{ $message }}</p>
            @enderror
        </div>



        <div class="flex flex-col">
            <label for="file" id="fileLabel" class="block text-gray-700 text-sm font-bold mb-1">Cover Photo
                <span style="color: #ff4800;">*</span>
            </label>
            <div id="preview"></div>
            <label for="upload" id="chooseFile"
                class="cursor-pointer w-fit my-4 bg-sky-500 hover:bg-sky-600 text-white py-2 px-4 rounded-md
             shadow-md inline-block @error('coverPhoto') border-red-500 @enderror">
                Choose File
            </label>
            @error('coverPhoto')
                <p class="text-red-500 text-xs italic">{{ $message }}</p>
            @enderror
            <input type="file" name="coverPhoto" accept="image/*" id="upload" class="hidden">
        </div>

        <div class="flex flex-col" id="additionalPhotosSection">
            <label for="otherPhotos" class="block text-gray-700 text-sm font-bold mb-1">Additional Photos</label>
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
        
        function toggleFileLabel() {
            const typeSelect = document.getElementById('type');
            const fileLabel = document.getElementById('fileLabel');
            const additionalPhotosSection = document.getElementById('additionalPhotosSection');
            const uploadInput = document.getElementById('upload');
            const previewSection = document.getElementById('preview');
            const chooseFile = document.getElementById('chooseFile');
            const input = document.getElementById('upload');

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

        // Call toggleFileLabel initially to set the initial display state
        toggleFileLabel();

        document.getElementById('type').addEventListener('change', toggleFileLabel);

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
