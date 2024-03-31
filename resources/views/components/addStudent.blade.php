<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500&display=swap" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">

    <style>
        /* .popup-container {
    z-index: 50;
    position: fixed;
    top: 0;
    left: 0;
    height: 100vh;
    width: 100vw;
    display: flex;
    align-items: center;
    justify-content: center;
}

.popup-content {
    width: 32rem;
    background-color: #fff;
    padding: 2rem;
    border-radius: 0.75rem;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1), 0 1px 3px rgba(0, 0, 0, 0.08);
}

.form-label {
    display: block;
    margin-bottom: 0.5rem;
    color: #4a5568;
    font-size: 0.875rem;
    font-weight: 600;
}

.form-input {
    width: 100%;
    padding: 0.5rem 0.75rem;
    font-size: 1rem;
    border-radius: 2rem;
    border: 1px solid #e2e8f0;
    transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
}

.form-input:focus {
    outline: none;
    border-color: #FFC254;
    box-shadow: 0 0 0 3px rgba(66, 153, 225, 0.5);
}

.form-button {
    width: 110px;
    padding: 0.5rem 0.75rem;
    font-size: 1rem;
    font-weight: 600;
    color: #fff;
    background-color: #4299e1;
    border: 1px solid transparent;
    border-radius: 0.25rem;
    transition: background-color 0.15s ease-in-out;
}

.form-button:hover {
    background-color: #3182ce;
} */
    </style>
</head>

<body>
    <body>
        <div id="addStudentModal" class="hidden z-50 fixed top-0 left-0 h-screen w-screen bg-gray-900 bg-opacity-50 flex items-center justify-center">
            <div class="popup-content">
                <div class="flex justify-between items-center mb-4">
                    <h1 style="margin-left: 10rem"
                    class="text-xl font-bold text-center">Add Student</h1>
                    <button id="closePopup" type="button" class="p-1 rounded-full transition-all duration-200 ease-in-out hover:bg-gray-200 close cursor-pointer">
                        <svg xmlns="http://www.w3.org/2000/svg" class="text-black transform transition-transform duration-200 ease-in-out hover:rotate-45 hover:text-[#FFC245] h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </button>
                </div>
                
                    <form class="space-y-6" action="{{ route('register') }}" method="POST">
                        @csrf
                        <div class="rounded-xl shadow-sm -space-y-px">
                            <div>
                                <input class="form-input mb-2 text-sm" id="name" name="name" type="text" required class="appearance-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-t-md focus:outline-none focus:ring-yellow-500 focus:border-yellow-500 focus:z-10 sm:text-sm" placeholder="Name">
                            </div>
                            <div>
                                <input class="form-input mb-2 text-sm" id="email" name="email" type="email" required class="appearance-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-b-md focus:outline-none focus:ring-yellow-500 focus:border-yellow-500 focus:z-10 sm:text-sm" placeholder="Email address">
                            </div>
                            <div>
                                <input class="form-input mb-2 text-sm" id="password" name="password" type="password" required class="appearance-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-xl focus:outline-none focus:ring-yellow-500 focus:border-yellow-500 focus:z-10 sm:text-sm" placeholder="Password">
                            </div>
                            <div>
                                <input class="form-input mb-2 text-sm" id="password_confirmation" name="password_confirmation" type="password" required class="appearance-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-xl focus:outline-none focus:ring-yellow-500 focus:border-yellow-500 focus:z-10 sm:text-sm" placeholder="Confirm Password">
                            </div>
                            <div>
                                <input class="form-input mb-2 text-sm" id="phone" name="phone" type="text" required class="appearance-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-xl focus:outline-none focus:ring-yellow-500 focus:border-yellow-500 focus:z-10 sm:text-sm" placeholder="Phone">
                            </div>
                            <div>
                                <input class="form-input mb-2 text-sm" id="address" name="address" type="text" required class="appearance-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-xl focus:outline-none focus:ring-yellow-500 focus:border-yellow-500 focus:z-10 sm:text-sm" placeholder="Address">
                            </div>
                            <div>
                                <input class="form-input mb-2 text-sm" id="national_number" name="national_number" type="text" required class="appearance-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-xl focus:outline-none focus:ring-yellow-500 focus:border-yellow-500 focus:z-10 sm:text-sm" placeholder="National Number">
                            </div>
                            <div>
                                <input class="form-input mb-2 text-sm" id="image" name="image" type="file" class="appearance-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-xl focus:outline-none focus:ring-yellow-500 focus:border-yellow-500 focus:z-10 sm:text-sm">
                            </div>
                        </div>
    
                        <div>
                            <button type="submit" class="group relative w-full flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-xl text-white bg-yellow-600 hover:bg-yellow-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-yellow-500">
                                Register
                            </button>
                        </div>
                    </form>
            </div>
        </div>
    <script>
        function toggleAddStudentModal() {
            var modal = document.getElementById('addStudentModal');
            if (modal.classList.contains('hidden')) {
                modal.classList.remove('hidden');
            } else {
                modal.classList.add('hidden');
            }
        }
        document.getElementById('closePopup').addEventListener('click', function() {
            toggleAddStudentModal();
        });
    </script>
</body>
</html>
