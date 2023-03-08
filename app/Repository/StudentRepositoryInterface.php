<?php

namespace App\Repository;

interface StudentRepositoryInterface
{
    public function getStudent();
    public function Get_classrooms($id);
    public function Get_sections($id);
    public function createStudent();
    public function storStudent($request);
    public function editStudent($id);
    public function updateStudent($request);
    public function destroyStudent($request);

}
