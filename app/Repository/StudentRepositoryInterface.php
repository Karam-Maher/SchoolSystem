<?php

namespace App\Repository;

interface StudentRepositoryInterface
{
    public function getStudent();
    // Get classrooms
    public function Get_classrooms($id);
    // Get sections
    public function Get_sections($id);
    public function createStudent();
    //Store_Student
    public function storStudent($request);
    // Show_Student
    public function showStudent($id);
    public function editStudent($id);
    //Update_Student
    public function updateStudent($request);
    //Delete_Student
    public function destroyStudent($request);
    //Upload_attachment
    public function upload_attachment($request);
    //Download_attachment
    public function download_attachment($studentsname, $filename);
    //Delete_attachment
    public function delete_attachment($request);
}
