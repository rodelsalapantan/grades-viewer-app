<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\AcademicYear;
use App\Models\Department;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $alert = $request->session()->get('alert');

        $users = User::where('role', '!=', 'admin')->get();
        $teachers = User::where('role', 'teacher')->count();
        $students = User::where('role', 'student')->count();
        $department = Department::all()->count();
        $academic_years = AcademicYear::all()->count();


        $counts = [
            'teachers'      => $teachers,
            'students'      => $students,
            'departments'   => $department,
            'academic_years'=> $academic_years
        ];

        if(isset($alert)){
            return view('pages.admin.index', compact('counts'))->with(['alert' => $alert]);
        }
        return view('pages.admin.index', compact('counts'));
    }
}
