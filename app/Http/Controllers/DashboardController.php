<?php

namespace App\Http\Controllers;

use App\ProjectMember;
use Illuminate\Http\Request;
use Auth;

class DashboardController extends Controller
{
    public function index()
    {

        return view('pages.dashboard');
    }
}
