<?php

namespace App\Http\Controllers\Admin\Modules;

use App\Http\Controllers\Controller;
use App\Http\Requests\CatalogAjaxRequest;
use Illuminate\Auth\Access\Response;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Modules\Admin\Routing\Routing;
use App\Catalog as Catalog;
use App\Products as Products;
use App\Attrs as Attr;
use App\AttrsValues as AttrsValues;
use Illuminate\Http\Request;

define ('ALL_CATEGORIES', 0);

class CatalogController extends Controller
{
    
    public function indexCategories()
    {
        $categories = Catalog::all();
        return view('admin.modules.catalog.categories', $categories);
    }

    public function indexProducts() {
        $products = Products::all();
        $allCategories = Catalog::all();
        foreach ($allCategories as $cat) {
            if($cat->active == 1) {
                $activeCategories[] = $cat;
            }
            else if($cat->parent_id == null) {
                $rootCategories[] = $cat;
            }
        }
        return view('admin.modules.catalog.products',
                ['activeCategories'=>$activeCategories,
                'rootCategories'=>$rootCategories]);
    }

    public function insertCategory() {

    }

    public function ajaxCatalog(Request $request, $action = null) {
        $input = $request->all();

        try {
            $category = new Catalog;
            if($input['parent_id'] != '' && $input['parent_id'] != null) {
                $category->parent_id = $input['parent_id'];
            }
            $category->name = $input['name'];
            $category->description = $input['description'];
            $category->active = ($input['active'] == 'true' ? true : false);
            $category->url_part = $input['url_part'];
            $category->save();
        }
        catch (\Exception $e) {
            return $e;
        }

        $additionalAttrs = $input['additional'];
        foreach($additionalAttrs as $attrName=>$type) {
            try {
                $attr = new Attr;
                $attr->category_id = $category->id;
                $attr->name = $attrName;
                $attr->type = $type;
                $attr->save();
            }
            catch(\Exception $e) {
                return $e;
            }
        }

        return "ok";
    }

    public function ajaxProductsAdd(Request $request) {
        $input = $request->all();
        try {
            $product = new Products;
            $product->category_id = $input['category_id'];
            $product->name = $input['name'];
            $product->price = $input['price'];
            $product->description = $input['description'];
            $product->active = ($input['active'] == 'true' ? true : false);
            $product->availability = ($input['availability'] == 'true' ? true : false);
            $product->url_part = $input['url_part'];
            $product->img_path = $input['img_path'];
            $product->save();
        }
        catch (\Exception $e) {
            return $e;
        }

        $additionalAttrs = $input['additional'];
        foreach($additionalAttrs as $attrId=>$value) {
            try {
                $attrValue = new AttrsValues();
                $attrValue->product_id = $product->id;
                $attrValue->attribute_id = $attrId;

                $type = Attr::find($attrId)->type;
                switch ($type) {
                    case 'int':
                        $attrValue->value_int = intval($value);
                        break;
                    case 'bool':
                        $attrValue->value_bool = boolval($value);
                        break;
                    case 'generic':
                        $attrValue->value_generic = $value;
                        break;
                    case 'string':
                        $attrValue->value_generic = $value;
                        break;
                    case 'date':
                        $attrValue->value_date = $value;
                        break;
                    default:
                        continue;
                }
                $attrValue->save();
            }
            catch(\Exception $e) {
                return $e;
            }
        }

        return "ok";
    }

    public function ajaxAttrsRetrieve(Request $request) {
        $input = $request->all();
        $categoryId = $input['id'];
        $attrs = Attr::where('category_id', $categoryId)->get();

        while(true) {
            foreach ($attrs as $attr) {
                $col_result[$attr->id] = $attr->name;
            }

            $categoryId = Catalog::where('id', $categoryId)->first()->parent_id;
            if($categoryId != null) {
                $attrs = Attr::where('category_id', $categoryId)->get();
            }
            else {
                break;
            }
        }

        return response()->json($col_result);
    }

    public function ajaxProductsRetrieve(Request $request) {
        $input = $request->all();
        $categoryId = $input['id'];

        $products = Products::where('category_id',  $categoryId)->get();
        if($products == null) {
            return response()->json(['test'=>'test']);
        }

        $result = array();
        foreach ($products as $product) {
            $result[$product->id] = $product->name;
        }

        return response()->json($result);
    }

    public function ajaxCategoriesRetrieve(Request $request) {
        $input = $request->all();
        $categoryId = $input['id'];


        $categories = Catalog::where('parent_id',  $categoryId)->get();
        if($categories == null) {
            return response()->json(['test'=>'test']);
        }

        $result = array();
        foreach ($categories as $category) {
            $result[$category->id] = $category->name;
        }

        return response()->json($result);
    }

    public function test() {
        $testclass = new \ReflectionClass('App\Catalog');
        echo "<pre>";
        \Reflection::export($testclass);
    }

}
