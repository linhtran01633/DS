<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Drug;
use App\Models\DrugUnit;
use App\Models\Generic;
use App\Models\ImageProduct;
use App\Models\Invoice;
use App\Models\InvoiceDetail;
use App\Models\News;
use App\Models\Patient;
use App\Models\Product;
use App\Models\Sick;
use App\Models\Usage;
use App\Models\User;
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

                    $new_news = new News();
                    $data = $request->only($new_news->getFillable());
                    $new_news->fill($data)->save();

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
                    $edit_news = News::where('id', $request->id)->first();
                    $data = $request->only($edit_news->getFillable());
                    $edit_news->fill($data)->save();
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

    // khu vực sử lý user
        public function userIndex(Request $request)
        {
            try {
                $page_current = 'user';
                $users = User::where('id', '!=', 1);

                if($request->search_user) $users = $users->where('name','LIKE', '%'.$request->search_user .'%');

                $users = $users->paginate(10);
                $request->flash();
                return view('admin.user')->with([
                    'users' => $users,
                    'page_current' => $page_current,
                ]);
            } catch (Exception $e) {
                return view('page404');
            }
        }

        public function userAdd(Request $request)
        {
            try {
                DB::transaction(function () use ($request) {
                    $new_user = new User();
                    $data = $request->only($new_user->getFillable());
                    $new_user->fill($data)->save();
                });
            } catch (Exception $e) {
                Log::info($e->getMessage());
                return Redirect::route('admin.user.index')->with('message', 'Đăng kí không thành công');
            }
            return Redirect::route('admin.user.index')->with('message', 'Đăng kí thành công');
        }

        public function userDelete(Request $request)
        {
            try {
                DB::transaction(function () use ($request) {
                    User::where('id', $request->id)
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
    // kết thúc khu vực user

    // khu vực quản lý clinic

        public function clinicIndex(Request $request)
        {
            try {
                $patient = Patient::where('status', 0)->orderBy('id', 'desc')->get();
                $usage = Usage::select( 'id','name')->where('status', 0)->orderBy('id', 'desc')->get();
                $generic = Generic::select( 'id','name')->where('status', 0)->orderBy('id', 'desc')->get();
                $drugUnit = DrugUnit::select( 'id','name')->where('status', 0)->orderBy('id', 'desc')->get();
                $drug = Drug::with(['Generic', 'DrugUnit'])->where('status', 0)->orderBy('id', 'desc')->get();

                return view('admin.clinic')->with([
                    'drug' => $drug,
                    'usage' => $usage,
                    'generic' => $generic,
                    'patient' => $patient,
                    'drugUnit' => $drugUnit,
                ]);
            } catch(Exception $e) {
                return view('admin.page_404');
            }
        }


        public function addGeneric(Request $request)
        {
            try {
               DB::transaction(function () use ($request) {
                    $new_news = new Generic();
                    $new_news->name = $request->name;
                    $new_news->save();
               });
            } catch(Exception $e) {
                return Redirect::route('admin.clinic.index', ['tab' => 3])->with('message', 'Đăng kí không thành công');
            }

            return Redirect::route('admin.clinic.index', ['tab' => 3])->with('message', 'Đăng kí thành công');
        }

        public function addDrugUnit(Request $request)
        {
            try {
               DB::transaction(function () use ($request) {
                    $new_news = new DrugUnit();
                    $new_news->name = $request->name;
                    $new_news->save();
               });
            } catch(Exception $e) {
                return Redirect::route('admin.clinic.index', ['tab' => 4])->with('message', 'Đăng kí không thành công');
            }

            return Redirect::route('admin.clinic.index', ['tab' => 4])->with('message', 'Đăng kí thành công');
        }

        public function addDrug(Request $request)
        {
            try {
                DB::transaction(function () use ($request) {
                    $new_drug = new Drug();
                    $new_drug->name = $request->name;
                    $new_drug->price = $request->price;
                    $new_drug->id_generic = $request->id_generic;
                    $new_drug->id_drug_unit = $request->id_drug_unit;
                    $new_drug->save();
                });
            } catch(Exception $e) {
                return Redirect::route('admin.clinic.index', ['tab' => 5])->with('message', 'Đăng kí không thành công');
            }

            return Redirect::route('admin.clinic.index', ['tab' => 5])->with('message', 'Đăng kí thành công');
        }

        public function addUsage(Request $request)
        {
            try {
                DB::transaction(function () use ($request) {
                    $new_usage = new Usage();
                    $new_usage->name = $request->name;
                    $new_usage->save();
                });
            } catch(Exception $e) {
                return Redirect::route('admin.clinic.index', ['tab' => 6])->with('message', 'Đăng kí không thành công');
            }

            return Redirect::route('admin.clinic.index', ['tab' => 6])->with('message', 'Đăng kí thành công');
        }

        public function patientAdd(Request $request)
        {
            try {
                DB::transaction(function () use ($request) {
                    $new_usage = new Patient();
                    $new_usage->sex = $request->sex;
                    $new_usage->job = $request->job;
                    $new_usage->date = $request->date;
                    $new_usage->name = $request->name;
                    $new_usage->phone = $request->phone;
                    $new_usage->ethnic = $request->ethnic;
                    $new_usage->address = $request->address;
                    $new_usage->workshop = $request->workshop;
                    $new_usage->save();
                });
            } catch(Exception $e) {
                return Redirect::route('admin.clinic.index', ['tab' => 1])->with('message', 'Đăng kí không thành công');
            }

            return Redirect::route('admin.clinic.index', ['tab' => 1])->with('message', 'Đăng kí thành công');
        }

        public function sickAdd(Request $request)
        {
            try {
                DB::transaction(function () use ($request) {
                    $new_sick = new Sick();
                    $new_sick->T = $request->T;
                    $new_sick->HA = $request->HA;
                    $new_sick->BMI = $request->BMI;
                    $new_sick->tall = $request->tall;
                    $new_sick->date = $request->date;
                    $new_sick->hours = $request->hours;
                    $new_sick->weight = $request->weight;
                    $new_sick->circuit = $request->circuit;
                    $new_sick->symptom = $request->symptom;
                    $new_sick->breathing = $request->breathing;
                    $new_sick->blood_sugar = $request->blood_sugar;
                    $new_sick->save();
                });
            } catch(Exception $e) {
                dd($e->getMessage());
                return Redirect::route('admin.clinic.index', ['tab' => 1])->with('message', 'Đăng kí không thành công');
            }

            return Redirect::route('admin.clinic.index', ['tab' => 1])->with('message', 'Đăng kí thành công');
        }

        public function dropdownGeneric(Request $request)
        {
            try {
                $resultCount = 50;
                $page = $request->page;
                $offset = ($page - 1) * $resultCount;

                $CountResults   = Generic::where('status', 0);
                $results = Generic::select(
                    'id',
                    'name',
                )->where('status', 0);

                if($request->term) {
                        $results = $results->where('name', 'LIKE', '%' . $request->term . '%');
                        $CountResults = $CountResults->where('name', 'LIKE', '%' . $request->term . '%');
                }

                $CountResults = $CountResults->count();
                $results = $results->skip($offset)->take($resultCount)->get();


                $count = $CountResults;
                $endCount = $offset + $resultCount;
                $morePages = $endCount < $count;


                $results = [
                    "results" => $results,
                    "pagination" => array("more" => $morePages)
                ];

                return response()->json($results, 200, [], JSON_UNESCAPED_UNICODE);
            } catch (Exception $e) {
                return response()->json($e->getMessage(), 500, [], JSON_UNESCAPED_UNICODE);
            }
        }

        public function dropdownDrugUnit(Request $request)
        {
            try {
                $resultCount = 50;
                $page = $request->page;
                $offset = ($page - 1) * $resultCount;

                $CountResults   = Generic::where('status', 0);
                $results = Generic::select(
                    'id',
                    'name',
                )->where('status', 0);

                if($request->term) {
                        $results = $results->where('name', 'LIKE', '%' . $request->term . '%');
                        $CountResults = $CountResults->where('name', 'LIKE', '%' . $request->term . '%');
                }

                $CountResults = $CountResults->count();
                $results = $results->skip($offset)->take($resultCount)->get();


                $count = $CountResults;
                $endCount = $offset + $resultCount;
                $morePages = $endCount < $count;


                $results = [
                    "results" => $results,
                    "pagination" => array("more" => $morePages)
                ];

                return response()->json($results, 200, [], JSON_UNESCAPED_UNICODE);
            } catch (Exception $e) {
                return response()->json($e->getMessage(), 500, [], JSON_UNESCAPED_UNICODE);
            }
        }
    // kết thúc khu vực clinic
}
