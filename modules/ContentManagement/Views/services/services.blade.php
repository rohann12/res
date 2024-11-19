@extends('layouts.adminLayout')
@section('heading', 'Company Services')
@section('subheading','All services')
@section('title', 'Services')
{{-- @section('content')
@if (session()->has('success'))
<div>
    {{ session('success') }}
</div>
@endif
<div>
    @foreach ($services as $service)
    <div>{{ $service->title }}</div>
    <div>{{ $service->description }}</div>

    @php
    $otherPhotosDisplayed = false;
    @endphp
    @foreach ($service->photos as $photo)
    @if ($photo->is_cover)
    <div>Cover Photo</div>
    <div><img src="{{ asset('storage/' . $photo->photo_path) }}" alt="cover" height="100px" width="200px"></div>
    @else
    @if (!$otherPhotosDisplayed)
    <div>Other Photos:</div>
    @php
    $otherPhotosDisplayed = true;
    @endphp
    @endif
    <div><img src="{{ asset('storage/' . $photo->photo_path) }}" alt="other" height="100px" width="200px"></div>
    @endif
    @endforeach
    <a href={{ route('service.edit', ['service'=> $service]) }}><button>Edit</button></a>

    <form action="{{ route('service.destroy', ['service' => $service]) }}" method="post">
        @csrf
        @method('delete')
        <input type="submit" value="Delete"
            onclick="return confirm('Are you sure you want to delete this employee?')" />
    </form>
    @endforeach
</div>
<a href="{{ route('service.create') }}"><button>Add new service</button></a>
@endsection --}}
@section('button')
<!-- Modal toggle -->
<div class=" flex h-20 items-center justify-end h-20">
    <a href="{{ route('service.create') }}">
        <button data-modal-target="crud-modal" data-modal-toggle="crud-modal"
            class="px-10 py-2 mr-6 text-white  bg-sky-500 rounded-md" type="button">
            + New Service
        </button>
    </a>
</div>
@endsection

@section('content')
<div class="flex flex-col w-full overflow-x-auto  shadow-md sm:rounded-lg" style="min-height: 400px;">
    <table class="w-full text-sm  text-left rtl:text-right text-gray-500 ">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50">
            <tr>
                <th scope="col" class="px-6 py-3">
                    S.N
                </th>
                <th scope="col" class="px-6 py-3">
                    Service Title
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
            @forelse ($services as $service)
            <tr class="bg-white border-b  hover:bg-gray-50 " >
                <th scope="row" class="px-6 py-1 font-medium text-gray-900 whitespace-nowrap">
                    {{ $loop->iteration }}
                </th>
                <td class="px-6 py-4">
                    {{ $service->title }}
                </td>
                <td class="flex px-6 pt-4 ">
                    <a href="{{ route('service.edit', ['service' => $service]) }} "
                        class="h-full pb-3 px-2 font-medium text-2xl font-medium mb-2 text-gray-900">
                        {{-- <object type="image/svg+xml" data="{{ asset('logos/edit.svg') }}" ></object>    --}}
                        <svg width="24" height="26" viewBox="0 0 15 16" fill="none" xmlns="http://www.w3.org/2000/svg"
                        class="stroke-current text-gray-600 hover:text-blue-500">
                            <path
                                d="M13.3148 2.14713C13.1191 1.95231 12.8868 1.79818 12.6312 1.69365C12.3757 1.58912 12.1019 1.53626 11.8258 1.53813C11.5497 1.54 11.2767 1.59656 11.0226 1.70454C10.7684 1.81252 10.5382 1.96978 10.3452 2.16724L2.01666 10.4958L1 14.4619L4.96612 13.4447L13.2947 5.11612C13.4922 4.92321 13.6495 4.69305 13.7575 4.43897C13.8655 4.18488 13.9221 3.91191 13.924 3.63582C13.9258 3.35974 13.873 3.08602 13.7684 2.83049C13.6638 2.57497 13.5097 2.34271 13.3148 2.14713V2.14713Z"
                                stroke="#615E83" class="hover:text-blue-500" stroke-width="1.3" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                    </a>
                </td>
                <td class="px-6 py-4 ">
                    <form action="{{ route('service.destroy', ['service' => $service]) }}" method="post">
                        @csrf
                        @method('delete')
                        <button type="submit" value="Delete"
                            onclick="return confirm('Are you sure you want to delete this service?')">
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
            <tr class="bg-white border-b  hover:bg-gray-50 ">
                <td scope="row" class="px-6 py-1 font-medium text-gray-900 whitespace-nowrap "
                    colspan="4">
                    No services to show
                </td>
            </tr>
            @endforelse

        </tbody>
    </table>
    
</div>
<div class="flex flex-row h-20 w-full mt-2 mb-2">
    <div>{{ $services->links() }}</div>
</div>
@endsection