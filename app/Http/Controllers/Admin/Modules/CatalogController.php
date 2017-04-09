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

    public function ajaxProducts(Request $request, $action = null) {
        $input = $request->all();

        if($action == 'add') {
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
        else {
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

    }

}
