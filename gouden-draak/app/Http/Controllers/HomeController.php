<?php

namespace App\Http\Controllers;

use App\Models\ProductType;
use Illuminate\Http\Request;
use PDF;

class HomeController extends Controller
{
    public function show() {
        $menuCategories = Array();
        $product_types = ProductType::all();

        foreach ($product_types as $product_type) {
            $category_products = Array();
            foreach ($product_type->products as $product) {
                if ($product->onTheMenu == true) {
                    array_push($category_products, $product);
                    $product->menuItem;
                    $product->productType;

                    // TODO: make extra page for bargains
                }
            }
            $menuCategories[$product_type->name] = $category_products;
        }
        return view('menu_card', ['menuCategories' => $menuCategories]);
    }

    public function makeMenuPDF() {
        $menuCategories = Array();
        // TODO: make Array of bargains
        // $activeBargains = Array();
        $product_types = ProductType::all();

        foreach ($product_types as $product_type) {
            foreach ($product_type->products as $product) {
                $product->menuItem;
                $product->productType;

                // TODO add bargains
//                $bargains = $product->bargains;
//                if(!empty($bargains)){
//                    foreach($bargains as $bargain){
//                        if($bargain->endDate > Carbon::now() && $bargain->startDate <= Carbon::now()){
//                            $product->price = $bargain->pivot->price;
//                        }
//                    }
//                }
            }
            $menuCategories[$product_type->name] = $product_type->products;
        }
        // TODO: fill bargain Array
//        $bargains = Bargain::all();
//        if(!empty($bargains)) {
//            foreach ($bargains as $bargain) {
//
//                if ($bargain->endDate > Carbon::now() && $bargain->startDate <= Carbon::now()) {
//                    $bargain->startDate = date('d-m-Y', strtotime($bargain->startDate));
//                    $bargain->endDate = date('d-m-Y', strtotime($bargain->endDate));
//                    array_push($activeBargains, $bargain);
//                }
//            }
//        }

        $pdf = PDF::loadview('menu_PDF', compact('menuCategories'));
        return $pdf->download('Gouden-draak_menukaart.pdf');
    }
}
