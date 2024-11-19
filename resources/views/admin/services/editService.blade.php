@extends('layouts.adminLayout')
@section('heading', 'Company Services')
@section('subheading', 'Edit existing service')
@section('title', 'Edit Service')
@section('content')

    @php
        $coverPhoto = null;
        $otherPhotos = [];

        // Separate cover photo from other photos
        foreach ($service->photos as $photo) {
            if ($photo->is_cover) {
                $coverPhoto = $photo;
            } else {
                $otherPhotos[] = $photo;
            }
        }
    @endphp
    <form action="{{ route('service.update', ['service' => $service]) }}" method="POST" enctype="multipart/form-data"
        class="px-4 pt-3 pb-4 mt-2">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label for="title" class="block text-gray-700 text-sm font-bold mb-2">
                Service Title
                <span style="color: #ff4800;">*</span>
            </label>
            <input type="text" name="title" id="title" value="{{ $service->title }}" required autocomplete="off"
                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
        </div>

        <div class="mb-4">
            <label for="description" class="block text-gray-700 text-sm font-bold mb-2">Service Description
                <span style="color: rgb(255, 72, 0);">*</span>
            </label>
            <span style="color: rgb(143, 135, 132);font-size:13px;">
                Include min. 260 characters to make it easier for readers to understand
            </span>
            </label>
            <div id="editor-container"></div>
            <input type="hidden" name="description">

            <div class="mb-4">
                <label for="coverPhoto" class="block text-gray-700 text-sm font-bold mb-2">Cover Photo
                    <span style="color: #ff4800;">*</span>
                </label>

                <div id="preview">
                    @if (!$coverPhoto)
                    @else
                        <img src="{{ asset('storage') . '/' . $coverPhoto->photo_path }}" alt="" height="200px"
                            width="200px">
                    @endif
                </div>
                <label for="upload"
                    class="cursor-pointer w-fit my-4 bg-sky-500 hover:bg-sky-600 text-white py-2 px-4 rounded-md shadow-md inline-block">
                    Choose File
                </label>
                @error('coverPhoto')
                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                @enderror
                <input type="file" name="coverPhoto" accept="image/*" id="upload" class="hidden">
            </div>

            {{-- <div class="mb-4">
                <label for="otherPhotos" class="block text-gray-700 text-sm font-bold mb-2">Additional Photos</label>
                <div id="previews" style="display:flex; flex-direction:row; flex-wrap:wrap;">
                    @foreach ($otherPhotos as $photo)
                        <img src="{{ asset('storage/' . $photo->photo_path) }}" alt="" height="200px" width="200px"
                            style="padding:10px">
                    @endforeach
                </div>
                <label for="uploads"
                    class="cursor-pointer w-fit my-4 bg-sky-500 hover:bg-sky-600 text-white py-2 px-4 rounded-md shadow-md inline-block">
                    Choose Files
                </label>
                <input type="file" name="otherPhotos[]" accept="image/*" id="uploads" multiple class="hidden">
            </div> --}}
            <div class="mb-4">
                <label for="otherPhotos" class="block text-gray-700 text-sm font-bold mb-2">Additional Photos</label>
                <div id="previews" style="display:flex; flex-direction:row; flex-wrap:wrap;">
                    @foreach ($otherPhotos as $photo)
                        <div class="image-container" style="position: relative; margin: 10px;">
                            <span class="remove-btn" style="position: absolute; top: 5px; right: 5px; background-color: rgba(0, 0, 0, 0.5); color: white; cursor: pointer; padding: 2px 5px; border-radius: 50%;">&times;</span>
                            <img src="{{ asset('storage/' . $photo->photo_path) }}" alt="" height="200px" width="200px">
                        </div>
                    @endforeach
                </div>
                <label for="uploads" class="cursor-pointer w-fit my-4 bg-sky-500 hover:bg-sky-600 text-white py-2 px-4 rounded-md shadow-md inline-block">
                    Choose Files
                </label>
                <input type="file" name="otherPhotos[]" accept="image/*" id="uploads" multiple class="hidden">
            </div>
            
            <script>
                document.querySelectorAll('.remove-btn').forEach(btn => {
                    btn.addEventListener('click', function() {
                        const container = this.parentElement;
                        container.remove(); // Remove the image container
                    });
                });
            
                document.getElementById('uploads').addEventListener('change', function(event) {
                    const files = event.target.files;
                    const previewsContainer = document.getElementById('previews');
            
                    for (let i = 0; i < files.length; i++) {
                        const file = files[i];
                        const reader = new FileReader();
            
                        reader.onload = function(e) {
                            const imgContainer = document.createElement('div');
                            imgContainer.style.position = 'relative';
                            imgContainer.style.margin = '10px';
            
                            const removeBtn = document.createElement('span');
                            removeBtn.innerHTML = '&times;';
                            Object.assign(removeBtn.style, {
                                position: 'absolute',
                                top: '5px',
                                right: '5px',
                                backgroundColor: 'rgba(0, 0, 0, 0.5)',
                                color: 'white',
                                cursor: 'pointer',
                                padding: '2px 5px',
                                borderRadius: '50%',
                            });
            
                            const img = document.createElement('img');
                            img.src = e.target.result;
                            Object.assign(img.style, {
                                maxWidth: '200px',
                                maxHeight: '200px',
                            });
            
                            imgContainer.appendChild(removeBtn);
                            imgContainer.appendChild(img);
                            previewsContainer.appendChild(imgContainer);
            
                            removeBtn.addEventListener('click', function() {
                                imgContainer.remove(); // Remove the image container
                            });
                        }
            
                        reader.readAsDataURL(file);
                    }
                });
            </script>
            

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
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var quill = new Quill('#editor-container', {
                theme: 'snow'
            });
            // Load existing content into Quill
            quill.root.innerHTML = {!! json_encode($service->description) !!};

            // Submit form handler
            document.querySelector('form').onsubmit = function() {
                var about = document.querySelector('input[name=description]');
                about.value = quill.root.innerHTML;
            };
        });

        ClassicEditor
            .create(document.querySelector('#description'))
            .catch(error => {
                console.error(error);
            });
    </script>
@endsection
