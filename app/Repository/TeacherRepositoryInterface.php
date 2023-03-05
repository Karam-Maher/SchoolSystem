<?php

namespace App\Repository;

interface TeacherRepositoryInterface
{
    // get all Teachers
    public function getAllTeachers();

    // get all Specializations
    public function getSpecializations();

    // get all Genders
    public function getGenders();

    //store teachers
    public function storeTeachers($request);

    //edit teachers
    public function editTeachers($id);

    // updateTeachers
    public function updateTeachers($request);

    // deleteTeachers
    public function deleteTeachers($request);
}
