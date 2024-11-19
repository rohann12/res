@extends('layouts.adminLayout')
@section('heading', 'Employees')
@section('subheading', 'All Employees')
@section('title', 'Employees')

{{-- <div class="container">
    <h1>All Employees</h1>
    <div class="row">
        @foreach ($employees as $employee)
        <div class="">
            <div class="">
                @if ($employee->photo_url)
                <img src="{{ asset('images/employees/' . $employee->photo_url) }}" alt="Employee Photo"
                    style="max-height: 100px; width: auto;">
                @else
                <!-- Default placeholder image -->
                <img src="{{ asset('images/default.png') }}" class="card-img-top" alt="Default Photo" height="100px;">
                @endif
                <div class="card-body">
                    <h2 class="card-title">{{ $employee->name }}</h2>
                    <p class="card-text"><strong>Description:</strong> {{ $employee->description }}</p>
                    <p class="card-text"><strong>Position:</strong> {{ $employee->position }}</p>
                    <p class="card-text"><strong>Email:</strong> {{ $employee->email }}</p>
                    <!-- Add more details as needed -->
                    <!-- For example, you can display phone number, date of birth, etc. -->
                    <a href="{{ route('employees.edit', ['id' => $employee->id]) }}" class="btn btn-primary">Edit</a>
                    <form action="{{ route('employees.destroy', ['id' => $employee->id]) }}" method="POST"
                        class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger"
                            onclick="return confirm('Are you sure you want to delete this employee?')">Delete</button>
                    </form>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div> --}}
@section('button')
<!-- Modal toggle -->
<div class="flex h-20 items-center justify-between">
    <div class="relative inline-block text-left ml-5">
        <select onchange="window.location.href = this.value"
            class="block px-4 py-2 text-sm text-gray-700 bg-white border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-indigo-100 focus:border-indigo-300">
            <option value="{{ route('employees.index') }}" @if(!$status) selected @endif>All</option>
            <option value="{{ route('employees.filterByStatus', ['status' => '1']) }}" @if($status==='1' ) selected
                @endif>Active</option>
            <option value="{{ route('employees.filterByStatus', ['status' => '0']) }}" @if($status==='0' ) selected
                @endif>Inactive</option>
        </select>
    </div>
    <div class="px-3">
        <a href="{{ route('employees.create') }}">
            <button data-modal-target="crud-modal" data-modal-toggle="crud-modal"
                class="px-10 py-2 mr-6 text-white bg-sky-500 rounded-md" type="button">
                + New Employee
            </button>
        </a>
    </div>
</div>
@endsection


@section('content')
<div class="relative overflow-x-auto  shadow-md sm:rounded-lg" style="min-height: 400px;">
    <table class="w-full text-sm  text-left rtl:text-right text-gray-500 ">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 ">
            <tr>
                <th scope="col" class="px-6 py-3">
                    S.N
                </th>
                <th scope="col" class="px-6 py-3">
                    Name
                </th>
                <th scope="col" class="px-6 py-3">
                    Position
                </th>
                <th scope="col" class="px-6 py-3">
                    Email
                </th>
                <th scope="col" class="px-6 py-3">
                    Phone Number
                </th>
                <th scope="col" class="px-6 py-3">
                    Status
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
            @forelse ($employees as $employee)
            <tr class="bg-white border-b   hover:bg-gray-50 ">
                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap ">
                    {{ $loop->iteration }}
                </th>
                <td class="px-6 py-5">
                    {{ $employee->name }}
                </td>
                <td class="px-6 py-5">
                    {{ $employee->position }}
                </td>
                <td class="px-6 py-5">
                    {{ $employee->email }}
                </td>
                <td class="px-6 py-5">
                    {{ $employee->phone }}
                </td>
                <td class="px-6 py-5">
                    @if ($employee->is_active === 1)
                    <span
                        class="bg-blue-100 text-blue-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded-full border border-blue-400">
                        Active</span>
                    @else

                    <span
                        class="bg-red-100 text-red-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded-full  border border-red-400">
                        Inactive</span>
                    @endif
                </td>
                <td class="flex px-6 pt-5">
                    <a href="{{ route('employees.edit', ['id' => $employee->id]) }}"
                        class="h-full pb-3 px-2 font-medium text-2xl mb-2 text-gray-900">
                        {{-- <object type="image/svg+xml" data="{{ asset('logos/edit.svg') }}"></object> --}}
                        <svg width="24" height="26" viewBox="0 0 15 16" fill="none" xmlns="http://www.w3.org/2000/svg"
                        class="stroke-current text-gray-600 hover:text-blue-500">
                            <path
                                d="M13.3148 2.14713C13.1191 1.95231 12.8868 1.79818 12.6312 1.69365C12.3757 1.58912 12.1019 1.53626 11.8258 1.53813C11.5497 1.54 11.2767 1.59656 11.0226 1.70454C10.7684 1.81252 10.5382 1.96978 10.3452 2.16724L2.01666 10.4958L1 14.4619L4.96612 13.4447L13.2947 5.11612C13.4922 4.92321 13.6495 4.69305 13.7575 4.43897C13.8655 4.18488 13.9221 3.91191 13.924 3.63582C13.9258 3.35974 13.873 3.08602 13.7684 2.83049C13.6638 2.57497 13.5097 2.34271 13.3148 2.14713V2.14713Z"
                                stroke="#615E83" class="hover:text-blue-500" stroke-width="1.3" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                    </a>
                </td>
                <td class="px-6 py-1">
                    <form action="{{ route('employees.destroy', ['id' => $employee->id]) }}" method="POST"
                        class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger"
                            onclick="return confirm('Are you sure you want to delete this employee?')">
                            {{-- <object type="image/svg+xml" data="{{ asset('logos/bin.svg') }}"></object> --}}
                            <svg width="24" height="24" viewBox="0 0 16 16" fill="none"  xmlns="http://www.w3.org/2000/svg">
                               
                            <path d="M11.7697 14.4616H4.23122C3.9456 14.4616 3.67168 14.3482 3.46972 14.1462C3.26776 13.9442 3.1543 13.6703 3.1543 13.3847V3.69238H12.8466V13.3847C12.8466 13.6703 12.7331 13.9442 12.5312 14.1462C12.3292 14.3482 12.0553 14.4616 11.7697 14.4616Z" stroke="#FF0000" stroke-width="1.3" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M6.38477 11.2305V6.92285" stroke="#FF0000" stroke-width="1.3" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M9.61621 11.2305V6.92285" stroke="#FF0000" stroke-width="1.3" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M1 3.69238H15" stroke="#FF0000" stroke-width="1.3" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M9.61531 1.53809H6.38454C6.09892 1.53809 5.825 1.65155 5.62304 1.85351C5.42108 2.05547 5.30762 2.32939 5.30762 2.61501V3.69193H10.6922V2.61501C10.6922 2.32939 10.5788 2.05547 10.3768 1.85351C10.1748 1.65155 9.90093 1.53809 9.61531 1.53809Z" stroke="#FF0000" stroke-width="1.3" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </button>
                    </form>
                </td>
            </tr>
            @empty
            <tr class="bg-white border-b  700 hover:bg-gray-50 ">
                <td scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap " colspan="8">
                    No employees to show
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
    <div class="flex flex-row h-20 w-full mt-2 mb-2">
        <div>{{ $employees->links() }}</div>
    </div>
</div>
@endsection