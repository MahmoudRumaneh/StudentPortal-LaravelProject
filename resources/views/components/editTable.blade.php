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
    <div id="myModal" class="z-50 modal hidden fixed inset-0 bg-gray-500 bg-opacity-75 overflow-y-auto">
        <div style="margin:5rem 5rem 5rem 5rem">
            <div class="rounded-3xl w-full flex flex-col bg-white p-4 mt-20">
                <div style="display: flex; justify-content: flex-end;">
                    <button onclick="handleClose()"
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

                <div id="myModalContent" class="overflow-y-auto px-8" style="max-height: 70vh;">
                    <div style="background-color: #f8dc9a" 
                        class="flex flex-row pr-10 py-1 font-bold rounded-xl text-sm text-center items-center justify-between">
                        <div class="flex w-full justify-center">
                            <p>Subject Name</p>
                        </div>    
                        <div class="flex w-full justify-center" style="width: 50%">
                            <p>Theoretical section</p>
                        </div>
                        <div class="flex w-full justify-center" style="width: 50%">
                            <p>Practical section</p>
                        </div>    

                        <div class="flex w-full justify-center">    
                            <p>Lecture time/room number</p>
                        </div>
                        <div class="flex w-full justify-center">
                            <p>Subject teacher</p>
                        </div>
                        <div style="width: 50%" class="flex justify-center">
                            <p>Number of hours</p>
                        </div>
                        <div  class="flex w-full justify-center">    
                            <p>Subject level</p>
                        </div>
                        <div class="flex justify-center" style="width: 50%">
                            <p>Days</p>
                        </div>

                    </div>
                
                    <div id="courseContent">
                        @isset ($notAddedCourses)
                        @foreach ($notAddedCourses as $course)
                            @php
                                $formattedDays = str_replace(',', ',<br>', $course->days);
                            @endphp
                            <div class="flex flex-row px-4 text-sm text-center items-center rounded-xl justify-between border py-2 my-2">
                                <div class="flex w-full justify-center">
                                    <p>{{ $course->name}}</p>
                                </div>
                                <div class="flex justify-center" style="width: 50%">
                                    <p>{{ $course->theoretical_section}}</p>
                                </div>
                                <div class="flex justify-center" style="width: 50%">
                                    <p>{{ $course->practical_section }}</p>
                                </div>

                                <div class="flex w-full justify-center">
                                    <p>{{ $course->lecture_time_and_room_number }}</p>
                                </div>
                                <div class="flex w-full justify-center">
                                    <p>{{ $course->teacher }}</p>
                                </div>
                                <div class="flex justify-center" style="width: 50%">
                                    <p>{{ $course->hours }}</p>
                                </div>
                                <div class="flex w-full justify-center">
                                    <p>{{ $course->level }}</p>
                                </div>
                                <div class="flex items-center justify-center" style="width: 50%">
                                    <p>
                                        {!! $formattedDays !!}
                                    </p>
                                </div>
                                <div>
                                    <form action="{{ route('addCourse') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="course_id" value="{{ $course->id }}">
                                        @if(auth()->check() && auth()->user()->type === 'admin')
                                            <input type="hidden" name="student_id" value="{{ $studentId }}">
                                        @else
                                            <input type="hidden" name="student_id" value="{{ auth()->user()->id }}">
                                        @endif
                                        @if(auth()->check() && auth()->user()->type === 'student')
                                            <button type="submit" class="hover:bg-green-900 bg-green-500 bg-transparent border-none" style="width: 24px; min-width: 24px; height: 24px; border-radius: 50%; color: white;">
                                                <i class="fas fa-plus"></i>
                                            </button>
                                        @endif
                                    </form>                                                                                                               

                                </div>
                            </div>
                        @endforeach
                        @endisset
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
    
        function handleClose() {
            var modal = document.getElementById("myModal");
            modal.classList.add("hidden");
        }
    </script>
    
</body>
</html>
