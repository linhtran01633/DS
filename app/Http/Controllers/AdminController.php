<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\ImageProduct;
use App\Models\Invoice;
use App\Models\InvoiceDetail;
use App\Models\News;
use App\Models\Product;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redirect;

class AdminController extends Controller
{
    // khu vực sử lý của danh mục
        public function index(Request $request)
        {
            try {
                $page_current = 'home';
                return view('admin.index')->with(['page_current' => $page_current]);
            } catch (Exception $e) {
                return view('admin.index');
            }
        }

        public function categoryIndex(Request $request)
        {
            try {
                $page_current = 'category';

                $categorys = Category::where('delete_flag', 0)->orderBy('id', 'DESC');

                if($request->search_name) $categorys = $categorys->where('name','LIKE', '%'.$request->search_name .'%');

                $categorys = $categorys->paginate(10);

                return view('admin.category')->with(['page_current' => $page_current, 'categorys' => $categorys]);
            } catch (Exception $e) {
                return view('admin.category');
            }
        }

        public function categoryAdd(Request $request)
        {
            try {
                DB::transaction(function() use ($request) {
                    $new_category = new Category();
                    $new_category->name = $request->name;
                    $new_category->save();
                });
            } catch (Exception $e) {
                Log::info($e->getMessage());
                return Redirect::route('admin.category.index')->with('message',  'Đăng kí không thành công');
            }

            return Redirect::route('admin.category.index')->with('message', 'Đăng kí thành công');
        }

        public function categoryEdit(Request $request)
        {
            try {
                DB::transaction(function () use ($request) {
                    Category::where('id', $request->id)
                    ->update([
                        'name' => $request->name
                    ]);
                });
            } catch (Exception $e) {
                return Redirect::route('admin.category.index')->with('message', $e->getMessage());
            }
            return Redirect::route('admin.category.index')->with('message', 'Cập nhập thành công');

        }

        public function categoryDelete(Request $request)
        {
            try {
                DB::transaction(function () use ($request) {
                    Category::where('id', $request->id)
                    ->update([
                        'delete_flag' => 1
                    ]);
                });
            } catch (Exception $e) {
                return response()->json($e->getMessage(), 500, [], JSON_UNESCAPED_UNICODE);
            }

            return response()->json('Xoá thành công', 200, [], JSON_UNESCAPED_UNICODE);
        }
    // kết thúc khu vực danh mục

    // khu vực sử lý của sản phẩm
        public function productIndex(Request $request)
        {
            try {
                $page_current = 'product';
                $categorys = Category::where('delete_flag', 0)->get();

                $products = Product::with(['Category'])->where('delete_flag', 0);
                if($request->search_name) $products = $products->where('name','LIKE', '%'.$request->search_name .'%');
                $products = $products->paginate(10);

                return view('admin.product')->with([
                    'products' => $products,
                    'categorys' => $categorys,
                    'page_current' => $page_current,
                ]);
            } catch (Exception $e) {
                return view('admin.page_404');
            }
        }

        public function productDetail(Request $request)
        {
            try {
                $result = Product::with(['Category', 'productImg'=>function($q){
                    $q->where('delete_flag', 0);
                }])
                ->where('id', $request->id)->first();

                return response()->json($result, 200, [], JSON_UNESCAPED_UNICODE);
            } catch (Exception $e) {
                return response()->json($e->getMessage(), 500, [], JSON_UNESCAPED_UNICODE);
            }
        }

