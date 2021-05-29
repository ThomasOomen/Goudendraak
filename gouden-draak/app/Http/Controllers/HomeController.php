<?php

namespace App\Http\Controllers;

use App\Models\ProductType;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function show() {
        $menuCategories = Array();
        $product_types = ProductType::all();

        foreach ($product_types as $product_type) {
            $category_products = Array();
            foreach ($product_type->products as $product) {
                if ($product->onTheMenu === true) {
                    array_push($category_products);

                    // TODO make extra pagina for bargains
                }
            }
            $menuCategories[$product_type->name] = $category_products;
        }
        return view('menu_card', ['menuCategories' => $menuCategories]);
    }
}
