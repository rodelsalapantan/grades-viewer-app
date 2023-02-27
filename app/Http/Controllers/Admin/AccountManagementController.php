<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreTeacherRequest;
use App\Models\Department;
use App\Models\TeacherProfile;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AccountManagementController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::where('role', '!=', 'admin')->get();
        $teachers = User::where('role', 'teacher')->paginate(10);
        $students = User::where('role', 'student')->paginate(10);
        //dd($students, $teachers);
        return view('pages.admin.accounts-management.view-accounts', compact('users', 'teachers', 'students'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function createTeacher()
    {
        $departments = Department::all();
        return view('pages.admin.accounts-management.create-teacher', compact('departments'));
    }

    public function createStudent()
    {
        return view('pages.admin.accounts-management.create-student');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function storeTeacher(StoreTeacherRequest $request)
    {
        $credentials = $request->validated();

        //$new_password = Str::random(8);
        $new_password = '11111111';
        $credentials['password'] = Hash::make($new_password);
        $credentials['role'] = 'teacher';

        // send to mail

        $user = new User($credentials);
        $user->save();
        
        $teacher_profile = new TeacherProfile([
            'user_id' => $user->id,
            'department_id' => $credentials['department']
        ]);

        $teacher_profile->save();

        $alert = [
            'message'   => 'New teacher has been created',
            'type'      => 'success'
        ];

        return back()->with(['alert' => $alert]);

    }
    /**
     * Store a newly created resource in storage.
     */
    public function storeStudent(Request $request)
    {
        return response()->noContent();
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
