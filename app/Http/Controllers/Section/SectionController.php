<?php

namespace App\Http\Controllers\Section;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreSections;
use App\Models\Classroom;
use App\Models\Grade;
use App\Models\Section;
use Illuminate\Http\Request;

class SectionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $grades = Grade::with('sections')->get();
        $list_Grades = Grade::all();

        return view('dashboard.sections.index', compact('grades', 'list_Grades'));
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreSections  $request)
    {
        try {

            $validated = $request->validated();
            $Sections = new Section();

            $Sections->name_section = ['ar' => $request->name_section_ar, 'en' => $request->name_section_en];
            $Sections->grade_id = $request->grade_id;
            $Sections->class_id = $request->class_id;
            $Sections->status = 1;
            $Sections->save();
            toastr()->success(trans('messages.success'));

            return redirect()->route('sections.index');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Section  $section
     * @return \Illuminate\Http\Response
     */
    public function update(StoreSections $request)
    {
        try {
            $validated = $request->validated();
            $sections = Section::findOrFail($request->id);

            $sections->name_section = ['ar' => $request->name_section_ar, 'en' => $request->name_section_en];
            $sections->grade_id = $request->grade_id;
            $sections->class_id = $request->class_id;

            if (isset($request->status)) {
                $sections->status = 1;
            } else {
                $sections->status = 2;
            }

            $sections->save();
            toastr()->success(trans('messages.update'));

            return redirect()->route('sections.index');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Section  $section
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        Section::findOrFail($request->id)->delete();
        toastr()->error(trans('messages.delete'));
        return redirect()->route('sections.index');
    }

    public function getClasses($id)
    {
        $list_classes = Classroom::where("grade_id", $id)->pluck("name_class", "id");
        return  $list_classes;
    }
}
