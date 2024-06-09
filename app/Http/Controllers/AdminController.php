<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\CategoryParent;
use App\Models\Drug;
use App\Models\DrugUnit;
use App\Models\Generic;
use App\Models\ImageProduct;
use App\Models\ImageSick;
use App\Models\Invoice;
use App\Models\InvoiceDetail;
use App\Models\News;
use App\Models\Patient;
use App\Models\Prescription;
use App\Models\PrescriptionDetail;
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
use PDF;


class AdminController extends Controller
{

    public function index(Request $request)
    {
        try {
            $page_current = 'home';
            return view('admin.index')->with(['page_current' => $page_current]);
        } catch (Exception $e) {
            return view('admin.index');
        }
    }

    // khu vực sử lý danh mục cha
        public function categoryParent(Request $request)
        {
            try {
                $page_current = 'category_parent';

                $categorys = CategoryParent::where('delete_flag', 0)->orderBy('id', 'DESC');

                if($request->search_name) $categorys = $categorys->where('name','LIKE', '%'.$request->search_name .'%');

                $categorys = $categorys->paginate(10);

                return view('admin.category_parent')->with(['page_current' => $page_current, 'categorys' => $categorys]);
            } catch (Exception $e) {
                return view('admin.category_parent');
            }
        }

        public function categoryParentAdd(Request $request)
        {
            try {
                DB::transaction(function() use ($request) {
                    $new_category = new CategoryParent();
                    $new_category->name = $request->name;
                    $new_category->id = CategoryParent::max('id') + 1;
                    $new_category->save();
                });
            } catch (Exception $e) {
                Log::info($e->getMessage());
                return Redirect::route('admin.categoryParent.index')->with('message',  'Đăng kí không thành công');
            }

            return Redirect::route('admin.categoryParent.index')->with('message', 'Đăng kí thành công');
        }

        public function categoryParentEdit(Request $request)
        {
            try {
                DB::transaction(function () use ($request) {
                    CategoryParent::where('id', $request->id)
                    ->update([
                        'name' => $request->name
                    ]);
                });
            } catch (Exception $e) {
                return Redirect::route('admin.categoryParent.index')->with('message', $e->getMessage());
            }
            return Redirect::route('admin.categoryParent.index')->with('message', 'Cập nhập thành công');

        }

        public function categoryParentDelete(Request $request)
        {
            try {
                DB::transaction(function () use ($request) {
                    CategoryParent::where('id', $request->id)
                    ->update([
                        'delete_flag' => 1
                    ]);
                });
            } catch (Exception $e) {
                return response()->json($e->getMessage(), 500, [], JSON_UNESCAPED_UNICODE);
            }

            return response()->json('Xoá thành công', 200, [], JSON_UNESCAPED_UNICODE);
        }


