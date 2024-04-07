<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Home - Student</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500&display=swap" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bodymovin/5.7.10/lottie.min.js"></script>
</head>

<body>
@if (auth()->user()->type === 'student')
@include('components.navbar')
    @if (auth()->user()->active == 0)
    <div style="margin-top: 4rem" class="bg-red-400 pb-3 pt-10">
        <p class="px-4">This account is inactive. Please wait for the administrator to activate your account.</p>
    </div>
    <div class="flex">
        <div class="flex justify-center items-center h-screen" id="lottie-container"
            style="position: absolute; top: 0; bottom: 0; left: 0; right: 0; margin: auto; width: 200px; height: 200px;">
            <script src="https://cdnjs.cloudflare.com/ajax/libs/bodymovin/5.7.10/lottie.min.js"></script>
            <script>
                document.addEventListener('DOMContentLoaded', function () {
                    var animation = bodymovin.loadAnimation({
                        container: document.getElementById('lottie-container'),
                        renderer: 'svg',
                        loop: true,
                        autoplay: true,
                        path: '/lottie/loadingAnimation.json'
                    });
                });
            </script>
        </div>
    </div>
@else
    <div style="margin-top: 8rem" class="flex flex-col items-start justify-center mx-10">
        <div class="flex flex-row w-full py-8 mt-10 border bg-white shadow-xl rounded-3xl text-gray-900">
            <div class="flex items-center flex-row rounded-t-lg h-50">
                <div class="flex relative border-4 ml-5 border-white rounded-full overflow-hidden">
                    <img src="{{ auth()->user()->image }}" alt="profile picture"
                        class="object-cover object-center rounded-full" style="width: 220px; height:250px"/>
                </div>
                <div class="ml-10">
                    <div class="flex items-center space-x-2 py-2 w-full">
                        <div class="block text-gray-700 text-2xl font-bold w-[1]">
                            {{ auth()->user()->name }}
                        </div>
                    </div>

                    <div class="flex items-center space-x-2 py-2 w-full">
                        <label class="block text-gray-700 text-md font-bold">
                            Email:
                        </label>
                        <div class="w-full text-left">
                            {{ auth()->user()->email }}
                        </div>
                    </div>

                    <div class="flex items-center space-x-2 py-2 w-full">
                        <label class="block text-gray-700 text-md font-bold">
                            Phone:
                        </label>
                        <div class="w-full text-left">
                            +962 {{ auth()->user()->phone }}
                        </div>
                    </div>

                    <div class="flex items-center space-x-2 py-2 w-full">
                        <label class="block text-gray-700 text-md font-bold">
                            Address:
                        </label>
                        <div class="w-full text-left">
                            {{ auth()->user()->address }}
                        </div>
                    </div>

                    <div class="flex flex-row items-center py-2">
                        <label class="text-gray-700 text-md font-bold w-auto pr-2">
                            National Number:
                        </label>
                        <div class="text-left">
                            {{ auth()->user()->national_number }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="flex flex-col mt-10 mx-10">
        <div class="flex w-auto mb-4 text-xl font-bold">
            <h1 style="border-radius: 10px; background-color: #f8dc9a; padding:2px 4px">Your Table</h1>
        </div>
        <div class="overflow-x-auto">
            <div style="font-size: 13px;">
                <div style="background-color: #f8dc9a;" class="flex flex-row pr-12 py-1 font-bold rounded-xl text-sm text-center items-center justify-between">
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
                    <div class="flex w-full justify-center">    
                        <p>Subject level</p>
                    </div>
                    <div class="flex justify-center" style="width: 50%">
                        <p>Days</p>
                    </div>
                </div>
                @foreach ($courses as $course)
                
                    @if (in_array($course->id, $addedCourseIds))
                        @php
                            $formattedDays = str_replace(',', ',<br>', $course->days);
                        @endphp
                        <div class="flex flex-row px-4 text-sm text-center items-center rounded-xl justify-between border py-2 my-2">
                            <div class="flex w-full justify-center">
                                <p>{{ $course->name }}</p>
                            </div>
                            <div class="flex justify-center" style="width: 50%">
                                <p>{{ $course->theoretical_section }}</p>
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
                                <p>{!! $formattedDays !!}</p>
                            </div>
                            <div class="flex justify-center" style="width: 10%">
                                <form action="{{ route('deleteCourseAssociation', ['userId' => auth()->user()->id, 'courseId' => $course->id]) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="hover:bg-gray-200 bg-transparent border-none text-md" style="padding: 0px 8px; border-radius: 5px; color: red;">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                </form>                                                                                                                                              
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>
        </div>
        
    </div>
        

        <div class="mt-10 text-center">
            <button id="openModal" onclick="openModal()" class="w-[80px] mt-4 mb-10 text-xl font-bold py-1 pl-1 rounded-md" style="background-color: #f8dc9a; padding:2px 4px">Add Course</button>
            
            @include('components.editTable')

        </div>
        

        <script>

            function openModal() {
                var modal = document.getElementById("myModal");
                modal.classList.remove("hidden");
            }
        
        
            function addCourse(courseId) {
                var userId = "{{ auth()->user()->id }}";
                var url = "{{ route('addCourse') }}";
                var formData = new FormData();
                formData.append('course_id', courseId);
                formData.append('_token', "{{ csrf_token() }}");
                fetch(url, {
                    method: 'POST',
                    body: formData
                })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            console.log('Course added successfully');
                        } else {
                            console.error('Failed to add course:', data.error);
                        }
                    })
                    .catch(error => console.error('Error adding course:', error));
            }
        </script>
        
    </div>
    @endif
    
    @auth
    <script>
        window.onload = function () {
            history.pushState(null, "", location.href);
            window.onpopstate = function () {
                history.go(1);
                window.location.href = "/404";
            };
        };
    </script>
    @endauth
@endif

@if (auth()->user()->type === 'admin')
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
@endif

    

</body>
</html>
