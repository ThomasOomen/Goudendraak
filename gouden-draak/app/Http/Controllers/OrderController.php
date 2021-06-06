<?php

namespace App\Http\Controllers;

use App\Models\DinnerTable;
use App\Models\Product;
use App\Models\RestaurantSale;
use App\Rules\TenMinutesOrderRule;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class OrderController extends Controller
{
    public function order_index() {
        $sales = RestaurantSale::all();
        foreach($sales as $sale){
            $sale->dinnerTable;

            foreach($sale->products as $product){
                $product->menuitem;
                $product->pivot->amount;
            }
        }

        return view('order_crud/order_index', ['sales' => $sales]);
    }

    public function order_create() {
        $products = Product::where('onTheMenu', true)->get();
        foreach($products as $product){
            $bargains = $product->bargains;
            if(!empty($bargains)){
                foreach($bargains as $bargain){
                    if($bargain->endDate > Carbon::now() && $bargain->startDate <= Carbon::now()){
                        $product->price = $bargain->pivot->price;
                    }
                }
            }
        }
        $tables = DinnerTable::all()->pluck('table_number');
        return view('order_crud/order_create', ['products' => $products, 'tables' => $tables]);
    }

    public function order_store(Request $request) {
        $this->validate($request, [
            'products.*' => 'required|numeric|distinct',
            'quantity.*' => 'required|numeric|',
            'tableNumber' => ['required','numeric',new TenMinutesOrderRule()],
        ]);

        $sale = new RestaurantSale;
        $sale->saleDate = Carbon::now();
        $sale->dinner_table_id = $request->tableNumber;

        $products = $request->products;
        $quantities = $request->quantity;

        $totalprice = 0;
        foreach($products as $key => $product){
            $productObject = Product::find($product);
            $bargains = $productObject->bargains;
            foreach($bargains as $bargain){
                if($bargain->startDate < Carbon::now() && $bargain->endDate > Carbon::now()){
                    $productObject->price = $bargain->pivot->price;
                }
            }

            $totalprice = $totalprice + ($productObject->price * $quantities[$key]);
            $sale->price = $totalprice;
            $sale->save();

            $sale->products()->attach($product,['amount'=>$quantities[$key]]);
        }
        return redirect(url('/'));
    }
}
