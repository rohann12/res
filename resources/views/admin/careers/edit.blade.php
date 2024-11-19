@extends('layouts.adminLayout')
@section('heading', 'Career Details')
@section('subheading', 'Edit existing career')
@section('title', 'Edit Career')
@section('content')
    <form action="{{ route('careers.update', $career->id) }}" method="POST" class="px-4 mt-2">
        @csrf
        @method('PUT')
        <div class="flex flex-col">
            <label for="title" class="block text-gray-700 text-sm font-bold mb-2">Title</label>
            <input type="text"
                class="border rounded-md py-2 px-3 text-gray-700 mt-1 mb-1 focus:outline-none focus:ring focus:ring-blue-400"
                id="title" name="title" value="{{ $career->title }}" required>
        </div>
        <div class="flex flex-col">
            <label for="description" class="block text-gray-700 text-sm font-bold mb-2">Description</label>
            <textarea class="border rounded-md py-2 px-3 text-gray-700 mt-1 mb-1 focus:outline-none focus:ring focus:ring-blue-400"
                id="description" name="description" rows="3" required>{{ $career->description }}</textarea>
        </div>
        <div class="flex flex-col">
            <label for="type" class="block text-gray-700 text-sm font-bold mb-2">Type</label>
            <select
                class="border rounded-md py-2 px-3 text-gray-700 mt-1 mb-1 focus:outline-none focus:ring focus:ring-blue-400"
                id="type" name="type" required>
                <option value="full-time" {{ $career->type === 'full-time' ? 'selected' : '' }}>Full-time</option>
                <option value="part-time" {{ $career->type === 'part-time' ? 'selected' : '' }}>Part-time</option>
                <option value="contract" {{ $career->type === 'contract' ? 'selected' : '' }}>Contract</option>
                <option value="internship" {{ $career->type === 'internship' ? 'selected' : '' }}>Internship</option>
                <option value="remote" {{ $career->type === 'remote' ? 'selected' : '' }}>Remote</option>
            </select>
        </div>
        <div class="flex flex-col">
            <label for="category" class="block text-gray-700 text-sm font-bold mb-2">Category</label>
            <input type="text"
                class="border rounded-md py-2 px-3 text-gray-700 mt-1 mb-1 focus:outline-none focus:ring focus:ring-blue-400"
                id="category" name="category" value="{{ $career->category }}">
        </div>
        <div class="flex flex-col">
            <label for="requirements" class="block text-gray-700 text-sm font-bold mb-2">Requirements</label>
            <textarea class="border rounded-md py-2 px-3 text-gray-700 mt-1 mb-1 focus:outline-none focus:ring focus:ring-blue-400"
                id="requirements" name="requirements" rows="3">{{ $career->requirements }}</textarea>
        </div>
        <div class="flex flex-col">
            <label for="responsibilities" class="block text-gray-700 text-sm font-bold mb-2">Responsibilities</label>
            <textarea class="border rounded-md py-2 px-3 text-gray-700 mt-1 mb-1 focus:outline-none focus:ring focus:ring-blue-400"
                id="responsibilities" name="responsibilities" rows="3">{{ $career->responsibilities }}</textarea>
        </div>
        <div class="flex flex-col">
            <label for="expiration_date" class="block text-gray-700 text-sm font-bold mb-2">Expiration Date</label>
            <input type="date"
                class="border rounded-md py-2 px-3 text-gray-700 mt-1 mb-1 focus:outline-none focus:ring focus:ring-blue-400"
                id="expiration_date" name="expiration_date" value="{{ $career->expiration_date->format('Y-m-d') }}">
        </div>
        <div class="flex flex-row gap-x-3">
            <button onclick="window.history.back()"
                class="w-1/2 border border-grey-400 text-black py-2 px-4 rounded-md hover:border-gray-700 cursor-pointer">
                Cancel
            </button>
    
            <input type="submit" value="Save"
                class="w-1/2 bg-sky-500 text-white py-2 px-4 rounded-md hover:bg-sky-600 cursor-pointer">
    
        </div>   </form>


@endsection
