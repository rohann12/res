<!-- Main Container -->
<div class="flex items-center justify-center h-full mb-10">
    <!-- Inner Container -->
    <!-- Close button -->
    
    <div class="bg-white flex flex-col w-full h-full overflow-auto rounded-lg shadow-lg">
        <div class="flex flex-col bg-sky-500 p-6 rounded-t-lg">
            <div class="flex flex-row items-center justify-between">
                <!-- Left side with photo and details -->
                <div class="flex flex-row items-center"> <!-- Aligns items in a row -->
                    <img src="{{ asset('images/employees/' . $employee->photo_url) }}" alt=""
                        class="h-40 w-40 rounded-lg mr-6 object-cover"> <!-- Employee photo -->
                    <div class="flex flex-col justify-center">
                        <div class="text-xl font-bold text-white">{{ $employee->name }}</div> <!-- Employee name -->
                        <div class="text-lg text-white">{{ $employee->position }}</div> <!-- Employee position -->
                    </div>
                </div>
        
                <!-- Right side with close button -->
                <div class="flex justify-end"> <!-- Ensure close button is on the right -->
                    <button onclick="closeModal()" class="text-white hover:text-gray-700 text-2xl">✖</button>
                </div>
            </div>
        </div>

        <!-- Orange Divider Line -->
        <div class="h-1 bg-orange-500 mt-2"></div>

        <!-- Description Section -->
        <div class="flex justify-center mt-6">
            <div class="w-4/5 text-justify text-gray-600 text-lg leading-7">
                {!! $employee->description !!}
            </div>
        </div>

        <!-- Horizontal Divider -->
        <div class="h-1 bg-gray-200 mt-6"></div>

        <!-- Information and Socials -->
        <div class="flex justify-between mt-6 mb-6 px-8">
            <!-- Information Section -->
            <div class="flex flex-col text-gray-700 space-y-4">
                <div class="text-lg font-bold">Information</div>
                <div><i class="fa fa-envelope" aria-hidden="true"></i> {{ $employee->email }}</div>
                <div><i class="fa fa-phone" aria-hidden="true"></i> {{ $employee->phone }}</div>
                <div><i class="fa fa-calendar" aria-hidden="true"></i> Joined {{ $employee->joined_date }}</div>
            </div>

            <!-- Socials Section -->
            <div class="flex flex-col text-gray-700 space-y-4">
                <div class="text-lg font-bold">Socials</div>
                <div>
                    <i class="fa fa-facebook-square"></i> <a href="{{ $employee->fb_link }}" class="hover:text-blue-600">Facebook</a>
                </div>
                <div>
                    <i class="fa fa-linkedin-square"></i> <a href="{{ $employee->linkedin_link }}" class="hover:text-blue-600">LinkedIn</a>
                </div>
                <div>
                    <i class="fa fa-instagram"></i> <a href="{{ $employee->insta_link }}" class="hover:text-pink-600">Instagram</a>
                </div>
            </div>
        </div>
    </div>
</div>
