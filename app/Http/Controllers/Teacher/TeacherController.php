<?php

namespace App\Http\Controllers\Teacher;

use App\Models\Teacher;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTeacher;
use App\Models\Gender;
use App\Models\Specializations;
use Illuminate\Http\Request;
use App\Repository\TeacherRepositoryInterface;


class TeacherController extends Controller
{
    protected $teacher;

    public function __construct(TeacherRepositoryInterface $teacher)
    {
        $this->teacher = $teacher;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $teachers = $this->teacher->getAllTeachers();
        return view('dashboard.teacher.index', compact('teachers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $specializations = $this->teacher->getSpecializations();
        $genders = $this->teacher->getGenders();
        return view('dashboard.teacher.create', compact('specializations', 'genders'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTeacher $request)
    {
        return $this->teacher->storeTeachers($request);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Teacher  $teacher
     * @return \Illuminate\Http\Response
     */
    public function show(Teacher $teacher)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Teacher  $teacher
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $teachers = $this->teacher->editTeachers($id);
        $specializations = $this->teacher->getSpecializations();
        $genders = $this->teacher->getGenders();
        return view('dashboard.teacher.edit', compact('teachers', 'specializations', 'genders'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Teacher  $teacher
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,)
    {
        return $this->teacher->updateTeachers($request);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Teacher  $teacher
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        return $this->teacher->deleteTeachers($request);
    }
}
