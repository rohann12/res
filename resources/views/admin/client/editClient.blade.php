@extends('layouts.adminLayout')
@section('heading', 'Client and Partners')
@section('subheading', 'Edit existing client')
@section('title', 'Edit Client')
@section('content')

<form action="{{ route('client.update', ['client' => $client]) }}" method="POST" enctype="multipart/form-data"
    class="flex flex-col px-4 pt-3 pb-4 mt-2 gap-y-3">
    @csrf
    @method('PUT')
    <div class="flex flex-col">
        <label for="logo" class="block text-gray-700 text-sm font-bold mb-2">
            Logo
        </label>
        <span style="color: #8f8784;font-size:13px;">
            Image format .jpg .jpeg .png and minimum size 300 x 300px
        </span>
        <div class="flex flex-col items-center">
            <div id="preview">
                <img src="{{ asset('images/clients/' . $client->logo_path) }}" alt="No logo available"
                    height="200px" width="200px"></div>
            <label for="upload"
                class="cursor-pointer w-fit my-4 bg-sky-500 hover:bg-sky-600 text-white py-2 px-4 rounded-md shadow-md inline-block">
                Choose File
            </label>
            <input type="file" name="logo" accept="image/*" id="upload" class="hidden">
        </div>
    </div>

    <div class="mb-4">
        <label for="company_name" class="block text-gray-700 text-sm font-bold mb-2">
            Client Name
            <span style="color: rgb(255, 72, 0);">*</span>
        </label>
        <input type="text" name="company_name" id="company_name" placeholder="Enter client name" required
            autocomplete="off" value="{{ $client->company_name }}"
            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
    </div>

    <div class="mb-4">
        <label for="email" class="block text-gray-700 text-sm font-bold mb-2">
            Client Email
            <span style="color: rgb(255, 72, 0);">*</span>
        </label>
        <input type="email" name="email" id="email" placeholder="Enter client email" required autocomplete="off"
            value="{{ $client->email }}"
            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
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
</script>
@endsection