@extends('UserInteractions::layouts.layout')
@section('title', 'Home')   
@section('content')

    <div class="container max-w-full">
        <div class="container-inner">
            <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel" data-interval="5000">
                <ol class="carousel-indicators">
                    @foreach ($projectsCarousel as $index => $projectCarousel)
                        <li data-target="#carouselExampleIndicators" data-slide-to="{{ $index }}"
                            class="{{ $index == 0 ? 'active' : '' }}"></li>
                    @endforeach
                </ol>
                <div class="carousel-inner center h-[80vh]">
                    @foreach ($projectsCarousel as $index => $projectCarousel)
                        <div class="carousel-item w-full h-full relative {{ $index == 0 ? 'active' : '' }}">
                            <div class="absolute top-0 left-0 w-full h-full z-20">
                                <div class="bg-gradient-to-r from-neutral-950 to-neutral-50/10 w-full h-full opacity-50"></div>
                            </div>
                            <img src="{{ asset('storage/' . $projectCarousel->coverPhoto->photo_path) }}"
                                alt="{{ $projectCarousel->name }}" class="absolute w-full h-full object-cover z-10">
                            <div class="content-wrapper z-20">
                                <div class="hotel-name custom-underline mb-2"
                                    style="font-size: 50px; font-family: 'Poppins'">
                                    {{ $projectCarousel->name }}</div>
                                <div class="description" style="font-size: 16px; font-family: 'Poppins', sans-serif;">
                                    {{ $projectCarousel->short_description }}</div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <button class="carousel-control-prev flex items-center justify-center z-20" href="#carouselExampleIndicators"
                    role="button" data-slide="prev">
                    <svg xmlns="http://www.w3.org/2000/svg" width="1.2rem" height="1.2rem" viewBox="0 0 20 20">
                        <path fill="white" d="m4 10l9 9l1.4-1.5L7 10l7.4-7.5L13 1z" />
                    </svg>
                </button>
                <button class="carousel-control-next flex items-center justify-center z-20" href="#carouselExampleIndicators"
                    role="button" data-slide="next">
                    <svg xmlns="http://www.w3.org/2000/svg" width="1.2rem" height="1.2rem" viewBox="0 0 20 20">
                        <path fill="white" d="M7 1L5.6 2.5L13 10l-7.4 7.5L7 19l9-9z" />
                    </svg>
                </button>
                <div class="carousel-timeline z-20"></div>
            </div>
        </div>
    </div>
    <div class="our-service">
        <h1 class="text-white text-4xl half-underline" style="font-family: 'Poppins', sans-serif;">WHY CHOOSE US</h1>
    </div>
    <div class="card-boxes">
        <div class="box overflow-hidden">
            <div class="icon">
                <img src="{{ asset('logos/expertise.svg') }}" alt="icon">
            </div>
            <div class="title">Expertise and Experience</div>
            <div class="content text-gray-500 text-sm text-justify overflow-hidden">
                With years of experience, our team of Civil and Structural engineers brings together a wealth of experience
                and expertise in the stru+al design of buildings We have wide range of experiene from historic structures to
                modern mullistory buildings. Our sound understanding of the structural engineering principles allows us to
                tackle complex structural engineering problems efficiently.
            </div>
        </div>
        <div class="box overflow-hidden">
            <div class="icon">
                <img src="{{ asset('logos/innovate.svg') }}" alt="icon">
            </div>
            <div class="title">Innovative Solutions</div>
            <div class="content text-gray-500 text-sm text-justify">
                Our team is commited to provide you with innovative solutions by staying updated on recent advancement
                in the state of art of structural and earthquake engineering.
            </div>
        </div>
        <div class="box overflow-hidden">
            <div class="icon">
                <img src="{{ asset('logos/services_client.svg') }}" alt="icon">
            </div>
            <div class="title">Comprehensive services</div>
            <div class="content text-gray-500 text-sm text-justify">
                We offer a compressive range of services in the field of structural and earthquake engineering. We provide
                services in new building design, seismic vulnerability assessment, retrofit design, historic structures
                renovation. We are capable of designing structures using wide varitey of materials
                including reinforced concrete, structural steel, light gauge steel, timber, CSEB and bamboo.
            </div>
        </div>
        <div class="box overflow-hidden">
            <div class="icon">
                <img src="{{ asset('logos/safety.svg') }}" alt="icon">
            </div>
            <div class="title">Commited to Safety</div>
            <div class="content text-gray-500 text-sm text-justify">
                Our motto is to create safer societies by designing and constructing safer structures We adhere to highest
                safety standards in design and construction of the structures.
            </div>
        </div>
    </div>
    <div class = "remaining-portion"></div>

    <div id="project-container">
        @foreach (range(1, 10) as $number)
        @foreach ($projects as $key => $project)

            @php
                // Initialize cover photo and other photos
                $coverPhoto = null;
                $otherPhotos = []; // Initialize as an empty array

                // Identify the cover photo and other photos
                foreach ($project->photos as $photo) {
                    if ($photo->is_cover) {
                        $coverPhoto = $photo; // Assign cover photo
                    } else {
                        $otherPhotos[] = $photo; // Append to other photos
                    }
                }
            @endphp

            <!-- Project Section -->
            <div class="project @if ($key != 0) hidden @endif" data-id="{{ $project->id }}">
                <!-- Project Header -->
                <div class="flex justify-between items-center lg:px-24 px-6">
                    <h2 class="text-4xl mb-8 mt-12 half-underline uppercase">FEATURED PROJECT</h2>
                    <div class="buttons">
                        <button class="mx-1 prev-btn text-yellow-500 text-4xl" data-direction="prev">
                            {{-- ⬅️ --}}
                            <
                        </button>
                        <button class="mx-1 next-btn text-yellow-500 text-4xl" data-direction="next">
                            {{-- ➡️ --}}
                            >
                        </button>
                    </div>
                </div>

                <div class="flex flex-col md:flex-row w-full h-screen px-6 md:px-24">
                    <div class="w-full  md:w-1/2 lg:pr-10">
                        <!-- Cover Photo -->
                        <div class="flex flex-col h-96 justify-center pr-0">
                            @if ($coverPhoto)
                                <img src="{{ asset('storage/' . $coverPhoto->photo_path) }}" alt="cover"
                                    class="w-full h-full object-cover cursor-pointer"
                                    onclick="openModal('{{ $project->id }}',
                                     '{{ asset('storage/' . $coverPhoto->photo_path) }}')">
                            @else
                                <p>No cover photo available.</p>
                            @endif
                        </div>

                        <!-- Additional Photos -->
                        <div class="flex flex-row w-full h-[20vh] bg-slate-50 py-2 " id="other-photos-container">
                            @php
                                $otherPhotos = $project->photos->where('is_cover', false);
                                $otherPhotosCount = $otherPhotos->count();
                            @endphp
                            @foreach ($otherPhotos as $index => $photo)
                                <div
                                    @if ($index > 3) class="w-0" 
                                    @elseif($index===3) class="relative w-1/3 mb-2 pr-0"
                                    @else class="relative w-1/3 mb-2 pr-1" @endif>
                                    <img src="{{ asset('storage/' . $photo->photo_path) }}" alt="other"
                                        class="w-full h-full object-cover cursor-pointer z-10"
                                        onclick="openModal('{{ $project->id }}', '{{ asset('storage/' . $photo->photo_path) }}')">

                                    @if ($index === 3)
                                        <div class="absolute inset-0 flex items-center justify-center bg-black bg-opacity-50 cursor-pointer"
                                            onclick="openModal('{{ $project->id }}', '{{ asset('storage/' . $photo->photo_path) }}')">
                                            <span class="text-white text-lg font-bold">
                                                +{{ $otherPhotosCount - 3 }}
                                            </span>
                                        </div>
                                    @endif
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <!-- Project Description -->
                    <div class="w-full md:w-1/2 h-screen overflow-hidden  md:px-8 pb-8">
                        <h2 class="uppercase text-stone-700 font-poppins font-bold text-2xl">
                            <span>{{ $project->name }}</span>
                        </h2>
                        <div class="mt-6 leading-7 h-[70vh] overflow-hidden text-justify text-gray-500">
                            {!! $project->description !!}
                        </div>
                        <div class="flex-1 flex justify-end">
                            <button class="bg-sky-500 text-white rounded-lg px-4 py-4 mt-4">
                                {{-- <a href="{{ route('projects') }}">VIEW ALL PROJECTS</a> --}}
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
        @endforeach
        <!-- Pagination -->
        <div class="pagination flex justify-center">
            @for ($i = 0; $i < count($projects); $i++)
                <button class="mx-2 page-btn {{ $i == 0 ? 'active' : '' }}"
                    data-page="{{ $i }}">{{ $i + 1 }}</button>
            @endfor
        </div>

    </div>

    <div id="myModal"
        class="modal fixed w-[100vw] h-[100vh] z-30 bg-black inset-0 items-center 
    justify-center bg-black bg-opacity-50 hidden">
        <div class="modal-content bg-white w-[100vw] h-[100vh] p-4 bg-gray-500 rounded-lg relative flex flex-col">
            <span class="close absolute top-2 right-4 cursor-pointer text-3xl" onclick="closeModal()">&times;</span>
            <div class="flex-1 flex h-[80vh] justify-center bg-gray-500 items-center">
                <img id="mainModalImage" src="" alt="cover" class="max-w-full max-h-full object-contain">
            </div>
            <div id="modal-thumbnails"
                class="flex w-full h-[20vh] justify-center mt-4 overflow-x-auto overflow-y-hidden space-x-2">
                <!-- Thumbnails will be inserted here dynamically -->
            </div>
        </div>
    </div>

    <!-- Appointment Section -->
    <div class="appointment-section h-32 bg-sky-500 flex justify-between items-center lg:px-24 px-6 ">
        {{-- <div class="text-white text-2xl font-normal">{{ $slogan->slogan }}</div> --}}
        {{-- <button class="bg-white text-black-500 lg:text-base text-sm px-4 py-2 h-12 w-52 rounded"><a href="{{ route('contact') }}">GET
                APPOINTMENT</a></button> --}}
    </div>

    <div class="custom-div">
        <div class="text-4xl ml-24 mt-12 half-underline uppercase ">
            News And Insights
        </div>
        <div class="flex flex-wrap h-screen justify-between gap-10 px-24 pt-14 overflow-hidden"> <!-- Gap between cards -->
            @foreach ($news as $item)
                <div class="relative w-full md:w-1/2 lg:w-1/3 xl:w-1/4 h-full"> <!-- Adjust width based on screen size -->
                    @if ($item->type === 'career')
                        <img src="{{ asset('images/hiring.jpg') }}" alt="News image"
                            class="w-full h-56 rounded-md object-cover">
                    @else
                        <img src="{{ asset('storage/' . $item->photo_path) }}" alt="News image"
                            class="w-full h-56 rounded-md object-cover">
                    @endif <!-- Image with full width -->
                    <div
                        class="absolute top-3 left-3 bg-white px-3 py-1 rounded text-orange-500 text-sm font-bold uppercase">
                        {{ $item->type }}
                    </div>
                    <div class="text-xl font-bold mt-4 "> <!-- Ellipsis to handle overflow -->
                        {{ $item->title }}
                    </div>
                    <div class="text-sm text-orange-500 mt-2"> <!-- Subtitle with author and date -->
                        {{ $item->author }} | {{ $item->created_at->format('M d, Y') }}
                    </div>
                    <div class="text-gray-700 mt-4  h-1/3 overflow-hidden"> <!-- Overflow hidden -->
                        {!! $item->description !!}
                    </div>
                    {{-- <div class="text-orange-500 mt-4"> <!-- Link to the detailed view -->
                        <a href="{{ route('updates', ['newsId' => $item->id]) }}">Read More &gt;</a>
                    </div> --}}
                </div>
            @endforeach
        </div>

        <!-- Flex container to align VIEW ALL button to the bottom-right -->
        {{-- <div class="flex justify-end mt-8 pb-6 px-24"> <!-- Aligns the button to the bottom-right -->
            <a href="{{ route('news') }}" class="bg-sky-500 text-white rounded-lg px-4 py-2">VIEW ALL NEWS</a>
            <!-- CTA button -->
        </div> --}}
    </div>

    <!-- Clients & Partners Section -->
    <div class="mt-8 bg-gray-300 pb-4">
        <!-- Background color and height -->
        <div class="text-4xl uppercase ml-24 half-underline pt-4">
            <!-- Improved heading with border underline -->
            Clients & Partners
        </div>
        <div class="marquee-container px-6 lg:px-28">
            <div class="marquee">
                <div class="marquee-inner">
                    {{-- @foreach ($clients as $client)
                        <img src="{{ asset('images/clients') . '/' . $client->logo_path }}"
                            alt="{{ $client->company_name }}" class="client-logo">
                    @endforeach
                    @foreach ($clients as $client)
                        <img src="{{ asset('images/clients') . '/' . $client->logo_path }}"
                            alt="{{ $client->company_name }}" class="client-logo">
                    @endforeach --}}
                </div>
            </div>
        </div>
    </div>
