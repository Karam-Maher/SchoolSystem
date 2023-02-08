<?php

namespace App\Http\Controllers\Grade;

use App\Http\Controllers\Controller;
use App\Http\Requests\GradeRequest;
use App\Models\Classroom;
use App\Models\Grade;
use Exception;
use Illuminate\Http\Request;

class GradeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $grades = Grade::all();
        return view('dashboard.grades.index', compact('grades'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(GradeRequest $request)
    {
        if (Grade::where('name->ar', $request->name)->orWhere('name->en', $request->name_en)->exists()) {
            return redirect()->back()->withErrors(trans('messages.exists'));
        }
        try {
            $validated = $request->validated();
            $grade = new Grade();
            $grade->name = ['en' => $request->name_en, 'ar' => $request->name];
            $grade->notes = $request->notes;
            $grade->save();
            toastr()->success(trans('messages.success'));
            return redirect()->route('grades.index');
        } catch (Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Grade  $grade
     * @return \Illuminate\Http\Response
     */
    public function update(GradeRequest $request)
    {
        try {
            $validated = $request->validated();
            $grades = Grade::findOrFail($request->id);
            $grades->update([
                $grades->Name = ['ar' => $request->name, 'en' => $request->name_en],
                $grades->notes = $request->notes,
            ]);
            toastr()->success(trans('messages.update'));
            return redirect()->route('grades.index');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Grade  $grade
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {

        $MyClass_id = Classroom::where('grade_id', $request->id)->pluck('grade_id');

        if ($MyClass_id->count() == 0) {
            $Grades = Grade::findOrFail($request->id)->delete();
            toastr()->error(trans('messages.delete'));
            return redirect()->route('grades.index');
        } else {
            toastr()->error(trans('grades_trans.delete_Grade_Error'));
            return redirect()->route('grades.index');
        }
    }
}
