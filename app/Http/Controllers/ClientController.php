<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Invoice;
use App\Models\InvoiceDetail;
use App\Models\News;
use App\Models\Product;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
            }]);

            if($request->group_category_id) {
                $categorys = $categorys->whereIn('id', $request->group_category_id);
            } else if($request->category_id) {
                $categorys = $categorys->where('id', $request->category_id);
            } else {
                $categorys = $categorys->whereHas('Product', function($query) {
                    $query->where('delete_flag', 0)->take(10);
                });
            }

            $categorys = $categorys->where('delete_flag', 0)
            ->get();



            return view('welcome')->with([
                'best_sale' => $best_sale,
                'categorys' => $categorys,
            ]);
        } catch(Exception $e) {
            return view('page404');
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
        try {
            DB::transaction(function() use ($request){
                $amount = 0;
                $curent_day = Carbon::now()->format('d-m-Y');

                foreach($request->data as $item) {
                    $amount += $item['price'] * $item['quantity_product'];
                }

                $new_invoice = new Invoice();
                $data = $request->only($new_invoice->getFillable());
                $data['amount'] = $amount;
                $data['date'] = $curent_day;
                $new_invoice->fill($data)->save();

                $new_invoice_id = $new_invoice->getConnection()->getPdo()->lastInsertId();

                foreach($request->data as $item) {
                    $new_invoice_detail = new InvoiceDetail();
                    $new_invoice_detail->amount = $item['price'];
                    $new_invoice_detail->quanty = $item['quantity_product'];
                    $new_invoice_detail->invoice_id = $new_invoice_id;
                    $new_invoice_detail->product_id = $item['id_product'];
                    $new_invoice_detail->save();
                }
            });
        } catch (Exception $e) {
            return redirect()->back();
        }
        return redirect()->back();
    }

    public function news(Request $request)
    {
        try {
            $news = News::where('delete_flag', 0)->orderBy('id', 'desc')->get();
            return view('news')->with(['news'=> $news]);
        } catch (Exception $e) {
            return view('page404');
        }
    }

    public function detailNews(Request $request)
    {
        try {
            $news = News::where('delete_flag', 0)->where('id' , $request->id)->orderBy('id', 'desc')->first();
            if($news) return view('detail_news')->with(['news'=> $news]);
            else return view('page404');
        } catch (Exception $e) {
            return view('page404');
        }
    }
}
