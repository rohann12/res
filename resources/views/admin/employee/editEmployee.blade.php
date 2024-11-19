@extends('layouts.adminLayout')
@section('heading', 'Employees')
@section('subheading', 'Edit existing employee')
@section('title', 'Edit Employees')
@section('content')
<form method="POST" action="{{ route('employees.update', ['id' => $employee->id]) }}" enctype="multipart/form-data"
    class="flex flex-col px-4 pt-3 pb-4 mt-2 gap-y-3">
    @csrf
    @method('PUT')
    <div class="flex flex-col">
        <label for="photo_url" class="block text-gray-700 text-sm font-bold mb-2">
            Employee profile picture
            <span style="color: #ff4800;">*</span>
        </label>
        <span style="color: #8f8784;font-size:13px;">
            Image format .jpg .jpeg .png and minimum size 300 x 300px
        </span>
        <div class="flex flex-col items-center">
            @if ($employee->photo_url)
            <div id="preview">
                <img src="{{ asset('images/employees/' . $employee->photo_url) }}" alt="Employee Photo"
                    style="max-width: 200px;">
            </div>
            @else
            <img src="{{ asset('images/default.png') }}" class="card-img-top" alt="Default Photo">
            @endif
            <label for="upload"
                class="cursor-pointer w-fit my-4 bg-sky-500 hover:bg-sky-600 text-white py-2 px-4 rounded-md shadow-md inline-block">
                Choose File
            </label>
            <input id="upload" type="file" class="hidden" name="photo_url"><br>
        </div>
    </div>
    <div class="flex flex-row gap-x-3">
        <div class="flex flex-col w-1/2">
            <label for="name" class="block text-gray-700 text-sm font-bold mb-2">Name
                <span style="color: rgb(255, 72, 0);">*</span>
            </label>
            <input id="name" type="text"
                class="border rounded-md py-2 px-3 text-gray-700 mt-1 focus:outline-none focus:ring focus:ring-blue-400"
                name="name" value="{{ $employee->name }}">
        </div>

        <div class="flex flex-col w-1/2">
            <label for="position" class="block text-gray-700 text-sm font-bold mb-2">Position
                <span style="color: rgb(255, 72, 0);">*</span>
            </label>
            <input id="position" type="text"
                class="border rounded-md py-2 px-3 text-gray-700 mt-1 focus:outline-none focus:ring focus:ring-blue-400"
                name="position" value="{{ $employee->position }}">
        </div>
    </div>
    <div class="flex flex-col">
        <label for="description" class="block text-gray-700 text-sm font-bold mb-2">Description
            <span style="color: rgb(255, 72, 0);">*</span>
        </label>
        <span style="color: rgb(143, 135, 132);font-size:13px;">
            Include min. 260 characters to make it easier for readers to understand
        </span>
        <textarea id="description"
            class="border rounded-md py-2 px-3 text-gray-700 mt-1 focus:outline-none focus:ring focus:ring-blue-400"
            name="description">{{ $employee->description }}</textarea>
    </div>

    <div class="flex flex-row gap-x-4">
        <div class="flex flex-col w-1/3">
            <label for="email" class="block text-gray-700 text-sm font-bold mb-2">Email
                <span style="color: rgb(255, 72, 0);">*</span>
            </label>
            <input id="email" type="text"
                class="border rounded-md py-2 px-3 text-gray-700 mt-1 focus:outline-none focus:ring focus:ring-blue-400"
                name="email" value="{{ $employee->email }}">
        </div>

        <div class="flex flex-col w-1/3">
            <label for="phone" class="block text-gray-700 text-sm font-bold mb-2">Phone Number
                <span style="color: rgb(255, 72, 0);">*</span>
            </label>
            <input id="phone" type="text"
                class="border rounded-md py-2 px-3 text-gray-700 mt-1 focus:outline-none focus:ring focus:ring-blue-400"
                name="phone" value="{{ $employee->phone }}">
        </div>

    </div>
    <div class="flex flex-row gap-x-4">
        <div class="flex flex-col w-2/3">
            <label for="address" class="block text-gray-700 text-sm font-bold mb-2">Address
                <span style="color: #ff4800;">*</span>
            </label>
            <input id="address" type="text" 
                class="w-2/3 shadow appearance-none border rounded py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('address') border-red-500 @enderror"
                name="address" value="{{ $employee->address }}">


        </div>
        <div class="flex flex-col">
            <label for="joined_date" class="block text-gray-700 text-sm font-bold mb-2">Joined Date
                <span style="color: #ff4800;">*</span>
            </label>
            <input id="joined_date" type="date"
                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('joined_date') border-red-500 @enderror"
                name="joined_date" value="{{$employee->joined_date }}">
        </div>
    </div>
    <div class="flex flex-row gap-x-4">
        <div class="flex flex-col w-1/3">
            <label for="linkedin_link" class="block text-gray-700 text-sm font-bold mb-2">LinkedIn Link:</label>
            <input id="linkedin_link" type="text"
                class="border rounded-md py-2 px-3 text-gray-700 mt-1 focus:outline-none focus:ring focus:ring-blue-400"
                name="linkedin_link" value="{{ $employee->linkedin_link }}">
        </div>

        <div class="flex flex-col w-1/3">
            <label for="fb_link" class="block text-gray-700 text-sm font-bold mb-2">Facebook Link</label>
            <input id="fb_link" type="text"
                class="border rounded-md py-2 px-3 text-gray-700 mt-1 focus:outline-none focus:ring focus:ring-blue-400"
                name="fb_link" value="{{ $employee->fb_link }}">
        </div>

        <div class="flex flex-col w-1/3">
            <label for="insta_link" class="block text-gray-700 text-sm font-bold mb-2">Instagram Link</label>
            <input id="insta_link" type="text"
                class="border rounded-md py-2 px-3 text-gray-700 mt-1 focus:outline-none focus:ring focus:ring-blue-400"
                name="insta_link" value="{{ $employee->insta_link }}">
        </div>

        <div class="flex flex-col w-1/3">
            <label for="order" class="block text-gray-700 text-sm font-bold mb-2">Display Order
                <span style="color: #ff4800;">*</span>
            </label>
            <input id="order" type="number" min="1" step="1" required
                class="border rounded-md py-2 px-3 text-gray-700 mt-1 focus:outline-none focus:ring focus:ring-blue-400"
                name="order" value="{{ $employee->order }}">
        </div>

    </div>
    <div class="flex flex-col">
        <label for="active" class="block text-gray-700 text-sm font-bold mb-2">
            <input type="checkbox" id="active" name="active" value="active" {{ $employee->is_active === 1 ? 'checked' :
            '' }}>
            Employee active status
        </label>
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
