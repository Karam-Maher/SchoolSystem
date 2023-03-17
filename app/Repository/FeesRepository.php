<?php


namespace App\Repository;


use App\Models\Fee;
use App\Models\Grade;

class FeesRepository implements FeesRepositoryInterface
{

    public function index()
    {
        $fees = Fee::all();
        $grades = Grade::all();
        return view('dashboard.fees.index', compact('fees', 'grades'));
    }

    public function create()
    {

        $grades = Grade::all();
        return view('dashboard.fees.create', compact('grades'));
    }

    public function edit($id)
    {
        $fee = Fee::findOrFail($id);
        $grades = Grade::all();
        return view('dashboard.fees.edit', compact('fee', 'grades'));
    }


    public function store($request)
    {
        try {
            $fees = new Fee();
            $fees->title = ['en' => $request->title_en, 'ar' => $request->title_ar];
            $fees->amount  = $request->amount;
            $fees->grade_id  = $request->grade_id;
            $fees->classroom_id  = $request->classroom_id;
            $fees->description  = $request->description;
            $fees->year  = $request->year;
            $fees->save();
            toastr()->success(trans('messages.success'));
            return redirect()->route('fees.index');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function update($request)
    {
        try {
            $fees = Fee::findOrFail($request->id);
            $fees->title = ['en' => $request->title_en, 'ar' => $request->title_ar];
            $fees->amount  = $request->amount;
            $fees->grade_id  = $request->grade_id;
            $fees->classroom_id  = $request->classroom_id;
            $fees->description  = $request->description;
            $fees->year  = $request->year;
            $fees->save();
            toastr()->success(trans('messages.Update'));
            return redirect()->route('fees.index');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function destroy($request)
    {
        try {
            Fee::destroy($request->id);
            toastr()->error(trans('messages.Delete'));
            return redirect()->back();
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
}
