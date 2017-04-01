<?php
	namespace App\Http\Controllers;

	use Illuminate\Http\Request;

	use App\Http\Requests;

	class PagesController extends Controller
	{
	    public function main()
	    {
	        return view('main.mainpage');
	    }

		public function about()
		{
		    return view('about');
		}

		public function contact()
		{
		    return view('tickets.create');
		}
	}