<?php

namespace App\Http\Controllers\Classroom;

use App\Http\Controllers\Controller;
use App\Http\Requests\ClassroomRequest;
use App\Models\Classroom;
use App\Models\Grade;
use Exception;
use Illuminate\Http\Request;

class ClassroomController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $classrooms = Classroom::all();
        $grades = Grade::all();
        return view('dashboard.classrooms.index', compact('classrooms', 'grades'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ClassroomRequest $request)
    {
        $List_Classes = $request->List_Classes;

        try {
            foreach ($List_Classes as $List_Class) {
                $My_Classes = new Classroom();
                $My_Classes->name_class = [
                    'en' => $List_Class['name_class_en'],
                    'ar' => $List_Class['name_class'],
                ];

                $My_Classes->grade_id = $List_Class['grade_id'];
                $My_Classes->save();
            }
            toastr()->success(trans('messages.success'));
            return redirect()->route('classrooms.index');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Classroom  $classroom
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        try {
            $classroom = Classroom::findOrFail($request->id);
            $classroom->update([
                $classroom->name_class = [
                    'ar' => $request->name_class,
                    'en' => $request->name_class_en
                ],

                $classroom->grade_id = $request->grade_id
            ]);
            toastr()->success(trans('messages.update'));
            return redirect()->route('classrooms.index');
        } catch (Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Classroom  $classroom
     * @return \Illuminate\Http\Response
     */
    public function destroy(Classroom $classroom)
    {
        $classroom->delete();
        toastr()->error(trans('messages.delete'));
        return redirect()->route('classrooms.index');
    }

    public function delete_all(Request $request)
    {
        // بتعمل ارريه ليا
        $delete_all_id = explode(",", $request->delete_all_id);
//whereIn بتاخد ارريه لازم نعمل الهها explode
        Classroom::whereIn('id', $delete_all_id)->Delete();
        toastr()->error(trans('messages.delete'));
        return redirect()->route('classrooms.index');
    }


    public function filter_classes(Request $request)
    {
        $grades = Grade::all();
        $Search = Classroom::select('*')->where('grade_id', '=', $request->grade_id)->get();
        return view('dashboard.classrooms.index', compact('grades'))->withDetalis($Search);
    }
}
