<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AcademicYear;
use Illuminate\Http\Request;

class AcademicYearController extends Controller
{
    public function index(){
        $year_list = AcademicYear::all()->sortByDesc('created_at');
        return view('pages.admin.academic-year.index', compact('year_list'));
    }

    public function store(Request $request){
        $credentials = $request->validate([
            'academic_year' => 'required|unique:academic_years',
            'semester' => 'required|unique:academic_years'
        ]);

        $acad_year = new AcademicYear($credentials);
        $acad_year->save();

        $alert = [
            'message'   => 'New academic year has been created',
            'type'      => 'success'
        ];

        return back()->with(['alert' => $alert]);
    }

    public function edit($id){
        $year = AcademicYear::find($id);

        if (!$year) 
            abort(404);
        
        $year_list = AcademicYear::all()->sortByDesc('created_at');

        return view('pages.admin.academic-year.edit', compact('year', 'year_list'));
    }
    
    public function update(Request $request){
        $year = AcademicYear::find($request->id);
        if (!$year) {
            abort(404);
        }

        $request->validate([
            'academic_year' => 'required|unique:academic_years,academic_year,' . $request->id,
            'semester' => 'required|unique:academic_years,semester,' . $request->id,
        ]);

        $year->academic_year = $request->academic_year;
        $year->semester = $request->semester;
        $year->save();

        $alert = [
            'message'   => 'Academic year has been updated',
            'type'      => 'success'
        ];

        return back()->with(['alert' => $alert]);
    }

    public function destroy($id){
        $year = AcademicYear::find($id);
        if (!$year) {
            abort(404);
        }

        $year->delete();

        $alert = [
            'message'   => 'Academic year has been deleted',
            'type'      => 'success'
        ];

        return redirect()->route('admin.manage-acad-year')
            ->with(['alert' => $alert]);
    }
}
