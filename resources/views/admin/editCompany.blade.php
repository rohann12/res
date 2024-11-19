{{-- @extends('layouts.app')

@section('content') --}}
{{-- <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Edit Company</div>
                <div class="card-body">
                    <form method="POST" action="{{ route('updateCompany', ['id' => $company->id]) }}"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="form-group">
                            <label for="name">Name:</label>
                            <input id="name" type="text" class="form-control" name="name" value="{{ $company->name }}">
                        </div>

                        <div class="form-group">
                            <label for="slogan">Slogan:</label>
                            <input id="slogan" type="text" class="form-control" name="slogan"
                                value="{{ $company->slogan }}">
                        </div>

                        <div class="form-group">
                            <label for="logo">Logo:</label><br>
                            @if ($company->logo)
                            <img src="{{ asset('images/' . $company->logo) }}" alt="Company Logo"
                                style="max-width: 500px;"><br><br>
                            @endif
                            <input id="logo" type="file" class="form-control" name="logo"><br>

                        </div>

                        <div class="form-group">
                            <label for="welcome_text">Welcome Text:</label>
                            <textarea id="welcome_text" class="form-control"
                                name="welcome_text">{{ $company->welcome_text }}</textarea>
                        </div>

                        <div class="form-group">
                            <label for="description">Description:</label>
                            <textarea id="description" class="form-control"
                                name="description">{{ $company->description }}</textarea>
                        </div>

                        <div class="form-group">
                            <label for="email">Email:</label>
                            <input id="email" type="email" class="form-control" name="email"
                                value="{{ $company->email }}">
                        </div>

                        <div class="form-group">
                            <label for="contact">Contact:</label>
                            <input id="contact" type="text" class="form-control" name="contact"
                                value="{{ $company->contact }}">
                        </div>

                        <div class="form-group">
                            <label for="address">Address:</label>
                            <input id="address" type="text" class="form-control" name="address"
                                value="{{ $company->address }}">
                        </div>

                        <div class="form-group">
                            <label for="fbLink">Facebook Link:</label>
                            <input id="fbLink" type="text" class="form-control" name="fbLink"
                                value="{{ $company->fbLink }}">
                        </div>

                        <div class="form-group">
                            <label for="instaLink">Instagram Link:</label>
                            <input id="instaLink" type="text" class="form-control" name="instaLink"
                                value="{{ $company->instaLink }}">
                        </div>

                        <div class="form-group">
                            <label for="linkedInLink">LinkedIn Link:</label>
                            <input id="linkedInLink" type="text" class="form-control" name="linkedInLink"
                                value="{{ $company->linkedInLink }}">
                        </div>

                        <button type="submit" class="btn btn-primary">Update Company</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div> --}}
{{-- @endsection --}}

