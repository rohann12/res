@extends('UserInteractions::layouts.layout')
@section('title', 'News & Insights')
@section('content')

    <div class="flex flex-row h-24 w-full bg-gray-100">
        <h2
            class="flex h-full capitalize text-stone-700 font-poppins font-medium text-4xl leading-7 tracking-wide 
            px-6 lg:px-28 items-center">
            <span>News and insight</span>
        </h2>
    </div>

    <!-- Tab Buttons for Filtering -->
    <div class="flex justify-between lg:justify-center mt-6 mb-6 px-0 lg:px-28 z-30">
        <button class="tab py-4 lg:px-6 lg:mx-4 border border-sky-500 bg-sky-500 text-white z-30" data-filter="all">All
            ({{ $allCount }})</button>
        <button class="tab py-4 lg:px-6 lg:mx-4 border border-sky-500 bg-white text-black z-30" data-filter="news">News
            ({{ $newsCount }})</button>
        <button class="tab py-4 lg:px-6 lg:mx-4 border border-sky-500 bg-white text-black z-30" data-filter="article">Article
            ({{ $articleCount }})</button>
        <button class="tab py-4 lg:px-6 lg:mx-4 border border-sky-500 bg-white text-black z-30" data-filter="blog">Blog
            ({{ $blogCount }})</button>
        <button class="tab py-4 lg:px-6 lg:mx-4 border border-sky-500 bg-white text-black z-30" data-filter="career">Careers
            ({{ $careerCount }})</button>
    </div>

    <div id="project-list" class="flex flex-col pb-8">
        @foreach ($all as $index => $item)
            <div class="project-container flex flex-col h-[20vh] lg:h-[40vh] bg-gray-100 mx-2 lg:mx-28 p-8 
            py-2 mb-4 overflow-hidden{{ $index >= 4 ? 'hidden' : '' }}"
                data-status="{{ strtolower($item->type) }}">
                <div class="flex flex-row lg:ml-6 mr-8 h-full " id="singleContainer">
                    <div class="w-1/4 h-full relative" id="photoContainer">

                        @if ($item->type === 'career')
                            <img src="{{ asset('images/hiring.jpg') }}" alt=""
                                class="w-full h-full object-cover rounded-lg">
                        @else
                            <img src="{{ asset('storage/' . $item->coverPhoto->photo_path) }}" alt=""
                                class="w-full h-full object-cover rounded-lg">
                        @endif
                        <div class="absolute uppercase top-4 px-3 py-1 bg-white text-yellow-500">{{ $item->type }} </div>
                    </div>
                    <div class="w-3/4 flex h-ful flex-col ml-5 justify-center" id="titleDescContainer">
                        <div class="flex h-1/6 uppercase pt-4 text-xl font-bold">{{ $item->title }}</div>
                        <div class="flex items-center flex-row h-1/6 text-sm text-yellow-500">
                            <div>{{ $item->author }}</div>
                            <div class="px-4">|</div>
                            <div>{{ $item->created_at->format('M-d-y') }}</div>
                        </div>
                        <div class="flex h-3/6 overflow-y-hidden text-sm text-justify leading-6">
                            {!! $item->description !!}
                        </div>

                        <div class="h-1/6 text-xs pt-2 text-yellow-500"><a
                                href="{{ route('updates', ['newsId' => $item->id]) }}">Read More &gt;</a></div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <!-- "Load More" Button -->
    <div class="text-center my-4">
        <button id="load-more-btn" class="bg-sky-500 text-white px-4 py-2 rounded">Load More</button>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", () => {
            const tabs = document.querySelectorAll(".tab");
            const projectContainers = document.querySelectorAll(".project-container");
            const loadMoreBtn = document.getElementById("load-more-btn");

            let visibleCount = 5; // Number of initially visible items
            let currentFilter = "all"; // Default filter to show all items

            // Function to filter and show items based on the filter and visible count
            function displayProjects() {
                let count = 0; // Count of displayed items

                projectContainers.forEach((project) => {
                    const projectStatus = project.dataset.status;

                    if (currentFilter === "all" || projectStatus === currentFilter) {
                        if (count < visibleCount) {
                            project.classList.remove("hidden"); // Show the item
                            count++;
                        } else {
                            project.classList.add("hidden"); // Hide extra items
                        }
                    } else {
                        project.classList.add("hidden"); // Hide non-matching items
                    }
                });

                // Hide the "Load More" button if there are no more hidden items
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

            // Function to set the selected tab and filter items
            function setSelectedTab(selectedTab) {
                tabs.forEach((tab) => {
                    tab.classList.remove("bg-sky-500", "text-white");
                    tab.classList.add("bg-white", "text-black");
                });

                selectedTab.classList.add("bg-sky-500", "text-white");
                selectedTab.classList.remove("bg-white", "text-black");

                currentFilter = selectedTab.getAttribute("data-filter"); // Update the current filter
                visibleCount = 5; // Reset the visible count when changing tabs
                displayProjects(); // Update displayed items based on new filter
            }

            // Add event listeners to the tabs for filtering
            tabs.forEach((tab) => {
                tab.addEventListener("click", () => {
                    setSelectedTab(tab); // Highlight the tab and filter items
                });
            });

            // Event listener for "Load More" button
            loadMoreBtn.addEventListener("click", () => {
                visibleCount += 5; // Show five more items
                displayProjects(); // Update displayed items
            });

            // Set initial state
            setSelectedTab(tabs[0]); // Highlight the first tab and initialize filtering
        });
    </script>

@endsection
