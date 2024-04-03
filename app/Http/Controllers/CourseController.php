<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\UserCourse;
use Illuminate\Support\Facades\View;

class CourseController extends Controller
{

    public function editTable(Request $request, $studentId)
    {
        try {
            $courses = Course::all();
            $addedCourseIds = UserCourse::where('user_id', $studentId)->pluck('course_id')->toArray();

            $notAddedCourses = $courses->whereNotIn('id', $addedCourseIds);
            $notAddedCourses = $notAddedCourses->toArray();

            return response()->json([
                'notAddedCourses' => $notAddedCourses,
                'addedCourseIds' => $addedCourseIds
            ]);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to fetch courses: ' . $e->getMessage()], 500);
        }
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
