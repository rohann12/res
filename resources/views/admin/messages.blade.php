@extends('layouts.adminLayout')
@section('heading', 'Messages')
@section('subheading', 'All messages')
@section('title', 'Messages')



@section('content')
    <div class="relative overflow-x-auto  shadow-md sm:rounded-lg" style="min-height: 452px;">
        <table class="w-full text-sm  text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        S.N
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Name
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Email
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Organization Name
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Message
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Status
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Read/Unread
                    </th>
                </tr>
            </thead>
            <tbody>
                @forelse ($messages as $message)
                    <tr
                        class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            {{ $loop->iteration }}
                        </th>
                        <td class="px-6 py-4">
                            {{ $message->name }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $message->email }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $message->organization_name ?: 'N/A' }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $message->message }}
                        </td>
                        <td class="px-6 py-4 uppercase">
                            {{ $message->status }}
                        </td>
                        <td class="px-6 py-4">
                            <form method="POST" action="{{ route('toggleStatus', $message->id) }}">
                                @csrf
                                @method('PUT')
                                <button type="submit">Toggle</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr
                        class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                        <td scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white"
                            colspan="8">
                            No messages to show
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
        <div>{{ $messages->links() }}</div>
    </div>
@endsection

