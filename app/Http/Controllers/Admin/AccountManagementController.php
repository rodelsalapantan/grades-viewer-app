<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Department;
use Illuminate\Support\Str;
use App\Mail\NewStudentMail;
use Illuminate\Http\Request;
use App\Models\StudentProfile;
use App\Models\TeacherProfile;
use App\Http\Controllers\Controller;
use App\Models\NewUserPasswordToken;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Http\Requests\Admin\StoreStudentRequest;
use App\Http\Requests\Admin\StoreTeacherRequest;

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

        // save new teacher

        //$new_password = Str::random(8);
        $new_password = '11111111'; // delete soon
        $credentials['password'] = Hash::make($new_password);
        $credentials['role'] = 'teacher';

        $user = new User($credentials);
        $user->save();
        
        // save teacher profile
        $teacher_profile = new TeacherProfile([
            'user_id' => $user->id,
            'department_id' => $credentials['department']
        ]);
        $teacher_profile->save();

        // save reset password token
        $token = Str::random(30);
        $new_user_token = new NewUserPasswordToken([
            'token' => $token,
            'email' => $credentials['email']
        ]);
        $new_user_token->save();

        // send to mail
        Mail::to($credentials['email'])->send(new NewStudentMail($user, $new_password, $token));

        $alert = [
            'message'   => 'New teacher has been created',
            'type'      => 'success'
        ];

        return back()->with(['alert' => $alert]);

    }
    /**
     * Store a newly created resource in storage.
     */
    public function storeStudent(StoreStudentRequest $request)
    {
        $credentials = $request->validated();

        //$new_password = Str::random(8);
        $new_password = '11111111'; // delete soon
        $credentials['password'] = Hash::make($new_password);
        $credentials['role'] = 'student';

        // send to mail

        $user = new User($credentials);
        $user->save();
        
        $student_profile = new StudentProfile([
            'user_id' => $user->id,
            'student_number' => $credentials['student_number']
        ]);

        $student_profile->save();

        $alert = [
            'message'   => 'New student has been created',
            'type'      => 'success'
        ];

        return back()->with(['alert' => $alert]);
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