@endsection
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    $(document).ready(function() {
        const projects = $('.project');
        let currentIndex = 0;

        function showProject(index) {
            projects.addClass('hidden');
            projects.eq(index).removeClass('hidden');

            $('.page-btn').removeClass('active');
            $('.page-btn').eq(index).addClass('active');
        }

        showProject(currentIndex);

        $('.buttons').on('click', 'button', function() {
            const direction = $(this).data('direction');

            if (direction === 'next') {
                currentIndex = (currentIndex < projects.length - 1) ? currentIndex + 1 : 0;
            } else {
                currentIndex = (currentIndex > 0) ? currentIndex - 1 : projects.length - 1;
            }

            showProject(currentIndex);
        });

        $('.pagination').on('click', '.page-btn', function() {
            const pageIndex = $(this).data('page');
            showProject(pageIndex);
        });
    });
</script>

<script>
    $(document).ready(function() {
        function slideCarousel($activeItem, $nextItem) {
            $activeItem.removeClass('active');
            $nextItem.addClass('active').removeClass('prev next');
        }

        function loopCarousel() {
            var $carousel = $('#carouselExampleIndicators');
            var $activeItem = $carousel.find('.carousel-item.active');
            var $nextItem = $activeItem.next('.carousel-item');

            if (!$nextItem.length) {
                $nextItem = $carousel.find('.carousel-item').first();
            }

            slideCarousel($activeItem, $nextItem);
        }

        var interval = setInterval(loopCarousel, 5000);

        $('.carousel-control-prev, .carousel-control-next').click(function() {
            clearInterval(interval);

            var $carousel = $('#carouselExampleIndicators');
            var $activeItem = $carousel.find('.carousel-item.active');
            var $nextItem;

            if ($(this).hasClass('carousel-control-next')) {
                $nextItem = $activeItem.next('.carousel-item');
                if (!$nextItem.length) {
                    $nextItem = $carousel.find('.carousel-item').first();
                }
            } else {
                $nextItem = $activeItem.prev('.carousel-item');
                if (!$nextItem.length) {
                    $nextItem = $carousel.find('.carousel-item').last();
                }
            }

            slideCarousel($activeItem, $nextItem);

            setTimeout(function() {
                interval = setInterval(loopCarousel, 5000);
            }, 0);
        });
    });
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
            const project = document.querySelector(`.project[data-id="${projectId}"]`);
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
