<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500&display=swap" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
</head>

<body>
    @foreach ($students as $student)
    <div
    id="editStudent{{ $student->id }}" class="hidden z-50 fixed top-0 left-0 h-screen w-screen bg-gray-900 bg-opacity-50 flex items-center justify-center">
        <div style="width: 50rem"
        class="bg-white p-8 rounded-3xl shadow-lg flex flex-col">
        <div style="display: flex; justify-content: flex-end;">
            <button id="cancelEdit{{ $student->id }}"
                type="button"
                    class="p-1 rounded-full transition-all duration-200 ease-in-out hover:bg-gray-200 close cursor-pointer">
                <svg xmlns="http://www.w3.org/2000/svg"
                    class="text-black transform transition-transform duration-200 ease-in-out hover:rotate-45
                    hover:text-[#FFC245] xl:h-6 xl:w-6 md:h-5 md:w-5 2xs:h-4 2xs:w-4"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke="currentColor"
                    stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>
            <form id="editForm{{ $student->id }}" action="{{ route('updateStudent', ['id' => $student->id]) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="mb-4 flex w-full justify-start items-center">
                    <label style="width: 10rem" for="name" class="text-left block text-gray-700 text-sm font-bold">Name:</label>
                    <input type="text" name="name" id="name" class="ml-3 appearance-none border-b w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" value="{{ $student->name }}" required>
                </div>
                <div class="mb-4 flex w-full justify-start items-center">
                    <label style="width: 10rem" for="email" class="text-left block text-gray-700 text-sm font-bold">Email:</label>
                    <input type="email" name="email" id="email" class="ml-3 appearance-none border-b w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" value="{{ $student->email }}" required>
                </div>
                <div class="mb-4 flex w-full justify-start items-center">
                    <label style="width: 10rem" for="phone" class="text-left block text-gray-700 text-sm font-bold">Phone:</label>
                    <input type="tel" name="phone" id="phone" class="ml-3 appearance-none border-b w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" value="{{ $student->phone }}" required>
                </div>
                <div class="mb-4 flex w-full justify-start items-center">
                    <label style="width: 10rem" for="address" class="text-left block text-gray-700 text-sm font-bold">Address:</label>
                    <input type="text" name="address" id="address" class="ml-3 appearance-none border-b w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" value="{{ $student->address }}" required>
                </div>
                <div class="mb-4 flex w-full justify-start items-center">
                    <label style="width: 10rem" for="national_number" class="text-left block text-gray-700 text-sm font-bold">National Number:</label>
                    <input type="text" name="national_number" id="national_number" class="ml-3 appearance-none border-b w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" value="{{ $student->national_number }}" required>
                </div>
                <div class="mb-4 flex w-full justify-start items-center">
                    <label style="width: 10rem" for="image" class="text-left block text-gray-700 text-sm font-bold">Image:</label>
                    <input type="file" name="image" id="image" class="ml-3 appearance-none border-b w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                </div>
                <div class="flex justify-center space-x-10">
                    <button style="width: 110px" type="submit"
                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold
                    py-1 rounded focus:outline-none focus:shadow-outline">Save</button>

                    <button style="width: 110px" id="cancelEdit{{ $student->id }}" 
                    type="button" class="bg-red-500 hover:bg-red-700 text-white 
                    font-bold py-1 rounded focus:outline-none focus:shadow-outline">Cancel</button>
                </div>
            </form>
        </div>
    </div>
    @endforeach

    <script>
        function showEditForm(studentId) {
            var editForm = document.getElementById('editStudentForm' + studentId);
            editForm.classList.remove('hidden');
        }

        var editButtons = document.querySelectorAll('[id^="editStudent"]');
        editButtons.forEach(function(button) {
            button.addEventListener('click', function() {
                var studentId = button.id.replace('editStudent', '');
                showEditForm(studentId);
            });
        });

        function hideEditForm(studentId) {
            var editForm = document.getElementById('editStudentForm' + studentId);
            editForm.classList.add('hidden');
        }

        var cancelButtons = document.querySelectorAll('[id^="cancelEdit"]');
        cancelButtons.forEach(function(button) {
            button.addEventListener('click', function() {
                var studentId = button.id.replace('cancelEdit', '');
                hideEditForm(studentId);
            });
        });
    </script>
</body>
</html>
