<div class="sidebar w-72 h-full  border-r border-gray-200">
    <div class="h-20 border-b border-gray-200">
        <span class="text-2xl cursor-pointer h-full">
            <img src="{{ asset('images/logo.png') }}" alt="icon" class="h-full ps-8 py-3">
        </span>
    </div>
    <div class="flex flex-row items-center h-20 ps-8">
        <div class=" h-10 w-10 rounded-full bg-red-200">
            <img src="{{ asset('storage/' . Auth::user()->photo_path) }}" alt="Profile Photo"
                onerror="this.onerror=null;this.src='{{ asset('images/minesh.jpg') }}';" class="rounded-full"
                style="height:100%;width:100%;object-fit:cover;">
        </div>
        <div class="flex flex-col ml-4">
            <h3 class="font-bold text-sm ">{{ Auth::user()->full_name }}</h3>
            <span class="text-gray-300 text-sm">@ {{ Auth::user()->user_name }}</span>
        </div>
    </div>

    <div id="sidebar" class="flex flex-col gap-y-1 mt-4 sidebar-links text-gray-500 ">
        <div class="flex items-center h-12 ">
            <a href="{{ route('news.index') }}" class="flex flex-row items-center gap-3 w-full py-4 px-8">
                <object type="image/svg+xml" data="{{ asset('logos/news.svg') }}"></object>
                News and Updates</a>
        </div>
        <div class="flex items-center  h-12">
            <a href="{{ route('project.index') }}" class="flex flex-row items-center gap-3 w-full py-4 px-8">
                <object type="image/svg+xml" data="{{ asset('logos/projects.svg') }}"></object>
                Projects</a>
        </div>
        <div class="flex items-center  h-12">
            <a href="{{ route('employees.index') }}" class="flex flex-row items-center gap-3 w-full py-4 px-8">
                <object type="image/svg+xml" data="{{ asset('logos/employees.svg') }}"></object>
                Employee Update</a>
        </div>
        <div class="flex items-center  h-12">
            <a href="{{ route('client.index') }}" class="flex flex-row items-center gap-3 w-full py-4 ps-8">
                <object type="image/svg+xml" data="{{ asset('logos/clients-and-partners.svg') }}"></object>
                Clients and Partners</a>
        </div>
        <div class="flex items-center  h-12">
            <a href="{{ route('service.index') }}" class="flex flex-row items-center gap-3 w-full py-4 px-8">
                <object type="image/svg+xml" data="{{ asset('logos/services.svg') }}"></object>
                Service</a>
        </div>
        {{-- <div class="flex items-center  h-12">
            <a href="{{ route('careers.index') }}" class="flex flex-row items-center gap-3 w-full py-4 px-8">
                <object type="image/svg+xml" data="{{ asset('logos/careers.svg') }}"></object>
                Careers</a>
        </div> --}}
        {{-- <div class="flex items-center h-12">
            <a href="{{ route('message.index') }}"
                class="flex flex-row items-center gap-3 w-full py-4 px-8">
                <object type="image/svg+xml" data="{{ asset('logos/company-details.svg') }}"></object>
                Messages</a>
y        </div> --}}
        <div class="flex items-center h-12">
            <a href="{{ route('company.index', ['id' => 1]) }}"
                class="flex flex-row items-center gap-3 w-full py-4 px-8">
                <object type="image/svg+xml" data="{{ asset('logos/company-details.svg') }}"></object>Company
                Details</a>
        </div>

    </div>
</div>
