@extends('layouts.adminLayout')
@section('heading', 'User Profile')
@section('title', 'Edit Profile')
@section('content')

@if (session('success'))
<div class="alert alert-success">
    {{ session('success') }}
</div>
@endif
<div class="flex flex-col  px-4 py-2 bg-white shadow-md rounded-md">
    <div class="mb-2">Full Name: <span class="font-semibold">{{ Auth::user()->full_name }}</span></div>
    <div class="mb-2">User Name: <span class="font-semibold">{{ Auth::user()->user_name }}</span></div>
    <div class="mb-2">Email: <span class="font-semibold">{{ Auth::user()->email }}</span></div>
</div>
<br>
<div class="px-4 py-2 bg-white shadow-md rounded-md">
    <div class="mb-2 font-bold">Add/Change Profile Photo</div>
    <form action="{{ route('user.update', ['user' => Auth::user()]) }}" method="POST" enctype="multipart/form-data"
        class="flex flex-col">
        @csrf
        @method('PUT')
        <div id="preview">
            @if (!Auth::user()->photo_path)
            <span>No photo available</span>
            @else
            <img src="{{ asset('storage') . '/' . Auth::user()->photo_path }}" alt="Couldn't preview photo"
                height="200px" width="200px">
            @endif

        </div>
        <label for="upload"
            class="cursor-pointer w-fit my-4 bg-sky-500 hover:bg-sky-600 text-white py-2 px-4 rounded-md shadow-md inline-block">
            Choose File
        </label>
        <input type="file" name="photo" id="upload" accept="image/*" class="mb-4 hidden">
        <button type="submit" class="px-4 py-2 bg-sky-500 text-white rounded hover:bg-sky-600">Upload Profile
            Photo</button>
    </form>
</div>

<div class="max-w-md px-4 py-2 mt-4 bg-white shadow-md rounded-md">
    <form action="{{ route('changePassword', ['user' => Auth::user()]) }}" method="POST" class="flex flex-col">
        @csrf
        @method('PUT')
        <div class="mb-4">
            <label for="current_password" class="block">Current Password</label>
            <input type="password" id="current_password" name="current_password"
                class="mt-1 block w-full rounded-md border-gray-300">
        </div>
        <div class="mb-4">
            <label for="new_password" class="block">New Password</label>
            <input type="password" id="new_password" name="new_password"
                class="mt-1 block w-full rounded-md border-gray-300">
        </div>
        <div class="mb-4">
            <label for="confirm_new_password" class="block">Confirm New Password</label>
            <input type="password" id="confirm_new_password" name="confirm_new_password"
                class="mt-1 block w-full rounded-md border-gray-300">
        </div>
        <button type="submit" class="px-4 py-2 bg-sky-500 text-white rounded hover:bg-sky-600">Change
            Password</button>
    </form>
</div>

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