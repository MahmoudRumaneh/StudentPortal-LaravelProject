<!-- resources\views\auth\register.blade.php -->
@if(session('status'))
    <div>{{ session('status') }}</div>
@endif
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Student Portal - Register</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    <style>
        body {
            background-image: url('/images/registerbg.jpg');
            background-size: cover;
            background-position: center;
            
        }
    </style>
</head>
<body class="font-sans antialiased dark:bg-black dark:text-white/50">

<div class="flex flex-col justify-center items-center h-screen">
    <div class="flex flex-col bg-white shadow-md rounded-3xl px-8 pt-6 pb-8 mb-4" style="width: 30rem;"> 
        <div class="flex justify-center">
            <img style="width: 100px;"
            src="/images/logo.png" alt="logo" />
        </div>
        <form class="flex flex-col" method="POST" action="{{ route('register') }}">
            @csrf

            <div class="flex flex-col pt-4">
                <label class="font-bold" for="name">Name</label>
                <input  class="mt-3 px-3 py-2 bg-gray-50 border-b border-gray-300 w-full focus:border-b-2 focus:border-[#FFC245] focus:outline-none
                text-md"
                id="name" type="text" name="name" value="{{ old('name') }}" required autofocus>
                @error('name')
                    <div>{{ $message }}</div>
                @enderror
            </div>

            <div class="flex flex-col pt-4">
                <label class="font-bold" for="email">Email</label>
                <input  class="mt-3 px-3 py-2 bg-gray-50 border-b border-gray-300 w-full focus:border-b-2 focus:border-[#FFC245] focus:outline-none
                text-md"
                id="email" type="email" name="email" value="{{ old('email') }}" required>
                @error('email')
                    <div>{{ $message }}</div>
                @enderror
            </div>

            <div class="flex flex-col pt-4">
                <label class="font-bold" for="password">Password</label>
                <input  class="mt-3 px-3 py-2 bg-gray-50 border-b border-gray-300 w-full focus:border-b-2 focus:border-[#FFC245] focus:outline-none
                text-md"
                id="password" type="password" name="password" required>
                @error('password')
                    <div>{{ $message }}</div>
                @enderror
            </div>

            <div class="flex flex-col pt-4">
                <label class="font-bold" for="password_confirmation">Confirm Password</label>
                <input  class="mt-3 px-3 py-2 bg-gray-50 border-b border-gray-300 w-full focus:border-b-2 focus:border-[#FFC245] focus:outline-none
                text-md"
                id="password_confirmation" type="password" name="password_confirmation" required>
                @error('password_confirmation')
                    <div>{{ $message }}</div>
                @enderror
            </div>

            <div class="mt-10 flex justify-center hover:bg-[#5e2b12]">
                <button  style="background-color: #8A411C; color:white; padding: 2px 5rem; font-size:20px; border-radius:10px;"
                type="submit">Register</button>
            </div>
        </form>
        <div class="flex flex-row justify-center mt-5">
            <p>Already have an account?</p>
            <a href="{{ route('login') }}">
            <p style="color:#8A411C; font-weight:bold; padding:0px 6px">Login here</p>
            </a>
        </div>

    </div>

</div>
