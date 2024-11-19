<div id="project-container">
    @foreach ($projects as $project)
        {{-- Flex col for project name, images, and description --}}
        <div class="flex flex-col w-full h-screen ml-8 px-6 pb-8 overflow-x-hidden" data-status="all">
            {{-- Project name --}}
            <div class="h-10" id="project-title">
                <h2 class="uppercase text-stone-700 font-poppins font-medium text-xl leading-7 tracking-wide">
                    <span class="border-b-2 border-yellow-500">{{ $project->name }}</span>
                </h2>
            </div>
            {{-- Images --}}
            <div class="flex h-3/4 flex-row w-full" id="project-photos">

                @php
                    $coverPhoto = null;
                    $otherPhotos = [];

                    // Separate cover photo from other photos
                    foreach ($project->photos as $photo) {
                        if ($photo->is_cover) {
                            $coverPhoto = $photo;
                        } else {
                            $otherPhotos[] = $photo;
                        }
                    }
                @endphp
                {{-- main image --}}

                @if ($coverPhoto)
                    <div class="flex h-full w-5/6 px-12 justify-center" id="cover-photo">
                        <img src="{{ asset('storage/' . $coverPhoto->photo_path) }}" alt="cover"
                            class="max-h-full  max-w-full ">
                    </div>
                @endif
                {{-- small images in loop --}}
                <div class="flex flex-col ml-2 w-1/6 bg-slate-50 overflow-y-scroll"
                    id="other-photos-container">

                    @foreach ($otherPhotos as $photo)
                        <div class="h-1/3 bg-black" id="other-photos"><img
                                src="{{ asset('storage/' . $photo->photo_path) }}" alt="other"
                                class="h-full w-full">
                        </div>
                    @endforeach
                </div>
            </div>
            {{-- Project description --}}
            <div class="w-full mt-6 bg-orange-50" id="project-description">
                {{ $project->description }}
            </div>
        </div>
    @endforeach
</div>

<div id="pagination-links">
    {{ $projects->links() }}
</div>
