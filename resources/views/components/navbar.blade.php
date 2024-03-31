@php
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
@endphp

<div class="fixed top-0 left-0 w-full z-20">
    <div style="background-color: #FFC254;"
    class="pt-2 flex firstPiece items-center space-x-2 sticky bg101B0B">
        <a style="cursor: pointer">
            <img style="width: 120px"
            src="/images/logo.png" onclick="handleImageClick()" class="2xs:pl-4 sm:pl-6 md:pl-10 xl:pl-10" alt="logo" />
        </a>

        <div class="flex justify-end text-[#FFC245] w-full xl:space-x-8 xl:pr-10  xl:text-[16px] md:space-x-4 md:pr-10  2xs:space-x-2 2xs:pr-4 2xs:text-xs">
            @guest
                <button class="font-bold" onclick="setShowLoginModal(true)">Login</button>
            @endguest
            
            @guest
                <a onclick="changeActivePage('registerCustomer')" href="/pages/customerSignup">Register</a>
            @else
                <form id="logoutForm" action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button class="font-bold mt-4 text-lg px-2 hover:text-white hover:bg-red-800 rounded-xl" onclick="logout()">Logout</button>
                </form>
            @endguest
        </div>
    </div>
    <svg style="margin-top: -20px" class="secondPiece" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 80">
        <path fill="#FFC254" fill-opacity="1" d="M0,40L60,40C120,40,240,40,360,36C480,32,600,24,720,28C840,32,960,64,1080,68C1200,72,1320,64,1380,62L1440,60L1440,0L1380,0C1320,0,1200,0,1080,0C960,0,840,0,720,0C600,0,480,0,360,0C240,0,120,0,60,0L0,0Z"></path>
    </svg>
</div>

<script>

    function logout() {
        document.getElementById('logoutForm').submit();
    }

</script>