    // kết thúc khu vực sử lý danh mục cha
    // khu vực sử lý của danh mục
        public function categoryIndex(Request $request)
        {
            try {
                $page_current = 'category';


                $categorys = Category::where('delete_flag', 0)->orderBy('name', 'ASC');
                $categoryParents = CategoryParent::where('delete_flag', 0)->orderBy('name', 'ASC')->get();

                if($request->search_name) $categorys = $categorys->where('name','LIKE', '%'.$request->search_name .'%');

                $categorys = $categorys->paginate(10);

                return view('admin.category')->with([
                    'categorys' => $categorys,
                    'page_current' => $page_current,
                    'categoryParents' => $categoryParents,
                ]);
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
                    $new_category->category_parent_id = $request->category_parent_id;
                    $new_category->save();
                });
            } catch (Exception $e) {
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
                        'name' => $request->name,
                        'category_parent_id' => $request->category_parent_id,
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
                $patient = Patient::where('status', 0);
                if($request->search_name_tab1) $patient = $patient->where('name', 'like', '%'. $request->search_name_tab1 . '%');
                $patient = $patient->orderBy('name', 'ASC')->paginate(10);

                $patient_tab2 = Patient::where('status', 0);
                if($request->search_name_tab2) $patient_tab2 = $patient_tab2->where('name', 'like', '%'. $request->search_name_tab2 . '%');
                $patient_tab2 = $patient_tab2->orderBy('name', 'ASC')->paginate(10);



                $generic = Generic::select( 'id','name')->where('status', 0);
                if($request->search_name_tab3) $generic = $generic->where('name', 'like', '%'. $request->search_name_tab3 . '%');
                $generic = $generic->orderBy('id', 'desc')->get();

                $drugUnit = DrugUnit::select( 'id','name')->where('status', 0);
                if($request->search_name_tab4) $drugUnit = $drugUnit->where('name', 'like', '%'. $request->search_name_tab4 . '%');
                $drugUnit = $drugUnit->orderBy('id', 'desc')->get();

                $drug = Drug::with(['Generic', 'DrugUnit'])->where('status', 0);
                if($request->search_name_tab5) $drug = $drug->where('name', 'like', '%'. $request->search_name_tab5 . '%');
                $drug = $drug->orderBy('id', 'desc')->get();

                $usage = Usage::select( 'id','name')->where('status', 0);
                if($request->search_name_tab6) $usage = $usage->where('name', 'like', '%'. $request->search_name_tab6 . '%');
                $usage = $usage->orderBy('id', 'desc')->get();

                $request->flash();

                return view('admin.clinic')->with([
                    'drug' => $drug,
                    'usage' => $usage,
                    'generic' => $generic,
                    'patient' => $patient,
                    'drugUnit' => $drugUnit,
                    'patient_tab2' => $patient_tab2,
                    'tab' => $request->tab,
                ]);
            } catch(Exception $e) {
                return view('page_404');
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

        public function editGeneric(Request $request)
        {
            try {
                DB::transaction(function () use ($request) {
                    Generic::where('id', $request->id)->update(['name' => $request->name]);
                });
            } catch(Exception $e) {
                return Redirect::route('admin.clinic.index', ['tab' => 3])->with('message', 'Cập nhập không thành công');
            }

            return Redirect::route('admin.clinic.index', ['tab' => 3])->with('message', 'Cập nhập thành công');
        }

        public function genericDelete(Request $request)
        {
            try {
                DB::transaction(function () use ($request) {
                    $count = Drug::where('id_generic', $request->id)->where('status', 0)->count();
                    if($count > 0) {
                        throw new Exception('Có dược phẩm đang sử dụng hoạt chất này');
                    } else {
                        Generic::where('id', $request->id)->update(['status' => 1]);
                    }
                });
            } catch(Exception $e) {
                $error = 'Xoá không thành công';
                if($e->getMessage() == 'Có dược phẩm đang sử dụng hoạt chất này') $error = $e->getMessage();
                return Redirect::route('admin.clinic.index', ['tab' => 3])->with('message', $error);
            }

            return Redirect::route('admin.clinic.index', ['tab' => 3])->with('message', 'Xoá thành công');

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

        public function editDrugUnit(Request $request)
        {
            try {
                DB::transaction(function () use ($request) {
                    DrugUnit::where('id', $request->id)->update(['name' => $request->name]);
                });
            } catch(Exception $e) {
                return Redirect::route('admin.clinic.index', ['tab' => 4])->with('message', 'Xoá không thành công');
            }

            return Redirect::route('admin.clinic.index', ['tab' => 4])->with('message', 'Xoá thành công');
        }

        public function drugUnitDelete(Request $request)
        {
            try {
                DB::transaction(function () use ($request) {
                    $count = Drug::where('id_drug_unit', $request->id)->where('status', 0)->count();
                    if($count > 0) {
                        throw new Exception('Có dược phẩm đang sử dụng đơn vị thuốc này');
                    } else {
                        DrugUnit::where('id', $request->id)->update(['status' => 1]);
                    }

                });
            } catch(Exception $e) {
                $error = 'Xoá không thành công';
                if($e->getMessage() == 'Có dược phẩm đang sử dụng đơn vị thuốc này') $error = $e->getMessage();
                return Redirect::route('admin.clinic.index', ['tab' => 4])->with('message', $error);
            }

            return Redirect::route('admin.clinic.index', ['tab' => 4])->with('message', 'Xoá thành công');
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

        public function editDrug(Request $request)
        {
            try {
                DB::transaction(function () use ($request) {
                    $edit_drug = Drug::where('id', $request->id)->first();
                    $edit_drug->name = $request->name;
                    $edit_drug->price = $request->price;
                    $edit_drug->id_generic = $request->id_generic;
                    $edit_drug->id_drug_unit = $request->id_drug_unit;
                    $edit_drug->save();
                });
            } catch(Exception $e) {
                return Redirect::route('admin.clinic.index', ['tab' => 5])->with('message', 'Cập nhập không thành công');
            }

            return Redirect::route('admin.clinic.index', ['tab' => 5])->with('message', 'Cập nhập thành công');
        }

        public function drugDelete(Request $request)
        {
            try {
                DB::transaction(function () use ($request) {
                    Drug::where('id', $request->id)->update(['status' => 1]);
                });
            } catch(Exception $e) {
                return Redirect::route('admin.clinic.index', ['tab' => 5])->with('message', 'Xoá không thành công');
            }

            return Redirect::route('admin.clinic.index', ['tab' => 5])->with('message', 'Xoá thành công');
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

        public function usageEdit(Request $request)
        {
            try {
                DB::transaction(function () use ($request) {
                    Usage::where('id', $request->id)->update(['name' => $request->name]);
                });
            } catch(Exception $e) {
                return Redirect::route('admin.clinic.index', ['tab' => 6])->with('message', 'Cập nhập không thành công');
            }

            return Redirect::route('admin.clinic.index', ['tab' => 6])->with('message', 'Cập nhập thành công');
        }

        public function usageDelete(Request $request)
        {
            try {
                DB::transaction(function () use ($request) {
                    Usage::where('id', $request->id)->update(['status' => 1]);
                });
            } catch(Exception $e) {
                return Redirect::route('admin.clinic.index', ['tab' => 6])->with('message', 'Xoá không thành công');
            }

            return Redirect::route('admin.clinic.index', ['tab' => 6])->with('message', 'Xoá thành công');
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
                    $data = $request->only($new_sick->getFillable());
                    $new_sick->fill($data)->save();
                });
            } catch(Exception $e) {
                return Redirect::route('admin.clinic.index', ['tab' => 1])->with('message', 'Đăng kí không thành công');
            }

            return Redirect::route('admin.clinic.index', ['tab' => 1])->with('message', 'Đăng kí thành công');
        }

        public function sickEdit(Request $request)
        {
            try {
                DB::transaction(function () use ($request) {
                    $edit_sick = Sick::where('id', $request->id_sick)->first();
                    $edit_sick->result = $request->result;
                    $edit_sick->result1 = $request->result1;
                    $edit_sick->result2 = $request->result2;
                    $edit_sick->result3 = $request->result3;
                    $edit_sick->save();



                    if ($request->hasFile('image_multiple')) {
                        ImageSick::where('sick_id', $request->id_sick)->update(['delete_flag' => 1]);

                        foreach($request->file('image_multiple') as $index=>$item) {

                            $path_item = 'public/sicks';
                            $extension_item = strtolower($item->extension());
                            $file_name = Carbon::now()->format('Ymdhisu'). $index . '.' . $extension_item;

                            $new_img_sick = new ImageSick();
                            $new_img_sick->path = 'sicks';
                            $new_img_sick->file_name = $file_name;
                            $new_img_sick->sick_id = $request->id_sick;
                            $new_img_sick->save();

                            $item->storeAs($path_item, $file_name);
                        }
                    }
                });
            } catch(Exception $e) {
                return Redirect::route('admin.clinic.index', ['tab' => 2])->with('message', 'Cập nhập không thành công');
            }

            return Redirect::route('admin.clinic.index', ['tab' => 2])->with('message', 'Cập nhập thành công');
        }

        public function getImgSick(Request $request)
        {
            try {
                $result = ImageSick::where('sick_id', $request->id)->where('delete_flag', 0)->get();
                return response()->json($result, 200, [], JSON_UNESCAPED_UNICODE);
            } catch (Exception $e) {
                return response()->json([], 200, [], JSON_UNESCAPED_UNICODE);
            }
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

    //
    public function listPatientSicks(Request $request)
    {
        try {
            $patient = Patient::where('id', $request->id)->first();
            $sicks = Sick::where('id_patient', $request->id)->get();
            $array_temp = [];
            foreach ($sicks as $item){
                $array_temp[$item->date][] = [
                    't' => $item->T,
                    'id' => $item->id,
                    'HA' => $item->HA,
                    'BMI' => $item->BMI,
                    'date' => $item->date,
                    'tall' => $item->tall,
                    'hours' => $item->hours,
                    'weight' => $item->weight,
                    'result' => $item->result,
                    'circuit' => $item->circuit,
                    'symptom' => $item->symptom,
                    'result1' => $item->result1,
                    'result2' => $item->result2,
                    'result3' => $item->result3,
                    'result4' => $item->result4,
                    'breathing' => $item->breathing,
                    'bloodSugar' => $item->bloodSugar,
                ];
            }

            $result = [
                'patient' => $patient,
                'array_temp' => $array_temp,
            ];

            return response()->json($result, 200, [], JSON_UNESCAPED_UNICODE);
        } catch (Exception $e) {
            return response()->json($e->getMessage(), 500, [], JSON_UNESCAPED_UNICODE);
        }

    }

    public function listPrescription(Request $request)
    {
        try {
            $sick = Sick::with('Patient', 'Prescription',
            'Prescription.PrescriptionDetail',
            'Prescription.PrescriptionDetail.Usage',
            'Prescription.PrescriptionDetail.Drug',
            'Prescription.PrescriptionDetail.Drug.Generic',
            'Prescription.PrescriptionDetail.Drug.DrugUnit',
            )->where('id', $request->id)->first();

            $list_prescription = [];
            if($sick) {
                $list_prescription = Prescription::select(
                    'sick.id',
                    'sick.date',
                    'sick.result',
                )
                ->join('sick', 'sick.id', 'prescription.id_sick')
                ->where('sick.id_patient', $sick->id_patient)->get();
            }

            return response()->json(['sick'=>$sick , 'list_prescription' => $list_prescription], 200, [], JSON_UNESCAPED_UNICODE);
        } catch (Exception $e) {
            return response()->json($e->getMessage(), 500, [], JSON_UNESCAPED_UNICODE);
        }
    }

    public function addPrescription(Request $request)
    {
        try {

            $drug = Drug::with('Generic', 'DrugUnit')->where('id', $request->id)->first();
            $usage = Usage::where('id', $request->usage_drug_add)->first();

            $array = [];
            $array['note'] = $request->note_drug_add;
            $array['price'] = $request->price_drug_add;
            $array['dosage'] = $request->dosage_drug_add;
            $array['session'] = $request->session_drug_add;
            $array['quantity'] = $request->quantity_drug_add;
            $array['every_day'] = $request->every_day_drug_add;
            $array['every_times'] = $request->every_times_drug_add;
            $array['number_of_day'] = $request->number_of_day_drug_add;

            if($drug) {
                $array['id_drug'] = $drug->id;
                $array['name_drug'] = $drug->name;
                $array['generic'] = $drug->Generic->name;
                $array['drug_unit'] = $drug->DrugUnit->name;
            } else {
                $array['id_drug'] = '';
                $array['name_drug'] = '';
                $array['generic'] = '';
                $array['drug_unit'] = '';
            }

            if($usage) {
                $array['id_usage'] = $usage->id;
                $array['name_usage'] = $usage->name;
            } else {
                $array['id_usage'] = '';
                $array['name_usage'] = '';
            }

            return response()->json($array, 200, [], JSON_UNESCAPED_UNICODE);
        } catch (Exception $e) {
            return response()->json($e->getMessage(), 500, [], JSON_UNESCAPED_UNICODE);
        }

    }

    public function savePrescription(Request $request)
    {
        try {
            DB::transaction(function () use ($request) {
                Log::info($request->all());
                $sick = Sick::where('id', $request->id_sick)->first();
                if($sick) {
                    Sick::where('id', $request->id_sick)->update([
                        'result' => $request->result,
                        'result4' => $request->result4,
                        'on_leave' => $request->on_leave,
                    ]);

                    $check_isset = Prescription::where('id_sick', $request->id_sick)->first();

                    if($check_isset) {
                        if($request->detail) {
                            $prescription = Prescription::where('id_sick', $request->id_sick)->first();
                            Prescription::where('id_sick', $request->id_sick)->update(['name' => $sick->date . ' ' . $request->result]);

                            PrescriptionDetail::where('id_prescription', $check_isset->id)->delete();

                            foreach($request->detail as $item) {
                                $new = new PrescriptionDetail();
                                $new->note = $item['note'];
                                $new->price = $item['price'];
                                $new->dosage = $item['dosage'];
                                $new->id_drug = $item['id_drug'];
                                $new->session = $item['session'];
                                $new->quantity = $item['quantity'];
                                $new->id_usage = $item['id_usage'];
                                $new->every_day = $item['every_day'];
                                $new->every_day = $item['every_day'];
                                $new->every_times = $item['every_times'];
                                // $new->user_create = $item['user_create'];
                                $new->id_prescription = $prescription->id;
                                $new->number_of_day = $item['number_of_day'];
                                $new->save();
                            }
                        }
                    } else {
                        if($request->detail) {
                            $new_prescription = new Prescription();
                            $new_prescription->name = $sick->date . ' ' . $request->result;
                            $new_prescription->id_sick = $request->id_sick;
                            $new_prescription->save();

                            $new_prescription_id = $new_prescription->getConnection()->getPdo()->lastInsertId();

                            foreach($request->detail as $item) {
                                $new = new PrescriptionDetail();
                                $new->note = $item['note'];
                                $new->price = $item['price'];
                                $new->dosage = $item['dosage'];
                                $new->id_drug = $item['id_drug'];
                                $new->session = $item['session'];
                                $new->quantity = $item['quantity'];
                                $new->id_usage = $item['id_usage'];
                                $new->every_day = $item['every_day'];
                                $new->every_day = $item['every_day'];
                                $new->every_times = $item['every_times'];
                                // $new->user_create = $item['user_create'];
                                $new->id_prescription = $new_prescription_id;
                                $new->number_of_day = $item['number_of_day'];
                                $new->save();
                            }
                        }
                    }
                }
            });
        } catch (Exception $e) {
            Log::info($e->getMessage());
            return response()->json('Lưu không thành công', 500, [], JSON_UNESCAPED_UNICODE);
        }


        return response()->json('Lưu thành công', 200, [], JSON_UNESCAPED_UNICODE);
    }

    public function generatePDF(Request $request)
    {

        $sick = Sick::with('Patient', 'Prescription',
            'Prescription.PrescriptionDetail',
            'Prescription.PrescriptionDetail.Usage',
            'Prescription.PrescriptionDetail.Drug',
            'Prescription.PrescriptionDetail.Drug.Generic',
            'Prescription.PrescriptionDetail.Drug.DrugUnit',
            )->where('id', $request->id)->first();

            $pdf = PDF::loadView('admin.export_pdf',['data'=>$sick]);

        return $pdf->download('đơn_thuốc.pdf');
    }
}
