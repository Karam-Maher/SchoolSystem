<?php

namespace App\Repository;

use App\Models\Gender;
use App\Models\Specializations;
use App\Models\Teacher;
use Exception;
use Illuminate\Support\Facades\Hash;

class TeacherRepository implements TeacherRepositoryInterface
{

    public function getAllTeachers()
    {
        return Teacher::all();
    }

    public function getSpecializations()
    {
        return Specializations::all();
    }

    public function getGenders()
    {
        return Gender::all();
    }

    public function storeTeachers($request)
    {
        try {
            $teachers = new Teacher();
            $teachers->email = $request->email;
            $teachers->password = Hash::make($request->password);
            $teachers->name = ['en' => $request->name_en, 'ar' => $request->name_ar];
            $teachers->specialization_id = $request->specialization_id;
            $teachers->gender_id = $request->gender_id;
            $teachers->joining_date = $request->joining_date;
            $teachers->address = $request->address;
            $teachers->save();
            toastr()->success(trans('messages.success'));
            return redirect()->route('teachers.index');
        } catch (Exception $e) {
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
    }


    public function editTeachers($id)
    {
        return Teacher::findOrFail($id);
    }


    public function updateTeachers($request)
    {
        try {
            $Teachers = Teacher::findOrFail($request->id);
            $Teachers->email = $request->email;
            $Teachers->password =  Hash::make($request->password);
            $Teachers->name = ['en' => $request->name_en, 'ar' => $request->name_ar];
            $Teachers->specialization_id = $request->specialization_id;
            $Teachers->gender_id = $request->gender_id;
            $Teachers->joining_date = $request->joining_date;
            $Teachers->address = $request->address;
            $Teachers->save();
            toastr()->success(trans('messages.update'));
            return redirect()->route('teachers.index');
        } catch (Exception $e) {
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
    }


    public function deleteTeachers($request)
    {
        Teacher::findOrFail($request->id)->delete();
        toastr()->error(trans('messages.delete'));
        return redirect()->route('teachers.index');
    }
}