        public function productAdd(Request $request)
        {
            try {
                DB::transaction(function () use ($request) {
                    $path = "public/product";
                    $extension = strtolower($request->image->extension());
                    $fileName = Carbon::now()->format('Ymdhisu').'.'.$extension;

                    $new_product = new Product();
                    $data = $request->only($new_product->getFillable());
                    $data['image'] = 'product/'. $fileName;
                    $new_product->fill($data)->save();

                    $new_product_id = $new_product->getConnection()->getPdo()->lastInsertId();

                    $request->image->storeAs($path, $fileName);

                    if ($request->hasFile('image_multiple')) {
                        foreach($request->file('image_multiple') as $index=>$item) {

                            $path_item = 'public/product/details';
                            $extension_item = strtolower($item->extension());
                            $file_name = Carbon::now()->format('Ymdhisu'). $index . '.' . $extension_item;

                            $new_img_product = new ImageProduct();
                            $new_img_product->path = 'product/details';
                            $new_img_product->file_name = $file_name;
                            $new_img_product->product_id = $new_product_id;
                            $new_img_product->save();

                            $item->storeAs($path_item, $file_name);
                        }
                    }
                });
            } catch (Exception $e) {
                Log::info($e->getMessage());
                return Redirect::route('admin.product.index')->with('message', 'Đăng kí không thành công');
            }
            return Redirect::route('admin.product.index')->with('message', 'Đăng kí thành công');
        }

        public function productEdit(Request $request)
        {
            try {
                DB::transaction(function () use ($request) {
                    $path = "public/product";

                    if($request->image) {
                        $extension = strtolower($request->image->extension());
                        $fileName = Carbon::now()->format('Ymdhisu').'.'.$extension;
                    }

                    $new_product = Product::where('id', $request->id)->first();
                    $data = $request->only($new_product->getFillable());

                    if($request->image) $data['image'] = 'product/'. $fileName;
                    else unset($data['image']);
                    $new_product->fill($data)->save();

                    if($request->image) {
                        $request->image->storeAs($path, $fileName);
                    }


                    if ($request->hasFile('image_multiple')) {
                        ImageProduct::where('product_id', $request->id)->update(['delete_flag' => 1]);

                        foreach($request->file('image_multiple') as $index=>$item) {
                            $path_item = 'public/product/details';
                            $extension_item = strtolower($item->extension());
                            $file_name = Carbon::now()->format('Ymdhisu'). $index . '.' . $extension_item;

                            $new_img_product = new ImageProduct();
                            $new_img_product->path = $path_item;
                            $new_img_product->file_name = $file_name;
                            $new_img_product->product_id = $request->id;
                            $new_img_product->save();

                            $item->storeAs($path_item, $file_name);
                        }
                    }
                });
            } catch (Exception $e) {
                Log::info($e->getMessage());
                return Redirect::route('admin.product.index')->with('message', 'Cập nhập không thành công');
            }
            return Redirect::route('admin.product.index')->with('message', 'Cập nhập thành công');
        }

        public function productDelete(Request $request)
        {
            try {
                DB::transaction(function () use ($request) {
                    Product::where('id', $request->id)
                    ->update([
                        'delete_flag' => 1
                    ]);

                    ImageProduct::where('product_id', $request->id)
                    ->update([
                        'delete_flag' => 1
                    ]);
                });
            } catch (Exception $e) {
                Log::info($e->getMessage());
                return response()->json('Xoá không thành công', 500, [], JSON_UNESCAPED_UNICODE);
            }

            return response()->json('Xoá thành công', 200, [], JSON_UNESCAPED_UNICODE);
        }
    // kết thúc khu vực sản phẩm

    // khu vực xử lý cảu tin tức

        public function newsIndex(Request $request)
        {
            try {
                $page_current = 'news';
                $news = News::where('delete_flag', 0);

                if($request->search_title) $news = $news->where('title','LIKE', '%'.$request->search_title .'%');

                $news = $news->paginate(10);
                $request->flash();
                return view('admin.news')->with([
                    'news' => $news,
                    'page_current' => $page_current,
                ]);
            } catch (Exception $e) {
                return view('admin.news');
            }
        }

        public function newsDetail(Request $request)
        {
            try {
                $result = News::where('id', $request->id)->first();

                return response()->json($result, 200, [], JSON_UNESCAPED_UNICODE);
            } catch (Exception $e) {
                return response()->json($e->getMessage(), 500, [], JSON_UNESCAPED_UNICODE);
            }
        }

