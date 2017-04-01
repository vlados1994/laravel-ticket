<?php

namespace App\Http\Controllers\Admin\Modules;

use App\Http\Controllers\Controller;
use App\Http\Requests\CatalogAjaxRequest;
use Illuminate\Auth\Access\Response;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Modules\Admin\Routing\Routing;
use App\Catalog;
use Illuminate\Http\Request;

class CatalogController extends Controller
{
    
    public function showCategories()
    {
        $categories = Catalog::all();
        return view('admin.modules.catalog.categories', $categories);
    }

    public function insertCategory() {

    }

    public function ajax(CatalogAjaxRequest $request, $action = null) {
        $input = $request->all();
        return response()->json($input);
    }

}
