<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Department;
use Illuminate\Http\Request;

class DepartmentManagement extends Controller
{
    public function index()
    {
        $dept_list = Department::all();
        return view('pages.admin.department-management.index', compact('dept_list'));
    }

    public function store(Request $request)
    {
        $credentials = $request->validate([
            'name' => 'required|unique:departments'
        ]);

        $department = new Department($credentials);
        $department->save();

        $alert = [
            'message'   => 'New department has been created',
            'type'      => 'success'
        ];

        return back()->with(['alert' => $alert]);
    }

    public function edit($id)
    {
        $dept = Department::find($id);
        if (!$dept) {
            abort(404);
        }

        $dept_list = Department::all();

        return view('pages.admin.department-management.edit', compact('dept', 'dept_list'));
    }

    public function update(Request $request, $id)
    {
        $dept = Department::find($id);
        if (!$dept) {
            abort(404);
        }

        $request->validate([
            'name' => 'required|unique:departments,name,' . $id
        ]);

        $dept->name = $request->name;
        $dept->save();

        $alert = [
            'message'   => 'Department has been updated',
            'type'      => 'success'
        ];

        return back()->with(['alert' => $alert]);
    }

    public function destroy($id)
    {
        $dept = Department::find($id);
        if (!$dept) {
            abort(404);
        }

        $dept->delete();

        $alert = [
            'message'   => 'Department has been deleted',
            'type'      => 'success'
        ];

        return redirect()->route('admin.manage-department')
            ->with(['alert' => $alert]);
    }
}
