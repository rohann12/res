@extends('UserInteractions::layouts.layout')
@section('title', 'Services')
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
                        <div class="leading-tight border-b-4 border-orange-500 inline-block">Our <br>Services</div>
                    </div>
                    <div class="description mt-7 text-left text-white"
                        style="font-family: 'Poppins', sans-serif; font-size: 1rem; line-height: 1.5rem;">
                        {{-- {{ $description->description }} --}}
    {{-- Lorem ipsum dolor sit, amet consectetur adipisicing elit. Labore quaerat unde eius dolorum, nihil quae atque esse, magni dolorem suscipit quas officia! Exercitationem ipsum officia vero eaque consectetur quae nam.
                    </div>
                </div>
            </div>
        </div>
    </div> --}}
    {{-- </div>  --}}
    <div class="flex flex-row px-6 lg:px-28 h-24 w-full bg-gray-100">
        <h2 class="flex h-full capitalize text-stone-700 font-poppins font-medium text-4xl leading-7 tracking-wide  items-center">
            <span>Our Services</span>
        </h2>
    </div>
    {{-- <div class="flex flex-row w-full mx-10">
        <div class="flex flex-col w-1/2 my-10">
            <div class="h-10">
                <h2 class="uppercase text-stone-700 font-poppins font-medium text-4xl leading-7 tracking-wide">
                    <span class="uppercase border-b-2 border-yellow-500">We offer</span>
                </h2>
            </div>
        </div>
    </div> --}}
    <div class="flex flex-col lg:flex-row w-full mb-10 px-6 lg:pr-14 lg:pl-28 overflow-hidden z-30">
        <!-- Tabs Navigation -->
        <div class="flex flex-col mt-10 w-full lg:w-1/3 overflow-y-scroll bg-gray-100 z-30" id="tab-navigation">
            @foreach ($services as $index => $service)
                <div class="service-tab flex items-center justify-start w-full p-4 mb-4 text-xl cursor-pointer z-30
                {{ $index === 0 ? 'bg-blue-500 text-white' : 'border-l-8 border-black' }}"
                    data-tab-id="{{ $service->id }}" onclick="selectTab({{ $service->id }})">
                    {{ $service->title }}
                </div>
            @endforeach
        </div>
        <!-- Tabs Content -->
        <div class="flex flex-col mx-2 lg:mx-16 mt-10 w-full lg:w-2/3 h-full " id="tab-content">
            @foreach ($services as $index => $service)
                <div class="tab-content {{ $index === 0 ? '' : 'hidden' }}" data-tab-id="{{ $service->id }}">
                    <!-- Cover Photo and Other Photos -->
                    <div class="mx-0 lg:mx-8">
                        @php
                            $coverPhoto = $service->photos->firstWhere('is_cover', true);
                            $otherPhotos = $service->photos->filter(fn($photo) => !$photo->is_cover);
                        @endphp
                        @if ($coverPhoto)
                            <div class="h-2/3 pr-3" id="cover-photo">
                                <img src="{{ asset('storage/' . $coverPhoto->photo_path) }}"
                                    alt="{{ $coverPhoto->photo_name }}" class="w-full h-full object-cover cursor-pointer"
                                    onclick="openModal({{ $service->id }}, '{{ asset('storage/' . $coverPhoto->photo_path) }}')">
                            </div>
                        @endif
                        <div class="flex justify-center items-center w-[50vw] h-[20vh] py-2 gap-x-1" id="other-photos-section">
                            @foreach ($otherPhotos as $index => $photo)
                                <div @if ($index > 3) class="w-0 gap-x-0" @else class="relative w-1/3 h-full" @endif>
                                    <img src="{{ asset('storage/' . $photo->photo_path) }}" alt="{{ $photo->photo_name }}"
                                        class="w-full h-full object-cover cursor-pointer"
                                        
                                        onclick="openModal({{ $service->id }}, '{{ asset('storage/' . $photo->photo_path) }}')">
                                    @if ($index === 3)
                                        <div class="absolute inset-0 flex items-center justify-center bg-black bg-opacity-50 rounded-md cursor-pointer" onclick="openModal({{ $service->id }}, '{{ asset('storage/' . $photo->photo_path) }}')">
                                            <span class="text-white text-lg font-bold">
                                                +{{ count($otherPhotos) - 3 }}
                                            </span>
                                        </div>
                                    @endif
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <!-- Content goes here, like cover photos and description -->
                    <div class="lg:mx-8 mt-6 text-lg">
                        <h2 class="text-2xl font-bold">{{ $service->title }}</h2>
                        <p>{!! $service->description !!}</p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    </div>
    <div id="myModal"
        class="modal fixed w-[100vw] h-[100vh] z-30 inset-0 items-center justify-center bg-black bg-opacity-50 hidden">
        <div class="modal-content bg-white w-[100vw] h-[100vh] p-4 bg-gray-500 rounded-lg relative flex flex-col">
            <span class="close absolute top-2 right-4 cursor-pointer text-white text-5xl" onclick="closeModal()">&times;</span>
            <div class="flex-1 flex h-[80vh] justify-center bg-gray-500 items-center">
                <img id="mainModalImage" src="" alt="cover" class="max-w-full max-h-full object-contain">
            </div>
            <div id="modal-thumbnails" class="flex w-full justify-center mt-4 overflow-x-auto space-x-2">
                <!-- Thumbnails will be inserted here dynamically -->
            </div>
        </div>
    </div>


    <script>
        let activeTabId = {{ $services[0]->id }}; // Initialize with the first tab's ID
        function selectTab(tabId) {
            // Clear the active state from all tabs
            const allTabs = document.querySelectorAll('.service-tab');
            const allTabContent = document.querySelectorAll('.tab-content');
            allTabs.forEach(tab => {
                tab.classList.remove('bg-blue-500', 'text-white'); // Remove active styling
                if (tab.dataset.tabId == activeTabId) {
                    tab.classList.add('border-l-8', 'border-black'); // Add border to previously active tab
                }
            });
            allTabContent.forEach(content => content.classList.add('hidden')); // Hide all content
            // Set the new active tab and remove border
            const activeTab = document.querySelector(`[data-tab-id='${tabId}']`);
            const activeTabContent = document.querySelector(`.tab-content[data-tab-id='${tabId}']`);
            activeTab.classList.add('bg-blue-500', 'text-white'); // Active styling
            activeTab.classList.remove('border-l-8', 'border-black'); // Remove border for active tab
            activeTabContent.classList.remove('hidden'); // Show corresponding content
            // Update the current active tab ID
            activeTabId = tabId;
        }
    </script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var modal = document.getElementById("myModal");
            var mainModalImage = document.getElementById("mainModalImage");
            var modalThumbnails = document.getElementById("modal-thumbnails");

            function openModal(projectId, src) {
                console.log(`Opening modal for project ${projectId} with image ${src}`);
                mainModalImage.src = src;
                modalThumbnails.innerHTML = ''; // Clear previous thumbnails

                // Fetch the project container by data-id attribute
                const project = document.querySelector(`.tab-content[data-tab-id="${projectId}"]`);
                if (!project) {
                    console.error(`Project with ID ${projectId} not found.`);
                    return;
                }

                // Collect all images from the project container
                const images = project.querySelectorAll('img');
                images.forEach((img, index) => {
                    const thumbnail = document.createElement('div');
                    thumbnail.classList.add('h-24', 'w-24', 'flex-shrink-0', 'mr-2');
                    thumbnail.innerHTML =
                        `<img src="${img.src}" alt="thumb" class="w-full h-full object-cover cursor-pointer" onclick="changeModalImage('${img.src}')">`;
                    modalThumbnails.appendChild(thumbnail);
                });

                modal.classList.remove("hidden");
            }

            function closeModal() {
                console.log("Closing modal");
                modal.classList.add("hidden");
            }

            function changeModalImage(src) {
                console.log(`Changing modal image to ${src}`);
                mainModalImage.src = src;
            }

            // Close the modal when clicking outside of it
            window.onclick = function(event) {
                if (event.target == modal) {
                    closeModal();
                }
            }

            // Make functions available globally
            window.openModal = openModal;
            window.closeModal = closeModal;
            window.changeModalImage = changeModalImage;
        });
    </script>

@endsection
