<?php

namespace App\Http\Controllers;

use App\Project;
use Illuminate\Http\Request;

class BoardController extends Controller
{
    public function index($id)
    {
        $item = Project::findOrFail($id);
        return view('pages.board.index', compact('item'));
    }
}
