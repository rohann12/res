@extends('layouts.layout')
@section('title', 'Updates')
@section('content')
    <div class="flex flex-row items-center justify-between h-24 w-full bg-gray-100 px-4 pl-28 pr-10">
        <h2 class="font-bold text-3xl text-gray-700 w-3/4">{{ $item->title }}</h2>
        <span class="capitalize">Home <span class="text-yellow-500">|</span> {{ $item->type }}</span>
    </div>
    <div class="flex flex-col md:flex-row min-h-screen w-full overflow-y-visible py-8  md:pl-28 md:pr-10">
        <div class="flex flex-col w-full md:w-3/5 h-screen">
            <div class="h-96 w-full bg-gray-100 relative overflow-hidden">                
                    @if ($item->type === 'career')
                        @if ($item->photos->isNotEmpty())
                            @php
                                $photo = $item->photos->first();
                            @endphp
                            @if (pathinfo($photo->photo_path, PATHINFO_EXTENSION) === 'pdf')
                                <embed src="{{ asset('storage/' . $photo->photo_path) }}" type="application/pdf"
                                    style="height: 60vh; width:100%;">
                            @endif
                        @endif
                    @else
                        <div class="images-container flex w-full h-full justify-center">
                            @foreach ($item->photos as $index => $photo)
                                <img src="{{ asset('storage/' . $photo->photo_path) }}" alt=""
                                    style=" height:100%; object-fit: cover; @if ($index > 0) display:none; @endif">
                            @endforeach
                        </div>
                    @endif
                
                <div @if ($item->type === 'career') class="z-0 hidden" @else class="navigation-buttons absolute top-0 bottom-0 flex justify-between items-center w-full" @endif>
                    
                
                    <button onclick="prevImage()" class="px-4 py-2 bg-gray-800 text-white border-2 border-white"><i
                            class="fas fa-chevron-left"></i></button>
                    <button onclick="nextImage()" class="px-4 py-2 bg-gray-800 text-white border-2 border-white"><i
                            class="fas fa-chevron-right"></i></button>
                </div>
            </div>
            <div class="min-h-1/2 w-full mt-4">
                <div class="w-4/5 flex flex-col">
                    <div class="h-1/6 uppercase">{{ $item->title }}</div>
                    <div class="flex flex-row h-1/6 text-yellow-500">
                        <div>By {{ $item->author }}</div>
                        <div class="px-4">|</div>
                        <div>{{ $item->created_at->format('M-d-y') }}</div>
                    </div>
                </div>
                <div class="mt-6 text-justify">
                    {!! $item->description !!}
                </div>
            </div>
        </div>
        <div class="flex flex-col w-full md:w-2/5 h-[80vh] mr-16 ms-4">
            <div class="h-10">
                <h2 class="uppercase font-poppins font-normal text-xl leading-7 tracking-wide">
                    <span class="border-b-2 border-yellow-500">{{ $item->type }} Stream</span>
                </h2>
            </div>
            @foreach ($others as $otherItem)
                <div class="flex flex-row mt-4 w-full h-[13vh] ">
                    <div class="w-2/5 h-full">
                        @if ($item->type === 'career')
                            <img src="{{ asset('images/hiring.jpg') }}" alt="" class="w-full h-full object-cover">
                        @else
                            <img src="{{ asset('storage/' . $otherItem->photo_path) }}" alt=""
                                class="w-full h-full object-cover">
                        @endif
                    </div>
                    <div class="flex flex-col w-4/5 h-full ml-5">
                        <a href="{{ route('updates', ['newsId' => $otherItem->id]) }}">
                            <div class="text-lg font-bold">{{ $otherItem->title }}</div>
                        </a>
                        <div class="flex flex-row items-end text-yellow-500">
                            <div>{{ $otherItem->author }}</div>
                            <div class="px-4">|</div>
                            <div>{{ $otherItem->created_at->format('M-d-y') }}</div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    <script>
        let currentImageIndex = 0;
        const images = document.querySelectorAll('.images-container img');
        const prevButton = document.querySelector('.navigation-buttons button:first-child');
        const nextButton = document.querySelector('.navigation-buttons button:last-child');

        function showImage(index) {
            images.forEach((img, i) => {
                if (i === index) {
                    img.style.display = 'block';
                } else {
                    img.style.display = 'none';
                }
            });

            // Update visibility of prev and next buttons
            if (images.length <= 1) {
                prevButton.style.display = 'none';
                nextButton.style.display = 'none';
            } else {
                prevButton.style.display = 'block';
                nextButton.style.display = 'block';
            }
        }

        function prevImage() {
            currentImageIndex = (currentImageIndex - 1 + images.length) % images.length;
            showImage(currentImageIndex);
        }

        function nextImage() {
            currentImageIndex = (currentImageIndex + 1) % images.length;
            showImage(currentImageIndex);
        }

        // Initially hide prev and next buttons if there's only one image
        if (images.length <= 1) {
            prevButton.style.display = 'none';
            nextButton.style.display = 'none';
        }
    </script>

@endsection
