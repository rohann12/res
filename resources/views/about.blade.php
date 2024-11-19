@extends('layouts.layout')
@section('title', 'About Us')
@section('content')
    {{-- 
<div class="image-section flex flex-col w-full">
    <div class="grid w-full relative" style="height:500px">
        <div class="absolute top-0 left-0 w-full h-full z-10">
            <img src="{{ asset('images/about_us.png') }}" alt="" class="w-full h-full object-cover">
        </div>
        <div class="absolute top-0 left-0 w-full h-full z-20">
            <div class="bg-gradient-to-r from-black to-black/50 w-full h-full"></div>
        </div>
        <div class="absolute top-0 left-0 w-full h-full z-20 ">
            <div class="grid h-full w-full justify-items-start items-end">
                <div class="ml-10 w-3/5 mb-20  overflow-hidden">
                    <div class="mb-2 text-left text-uppercase font-semibold text-white"
                        style="font-size: 4rem; line-height: 150%; letter-spacing: 0.04em;">
                        <div class="leading-tight border-b-4 border-orange-500 inline-block">About Us</div>
                    </div>
                    <div class="description mt-7 text-left text-white"
                        style="font-family: 'Poppins', sans-serif; font-size: 1rem; line-height: 1.5rem;">
                        {{ $description->description }}
                    </div>
                </div>
            </div>  
        </div>
    </div>
</div> --}}
    <div class="flex flex-row px-6 lg:px-28 h-24 w-full bg-gray-100">
        <h2
            class="flex capitalize h-full text-stone-700 font-poppins font-medium text-4xl leading-7 tracking-wide 
            items-center">
            <span>About us</span>
        </h2>
    </div>

    <div class="flex flex-col w-full px-6 lg:px-28 md:flex-row md:justify-between md:items-center  mt-10 overflow-hidden">
        <div class="w-full md:w-2/5 pr-0  text-center">
            <span
                class="text-lg uppercase  md:text-xl  text-orange-500 lg:text-2xl xl:text-3xl font-semibold leading-loose">{{ $welcomeText->welcome_text }}</span>
        </div>
        <div class="w-full md:w-3/5 md:pl-8 overflow-auto">
            <span class="text-sm text-slate-600 md:text-base lg:text-lg xl:text-base">{!! $descriptionfirst !!}</span>
        </div>
    </div>
    <div class="flex flex-col w-full  px-6 lg:px-28 md:flex-row md:justify-between md:items-center mt-10 overflow-hidden">
        <div class="w-full md:w-2/5 pr-0">
            <div class="w-full pr-0 flex flex-col">
                <!-- First Row: Project Description -->
                <div class="w-full">
                    <span class="text-sm text-slate-600 md:text-base lg:text-lg xl:text-base">
                        {!! $descriptionsecond !!} <!-- Main description content -->
                    </span>
                </div>

                <!-- Second Row: Three Columns with Number and Description -->
                <div class="w-full mt-4 grid grid-cols-1 md:grid-cols-3 gap-4"> <!-- Responsive grid -->
                    <!-- First Column -->
                    <div class="flex flex-col items-center">
                        <div class="text-2xl font-bold text-slate-800">
                            {!! $completed !!}
                        </div>
                        <div class="text-sm text-slate-500 text-center">
                            Completed Project
                        </div>
                    </div>

                    <!-- Second Column -->
                    <div class="flex flex-col items-center">
                        <div class="text-2xl font-bold text-slate-800">
                            {!! $running !!}
                        </div>
                        <div class="text-sm text-slate-500 text-center">
                            Running Project
                        </div>
                    </div>

                    <!-- Third Column -->
                    <div class="flex flex-col items-center">
                        <div class="text-2xl font-bold text-slate-800">
                            {!! $upcoming !!}
                        </div>
                        <div class="text-sm text-slate-500 text-center">
                            Upcoming Project
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="w-full md:w-3/5 md:pl-8 overflow-auto">
            <div class="z-10 h-72 md:h-96"><img src="{{ asset('images/about-us1.jpg') }}" alt=""
                    class="w-full h-full object-cover"></div>
        </div>
    </div>


    <div class="flex px-6 lg:px-28 flex-row  h-32 w-full bg-sky-500 overflow-x-hidden content-center items-center mt-10">
        <div class="flex flex-row h-1/3 w-full capitalize items-center justify-between">
            <span class="ms-8 md:ms-20 text-xl text-white">{{ $slogan->slogan }}</span>
            <button class="mr-8 bg-white p-3 rounded"><a href="{{route('contact')}}">Get Appointment</a></button>
        </div>
    </div>

    <div class="flex px-2 lg:px-28 flex-col w-auto  ">
        <div class="h-10 my-4 ml-12">
            <h2 class="uppercase p-0 h-26 ">
                <span class="half-underline text-lg md:text-xl lg:text-2xl xl:text-4xl font-medium ">Meet
                    Our team</span>
            </h2>
        </div>
        {{-- Employee section --}}
        {{-- <div class="grid grid-cols-4 grid-rows-2 place-self-center gap-4  h-full w-11/12"> --}}
        <div class="grid grid-cols-2 md:grid-cols-2 min-h-[50vh] mt-4 pb-8 lg:grid-cols-4 
             xl:grid-col-4 place-self-center lg:gap-4 w-11/12 ">
             @foreach (range(1, 10) as $number)
                
            
            @foreach ($employees->where('is_active', 1)->sortBy('order') as $employee)
            
                <div class="flex flex-col mx-5">
                    <div class="h-2/3 flex justify-center items-center">
                        <div class="h-40 w-40">

                            <img src="{{ asset('images/employees/' . $employee->photo_url) }}" alt=""
                                class="rounded-full h-full w-full shadow-2xl object-cover">
                        </div>
                    </div>
                    <div class="flex text-center flex-col h-1/2">
                        <div class="flex flex-col h-1/2 my-2">
                            <div>{{ $employee->name }}</div>
                            <div>{{ $employee->position }}</div>
                        </div>
                        <div class="flex flex-row items-center py-2 h-1/2 bg-sky-500 list-none justify-between px-4">
                            <div class="flex flex-row items-center px-2 list-none gap-x-6">
                                <li><a href="{{ $employee->fb_link }}"><svg xmlns="http://www.w3.org/2000/svg"
                                            width="1.3rem" height="1.3rem" viewBox="0 0 24 24">
                                            <g fill="none" fill-rule="evenodd">
                                                <path
                                                    d="M24 0v24H0V0zM12.593 23.258l-.011.002l-.071.035l-.02.004l-.014-.004l-.071-.035c-.01-.004-.019-.001-.024.005l-.004.01l-.017.428l.005.02l.01.013l.104.074l.015.004l.012-.004l.104-.074l.012-.016l.004-.017l-.017-.427c-.002-.01-.009-.017-.017-.018m.265-.113l-.013.002l-.185.093l-.01.01l-.003.011l.018.43l.005.012l.008.007l.201.093c.012.004.023 0 .029-.008l.004-.014l-.034-.614c-.003-.012-.01-.02-.02-.022m-.715.002a.023.023 0 0 0-.027.006l-.006.014l-.034.614c0 .012.007.02.017.024l.015-.002l.201-.093l.01-.008l.004-.011l.017-.43l-.003-.012l-.01-.01z" />
                                                <path fill="white"
                                                    d="M4 12a8 8 0 1 1 9 7.938V14h2a1 1 0 1 0 0-2h-2v-2a1 1 0 0 1 1-1h.5a1 1 0 1 0 0-2H14a3 3 0 0 0-3 3v2H9a1 1 0 1 0 0 2h2v5.938A8.001 8.001 0 0 1 4 12m8 10c5.523 0 10-4.477 10-10S17.523 2 12 2S2 6.477 2 12s4.477 10 10 10" />
                                            </g>
                                        </svg>
                                    </a></li>
                                <li><a href="{{ $employee->insta_link }}">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="1.3rem" height="1.3rem"
                                            viewBox="0 0 24 24">
                                            <path fill="white"
                                                d="M12.001 9a3 3 0 1 0 0 6a3 3 0 0 0 0-6m0-2a5 5 0 1 1 0 10a5 5 0 0 1 0-10m6.5-.25a1.25 1.25 0 0 1-2.5 0a1.25 1.25 0 0 1 2.5 0M12.001 4c-2.474 0-2.878.007-4.029.058c-.784.037-1.31.142-1.798.332a2.886 2.886 0 0 0-1.08.703a2.89 2.89 0 0 0-.704 1.08c-.19.49-.295 1.015-.331 1.798C4.007 9.075 4 9.461 4 12c0 2.475.007 2.878.058 4.029c.037.783.142 1.31.331 1.797c.17.435.37.748.702 1.08c.337.336.65.537 1.08.703c.494.191 1.02.297 1.8.333C9.075 19.994 9.461 20 12 20c2.475 0 2.878-.007 4.029-.058c.782-.037 1.308-.142 1.797-.331a2.91 2.91 0 0 0 1.08-.703c.337-.336.538-.649.704-1.08c.19-.492.296-1.018.332-1.8c.052-1.103.058-1.49.058-4.028c0-2.474-.007-2.878-.058-4.029c-.037-.782-.143-1.31-.332-1.798a2.912 2.912 0 0 0-.703-1.08a2.884 2.884 0 0 0-1.08-.704c-.49-.19-1.016-.295-1.798-.331C14.926 4.006 14.54 4 12 4m0-2c2.717 0 3.056.01 4.123.06c1.064.05 1.79.217 2.427.465c.66.254 1.216.598 1.772 1.153a4.908 4.908 0 0 1 1.153 1.772c.247.637.415 1.363.465 2.428c.047 1.066.06 1.405.06 4.122c0 2.717-.01 3.056-.06 4.122c-.05 1.065-.218 1.79-.465 2.428a4.884 4.884 0 0 1-1.153 1.772a4.915 4.915 0 0 1-1.772 1.153c-.637.247-1.363.415-2.427.465c-1.067.047-1.406.06-4.123.06c-2.717 0-3.056-.01-4.123-.06c-1.064-.05-1.789-.218-2.427-.465a4.89 4.89 0 0 1-1.772-1.153a4.905 4.905 0 0 1-1.153-1.772c-.248-.637-.415-1.363-.465-2.428C2.012 15.056 2 14.717 2 12c0-2.717.01-3.056.06-4.122c.05-1.065.217-1.79.465-2.428a4.88 4.88 0 0 1 1.153-1.772A4.897 4.897 0 0 1 5.45 2.525c.637-.248 1.362-.415 2.427-.465C8.945 2.013 9.284 2 12.001 2" />
                                        </svg>
                                    </a></li>
                                <li><a href="{{ $employee->linkedin_link }}">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="1.3rem" height="1.3rem"
                                            viewBox="0 0 24 24">
                                            <g fill="none">
                                                <path
                                                    d="M24 0v24H0V0zM12.593 23.258l-.011.002l-.071.035l-.02.004l-.014-.004l-.071-.035c-.01-.004-.019-.001-.024.005l-.004.01l-.017.428l.005.02l.01.013l.104.074l.015.004l.012-.004l.104-.074l.012-.016l.004-.017l-.017-.427c-.002-.01-.009-.017-.017-.018m.265-.113l-.013.002l-.185.093l-.01.01l-.003.011l.018.43l.005.012l.008.007l.201.093c.012.004.023 0 .029-.008l.004-.014l-.034-.614c-.003-.012-.01-.02-.02-.022m-.715.002a.023.023 0 0 0-.027.006l-.006.014l-.034.614c0 .012.007.02.017.024l.015-.002l.201-.093l.01-.008l.004-.011l.017-.43l-.003-.012l-.01-.01z" />
                                                <path fill="white"
                                                    d="M18 3a3 3 0 0 1 3 3v12a3 3 0 0 1-3 3H6a3 3 0 0 1-3-3V6a3 3 0 0 1 3-3zm0 2H6a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V6a1 1 0 0 0-1-1M8 10a1 1 0 0 1 .993.883L9 11v5a1 1 0 0 1-1.993.117L7 16v-5a1 1 0 0 1 1-1m3-1a1 1 0 0 1 .984.821a5.82 5.82 0 0 1 .623-.313c.667-.285 1.666-.442 2.568-.159c.473.15.948.43 1.3.907c.315.425.485.942.519 1.523L17 12v4a1 1 0 0 1-1.993.117L15 16v-4c0-.33-.08-.484-.132-.555a.548.548 0 0 0-.293-.188c-.348-.11-.849-.052-1.182.09c-.5.214-.958.55-1.27.861L12 12.34V16a1 1 0 0 1-1.993.117L10 16v-6a1 1 0 0 1 1-1M8 7a1 1 0 1 1 0 2a1 1 0 0 1 0-2" />
                                            </g>
                                        </svg>
                                    </a></li>
                            </div>
                            <div class="flex justify-end">
                                {{-- <a href="{{ route('employeeDetails', ['employeeId' => $employee->id]) }}"
                                onclick="openModal()" class="text-white border-2 rounded-full px-1">
                                ➡ </a> --}}
                                <!-- Button to open modal -->
                                <div class="flex justify-end">
                                    <button
                                        onclick="openEmployeeModal('{{ route('employeeDetails', ['employeeId' => $employee->id]) }}')"
                                        class="text-white border-2 rounded-full px-1">
                                        ➡
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
            @endforeach
        </div>
    </div>

    <!-- Modal structure -->
    <div id="userModal" class="fixed flex inset-0 hidden z-50  items-center justify-center bg-gray-900 bg-opacity-50">
        <div class="rounded-lg shadow-lg w-3/5">            
            <!-- Content area for the modal -->
            <div id="modalContent" class="flex h-[95vh] ">
                <!-- Dynamic content will be inserted here -->
            </div>
        </div>
    </div>

    <script>
        function openEmployeeModal(employeeUrl) {
            const modal = document.getElementById('userModal');
            modal.classList.remove('hidden'); // Show the modal

            // Clear previous content
            const modalContent = document.getElementById('modalContent');
            modalContent.innerHTML = 'Loading...'; // Show a loading message

            // Fetch the content from the provided URLs
            fetch(employeeUrl)
                .then(response => response.text()) // Get response as text (HTML)
                .then(html => {
                    modalContent.innerHTML = html; // Insert the fetched HTML into the modal
                })
                .catch(error => {
                    modalContent.innerHTML = 'Error loading content.';
                    console.error('Error fetching modal content:', error);
                });
        }

        function closeModal() {
            const modal = document.getElementById('userModal');
            modal.classList.add('hidden'); // Hide the modal
        }
    </script>
@endsection
