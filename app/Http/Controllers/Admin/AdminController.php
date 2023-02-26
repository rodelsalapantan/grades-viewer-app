<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $alert = $request->session()->get('alert');
        if(isset($alert)){
            return view('pages.admin.index')->with(['alert' => $alert]);
        }
        return view('pages.admin.index');
    }
}
