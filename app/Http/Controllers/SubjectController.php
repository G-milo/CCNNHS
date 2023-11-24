<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SubjectModel;

class SubjectController extends Controller
{
    public function list() {

        $data['header_title'] = "Subject List";
        return view('admin.subject.list', $data);
    }

    public function add() {

        $data['header_title'] = "Add New Subject";
        return view('admin.subject.add', $data);
    }
}
