<?php

namespace App\Repository;

use App\Models\Classroom;
use App\Models\Gender;
use App\Models\Grade;
use App\Models\Image;
use App\Models\My_Parent;
use App\Models\Nationality;
use App\Models\Section;
use App\Models\Student;
use App\Models\TypeBlood;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class StudentRepository implements StudentRepositoryInterface
{
    public function getStudent()
    {
        $students = Student::all();
        return view('dashboard.students.index', compact('students'));
    }

    public function createStudent()
    {
        $data['my_classes'] = Grade::all();
        $data['parents'] = My_Parent::all();
        $data['genders'] = Gender::all();
        $data['nationals'] = Nationality::all();
        $data['bloods'] = TypeBlood::all();
        return view('dashboard.students.create', $data);
    }

    public function Get_classrooms($id)
    {
        $list_classes = Classroom::where('grade_id', $id)->pluck("name_class", "id");
        return $list_classes;
    }

    public function Get_sections($id)
    {
        $list_sections = Section::where('class_id', $id)->pluck("name_section", "id");
        return $list_sections;
    }

    public function storStudent($request)
    {
        DB::beginTransaction();
        try {
            $students = new Student();
            $students->name = ['en' => $request->name_en, 'ar' => $request->name_ar];
            $students->email = $request->email;
            $students->password = Hash::make($request->password);
            $students->gender_id = $request->gender_id;
            $students->nationalitie_id = $request->nationalitie_id;
            $students->blood_id = $request->blood_id;
            $students->date_birth = $request->date_birth;
            $students->grade_id = $request->grade_id;
            $students->classroom_id = $request->classroom_id;
            $students->section_id = $request->section_id;
            $students->parent_id = $request->parent_id;
            $students->academic_year = $request->academic_year;
            $students->save();

            if ($request->hasfile('photos')) {
                foreach ($request->file('photos') as $file) {
                    $name = $file->getClientOriginalName();
                    $file->storeAs('attachments/students/' . $students->name, $file->getClientOriginalName(), 'upload_attachments');

                    // insert in image_table
                    $images = new Image();
                    $images->filename = $name;
                    $images->imageable_id = $students->id;
                    $images->imageable_type = 'App\Models\Student';
                    $images->save();
                }
            }

            DB::commit();
            toastr()->success(trans('messages.success'));
            return redirect()->route('students.index');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function showStudent($id)
    {
        $student = Student::findOrFail($id);
        return view('dashboard.students.show', compact('student'));
    }

    public function editStudent($id)
    {
        $data['grades'] = Grade::all();
        $data['parents'] = My_Parent::all();
        $data['genders'] = Gender::all();
        $data['nationals'] = Nationality::all();
        $data['bloods'] = TypeBlood::all();
        $students = Student::findOrFail($id);
        return view('dashboard.students.edit', $data, compact('students'));
    }

    public function updateStudent($request)
    {
        try {
            $students = Student::findOrFail($request->id);
            $students->name = ['en' => $request->name_en, 'ar' => $request->name_ar];
            $students->email = $request->email;
            $students->password = Hash::make($request->password);
            $students->gender_id = $request->gender_id;
            $students->nationalitie_id = $request->nationalitie_id;
            $students->blood_id = $request->blood_id;
            $students->date_birth = $request->date_birth;
            $students->grade_id = $request->grade_id;
            $students->classroom_id = $request->classroom_id;
            $students->section_id = $request->section_id;
            $students->parent_id = $request->parent_id;
            $students->academic_year = $request->academic_year;
            $students->save();
            toastr()->success(trans('messages.update'));
            return redirect()->route('students.index');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
    public function destroyStudent($request)
    {
        Student::destroy($request->id);
        toastr()->error(trans('messages.delete'));
        return redirect()->route('students.index');
    }
    public function upload_attachment($request)
    {
        foreach ($request->file('photos') as $file) {
            $name = $file->getClientOriginalName();
            $file->storeAs('attachments/students/' . $request->student_name, $file->getClientOriginalName(), 'upload_attachments');

            // insert in image_table
            $images = new image();
            $images->filename = $name;
            $images->imageable_id = $request->student_id;
            $images->imageable_type = 'App\Models\Student';
            $images->save();
        }
        toastr()->success(trans('messages.success'));
        return redirect()->route('students.show', $request->student_id);
    }
    //Download_attachment
    public function download_attachment($studentsname, $filename)
    {
        return response()->download(public_path('attachments/students/' . $studentsname . '/' . $filename));
    }

    //Delete_attachment
    public function delete_attachment($request)
    {
        // Delete img in server disk
        Storage::disk('upload_attachments')->delete('attachments/students/' . $request->student_name . '/' . $request->filename);

        // Delete in data
        image::where('id', $request->id)->where('filename', $request->filename)->delete();
        toastr()->error(trans('messages.Delete'));
        // return redirect()->route('students.show', $request->student_id);
        return redirect()->back();
    }
}
