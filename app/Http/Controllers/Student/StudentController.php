<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreStudentRequest;
use App\Models\Student;
use App\Repository\StudentRepositoryInterface;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    protected $student;

    public function __construct(StudentRepositoryInterface $student)
    {
        $this->student = $student;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $this->student->getStudent();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return $this->student->createStudent();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreStudentRequest $request)
    {
        $this->student->storStudent($request);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return $this->student->showStudent($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return $this->student->editStudent($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function update(StoreStudentRequest $request)
    {
        $this->student->updateStudent($request);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $this->student->destroyStudent($request);
    }

    public function Get_classrooms($id)
    {
        return $this->student->Get_classrooms($id);
    }

    public function Get_sections($id)
    {
        return $this->student->Get_sections($id);
    }
    public function upload_attachment(Request $request)
    {
        return $this->student->updateStudent($request);
    }

    public function download_attachment($studentsname, $filename)
    {
        return $this->student->download_attachment($studentsname, $filename);
    }

    public function delete_attachment(Request $request)
    {
        return $this->student->delete_attachment($request);
    }
}
