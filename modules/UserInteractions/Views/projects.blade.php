@extends('UserInteractions::layouts.layout')
@section('title', 'Projects')
@section('content')
    <div class="flex flex-row h-24 w-full px-6 lg:px-28 bg-gray-100">
        <h2 class="flex h-full capitalize text-stone-700 font-poppins font-medium text-4xl leading-7 tracking-wide items-center">
            <span>Our Projects</span>
        </h2>
    </div>
    <!-- Tab Buttons for Filtering -->
    <div class="flex justify-center mt-6 mb-6 px-6 lg:px-28 w-screen">
        <button class="tab py-4 lg:px-6 lg:mx-4 border border-sky-500 bg-sky-500 text-white z-30" data-filter="all">All Projects ({{ count($projectsAll) }})</button>
        <button class="tab py-4 lg:px-6 lg:mx-4 border border-sky-500 bg-white text-black z-30"
            data-filter="completed">Completed ({{ count($projectsCompleted) }})</button>
        <button class="tab py-4 lg:px-6 lg:mx-4 border border-sky-500 bg-white text-black z-30" data-filter="running">Running ({{ count($projectsRunning) }})</button>
        <button class="tab py-4 lg:px-6 lg:mx-4 border border-sky-500 bg-white text-black z-30" data-filter="upcoming">Upcoming ({{ count($projectsUpcoming) }})</button>
    </div>
    <!-- Projects Container --> 
    <div id="projects-container">
        <!-- Display first three projects -->
        @foreach ($projectsAll as $index => $project)
            <div class="project-container flex flex-col bg-gray-100 mx-2 lg:mx-28 p-8 py-6 mb-4 {{ $index >= 3 ? 'hidden' : '' }}"
                data-status="{{ strtolower($project->status) }}" data-id="{{ $project->id }}">
                <h2 class="uppercase text-stone-700 font-poppins mb-4 font-semibold text-2xl leading-7 tracking-wide">
                    {{ $project->name }}
                </h2>
                <!-- Project content -->
                <div class="flex h-3/4 flex-col lg:flex-row w-full" id="project-content">
                    <!-- Cover photo and project description -->
                    <div class="flex flex-col w-full lg:w-3/4 pr-4 pb-4" id="cover-photo-and-description">
                        @php
                            $coverPhoto = $project->photos->firstWhere('is_cover', true);
                        @endphp
                        @if ($coverPhoto)
                            <div class="flex justify-center items-center w-[60vw] h-[70vh]" id="cover-photo">
                                <img src="{{ asset('storage/' . $coverPhoto->photo_path) }}" alt="cover"
                                    class="w-full h-full object-cover cursor-pointer" onclick="openModal('{{ $project->id }}', '{{ asset('storage/' . $coverPhoto->photo_path) }}')">
                            </div>
                        @endif
                        <!-- Project description -->
                        <div class="pt-4">
                            <p class="text-stone-700 font-poppins font-medium text-xl leading-7 tracking-wide">
                                Project Description
                            </p>
                            <p>{!! $project->description !!}</p>    
                        </div>
                    </div>
                    <!-- Other photos -->
                    <div class="hidden lg:flex flex-col gap-y-2 overflow-hidden ml-1 w-[40vh] h-[70vh] bg-slate-50 ml-6" 
                    id="other-photos-container">
                    @php
                        $otherPhotos = $project->photos->where('is_cover', false);
                        $otherPhotosCount = $otherPhotos->count();
                    @endphp
                    @foreach ($otherPhotos as $index => $photo)
                        <div @if ($index > 3) class="w-0" @else class="relative h-1/3" @endif>
                            <img src="{{ asset('storage/' . $photo->photo_path) }}" alt="other"
                                class="w-full h-full object-cover cursor-pointer"  
                            onclick="openModal('{{ $project->id }}', 
                            '{{ asset('storage/' . $photo->photo_path) }}')">
                            @if ($index === 3)
                                <div class="absolute inset-0 flex items-center justify-center 
                                bg-black bg-opacity-50  rounded-md cursor-pointer" 
                                onclick="openModal('{{ $project->id }}', 
                                    '{{ asset('storage/' . $photo->photo_path) }}')">
                                    <span class="text-white text-lg font-bold">
                                        +{{ $otherPhotosCount - 3 }}
                                    </span>
                                </div>
                            @endif
                        </div>
                    @endforeach
                </div>
                </div>
            </div>
        @endforeach
    </div>

    <!-- Modal -->
    <div id="myModal" class="modal fixed w-[100vw] h-[100vh] z-30  inset-0 items-center justify-center bg-black bg-opacity-50 hidden">
        <div class="modal-content bg-white w-[100vw] h-[100vh] p-4 bg-gray-700 rounded-lg relative flex flex-col">
            <span class="close absolute top-2 right-4 text-white cursor-pointer text-5xl" onclick="closeModal()">&times;</span>
            <div class="flex-1 flex h-[80vh] justify-center bg-gray-700 items-center">
                <img id="mainModalImage" src="" alt="cover" class="max-w-full max-h-full object-contain">
            </div>
            <div id="modal-thumbnails" class="flex mt-4 w-full justify-center overflow-x-auto overflow-y-hidden space-x-2">
                <!-- Thumbnails will be inserted here dynamically -->
            </div>
        </div>
    </div>

    <!-- "Load More" Button -->
    <div class="text-center my-4">
        <button id="load-more-btn" class="bg-blue-500 text-white px-4 py-2 rounded">Load More</button>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", () => {
            const tabs = document.querySelectorAll(".tab");
            const projectContainers = document.querySelectorAll(".project-container");
            const loadMoreBtn = document.getElementById("load-more-btn");
            let visibleCount = 3; // Number of initially visible projects
            let currentFilter = "all"; // Default filter to show all projects
            // Function to filter and show projects based on the filter and visible count
            function displayProjects() {
                let count = 0; // Count of displayed projects
                projectContainers.forEach((project) => {
                    const projectStatus = project.dataset.status;
                    if (currentFilter === "all" || projectStatus === currentFilter) {
                        if (count < visibleCount) {
                            project.classList.remove("hidden"); // Show the project
                            count++;
                        } else {
                            project.classList.add("hidden"); // Hide extra projects
                        }
                    } else {
                        project.classList.add("hidden"); // Hide non-matching projects
                    }
                });

                // Hide the "Load More" button if there are no more hidden projects
                const hiddenProjects = Array.from(projectContainers).filter(
                    (project) => project.classList.contains("hidden") &&
                                (currentFilter === "all" || project.dataset.status === currentFilter)
                );
                if (hiddenProjects.length === 0) {
                    loadMoreBtn.classList.add("hidden");
                } else {
                    loadMoreBtn.classList.remove("hidden");
                }
            }
            // Function to set the selected tab and filter projects
            function setSelectedTab(selectedTab) {
                tabs.forEach((tab) => {
                    tab.classList.remove("bg-sky-500", "text-white");
                    tab.classList.add("bg-white", "text-black");
                });
                selectedTab.classList.add("bg-sky-500", "text-white");
                selectedTab.classList.remove("bg-white", "text-black");
                currentFilter = selectedTab.getAttribute("data-filter"); // Update the current filter
                visibleCount = 3; // Reset the visible count when changing tabs
                displayProjects(); // Update displayed projects based on new filter
            }
            // Add event listeners to the tabs for filtering
            tabs.forEach((tab) => {
                tab.addEventListener("click", () => {
                    setSelectedTab(tab); // Highlight the tab and filter projects
                });
            });

            // Event listener for "Load More" button    
            loadMoreBtn.addEventListener("click", () => {
                visibleCount += 3; // Show three more projects
                displayProjects(); // Update displayed projects
            });

            // Set initial state
            setSelectedTab(tabs[0]); // Highlight the first tab and initialize filtering
        });

        // Get the modal
        var modal = document.getElementById("myModal");
        var mainModalImage = document.getElementById("mainModalImage");
        var modalThumbnails = document.getElementById("modal-thumbnails");

        // Function to open the modal and set the main image
        function openModal(projectId, src) {
            mainModalImage.src = src;
            modalThumbnails.innerHTML = ''; // Clear previous thumbnails

            // Fetch the project images
            const project = document.querySelector(`.project-container[data-id="${projectId}"]`);
            const images = project.querySelectorAll('img');
            images.forEach((img, index) => {
                const thumbnail = document.createElement('div');
                thumbnail.classList.add('h-24', 'w-24', 'flex-shrink-0', 'mr-2');
                thumbnail.innerHTML = `<img src="${img.src}" alt="thumb" class="w-full h-full object-cover cursor-pointer" onclick="changeModalImage('${img.src}')">`;
                modalThumbnails.appendChild(thumbnail);
            });

            modal.classList.remove("hidden");
        }

        // Function to close the modal
        function closeModal() {
            modal.classList.add("hidden");
        }

        // Function to change the main modal image
        function changeModalImage(src) {
            mainModalImage.src = src;
        }

        // Close the modal when clicking outside of it
        window.onclick = function(event) {
            if (event.target == modal) {
                closeModal();
            }
        }
    </script>
@endsection

