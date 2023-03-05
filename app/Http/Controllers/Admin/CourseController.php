<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Department;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    public function index()
    {
        $courses = Course::all()->sortByDesc('created_at');
        $departments = Department::all()->sortByDesc('created_at');

        $courses = $courses->map(function($course){
            $course->department_name = $course->department->name;
            unset($course->department);
            return $course;
        });
        return view('pages.admin.course-management.index', compact('courses', 'departments'));
    }

    public function store(Request $request)
    {
        $credentials = $request->validate([
            'course_name' => 'required|unique:courses',
            'department_id' => 'required|exists:departments,id'
        ]);

        $course = new Course($credentials);
        $course->save();

        $alert = [
            'message'   => 'New course has been created',
            'type'      => 'success'
        ];

        return back()->with(['alert' => $alert]);
    }

    public function edit($id)
    {
        $course = Course::find($id);
        if (!$course) {
            abort(404);
        }

        $courses = Course::all();
        $departments = Department::all()->sortByDesc('created_at');

        return view('pages.admin.course-management.edit', compact('course', 'courses', 'departments'));
    }

    public function update(Request $request)
    {
        $course = Course::find($request->id);
        if (!$course) {
            abort(404);
        }

        $request->validate([
            'course_name' => 'required|unique:departments,name,' . $request->id,
            'department_id' => 'required|exists:departments,id'
        ]);

        $course->course_name = $request->course_name;
        $course->department_id = $request->department_id;
        $course->save();

        $alert = [
            'message'   => 'Course has been updated',
            'type'      => 'success'
        ];

        return back()->with(['alert' => $alert]);
    }

    public function destroy($id)
    {
        $course = Course::find($id);
        if (!$course) {
            abort(404);
        }

        $course->delete();

        $alert = [
            'message'   => 'Course has been deleted',
            'type'      => 'success'
        ];

        return redirect()->route('admin.manage-course')
            ->with(['alert' => $alert]);
    }
}
