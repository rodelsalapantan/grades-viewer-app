<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AcademicYear;
use Illuminate\Http\Request;

class AcademicYearController extends Controller
{
    public function index(){
        $year_list = AcademicYear::all();
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

    }
    
    public function update(Request $request, $id){
        
    }

    public function delete( $id){
        
    }
}
