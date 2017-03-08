<?php

namespace App\Http\Controllers\Admin\Pages;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Modules\Admin\Routing\Routing;

class RoutingController extends Controller
{
    
    public function index()
    {
       	return view('admin.routing');
    }
}