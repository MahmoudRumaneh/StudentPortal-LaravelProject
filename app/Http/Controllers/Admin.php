<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\User;

class Admin extends Controller
{
    public function adminHomePage()
    {
        $courses = Course::all();
        $students = User::where('type', 'student')->get();
        return view('adminHomePage', compact('courses', 'students'));
    }


    public function createCourse(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'days' => 'required|array',
        ]);

        $days = implode(',', $request->input('days'));

        Course::create([
            'name' => $request->input('name'),
            'theoretical_section' => $request->input('theoretical_section'),
            'practical_section' => $request->input('practical_section'),
            'lecture_time_and_room_number' => $request->input('lecture_time_and_room_number'),
            'teacher' => $request->input('teacher'),
            'hours' => $request->input('hours'),
            'level' => $request->input('level'),
            'days' => $days,
        ]);

        return redirect()->route('adminHomePage')->with('success', 'Course created successfully');
    }

    public function deleteCourse($id)
    {
        $course = Course::findOrFail($id);
        $course->delete();

        return redirect()->route('adminHomePage')->with('success', 'Course deleted successfully');
    }

    public function toggleStudentStatus($id)
    {
        $student = User::findOrFail($id);
        $student->active = $student->active ? 0 : 1;
        $student->save();

        return redirect()->route('adminHomePage')->with('success', 'Student status toggled successfully');
    }

    public function createStudent(Request $request)
    {
        $request->validate([
            'name' => 'required',
        ]);

        User::create($request->all());

        return redirect()->route('adminHomePage')->with('success', 'Student created successfully');
    }


    public function updateStudent(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
        ]);

        $student = User::findOrFail($id);

        $student->update([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'national_number' => $request->national_number,
            'updated_at' => now(),
        ]);

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('images');
            $student->update(['image' => $imagePath]);
        }

        return redirect()->route('adminHomePage')->with('info', 'Student information updated successfully');
    }


    public function updateCourse(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'theoretical_section' => 'required',
            'practical_section' => 'required',
            'lecture_time_and_room_number' => 'required',
            'teacher' => 'required',
            'hours' => 'required|integer',
            'level' => 'required',
            'days' => 'required|array',
        ]);

        $course = Course::findOrFail($id);
        $course->update([
            'name' => $request->input('name'),
            'theoretical_section' => $request->input('theoretical_section'),
            'practical_section' => $request->input('practical_section'),
            'lecture_time_and_room_number' => $request->input('lecture_time_and_room_number'),
            'teacher' => $request->input('teacher'),
            'hours' => $request->input('hours'),
            'level' => $request->input('level'),
            'days' => implode(',', $request->input('days')), // Assuming days are stored as comma-separated values in the database
        ]);

        return redirect()->route('adminHomePage')->with('success', 'Course updated successfully');
    }


    public function deleteAllStudents()
    {
        User::where('type', 'student')->delete();
        return redirect()->route('adminHomePage')->with('success', 'All students removed successfully');
    }

    public function deleteStudent($id)
    {
        $student = User::findOrFail($id);
        $student->delete();
        return redirect()->route('adminHomePage')->with('success', 'Student deleted successfully');
    }

    public function deleteAllCourses()
    {
        Course::truncate();
        return redirect()->route('adminHomePage')->with('success', 'All courses removed successfully');
    }
}
