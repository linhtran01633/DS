<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Exception;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    //
    public function index(Request $request)
    {
        try{

            if($request->category_id) {
                $best_sale = [];
            } else {
                $best_sale = Product::where('delete_flag', 0)->orderBy('id', 'desc')->take(10)->get();
            }

            $categorys = Category::with(['Product'=>function($q){
                $q->where('delete_flag', 0);
                $q->take(10);
            }]);

            if($request->category_id) {
                $categorys = $categorys->where('id', $request->category_id);
            }

            $categorys = $categorys->where('delete_flag', 0)
            ->get();

            return view('welcome')->with([
                'best_sale' => $best_sale,
                'categorys' => $categorys,
            ]);
        } catch(Exception $e) {
            dd($e->getMessage());
            return view('welcome');
        }
    }

    public function detail(Request $request)
    {
        try {
            $product_detail = Product::with(['Category', 'productImg'])->where('id', $request->id)->first();

            return view('detail')->with(['product_detail' => $product_detail]);
        } catch(Exception $e) {
            return view('welcome');
        }
    }

    public function introduce(Request $request)
    {
        try {
            return view('introduce');
        } catch(Exception $e) {
            return 1;
        }
    }

    public function contact(Request $request)
    {
        try {
            return view('contact');
        } catch(Exception $e) {
            return 1;
        }
    }

    public function shoppingCard(Request $request)
    {
        return view('card');
    }

    public function shopping_card(Request $request)
    {
        try{
            $result = [];
            $array_id = [];

            foreach($request->data as $item) {
                $array_id[] = $item['id'];
            }

            if(count($array_id) > 0) {
                $array_result = Product::whereIn('id', $array_id)->get();

                foreach($array_result as $item) {
                    $quantity = 1;
                    foreach ($request->data as $value) {
                        if ($value["id"] == $item->id) {
                            $quantity = $value['quantity'];
                            break;
                        }
                    }
                    $result[] = [
                        'product' => $item,
                        'quantity' => $quantity,
                    ];
                }
            }

            return response()->json($result, 200, [], JSON_UNESCAPED_UNICODE);
        } catch(Exception $e) {
            return response()->json($e->getMessage(), 500, [], JSON_UNESCAPED_UNICODE);
        }
    }

    public function invoice(Request $request)
    {
        try{

        } catch(Exception $e) {

        }
        return redirect()->back();
    }
}
