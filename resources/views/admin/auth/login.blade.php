@extends('layouts.adminVerificationLayout')
@section('heading','Login')
@section('content')
<h1 class="lg:text-sky-500 text-4xl font-bold mb-10">Login</h2>

    <form action="{{ route('loginPost') }}" method="post" class="flex flex-col gap-4">
        @csrf
        @method('post')
        <div>
            <label for="email" class="block mb-2 text-sm font-medium text-gray-900">Email</label>
            <input type="text" name="email" id="email"
                class="border border-gray-500 text-gray-900 text-sm rounded-lg focus:ring-sky-500 
                focus:border-sky-500 block w-full p-2.5"
                required value="{{ old('email') }}">
        </div>
        
        <div>
            <label for="password" class="block mb-2 text-sm font-medium text-gray-900">Password</label>
            <input type="password" name="password" id="password"
                class="border border-gray-500 text-gray-900 text-sm rounded-lg focus:ring-sky-500 focus:border-sky-500 block w-full p-2.5"
                required value="">
        </div>             

        <div>
            <span class='forgot'><a href="{{route('password.request')}}" class=" text-black lg:text-sky-500 font-bold">Forgot Password?</a></span>
        </div>
        <div>
            <input type="checkbox" class="form-check-input  rounded" id="rememberMe" name="rememberMe">
            <label class="form-check-label" for="exampleCheck1">Remember Me</label>
        </div >
        <button type="submit" class="w-full bg-sky-500 py-3 rounded-md text-white font-base" >Login</button>
    </form>
@endsection