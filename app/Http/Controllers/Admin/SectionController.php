<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Section;
use Illuminate\Http\Request;

class SectionController extends Controller
{
    public function index(){
        $sections = Section::all()->sortByDesc('created_at');

        return view('pages.admin.section-management.index', compact('sections'));
    }
    public function updateSection(Request $request){
        return view('pages.admin.section-management.index');
    }
}
