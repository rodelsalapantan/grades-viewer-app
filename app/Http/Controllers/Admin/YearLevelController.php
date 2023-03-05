<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\YearLevel;
use Illuminate\Http\Request;

class YearLevelController extends Controller
{
    public function index()
    {
        $year_levels = YearLevel::all()->sortByDesc('created_at');

        return view('pages.admin.year-level-management.index', compact('year_levels'));
    }

    public function store(Request $request)
    {
        $credentials = $request->validate([
            'year_level' => 'required|unique:year_levels',
        ]);

        $year_level = new YearLevel($credentials);
        $year_level->save();

        $alert = [
            'message'   => 'New Year Level has been created',
            'type'      => 'success'
        ];

        return back()->with(['alert' => $alert]);
    }

    public function edit($id)
    {
        $year_level = YearLevel::find($id);
        if (!$year_level) {
            abort(404);
        }

        $year_levels = YearLevel::all();

        return view('pages.admin.year-level-management.edit', compact('year_level', 'year_levels'));
    }

    public function update(Request $request)
    {
        $year_level = YearLevel::find($request->id);
        if (!$year_level) {
            abort(404);
        }

        $request->validate([
            'year_level' => 'required|unique:year_level,year_level' . $request->id,
        ]);

        $year_level->year_level = $request->year_level;
        $year_level->save();

        $alert = [
            'message'   => 'year_level has been updated',
            'type'      => 'success'
        ];

        return back()->with(['alert' => $alert]);
    }

    public function destroy($id)
    {
        $year_level = YearLevel::find($id);
        if (!$year_level) {
            abort(404);
        }

        $year_level->delete();

        $alert = [
            'message'   => 'Year Level has been deleted',
            'type'      => 'success'
        ];

        return redirect()->route('admin.manage-year-level')
            ->with(['alert' => $alert]);
    }
}
