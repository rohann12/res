@extends('layouts.adminLayout')
@section('heading', 'Projects')
@section('subheading', 'Edit existing project')
@section('title', 'Edit Project')

@section('content')

@php
$coverPhoto = null;
$otherPhotos = [];

// Separate cover photo from other photos
foreach ($project->photos as $photo) {
if ($photo->is_cover) {
$coverPhoto = $photo;
} else {
$otherPhotos[] = $photo;
}
}
@endphp
<form action="{{ route('project.update', ['project' => $project]) }}" method="POST" enctype="multipart/form-data"
    class="flex flex-col px-4 pt-3 pb-4 mt-2 gap-y-3">
    @csrf
    @method('PUT')
    <div class="flex flex-col">
        <label for="name" class="block text-gray-700 text-sm font-bold mb-2">
            Project Title
            <span style="color: rgb(255, 72, 0);">*</span>
        </label>
        <input type="text" name="name" id="name" placeholder="Enter project name" value="{{ $project->name }}" required
            autocomplete="off"
            class="border rounded-md py-2 px-3 text-gray-700 mt-1 mb-1 focus:outline-none focus:ring focus:ring-blue-400">
    </div>
    <div class="flex flex-col flex-wrap">
        <div>
            <span class="block text-gray-700 text-sm font-bold mb-2">Status</span>
        </div>
        <div class="flex-row">
            <input type="radio" name="status" value="upcoming" {{ $project->status === 'upcoming' ? 'checked' : '' }}
            class="mx-1">
            <label for="upcoming" class="mx-1">Upcoming</label>
            <input type="radio" name="status" value="running" {{ $project->status === 'running' ? 'checked' : '' }}
            class="mx-1">
            <label for="running" class="mx-1">Running</label>
            <input type="radio" name="status" value="completed" {{ $project->status === 'completed' ? 'checked' : '' }}
            class="mx-1">
            <label for="completed" class="mx-1">Completed</label>
        </div>
    </div>

    <div class="flex flex-col">
        <label for="description" class="block text-gray-700 text-sm font-bold mb-2">
            Project Description
            <span style="color: rgb(255, 72, 0);">*</span>
        </label>
        <span style="color: rgb(143, 135, 132);font-size:13px;">
            Include min. 260 characters to make it easier for readers to understand
        </span>
        <textarea name="description" id="description" cols="30" rows="10" placeholder="Enter project description"
            required autocomplete="off"
            class="border rounded-md py-2 px-3 text-gray-700 mt-1 mb-1 focus:outline-none focus:ring focus:ring-blue-400">{{ $project->description }}</textarea>
    </div>



    <div class="flex flex-col">
        <label for="coverPhoto" class="block text-gray-700 text-sm font-bold mb-2">Cover Photo</label>
        <div id="preview"><img src="{{ asset('storage/' . $coverPhoto->photo_path) }}" alt="" height="200px"
                width="200px">
        </div>
        <label for="upload"
            class="cursor-pointer w-fit my-4 bg-sky-500 hover:bg-sky-600 text-white  py-2 px-4 rounded-md shadow-md inline-block">
            Choose File
        </label>
        <input type="file" name="coverPhoto" accept="image/*" id="upload" class="hidden">
    </div>

    <div class="flex flex-col">
        <label for="otherPhotos" class="block text-gray-700 text-sm font-bold mb-2">Additional Photos</label>
        <div id="previews" style="display:flex; flex-direction:row; flex-wrap:wrap;">
            @foreach ($otherPhotos as $photo)
            <img src="{{ asset('storage/' . $photo->photo_path) }}" alt="" height="200px" width="200px"
                style="padding:10px;">
            @endforeach
        </div>
        <label for="uploads"
            class="cursor-pointer w-fit my-4 bg-sky-500 hover:bg-sky-600 text-white  py-2 px-4 rounded-md shadow-md inline-block">
            Choose File
        </label>
        <input type="file" name="otherPhotos[]" accept="image/*" id="uploads" class="hidden" multiple>
    </div>

    <div class="flex flex-col">
        <label for="featured" class="block text-gray-700 text-sm font-bold mb-2">
            <input type="checkbox" id="featured" name="featured" value="featured" {{ $project->featured === 1 ?
            'checked' : '' }}>
            Add project to featured projects
        </label>
    </div>

    <div class="flex flex-col">
        <label for="carousel" class="block text-gray-700 text-sm font-bold mb-2">
            <input type="checkbox" id="carousel" name="carousel" value="carousel" {{ $project->on_carousel === 1 ?
            'checked' : '' }} onclick="carousel()">
            Add project to carousel
        </label>
    </div>

    <div class="flex flex-col">
        <label for="short_description" id="short_description_label" class="text-gray-700 text-sm font-bold mb-2"
            hidden>Short description for carousel</label>
        <textarea name="short_description" id="short_description" cols="40" rows="5" hidden
            class="border rounded-md py-2 px-3 text-gray-700 mt-1 mb-1 focus:outline-none focus:ring focus:ring-blue-400">{{ $project->short_description }}</textarea>
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
    var label = document.getElementById("short_description_label");
        var textarea = document.getElementById("short_description");
        if (document.getElementById("carousel").checked) {
            label.removeAttribute("hidden");
            textarea.removeAttribute("hidden");
            textarea.setAttribute("required", "required");
        }
        document.getElementById("carousel").addEventListener("change", function() {

            if (this.checked) {
                label.removeAttribute("hidden");
                textarea.removeAttribute("hidden");
                textarea.setAttribute("required", "required");
            } else {
                label.setAttribute("hidden", true);
                textarea.setAttribute("hidden", true);
                textarea.removeAttribute("required");
            }
        });

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
    ClassicEditor
                 .create(document.querySelector('#description'))
                 .catch(error => {
                     console.error(error);
                 });
 </script>
@endsection
