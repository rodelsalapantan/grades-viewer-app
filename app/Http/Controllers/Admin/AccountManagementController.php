<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AccountManagementController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('pages.admin.accounts-management.view-accounts');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function createTeacher()
    {
        return view('pages.admin.accounts-management.create-teacher');
    }

    public function createStudent()
    {
        return view('pages.admin.accounts-management.create-student');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function storeTeacher(Request $request)
    {
        return response()->noContent();
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