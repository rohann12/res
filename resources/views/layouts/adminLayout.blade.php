<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin-@yield('title')</title>
    {{-- <script src="https://code.iconify.design/1/1.0.7/iconify.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet"> --}}
    @vite('resources/css/app.css')
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="icon" href="{{ asset('/images/resilient_logo.png') }}" type="image/x-icon" />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/scroll.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/quill@2.0.2/dist/quill.snow.css" rel="stylesheet">
    <script src="https://cdn.ckeditor.com/ckeditor5/41.3.0/classic/ckeditor.js"></script>
     <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
     <script src="https://cdn.datatables.net/2.0.6/js/dataTables.js"></script>
     <script src="https://kit.fontawesome.com/20789f0b6f.js" crossorigin="anonymous"></script>
     <script src="https://cdn.jsdelivr.net/npm/quill@2.0.2/dist/quill.js"></script>


</head>
<style>
    body {
        font-family: 'poppins';
    }

    .object {
        height: 35px;
        width: 35px;
       
    }
    object{
        pointer-events: none;
    }
     /* Define styles for the SVG */
     svg {
        
        transition: transform 0.3s ease; /* Add a smooth transition */
    }

    /* Define styles for the SVG when hovered */
    svg:hover {
        transform: scale(1.2); /* Scale up the SVG on hover */
    }
</style>

<body>
    <div class="flex flex-row w-screen h-screen overflow-x-hidden">
        @include('layouts.sidebar')

        <div class="flex flex-1 flex-col w-full h-screen overflow-hidden">
            <div class="flex flex-row items-center justify-between w-full h-20 ps-6 border-b border-gray-200 ">
                <div class="flex flex-col gap-y-1">
                    <h3 class="font-semibold lg:text-2xl md:text-xl">@yield('heading')</h3>
                    <span class="text-gray-500 font-normal lg:text-xs md:text-xs">@yield('subheading')</span>
                </div>
                {{-- User icon and dropdown --}}
                <button id="dropdownDividerButton" data-dropdown-toggle="dropdownDivider"
                    class="text-gray-300  hover:text-black   mr-5 font-medium rounded-lg text-sm text-center inline-flex items-center"
                    type="button">
                    {{-- User icon --}}
                    <div class="h-10 w-10 rounded-full bg-red-200 ">
                        {{-- Insert image here --}}
                        <img src="{{ asset('storage/' . Auth::user()->photo_path) }}" alt="Profile Photo"
                            onerror="this.onerror=null;this.src='{{ asset('images/minesh.jpg') }}';" class="rounded-full"
                            style="height:100%;width:100%;object-fit:cover;">


                    </div>
                    <svg class="w-2.5 h-2.5 ms-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 10 6">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m1 1 4 4 4-4" />
                    </svg>
                </button>

                <!-- Dropdown menu -->
                <div id="dropdownDivider" class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44 ">
                    <ul class="py-2  text-sm text-gray-700 " aria-labelledby="dropdownDividerButton">
                        <li class="flex items-center px-4 hover:bg-gray-100 hover:text-sky-500">
                            <object type="image/svg+xml" data="{{ asset('logos/profile.svg') }}"
                                class="text-sky-500"></object>
                            <a href="{{ route('user.edit') }}" class="block px-2 py-2 ">Profile</a>
                        </li>

                        <li class="flex items-center px-4 hover:bg-gray-100 hover:text-sky-500">
                            <object type="image/svg+xml" data="{{ asset('logos/settings.svg') }}"
                                class="text-sky-500"></object>
                            <a href="#" class="block px-2 py-2">Settings</a>
                        </li>


                    </ul>
                    <div class="py-2 flex items-center text-sm text-gray-700 px-4 hover:bg-gray-100 hover:text-sky-500">
                        <object type="image/svg+xml" data="{{ asset('logos/logout.svg') }}"
                            class="text-sky-500"></object>
                        <a href="{{ route('logout') }}" class="block px-2 ">
                            Logout
                        </a>
                    </div>
                </div>


            </div>
            @yield('button')

            <div class="flex flex-col px-6 pt-4 flex-1 min-h-96 bg-gray-50 overflow-x-hidden overflow-y-scroll ">
                <div class="flex flex-col bg-white w-full h-fit rounded-md ">
                    @yield('content')

                </div>

            </div>
        </div>
    </div>
  <!-- Include the Error Modal Component -->
  <x-error-modal :message="session('error')" />


        @if (session()->has('success'))
            <div id="success" class="fixed bottom-0 left-0 w-full bg-blue-500 border text-white text-center p-4 ">
                {{ session('success') }}
            </div>
            <script>
                function showSuccess() {
                    const successDiv = document.getElementById('success');
                    setTimeout(() => {
                        successDiv.classList.add('hidden');
                    }, 5000);
                }
                showSuccess();
            </script>
        @endif
        {{-- @if ($errors->any())
            @foreach ($errors->all() as $error)
                <div id="error" class="fixed bottom-0 left-0 w-full bg-red-500 text-white text-center p-4">
                    {{ $error }}</div>
                <script>
                    function showError() {
                        const errorDiv = document.getElementById('error');
                        setTimeout(() => {
                            errorDiv.classList.add('hidden');
                        }, 5000);
                    }
                    showError();
                </script>
            @endforeach
        @endif --}}
<!-- Include scripts to manage the modal -->
    <script>
        const errorModal = document.getElementById('errorModal');
        const closeErrorModal = document.getElementById('closeErrorModal');
        const closeErrorModalButton = document.getElementById('closeErrorModalButton');

        // If there's an error message, show the modal
        @if(session('error'))
            errorModal.classList.remove('hidden');
        @endif

        // Close modal on button click
        [closeErrorModal, closeErrorModalButton].forEach(button => {
            button.addEventListener('click', () => {
                errorModal.classList.add('hidden');
            });
        });
    </script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            setTimeout(function() {
                // Get the current page URL
                const currentPageUrl = window.location.href;

                // Get all sidebar links
                const sidebarLinks = document.querySelectorAll('#sidebar a');

                // Loop through each link
                sidebarLinks.forEach(link => {
                    if (currentPageUrl.startsWith(link.href)) {
                        link.classList.add('text-sky-500', 'font-bold', 'bg-gray-100',
                            'rounded-lg');
                        const svgObject = link.querySelector('object');
                        if (svgObject) {
                            if (svgObject.contentDocument && svgObject.contentDocument
                                .readyState === 'complete') {
                                // SVG content already loaded
                                applySVGColor(svgObject);
                            } else {
                                // Wait for SVG content to load
                                svgObject.addEventListener('load', function() {
                                    applySVGColor(svgObject);
                                });
                            }
                        }
                    }
                });
            }, 1000); // 3000 milliseconds = 3 seconds
        });

        function applySVGColor(svgObject) {
            const svgDoc = svgObject.contentDocument;
            if (svgDoc) {
                const svg = svgDoc.querySelector('svg');
                if (svg) {
                    const paths = svg.querySelectorAll('path');
                    paths.forEach(path => {
                        path.setAttribute('fill', 'rgb(14 165 233)');
                    });
                }
            }
        }
        function goBack() {
        window.history.back();
    }
    </script>

</body>

</html>