@extends('layouts.adminLayout')
@section('heading', 'Company Details')
@section('subheading', 'Edit company details')
@section('title', 'Details')
@section('content')
    <form class="px-4 pt-3 pb-4 mt-2" method="POST" action="{{ route('company.update', ['id' => $company->id]) }}">
        @csrf
        @method('PUT')
        <div class="flex flex-col space-y-4">
            <!-- First 3 elements in a single row -->
           
                <div class="flex flex-col w-full">
                    <label for="description" class="block text-gray-700 text-sm font-bold mb-2">Company Description</label>
                    <textarea id="description" rows="6" name="description" required
                        class="border rounded-md py-2 w-full px-3 text-gray-700 mt-1 mb-1 focus:outline-none focus:ring focus:ring-blue-400">{{ $company->description }}</textarea>
                </div>
                <div class="flex flex-col w-full">
                    <label for="welcome_text" class="block text-gray-700 text-sm font-bold mb-2">Welcome Text</label>
                    <textarea id="welcome_text" rows="2" name="welcome_text" required
                        class="border rounded-md py-2 w-full px-3 text-gray-700 mt-1 mb-1 focus:outline-none focus:ring focus:ring-blue-400">{{ $company->welcome_text }}</textarea>
                </div>
                <div class="flex flex-col w-full">
                    <label for="slogan" class="block text-gray-700 text-sm font-bold mb-2">Slogan</label>
                    <textarea id="slogan" rows="2" name="slogan" required
                        class="border rounded-md py-2 w-full px-3 text-gray-700 mt-1 mb-1 focus:outline-none focus:ring focus:ring-blue-400">{{ $company->slogan }}</textarea>
                </div>
            </div>
        
            <!-- Remaining elements in two-column layout -->
            <div class="flex flex-row mb-2 space-x-4">
                <div class="flex flex-col w-1/2">
                    <label for="address" class="block text-gray-700 text-sm font-bold mb-2">Address</label>
                    <input type="text" name="address" id="address" required value="{{ $company->address }}"
                        class="border rounded-md py-2 px-3 text-gray-700 mt-1 mb-1 focus:outline-none focus:ring focus:ring-blue-400">
                </div>
                <div class="flex flex-col w-1/2">
                    <label for="contact" class="block text-gray-700 text-sm font-bold mb-2">Phone</label>
                    <input type="text" name="contact" id="contact" required value="{{ $company->contact }}"
                        class="border rounded-md py-2 px-3 text-gray-700 mt-1 mb-1 focus:outline-none focus:ring focus:ring-blue-400">
                </div>
            </div>        
          
            <div class="flex flex-row mb-2 space-x-4">
                <div class="flex flex-col w-1/2">
                    <label for="email" class="block text-gray-700 text-sm font-bold mb-2">Email</label>
                    <input type="email" name="email" id="email" required value="{{ $company->email }}"
                        class="border rounded-md py-2 px-3 text-gray-700 mt-1 mb-1 focus:outline-none focus:ring focus:ring-blue-400">
                </div>              
                <div class="flex flex-col w-1/2">
                        <label for="fbLink" class="block text-gray-700 text-sm font-bold mb-2">Facebook URL</label>
                        <input type="text" name="fbLink" id="fbLink" required value="{{ $company->fbLink }}"
                            class="border rounded-md py-2 px-3 text-gray-700 mt-1 mb-1 focus:outline-none focus:ring focus:ring-blue-400">
                </div>
            </div>
            <div class="flex flex-row mb-2 space-x-4">
                <div class="flex flex-col w-1/2">
                    <label for="instaLink" class="block text-gray-700 text-sm font-bold mb-2">Instagram URL</label>
                    <input type="text" name="instaLink" id="instaLink" required value="{{ $company->instaLink }}"
                        class="border rounded-md py-2 px-3 text-gray-700 mt-1 mb-1 focus:outline-none focus:ring focus:ring-blue-400">
                </div>
               
          
                <div class="flex flex-col w-1/2">
                    <label for="linkedInLink" class="block text-gray-700 text-sm font-bold mb-2">LinkedIn URL</label>
                    <input type="text" name="linkedInLink" id="linkedInLink" required value="{{ $company->linkedInLink }}"
                        class="border rounded-md py-2 px-3 text-gray-700 mt-1 mb-1 focus:outline-none focus:ring focus:ring-blue-400">
                </div>
               
            </div>
        </div>
        
        <div class="flex flex-row gap-x-3 mb-12">
            <button onclick="window.history.back()"
                class="w-1/2 border border-grey-400 text-black py-2 px-4 rounded-md hover:border-gray-700 cursor-pointer">
                Cancel
            </button>
    
            <input type="submit" value="Save"
                class="w-1/2 bg-sky-500 text-white py-2 px-4 rounded-md hover:bg-sky-600 cursor-pointer">
    
        </div>
    </form>

    <script>
        ClassicEditor
                     .create(document.querySelector('#description'))
                     .catch(error => {
                         console.error(error);
                     });
     </script>
@endsection
