<?php

namespace App\Repository;

interface TeacherRepositoryInterface{

    // get all Teachers
    public function GetAllTeatchers();
    public function GetSpecializations();
    public function GetGender();
    public function StoreTeatcher($request);

}
