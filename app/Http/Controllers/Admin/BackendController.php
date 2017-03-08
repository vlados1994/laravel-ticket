<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class BackendController extends Controller
{
    
    public function index()
    {
        return view('admin.index');
    }
}