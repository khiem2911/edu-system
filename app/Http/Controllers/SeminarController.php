<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use RealRashid\SweetAlert\Facades\Alert;
Use Exception;
class SeminarController extends Controller
{
    public function index()
    {
        return view('seminar.index');
    }
}
