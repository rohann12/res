@extends('layouts.adminLayout')
@section('heading', 'Career Details')
@section('subheading', 'Create new career')
@section('title', 'Create Career')
@section('content')

<<<<<<< HEAD
    <form action="{{ route('careers.store') }}" method="POST" class="max-w-md px-4 mt-2">
        @csrf
        <div class="form-group">
            <label for="title">Title</label>
            <input type="text" class="form-control" id="title" name="title" required>
        </div>
        <div class="form-group">
            <label for="description">Description</label>
            <textarea class="form-control" id="description" name="description" rows="3" required></textarea>
        </div>
        <div class="form-group">
            <label for="type">Type</label>
            <select class="form-control" id="type" name="type" required>
                <option value="full-time">Full-time</option>
                <option value="part-time">Part-time</option>
                <option value="contract">Contract</option>
                <option value="internship">Internship</option>
                <option value="remote">Remote</option>
            </select>
        </div>
        <div class="form-group">
            <label for="category">Category</label>
            <input type="text" class="form-control" id="category" name="category">
        </div>
        <div class="form-group">
            <label for="requirements">Requirements</label>
            <textarea class="form-control" id="requirements" name="requirements" rows="3"></textarea>
        </div>
        <div class="form-group">
            <label for="responsibilities">Responsibilities</label>
            <textarea class="form-control" id="responsibilities" name="responsibilities" rows="3"></textarea>
        </div>
        <div class="form-group">
            <label for="expiration_date">Expiration Date</label>
            <input type="date" class="form-control" id="expiration_date" name="expiration_date">
        </div>

        <button type="submit"
            class="w-full bg-blue-500 text-white py-2 px-3 mb-3 rounded-md hover:bg-blue-700 focus:outline-none focus:ring focus:ring-blue-400">Submit</button>
    </form>
</body>
</html>
=======
<form action="{{ route('careers.store') }}" method="POST" class="flex flex-col px-4 pt-3 pb-4 mt-2 gap-y-3">
    @csrf

    <div class="flex flex-col">
        <label for="title" class="block text-gray-700 text-sm font-bold mb-2">
            Title
            <span style="color: #ff4800;">*</span>
        </label>
        <input type="text" name="title" id="title" placeholder="Enter title" autocomplete="off" class="border rounded-md py-2 px-3 mb-1 text-gray-700 leading-tight focus:outline-none focus:ring focus:ring-blue-400
                @error('title') border-red-500 @enderror" value="{{ old('title') }}">
        @error('title')
        <p class="text-red-500 text-xs italic">{{ $message }}</p>
        @enderror
    </div>

    <div class="flex flex-col">
        <label for="description" class="block text-gray-700 text-sm font-bold mb-2">
            Description
            <span style="color: #ff4800;">*</span></label>
        <textarea name="description" id="description" cols="40" rows="3" placeholder="Enter description"
            autocomplete="off"
            class="border rounded-md py-2 mb-1 px-3 text-gray-700 leading-tight focus:outline-none 
            focus:ring focus:ring-blue-400 @error('description') border-red-500 @enderror">
            {{ old('description') }}</textarea>
            @error('description')
            <p class="text-red-500 text-xs italic">{{ $message }}</p>
            @enderror
    </div>

    <div class="flex flex-col">
        <label for="type" class="block text-gray-700 text-sm font-bold mb-2">Type</label>
        <select name="type" id="type"
            class="border rounded-md py-2 px-3 mb-1 text-gray-700 leading-tight focus:outline-none focus:ring focus:ring-blue-400">
            <option value="full-time">Full-time</option>
            <option value="part-time">Part-time</option>
            <option value="contract">Contract</option>
            <option value="internship">Internship</option>
            <option value="remote">Remote</option>
        </select>
    </div>

    <div class="flex flex-col">
        <label for="category" class="block text-gray-700 text-sm font-bold mb-2">
            Category
            <span style="color: #ff4800;">*</span>
        </label>
        <input type="text" name="category" id="category" placeholder="Enter category" value="{{ old('category') }}"
            autocomplete="off"
            class="border rounded-md py-2 px-3 mb-1 text-gray-700 leading-tight focus:outline-none focus:ring
             focus:ring-blue-400 @error('category') border-red-500 @enderror">
             @error('category')
            <p class="text-red-500 text-xs italic">{{ $message }}</p>
            @enderror
    </div>

    <div class="flex flex-col">
        <label for="requirements" class="block text-gray-700 text-sm font-bold mb-2">
            Requirements
            <span style="color: #ff4800;">*</span>
        </label>
        <textarea name="requirements" id="requirements" cols="40" rows="3" placeholder="Enter requirements"
            class="border rounded-md py-2 px-3 mb-1 text-gray-700 leading-tight focus:outline-none 
            focus:ring focus:ring-blue-400 @error('requirements') border-red-500 @enderror">
            {{ old('requirements') }}</textarea>
            @error('requirements')
            <p class="text-red-500 text-xs italic">{{ $message }}</p>
            @enderror
    </div>

    <div class="flex flex-col">
        <label for="responsibilities" class="block text-gray-700 text-sm font-bold mb-2">
            Responsibilities
            <span style="color: #ff4800;">*</span>
        </label>
        <textarea name="responsibilities" id="responsibilities" cols="40" rows="3" placeholder="Enter responsibilities"
            autocomplete="off"
            class="border rounded-md py-2 px-3 mb-1 text-gray-700 leading-tight focus:outline-none 
            focus:ring focus:ring-blue-400 @error('responsibilities') border-red-500 @enderror">
            {{ old('responsibilities') }}</textarea>
            @error('responsibilities')
            <p class="text-red-500 text-xs italic">{{ $message }}</p>
            @enderror
    </div>

    <div class="flex flex-col">
        <label for="expiration_date" class="block text-gray-700 text-sm font-bold mb-2">
            Expiration Date
            <span style="color: #ff4800;">*</span>
        </label>
        <input type="date" name="expiration_date" id="expiration_date" value="{{ old('expiration_date') }}"
            autocomplete="off"
            class="border rounded-md py-2 px-3 mb-1 text-gray-700 leading-tight focus:outline-none 
            focus:ring focus:ring-blue-400 @error('expiration_date') border-red-500 @enderror">
            @error('expiration_date')
            <p class="text-red-500 text-xs italic">{{ $message }}</p>
            @enderror
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
@endsection
