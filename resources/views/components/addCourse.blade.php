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
        .popup-container {
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
        .form-input {
            width: 100%;
            padding: 0.5rem 0.75rem;
            font-size: 1rem;
            border-radius: 0.25rem;
            border: 1px solid #e2e8f0;
            transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
        }
        .form-input:focus {
            outline: none;
            border-color: #D97706;
            box-shadow: 0 0 0 1px #D97706;
        }
    </style>
</head>
<body>
    <div id="addCourseModal" class="hidden z-50 fixed top-0 left-0 h-screen w-screen bg-gray-900 bg-opacity-50 flex items-center justify-center">
        <div class="popup-content">
            <div class="flex justify-between items-center mb-4">
                <h1 style="margin-left: 10rem"
                class="text-xl font-bold text-center">Add Course</h1>
                <button id="closeCoursePopup" type="button" class="p-1 rounded-full transition-all duration-200 ease-in-out hover:bg-gray-200 close cursor-pointer">
                    <svg xmlns="http://www.w3.org/2000/svg" class="text-black transform transition-transform duration-200 ease-in-out hover:rotate-45 hover:text-[#FFC245] h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>
            <form class="space-y-6" action="{{ route('createCourse') }}" method="POST">
                @csrf
                <div class="rounded-md shadow-sm -space-y-px">
                    <div>
                        <input class="form-input mb-2 text-sm" id="name" name="name" type="text" required placeholder="Name">
                    </div>
                    <div>
                        <input class="form-input mb-2 text-sm" id="theoretical_section" name="theoretical_section" type="text" required placeholder="Theoretical section">
                    </div>
                    <div>
                        <input class="form-input mb-2 text-sm" id="practical_section" name="practical_section" type="text" required placeholder="Practical section">
                    </div>
                    <div>
                        <input class="form-input mb-2 text-sm" id="lecture_time_and_room_number" name="lecture_time_and_room_number" type="text" required placeholder="Lecture time/room number">
                    </div>
                    <div>
                        <input class="form-input mb-2 text-sm" id="teacher" name="teacher" type="text" required placeholder="Subject teacher">
                    </div>
                    <div>
                        <input class="form-input mb-2 text-sm" id="hours" name="hours" type="text" required placeholder="Number of hours">
                    </div>
                    <div>
                        <input class="form-input mb-2 text-sm" id="level" name="level" type="text" required placeholder="Subject level">
                    </div>
                    <div>
                        <select class="form-input mb-2 text-sm" id="days" name="days[]" multiple class="form-input">
                            @foreach(['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'] as $day)
                                <option value="{{ $day }}">{{ $day }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div>
                    <button type="submit" class="form-button group relative w-full flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-xl text-white bg-yellow-600 hover:bg-yellow-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-yellow-500">Add</button>
                </div>
            </form>
        </div>
    </div>
    <script>
        function toggleAddCourseModal() {
            var modal = document.getElementById('addCourseModal');
            if (modal.classList.contains('hidden')) {
                modal.classList.remove('hidden');
            } else {
                modal.classList.add('hidden');
            }
        }
        document.getElementById('closeCoursePopup').addEventListener('click', function() {
            toggleAddCourseModal();
        });
    </script>
</body>
</html>