        public function newsAdd(Request $request)
        {
            try {
                DB::transaction(function () use ($request) {

                    $path = "public/news";
                    $extension = strtolower($request->image->extension());
                    $fileName = Carbon::now()->format('Ymdhisu').'.'.$extension;

                    $new_news = new News();
                    $data = $request->only($new_news->getFillable());
                    $data['image'] = 'news/'. $fileName;
                    $new_news->fill($data)->save();

                    $request->image->storeAs($path, $fileName);

                });
            } catch (Exception $e) {
                Log::info($e->getMessage());
                return Redirect::route('admin.news.index')->with('message', 'Đăng kí không thành công');
            }
            return Redirect::route('admin.news.index')->with('message', 'Đăng kí thành công');
        }

        public function newsEdit(Request $request)
        {
            try {
                DB::transaction(function () use ($request) {

                    $path = "public/news";
                    if($request->image) {
                        $extension = strtolower($request->image->extension());
                        $fileName = Carbon::now()->format('Ymdhisu').'.'.$extension;
                    }

                    $edit_news = News::where('id', $request->id)->first();
                    $data = $request->only($edit_news->getFillable());
                    if($request->image) $data['image'] = 'news/'. $fileName;
                    else unset($data['image']);

                    $edit_news->fill($data)->save();
                    if($request->image) {
                        $request->image->storeAs($path, $fileName);
                    }
                });
            } catch (Exception $e) {
                Log::info($e->getMessage());
                return Redirect::route('admin.news.index')->with('message', 'Cập nhập không thành công');
            }
            return Redirect::route('admin.news.index')->with('message', 'Cập nhập thành công');
        }

        public function newsDelete(Request $request)
        {
            try {
                DB::transaction(function () use ($request) {
                    News::where('id', $request->id)
                    ->update([
                        'delete_flag' => 1
                    ]);
                });
            } catch (Exception $e) {
                Log::info($e->getMessage());
                return response()->json('Xoá không thành công', 500, [], JSON_UNESCAPED_UNICODE);
            }

            return response()->json('Xoá thành công', 200, [], JSON_UNESCAPED_UNICODE);
        }

    // khu vuc xu ly hoa don
        public function invoiceIndex(Request $request)
        {
            try {
                $page_current = 'invoice';

                $invoices = Invoice::where('delete_flag', 0);

                if($request->search_name_to) $invoices = $invoices->where('name_to','LIKE', '%'.$request->search_name_to .'%');

                $invoices = $invoices->paginate(10);

                $request->flash();

                return view('admin.invoice')->with([
                    'invoices' => $invoices,
                    'page_current' => $page_current,
                ]);
            } catch (Exception $e) {
                return view('admin.invoice');
            }
        }

        public function invoiceEdit(Request $request)
        {
            try {
                DB::transaction(function () use ($request) {
                    $invoices = Invoice::where('id', $request->id)->first();
                    if($invoices->invoice_flag == 0) {
                        Invoice::where('id', $request->id)->update(['invoice_flag' => 1]);
                    } else {
                        Invoice::where('id', $request->id)->update(['invoice_flag' => 0]);
                    }
                });
            } catch (Exception $e) {
                Log::info($e->getMessage());
                return response()->json('Xoá không thành công', 500, [], JSON_UNESCAPED_UNICODE);
            }

            return response()->json('Xoá thành công', 200, [], JSON_UNESCAPED_UNICODE);
        }

        public function invoiceDetail(Request $request)
        {
            try {
                $result = Invoice::with(['InvoiceDetail'=>function($q){
                    $q->with('Product');
                }])
                ->where('id', $request->id)->first();

                return response()->json($result, 200, [], JSON_UNESCAPED_UNICODE);
            } catch (Exception $e) {
                return response()->json($e->getMessage(), 500, [], JSON_UNESCAPED_UNICODE);
            }

        }
    // kết thúc khu vực hoá đơn
}
