<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\UserCourse;
use Illuminate\Support\Facades\Auth;


class Student extends Controller
{
    public function studentHomePage()
    {
        try {
            $studentId = Auth::user()->id;
            $addedCourseIds = UserCourse::where('user_id', $studentId)->pluck('course_id')->toArray();
            $courses = Course::all();
            $notAddedCourses = $courses->whereNotIn('id', $addedCourseIds); // Filter not added courses

            return view('studentHomePage', compact('courses', 'notAddedCourses', 'addedCourseIds'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to fetch courses: ' . $e->getMessage());
        }
    }
}
