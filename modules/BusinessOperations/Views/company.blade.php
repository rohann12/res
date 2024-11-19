@extends('layouts.adminLayout')
@section('heading', 'Company Details')
@section('subheading', 'Detailed information about company')
@section('title', 'Details')



@section('button')
<div class="flex h-20 items-center justify-end">
    <a href="{{ route('company.edit', ['id' => $company->id]) }}">
        <button class="px-10 py-2 mr-6 text-white  bg-sky-500 rounded-md hover:bg-sky-600" type="button">
            Edit
        </button></a>
</div>
@endsection

@section('content')
<div class="flex overflow-x-hidden justify-center items-center w-full md:inset-0 h-fit max-h-full">

    <!-- Modal content -->
    <div class="p-4 w-full max-w-full bg-white rounded-lg shadow">
        <span class="font-bold px-6 py-4">Company description</span>
        <div class="text-gray-500 px-6 py-4">{!! $company->description !!}</div>
        <span class="font-bold px-6 py-4">Welcome text</span>
        <div class="text-gray-500 px-6 py-4">{{ $company->welcome_text }}</div>
        <span class="font-bold px-6 py-4">Slogan</span>
        <p class="text-gray-500 px-6 py-4">{{ $company->slogan }}</p>
        <table>
            <tr class="pb-10">
                <td class="font-bold px-6 py-3">Address:</td>
                <td>{{ $company->address }}</td>
            </tr>
            <tr>
                <td class="font-bold px-6 py-3">Phone:</td>
                <td>{{ $company->contact }}</td>
            </tr>
            <tr>
                <td class="font-bold px-6 py-3">Email:</td>
                <td>{{ $company->email }}</td>
            </tr>
            <tr>
                <td class="font-bold px-6 py-3">Facebook Page:</td>
                <td>{{ $company->fbLink }}</td>
            </tr>
            <tr>
                <td class="font-bold px-6 py-3">Instagram Page:</td>
                <td>{{ $company->instaLink }}</td>
            </tr>
            <tr>
                <td class="font-bold px-6 py-3">Linkden Page:</td>
                <td>{{ $company->linkedInLink }}</td>
            </tr>
        </table>
        
    </div>
    @endsection