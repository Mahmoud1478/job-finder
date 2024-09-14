<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EmployerController extends Controller
{
    public function index()
    {
        $jobs = auth()->user()->jobs()->latest()->withCount(['applications'])->paginate();
        return view('dashboard', compact('jobs'));
    }
}
