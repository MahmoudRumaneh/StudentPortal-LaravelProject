<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Student Portal - Login</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    
    <style>
        .body-cont {
            background-image: url('/images/bgLogin.jpg');
            background-size: cover;
            background-position: center;
            
        }
    </style>
</head>
<body class="font-sans antialiased dark:bg-black dark:text-white/50">
    @guest
    <div class="body-cont flex flex-col justify-center items-center h-screen">
        <div class="flex flex-col bg-white shadow-md rounded-3xl px-8 pt-6 pb-8 mb-4" style="width: 30rem;"> 
            <div class="flex justify-center">
                <img style="width: 100px;"
                src="/images/logo.png" alt="logo" />
            </div>
            <form class="flex flex-col" method="POST" action="{{ route('login') }}">
                @csrf
                <div class="flex flex-col pt-4">
                    <label class="font-bold" for="email">Email:</label>
                    <input class="mt-3 px-3 py-2 bg-gray-50 border-b border-gray-300 w-full focus:border-b-2 focus:border-[#FFC245] focus:outline-none
                    text-md"
                    type="email" id="email" name="email" required>
                </div>
                <div class="flex flex-col pt-4">
                    <label class="font-bold" for="password">Password:</label>
                    <input class="mt-3 px-3 py-2 bg-gray-50 border-b border-gray-300 w-full focus:border-b-2 focus:border-[#FFC245] focus:outline-none
                    text-md"
                    type="password" id="password" name="password" required>
                </div>
                <div class="mt-10 flex justify-center hover:bg-[#5e2b12]">
                    <button class=""
                    style="background-color: #8A411C; color:white; padding: 2px 5rem; font-size:20px; border-radius:10px;"
                    type="submit">Login</button>
                </div>
            </form>
            <div class="flex flex-row justify-center mt-5">
                <p>Don't have an account?</p>
                <a href="{{ route('register') }}">
                <p style="color:#8A411C; font-weight:bold; padding:0px 6px">Create an account</p>
                </a>
            </div>
        </div>
    </div>
    @endguest
    @auth
        <div class="flex justify-center items-center h-screen" id="lottie-container"
            style="position: absolute; top: 0; bottom: 0; left: 0; right: 0; margin: auto; width: 100%; height: 100%;">
            <script src="https://cdnjs.cloudflare.com/ajax/libs/bodymovin/5.7.10/lottie.min.js"></script>
            <script>
                document.addEventListener('DOMContentLoaded', function () {
                    var animation = bodymovin.loadAnimation({
                        container: document.getElementById('lottie-container'),
                        renderer: 'svg',
                        loop: true,
                        autoplay: true,
                        path: '/lottie/404Page.json'
                    });
                });
            </script>
        </div>
    @endauth

    
</body>
</html>
