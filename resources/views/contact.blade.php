@extends('layouts.layout')
@section('title','Contact Us' )
@section('content')

{{-- <div class="image-section flex flex-col w-full">
    <div class="grid w-full relative" style="height:80vh">
        <div class="absolute top-0 left-0 w-full h-full z-10">
            <img src="{{ asset('images/contact.png') }}" alt="" style="width: 100%; height:100%; object-fit: cover;">
        </div>
        <div class="absolute top-0 left-0 w-full h-full z-20">
            <div class="bg-gradient-to-r from-black to-black/0 w-full h-full"></div>

        </div>
        <div class="absolute top-0 left-0 w-full h-full z-20 ">
            <div class="grid h-full w-full justify-items-start items-end">
                <div class="ml-10 w-3/5 mb-20 overflow-hidden">
                    <div class="mb-2"
                        style="text-align: left; text-transform: uppercase; font: 600 64px/150% DM Sans, sans-serif; color: white;">
                        <div class="leading-tight" style="border-bottom: 7px solid orange; display: inline-block;">
                            <span>Contact us</span>
                        </div>
                    </div>
                    <div class="description mt-7"
                        style="font-family: 'Poppins', sans-serif; font-size: 16px; font-weight: 300; line-height: 24px; color: #fff; letter-spacing: 0.04em; text-align: left;">
                        Lorem ipsum dolor sit amet consectetur, adipisicing elit. Minima, officiis, fugit ipsa at quia
                        maiores, voluptatum quam reiciendis nam rerum quis aliquid illum
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> --}}
<div class="flex flex-col md:flex-row h-24 w-full  px-6 lg:px-28 bg-gray-100">
    <h2 class="flex capitalize h-full text-stone-700 font-poppins font-medium text-3xl leading-7 tracking-wide 
          items-center">
        <span class="text-4xl font-medium">Contact Us</span>
    </h2>
</div>
<div class="flex flex-col xl:flex-row px-2 lg:pl-28 lg:pr-10 overflow-y-hidden">
    <div class="flex flex-col w-full md:w-1/2 pt-12">
        <div class="h-10 w-full">
            <h2 class="capitalize text-stone-700 font-poppins font-medium xl:text-2xl leading-7
            tracking-wide">
                {{-- <span class="border-b-2 border-yellow-500 pb-1 text-4xl font-bold">Contact Information</span> --}}

                <h1 class="half-underline pb-1 text-2xl xl:text-4xl font-bold">Contact Information</h1>

            </h2>
        </div>
            <table class="table-fixed border-separate w-full border-spacing-y-10 px-2 mt-10 lg:pr-8">
                <tbody>
                    <tr>
                        <td class="text-gray-700 pr-0 w-1/3 lg:pr-4">Address:</td>
                        <td class="text-gray-700  w-2/3">{{ $company->address }}</td>
                    </tr>
                    <tr>
                        <td class="text-gray-700 pr-0 lg:pr-4">Email:</td>
                        <td class="text-gray-700"><a href="mailto:{{ $company->email }}" class="lowercase font-medium">{{
                                $company->email }}</a></td>
                    </tr>
                    <tr>
                        <td class="text-gray-700 pr-0 lg:pr-4">Phone:</td>
                        <td class="text-gray-700">{{ $company->contact }}</td>
                    </tr>
                    <tr>
                        <td class="text-gray-700 pr-2">Open:</td>
                        <td class="text-gray-700">
                            <span>10:00 AM </span>
                            <span class="text-xs font-normal">(Sunday to Friday)</span>
                            <span class="ml-10 lg:ml-14 pr-2">Close:</span>
                            <span>5:00 PM</span>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div id="placeholder"></div>
                        </td>
                    </tr>
                </tbody>
            </table>
    </div>

    <div class="flex w-full md:w-1/2 border-l-md border-l-2 border-gray-200">
        <form method="POST" action="{{ route('postMessage') }}"
            class="flex flex-col gap-4 mt-12 p-4 rounded-md  w-full">
            @csrf
            <div class="flex flex-col">
                <label for="name" class="text-sm font-medium text-gray-800">Name</span><span
                        style="color: rgb(255, 72, 0);">*</span></label>
                <input type="text" id="name" name="name" required class="block w-full mt-1 border-b border-0 border-gray-200 rounded-none py-1 px-2
                     focus:ring-0" />

            </div>
            <div class="flex flex-col">
                <label for="email" class="text-sm font-medium text-gray-800">Email</span><span
                        style="color: rgb(255, 72, 0);">*</span></label>
                <input type="email" id="email" name="email" required class="block w-full mt-1 border-b border-0 border-gray-200 rounded-none py-1 px-2 
                    focus:outline-none focus:ring-0" />
            </div>
            <div class="flex flex-col">
                <label for="organization_name" class="text-sm font-medium text-gray-800">Organization
                    Name</label>
                <input type="text" id="organization_name" name="organization_name" class="block w-full mt-1 border-b   border-0 border-gray-200 rounded-none py-1 px-2 
                    focus:ring-0" />
            </div>
            <div class="flex flex-col">
                <label for="message" class="text-sm font-medium text-gray-800">Message</span>
                    <span style="color: rgb(255, 72, 0);">*</span>
                </label>
                <textarea id="message" name="message" required class="block w-full mt-1 border-b  border-0 border-gray-200 rounded-none py-1 px-2 
                    resize-none focus:ring-0" rows="4"></textarea>
            </div>
            <div class="grid grid-cols-1 ">
                <button type="submit" class="justify-self-end text-white px-10 py-3 bg-sky-500 rounded-md">
                    Send Message
                </button>
            </div>
        </form>
    </div>
</div>
<script>
    // JavaScript to clone and append the element
    document.addEventListener("DOMContentLoaded", function() {
        // Find the original element
        const originalElement = document.querySelector('.social-links');
        // Clone the original element
        const clonedElement = originalElement.cloneNode(true);
        // Append the cloned element to the desired location
        document.getElementById('placeholder').appendChild(clonedElement);
    });
</script>
@endsection