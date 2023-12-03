<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\ClassModel;
use Hash;
use Auth;

class TeacherController extends Controller
{
    public function list() {

        //$data['getRecord'] = User::getTeacher();
        $data['header_title'] = "Teacher List";
        return view('admin.teacher.list', $data);
    }

    public function add() {
       // $data['getClass'] = ClassModel::getClass();
        $data['header_title'] = "Add New Teacher";
        return view('admin.teacher.add', $data);
    }
}
