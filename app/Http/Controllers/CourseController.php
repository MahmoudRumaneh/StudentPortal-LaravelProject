<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\UserCourse;
use Illuminate\Support\Facades\Auth;

class CourseController extends Controller
{
    public function showCourses()
    {
        try {
            $courses = Course::all();
            $addedCourseIds = [];

            if (Auth::check()) {
                if (Auth::user()->type === 'admin') {
                    $addedCourseIds = Course::pluck('id')->toArray();
                } else {
                    $addedCourseIds = Auth::user()->courses->pluck('id')->toArray();
                }
            }

            $notAddedCourses = Course::whereNotIn('id', $addedCourseIds)->get();
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to fetch courses: ' . $e->getMessage());
        }

        return view('studentHomePage', compact('notAddedCourses', 'addedCourseIds', 'courses'));
    }

    public function addCourse(Request $request)
    {
        try {
            $userId = auth()->user()->id;

            if (auth()->user()->type === 'admin') {
                $userId = $request->student_id;
            }
            $userCourse = new UserCourse();
            $userCourse->user_id = $userId;
            $userCourse->course_id = $request->course_id;
            $userCourse->save();

            $route = auth()->user()->type === 'admin' ? 'adminHomePage' : 'studentHomePage';

            return redirect()->route($route)->with('success', 'Course added successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to add course: ' . $e->getMessage());
        }
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


    public function showEditTable($studentId)
    {
        try {
            $addedCourseIds = UserCourse::where('user_id', $studentId)->pluck('course_id')->toArray();
            $notAddedCourses = Course::whereNotIn('id', $addedCourseIds)->get();
        } catch (\Exception $e) {
            dd($e->getMessage());
        }

        return view('components.editTable', compact('notAddedCourses', 'studentId'));
    }




    public function deleteCourseAssociation($userId, $courseId)
    {
        try {
            $userCourse = UserCourse::where('user_id', $userId)
                ->where('course_id', $courseId)
                ->first();

            if (!$userCourse) {
                return redirect()->back()->with('error', 'Course association not found for deletion.');
            }
            $userCourse->delete();

            return redirect()->back()->with('success', 'Course association deleted successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to delete course association: ' . $e->getMessage());
        }
    }
}
