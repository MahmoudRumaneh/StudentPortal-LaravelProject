@if(auth()->user()->type === 'admin')
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Home - Admin</title>
        <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500&display=swap" rel="stylesheet" />
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">

</head>

<body>
    @include('components.navbar')
        

        <div class="flex justify-center" style="padding-bottom: 5rem; background-image: url('/images/adminHomeImage.png')">
            
            <div style="margin-top: 6rem; width: 50%" class="flex flex-col items-start justify-center">
            <div class="flex flex-row w-full py-8 mt-10 border bg-white shadow-xl rounded-3xl text-gray-900">
                <div class="flex items-center flex-row rounded-t-lg h-50">
                    <div class="flex relative border-4 ml-5 border-white rounded-full overflow-hidden">
                            <img
                            src="{{ auth()->user()->image}}"
                            alt="profile picture"
                            class="z-0 object-cover object-center rounded-full"
                            style="width: 220px; height:250px"
                            />
                    </div>
                    <div class="ml-10">
                        <div class="flex items-center space-x-2 py-2 w-full">
                            <div class="block text-gray-700 text-2xl font-bold w-[1">
                                {{ auth()->user()->name}}
                            </div>
                        </div>
                
                        <div class="flex items-center space-x-2 py-2 w-full">
                            <label class="block text-gray-700 text-md font-bold">
                                Email:
                            </label>
                            <div class="w-full text-left">
                                {{ auth()->user()->email}}   
                            </div>
                        </div>
                
                        <div class="flex items-center space-x-2 py-2 w-full">
                            <label class="block text-gray-700 text-md font-bold">
                                Phone:
                            </label>
                            <div class="w-full text-left">
                                +962 {{ auth()->user()->phone}}   
                            </div>
                        </div>
                
                
                        <div class="flex items-center space-x-2 py-2 w-full">
                            <label class="block text-gray-700 text-md font-bold">
                                Address:
                            </label>
                            <div class="w-full text-left">
                                {{ auth()->user()->address}}   
                            </div>
                        </div>
                
                        <div class="flex flex-row items-center py-2">
                            <label class="text-gray-700 text-md font-bold w-auto pr-2">
                                National Number:
                            </label>
                            <div class="text-left">
                                {{ auth()->user()->national_number}}   
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            </div>
        </div>
        <div class="flex flex-col shadow-xl border border-gray-200 m-10 rounded-3xl" >
            <div class="flex flex-row space-x-5 mt-10" style="padding-left: 4.5rem;"
            class="h-auto rounded-3xl w-20 flex flex-col items-center justify-center">
                <button id="toggleStudents" class="mb-4 focus:outline-none">
                    Students
                </button>
                <button id="toggleCourses" class="mb-4 focus:outline-none">
                    Courses
                </button>
            </div>


            <div>

                <div id="studentsSection" class="flex flex-col mt-4 mb-10">
                    <div class="flex w-auto mb-4 mx-10 text-xl font-bold justify-between">
                        <div class="flex flex-row mr-16">
                            <div class="flex ml-8 text-sm bg-yellow-400 hover:bg-gray-400 rounded-xl">
                                <button style="border-radius: 10px; width: 160px; padding:0px" onclick="toggleAddStudentModal()">Add Student</button>
                            </div>
                            @include('components.addStudent')
                            <div class="flex ml-8 text-sm bg-yellow-400 hover:bg-red-600 rounded-xl items-center">
                                <form id="removeAllStudentsForm" action="{{ route('deleteAllStudents') }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    
                                        <button style="border-radius: 10px; width: 160px; padding: 0px;" onclick="confirmDeleteAllStudents()">Remove All Students</button>
                                    
                                </form>  
                            </div>                 
                        </div>
                    </div>

                    <div class="flex flex-col mx-10 mb-20" style="display: block;">
                        <div class="overflow-y-auto px-8">
                            @foreach ($students as $student)
                                <div class="flex flex-col mb-10 rounded-xl px-4 pb-6 border shadow-lg">
                                    <div class="flex flex-row justify-between px-4 text-sm text-center items-center my-2">
                                        <div class="flex">
                                            <div class="flex relative border-4 ml-5 border-white rounded-full overflow-hidden">
                                                <img class="object-cover object-center rounded-full"
                                                style="width: 100px; height:120px"
                                                src={{ $student->image }} alt="studentImage" />
                                            </div>
                                            <div class="flex flex-col ml-8">
                                                <div class="flex w-full text-left text-lg font-bold">
                                                    <p>{{ $student->name }}</p>
                                                </div>
                                                <div class="flex w-full text-left">
                                                    <p>Email: {{ $student->email }}</p>
                                                </div>
                                                <div class="flex w-full text-left">
                                                    <p>Phone: +962 {{ $student->phone }}</p>
                                                </div>
                                                <div class="flex w-full text-left">
                                                    <p>Address: {{ $student->address }}</p>
                                                </div>
                                                <div class="flex w-full text-left">
                                                    <p>National Number: {{ $student->national_number }}</p>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        
                                        <div class="flex flex-col items-center justify-center" style="width: 20%">
                                            <div class="flex flex-row items-center justify-center">
                                                <button id="editStudent{{ $student->id }}" class="hover:bg-gray-200 
                                                    bg-yellow-400 hover:bg-gray-400 rounded-xl text-md mb-5"
                                                    style="width: 110px; padding: 2px 0px; border-radius:
                                                    10px;">Edit Profile</button>
                                            </div>
                                            @include('components.editStudentProfile', ['student' => $student])
                                            <form action="{{ route('deleteStudent', ['id' => $student->id]) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this student?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="hover:bg-gray-200 bg-transparent border-none text-md" style="width: 110px; padding: 2px 0px; border-radius: 10px; background-color: rgb(169, 4, 4); color: white">
                                                    Remove
                                                </button>
                                            </form>
                                            <div>
                                                <div>
                                                    @if ($student->active == 0)
                                                        <form action="{{ route('toggleStudentStatus', ['id' => $student->id]) }}" method="POST">
                                                            @csrf
                                                            <button style="width: 110px; padding: 2px 0px; border-radius: 10px;"
                                                            type="submit" class="bg-red-500 text-white mt-5 px-4 py-2 rounded-lg" onclick="return confirm('Are you sure you want to activate this student?')">Unactive</button>
                                                        </form>
                                                    @else
                                                        <button class="bg-green-500 mt-5 text-white px-4 py-2 rounded-lg cursor-not-allowed"
                                                        style="width: 110px; padding: 2px 0px; border-radius: 10px;"
                                                        disabled>Active</button>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="flex mb-3 text-sm">
                                        <div class="mt-10 text-center">
                                            <button id="openModal" onclick="openModal()"
                                            onclick="openModal({{ $student->id }})" class="text-blue-500 hover:text-blue-700 font-bold cursor-pointer">
                                                Edit Table
                                            </button>                                         
                                            @include('components.editTable', ['studentId' => $student->id])

                                        </div>
                                        
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
                                            @foreach ($student->courses as $course)
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
                                                        <p>{!! $formattedDays !!}</p>
                                                    </div>
                                                    <div class="flex justify-center" style="width: 10%">
                                                        <form action="{{ route('deleteCourseAssociation', ['userId' => $student->id, 'courseId' => $course->id]) }}" method="POST">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="hover:bg-gray-200 bg-transparent border-none text-md" style="padding: 0px 8px; border-radius: 5px; color: red;">
                                                                <i class="fas fa-minus"></i>
                                                            </button>
                                                        </form>                                                                                                                                              
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                    
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                <div id="coursesSection" class="flex flex-col mt-4 mx-10 mb-10">
                        <div class="flex justify-between w-auto mb-4 text-xl font-bold">
                            <div class="flex flex-row mr-16">
                                <div class="flex ml-8 text-sm bg-yellow-400 hover:bg-gray-400 rounded-xl">
                                    <button onclick="toggleAddCourseModal()" style="border-radius: 10px; padding:0px; width: 160px;">Add Course</button>
                                </div>
                                @include('components.addCourse')
                                <div class="flex ml-8 text-sm bg-yellow-400 hover:bg-red-600 rounded-xl">
                                    <form action="{{ route('deleteAllCourses') }}" method="POST" onsubmit="return confirm('Are you sure you want to remove all courses? This action cannot be undone.')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" style="border-radius: 10px; padding:0px; width: 160px;">Remove All Courses</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="flex flex-col" style="display: block;">
                            <div class="overflow-y-auto px-8" style="max-height: 70vh;">
                                <div style="background-color: #f8dc9a" 
                                    class="flex flex-row pr-20 py-1 font-bold rounded-xl text-sm text-center items-center justify-between">
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
                                    @foreach ($courses as $course)
                                        @php
                                            $formattedDays = str_replace(',', ',<br>', $course->days);
                                        @endphp
                                        <div class="flex flex-row pl-4 pr-5 text-sm text-center items-center rounded-xl justify-between border py-2 my-2">
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
                                            <div class="flex justify-center pr-2" style="width: 10%">
                                                <button onclick="showEditForm({{ $course->id }})" class="hover:bg-gray-200 bg-transparent border-none text-md" style="padding: 0px 5px; border-radius: 5px; color: #8A411C;">
                                                    <i class="fas fa-pen"></i>
                                                </button>
                                            </div>
                                            @include('components.editCourse', ['course' => $course])
                                            <div class="flex justify-center" style="width: 10%">
                                                <form id="deleteCourseForm_{{ $course->id }}" action="{{ route('deleteCourse', $course->id) }}" method="POST" onsubmit="return confirmDeleteCourse('{{ $course->name }}')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="hover:bg-gray-200 bg-transparent border-none text-md" style="padding: 0px 5px; border-radius: 5px; color: red;">
                                                        <i class="fas fa-minus"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    @endforeach
                            </div>
                        </div>
                </div>

            </div>
        </div>


        <script>
        document.getElementById('toggleStudents').addEventListener('click', function() {
            showStudentsSection();
        });

        document.getElementById('toggleCourses').addEventListener('click', function() {
            showCoursesSection();
        });

        function showStudentsSection() {
            var studentsSection = document.getElementById('studentsSection');
            var coursesSection = document.getElementById('coursesSection');

            studentsSection.style.display = 'block';
            coursesSection.style.display = 'none';

            document.getElementById('toggleStudents').style.textDecoration = 'underline';
            document.getElementById('toggleCourses').style.textDecoration = 'none';
        }

        function showCoursesSection() {
            var studentsSection = document.getElementById('studentsSection');
            var coursesSection = document.getElementById('coursesSection');

            coursesSection.style.display = 'block';
            studentsSection.style.display = 'none';

            document.getElementById('toggleCourses').style.textDecoration = 'underline';
            document.getElementById('toggleStudents').style.textDecoration = 'none';
        }

        showStudentsSection();

        function confirmDeleteAllStudents() {
            if (confirm('Are you sure you want to remove all students?')) {
                document.getElementById('removeAllStudentsForm').submit();
            } else {
                event.preventDefault();
                return false;
            }
        }



        function openModal(studentId) {
    var modal = document.getElementById("myModal");
    modal.classList.remove("hidden");
    showCourses(studentId);
}

        function handleClose() {
            var modal = document.getElementById("myModal");
            modal.classList.add("hidden");
        }

        function showEditTable(studentId) {
    var editTableContainer = document.getElementById("editTableContainer_" + studentId);
    editTableContainer.innerHTML = `<div id="editTable_${studentId}"></div>`;
    // Pass the studentId parameter in the route
    var url = "{{ route('editTable', ['studentId' => ':studentId']) }}".replace(':studentId', studentId);
    fetch(url)
        .then(response => response.text())
        .then(html => {
            document.getElementById(`editTable_${studentId}`).innerHTML = html;
            var modal = document.getElementById("myModal");
            modal.classList.remove("hidden");
            var span = document.getElementsByClassName("close")[0];
            span.onclick = function () {
                modal.classList.add("hidden");
            };
            window.onclick = function (event) {
                if (event.target == modal) {
                    modal.classList.add("hidden");
                }
            };
        })
        .catch(error => console.error('Error fetching edit table:', error));
}

        function addCourse(courseId, studentId) {
            var url = "{{ route('addCourse') }}";
            var formData = new FormData();
            formData.append('course_id', courseId);
            formData.append('student_id', studentId);
            formData.append('_token', "{{ csrf_token() }}");
            fetch(url, {
                method: 'POST',
                body: formData
            })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        console.log('Course added successfully');
                        showEditTable(studentId);
                    } else {
                        console.error('Failed to add course:', data.error);
                    }
                })
                .catch(error => console.error('Error adding course:', error));
        }




            

            function deleteCourseAssociation(courseId) {
                if (confirm('Are you sure you want to delete this course association?')) {
                    document.getElementById('deleteCourseAssociationForm_' + courseId).submit();
                }
            }
            
            function confirmDeleteCourse(courseName) {
                return confirm(`Are you sure you want to delete the course "${courseName}"?`);
            }


        </script>


</body>
</html>

@endif
