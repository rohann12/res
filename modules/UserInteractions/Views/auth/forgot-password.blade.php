@extends('layouts.adminVerificationLayout')
@section('heading','Login')
@section('content')
    @if (session('status'))
        <div>
            {{ session('status') }}
        </div>
    @endif
    <h1 class="text-sky-500 text-4xl font-bold mb-10">Reset Password</h2>

        <form action="{{ route('password.email') }}" method="post" class="flex flex-col gap-4">
            @csrf
            @method('post')
            <div>
                <label for="email" class="block mb-2 text-sm font-medium text-gray-900">Email</label>
                <input type="text" name="email" id="email"  value="{{ old('email') }}" required autofocus
                    class="border border-sky-500 text-gray-900 text-sm rounded-lg focus:ring-sky-500 focus:border-sky-500 block w-full p-2.5"
                    >
                    @error('email')
                    <span>{{ $message }}</span>
                @enderror
            </div>
          
    
           
                         
    
           
            <button type="submit" class="w-full bg-sky-500 py-3 rounded-md text-white font-base" >Send Password Reset Link</button>
        </form>
        @endsection
    {{-- <form method="POST" action="{{ route('password.email') }}">
        @csrf

        <div>
            <label for="email">Email</label>
            <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus>
            @error('email')
                <span>{{ $message }}</span>
            @enderror
        </div>

        <div>
            <button type="submit">Send Password Reset Link</button>
        </div>
    </form> --}}

