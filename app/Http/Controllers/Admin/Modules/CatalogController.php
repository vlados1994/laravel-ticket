<?php

namespace App\Http\Controllers\Admin\Modules;

use App\Http\Controllers\Controller;
use App\Http\Requests\CatalogAjaxRequest;
use Illuminate\Auth\Access\Response;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Modules\Admin\Routing\Routing;
use App\Catalog as Catalog;
use App\Products as Products;
use App\Attr as Attr;
use Illuminate\Http\Request;

class CatalogController extends Controller
{
    
    public function showCategories()
    {
        $categories = Catalog::all();
        return view('admin.modules.catalog.categories', $categories);
    }

    public function showProducts() {
        $products = Products::all();
        $categories = Catalog::all();
        return view('admin.modules.catalog.products',
            ['categories'=>$categories, 'products'=>$products]);
    }

    public function insertCategory() {

    }

    public function ajaxCatalog(Request $request, $action = null) {
        $input = $request->all();
        try {
            $category = new Catalog;
            $category->parent_id = $input['parent_id'];
            $category->name = $input['name'];
            $category->description = $input['description'];
            $category->active = ($input['active'] == 'true' ? true : false);
            $category->url_part = $input['url_part'];
            $category->save();
        }
        catch (\Exception $e) {
            return $e;
        }
        return "ok";
    }

    public function ajaxProducts(Request $request, $action = null) {
        $input = $request->all();

        if($action == 'add') {
            try {
                $product = new Products;
                $product->parent_id = $input['parent_id'];
                $product->name = $input['name'];
                $product->description = $input['description'];
                $product->active = ($input['active'] == 'true' ? true : false);
                $product->url_part = $input['url_part'];
                $product->save();
            }
            catch (\Exception $e) {
                return $e;
            }
            return "ok";
        }
        else {
            try {
                $cols = \DB::connection()->getSchemaBuilder()->getColumnListing($input['type']);
            }
            catch (\Exception $e) {
                return $e;
            }

            //негибкий метод. TODO: придумать как исправить.
            // хотя мб и гибкий. убираем два последних значения которые есть во всех таблицах ларавел
            // с датой создания и модификации, так же столбцы primary key и foreign key (содержащие в названии 'id')
            array_pop($cols);
            array_pop($cols);
            for($i = 0; $i < count($cols); $i++) {
                if(strpos($cols[$i], 'id') === false) {
                    $col_result[] = $cols[$i];
                }
            }
        }
        return response()->json($col_result);
    }

}
