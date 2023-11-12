<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

class DashboardController extends Controller
{
    public function dashboard() {

        $data['header_title'] = 'Dashboard';
        if(Auth::user()->user_type == 1) {
            return view('admin.Dashboard', $data);
        }
        else if(Auth::user()->user_type == 2) {
            return view('teacher.Dashboard', $data);
        }
        else if(Auth::user()->user_type == 3) {
            return view('student.Dashboard', $data);
        }
        else if(Auth::user()->user_type == 4) {
            return view('parent.Dashboard', $data);
        }
    }
}
