<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <h1>Careers</h1>

@section('button')
<!-- Modal toggle -->
<div class="flex h-20 items-center justify-between">
    <div class="relative inline-block text-left ml-5">
        <select onchange="window.location.href = this.value"
            class="block px-4 py-2 text-sm text-gray-700 bg-white border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-indigo-100 focus:border-indigo-300">
            <option value="{{ route('careers.index') }}" @if(!$type) selected @endif>All</option>
            <option value="{{ route('careers.filterByType', ['type' => 'full-time']) }}" @if($type === 'full-time') selected @endif>Full-Time</option>
            <option value="{{ route('careers.filterByType', ['type' => 'part-time']) }}" @if($type === 'part-time') selected @endif>Part-Time</option>
            <option value="{{ route('careers.filterByType', ['type' => 'contract']) }}" @if($type === 'contract') selected @endif>Contract</option>
            <option value="{{ route('careers.filterByType', ['type' => 'internship']) }}" @if($type === 'internship') selected @endif>Internship</option>
            <option value="{{ route('careers.filterByType', ['type' => 'remote']) }}" @if($type === 'remote') selected @endif>Remote</option>
        </select>
    </div>
    <div class="px-3">
        <a href="{{ route('careers.create') }}">
            <button data-modal-target="crud-modal" data-modal-toggle="crud-modal"
                class="px-10 py-2 mr-6 text-white bg-sky-500 rounded-md" type="button">
                + New Career
            </button>
        </a>
    </div>
</div>
@endsection


@section('content')
<div class="relative overflow-x-auto shadow-md sm:rounded-lg" style="min-height: 452px;">
    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="px-6 py-3">
                    S.N
                </th>
                <th scope="col" class="px-6 py-3">
                    Title
                </th>
                <th scope="col" class="px-6 py-3">
                    Description
                </th>
                <th scope="col" class="px-6 py-3">
                    Type
                </th>
                <th scope="col" class="px-6 py-3">
                    Category
                </th>
                <th scope="col" class="px-6 py-3">
                    Published At
                </th>
                <th scope="col" class="px-6 py-3">
                    Expiration Date
                </th>
                <th scope="col" class="px-6 py-3">
                    Edit
                </th>
                <th scope="col" class="px-6 py-3">
                    Delete
                </th>
            </tr>
        </thead>
        <tbody>
            @forelse ($careers as $career)
            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                <td class="px-6 py-4">{{ $loop->iteration }}</td>
                <td class="px-6 py-4">{{ $career->title }}</td>
                <td class="px-6 py-4">{{ $career->description }}</td>
                <td class="px-6 py-4">{{ $career->type }}</td>
                <td class="px-6 py-4">{{ $career->category }}</td>
                <td class="px-6 py-4">{{ $career->published_at->format('M-d-y') }}</td>
                <td class="px-6 py-4">{{ $career->expiration_date->format('M-d-y') }}</td>
                <td class="px-6 py-4">
                    <a href="{{ route('careers.edit', $career->id) }}" class="btn btn-sm btn-primary">
                        <object type="image/svg+xml" data="{{ asset('logos/edit.svg') }}"></object>
                    </a>
                </td>
                <td>
                    <form action="{{ route('careers.destroy', $career->id) }}" method="POST"
                        style="" class="flex h-full w-full justify-center items-center">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger"
                            onclick="return confirm('Are you sure you want to delete this career?')">
                            <object type="image/svg+xml" data="{{ asset('logos/bin.svg') }}"></object>
                        </button>
                    </form>
                </td>
            </tr>
            @empty
            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                <td colspan="10" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">No
                    careers to show</td>
            </tr>
            @endforelse
        </tbody>
    </table>
    <div class="my-4">
        <div>{{ $careers->links() }}</div>
    </div>
</div>
@endsection
