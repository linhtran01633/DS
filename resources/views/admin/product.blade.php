@extends('admin.layout_admin')

@section('content')
    <main class="w-full flex-grow p-6 h-full">
        <section class="bg-white dark:bg-gray-900">
            <div class="pl-2 pb-2">
                <button type="button" class="open_sesion_add_product inline-flex items-center px-5 py-2.5 mt-4 sm:mt-6 text-sm font-medium text-center text-white rounded-lg bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300">
                    THÊM SẢN PHẨM MỚI
                </button>

                <button type="button" class="hidden close_sesion_add_product inline-flex items-center px-5 py-2.5 mt-4 sm:mt-6 text-sm font-medium text-center text-white rounded-lg bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300">
                    ẨN THÊM MỚI
                </button>
            </div>
            <div class="hidden sesion-propduct py-8 px-4 mx-auto max-w-2xl lg:py-16">
                <h2 class="mb-4 text-xl font-bold text-gray-900 dark:text-white">Thêm Mới Sản phẩm</h2>
                <form  action="{{route('admin.product.add')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="grid gap-4 sm:grid-cols-2 sm:gap-6">
                        <div class="sm:col-span-2">
                            <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Tên Sản Phẩm</label>
                            <input type="text" name="name" id="name" value="{{old('name')}}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Tên Sản Phẩm" required="">
                        </div>
                        <div class="w-full">
                            <label for="brand" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Thương Hiệu</label>
                            <input type="text" name="brand" id="brand" value="{{old('brand')}}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Thương Hiệu" required="">
                        </div>
                        <div class="w-full">
                            <label for="price" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Giá</label>
                            <input type="number" name="price" id="price" value="{{old('price')}}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="VND" required="">
                        </div>
                        <div>
                            <label for="category" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Danh Mục</label>
                            <select id="Danh Mục" required = "" name="category_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                <option value="">Chọn Danh mục thuốc</option>
                                @foreach ($categorys as $category)
                                    <option value="{{$category->id}}">{{$category->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label for="item-weight" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Số Lượng</label>
                            <input type="text" name="quantity" id="item-weight" value="{{old('quantity')}}"  class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="12" required="">
                        </div>

                        <div class="sm:col-span-2">
                            <label for="image" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Hình Ảnh Chính</label>
                            <input type="file" name="image" id="image" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Mô Tả Ngắn" required="">
                            <div class="mt-2 flex items-center flex-warp" id="preview_image"></div>
                        </div>

                        <div class="sm:col-span-2">
                            <label for="image_extra" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Hình Ảnh Phụ</label>
                            <input type="file" name="image_multiple[]" multiple id="image_extra" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Mô Tả Ngắn" required="">
                            <div class="mt-2 flex items-center flex-warp" id="preview_image_extra"></div>
                        </div>

                        <div class="sm:col-span-2">
                            <label for="title" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Mô Tả Ngắn</label>
                            <input type="text" name="title" id="title" value="{{old('title')}}"   class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Mô Tả Ngắn" required="">
                        </div>

                        <div class="sm:col-span-2">
                            <label for="title_detail" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Mô Tả Chi Tiết</label>
                            <textarea id="title_detail" rows="8" name="title_detail" value="{{old('title_detail')}}" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Mô Tả Chi Tiết"></textarea>
                        </div>
                    </div>

                    <div class="flex justify-center">
                        <button type="submit" class="inline-flex items-center px-5 py-2.5 mt-4 sm:mt-6 text-sm font-medium text-center text-white rounded-lg bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300">
                            THÊM SẢN PHẨM MỚI
                        </button>
                    </div>

                </form>
            </div>
        </section>
        <section class="w-full mt-6">
            <p class="text-xl pb-3 flex items-center">
                <i class="fas fa-list mr-3"></i> Danh Sách Sản Phẩm
            </p>

            <div class="flex justify-between my-2">
                <div>
                    @if (count($products) > 0)
                        {{ $products->appends(array(
                            'search_name' => old('search_name'),
                        ))->links() }}
                    @endif
                </div>

                <div>
                    <form method="GET" action="{{ route('admin.product.index')}}" class="flex">
                        <div class="sm:col-span-2">
                            <input type="text" name="search_name"  value="{{old('search_name')}}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Tìm theo Tên sản phẩm...">
                        </div>
                        <div>
                            <button type="submit" class="inline-flex items-center px-5 py-2.5 mx-2 text-sm font-medium text-center text-white rounded-lg bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300">
                                Tìm kiếm
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <div class="bg-white overflow-auto">
                <table class="min-w-full bg-white">
                    <thead class="bg-gray-800 text-white">
                        <tr>
                            <th class="w-1/12 text-left py-3 px-4 uppercase font-semibold text-sm">STT</th>
                            <th class="w-3/12 text-left py-3 px-4 uppercase font-semibold text-sm">TÊN SẢN PHẨM</th>
                            <th class="w-2/12 text-left py-3 px-4 uppercase font-semibold text-sm">DANH MỤC</th>
                            <th class="w-2/12 text-left py-3 px-4 uppercase font-semibold text-sm">THƯƠNG HIÊU</th>
                            <th class="w-2/12 text-left py-3 px-4 uppercase font-semibold text-sm">GIÁ</th>
                            <th class="w-2/12 text-left py-3 px-4 uppercase font-semibold text-sm">TRẠNG THÁI</th>
                        </tr>
                    </thead>
                    <tbody class="text-gray-700">

                        @if (count($products) <= 0)
                            <tr>
                                <td colspan="6" class="text-center">không có dữ liệu</td>
                            </tr>
                        @else
                            @foreach ($products as $index=>$product)
                                <tr>
                                    <td class="text-left py-2 px-2">{{ $index + 1 }}</td>
                                    <td class="text-left py-2 px-2">{{$product->name}}</td>
                                    <td class="text-left py-2 px-2">{{$product->Category ? $product->Category->name : ''}}</td>
                                    <td class="text-left py-2 px-2">{{$product->brand}}</td>
                                    <td class="text-left py-2 px-2">{{number_format($product->price)}}</td>
                                    <td class="text-left py-2 px-2">
                                        <button type="button" data-id="{{$product->id}}" class="update_product focus:outline-none text-white bg-yellow-400 hover:bg-yellow-500 focus:ring-4 focus:ring-yellow-300 font-medium rounded-lg text-sm px-3 py-1 mr-1 dark:focus:ring-yellow-900">
                                            Cập nhập
                                        </button>

                                        <button type="button" data-id="{{$product->id}}" class="delete_product mt-1 focus:outline-none text-white bg-red-400 hover:bg-red-500 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-3 py-1 dark:focus:ring-red-900">
                                            Xoá
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
        </section>

        <!-- Main modal -->
        <div id="default-modal_product" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
            <div class="relative p-4 w-full max-w-2xl max-h-full mx-auto pt-10">
                <!-- Modal content -->
                <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                    <!-- Modal header -->
                    <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                        <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                            Chi Tiết Hoá Đơn
                        </h3>
                        <button type="button" class="cancel_popup_product text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="default-modal">
                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                            </svg>
                            <span class="sr-only">Close modal</span>
                        </button>
                    </div>
                    <!-- Modal body -->
                    <div class="p-4 md:p-5 space-y-4">
                        <div class="">
                            <form  action="{{route('admin.product.edit')}}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="id" id="id_edit">
                                <div class="grid gap-4 sm:grid-cols-2 sm:gap-6">
                                    <div class="sm:col-span-2">
                                        <label for="name_edit" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Tên Sản Phẩm</label>
                                        <input type="text" name="name" id="name_edit" value="" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Tên Sản Phẩm" required="">
                                    </div>
                                    <div class="w-full">
                                        <label for="brand_edit" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Thương Hiệu</label>
                                        <input type="text" name="brand" id="brand_edit" value="" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Thương Hiệu" required="">
                                    </div>
                                    <div class="w-full">
                                        <label for="price_edit" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Giá</label>
                                        <input type="number" name="price" id="price_edit" value="" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="VND" required="">
                                    </div>
                                    <div>
                                        <label for="category_id_edit" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Danh Mục</label>
                                        <select id="category_id_edit" required name="category_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                            <option value="">Chọn Danh mục thuốc</option>
                                            @foreach ($categorys as $category)
                                                <option value="{{$category->id}}">{{$category->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div>
                                        <label for="quantity_edit" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Số Lượng</label>
                                        <input type="text" name="quantity" id="quantity_edit" value=""  class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="12" required="">
                                    </div>

                                    <div class="sm:col-span-2">
                                        <label for="image_edit" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Hình Ảnh Chính</label>
                                        <input type="file" name="image" id="image_edit" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Mô Tả Ngắn">
                                        <div class="mt-2 flex items-center flex-warp" id="preview_image_edit"></div>
                                    </div>

                                    <div class="sm:col-span-2">
                                        <label for="image_extra_edit" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Hình Ảnh Phụ</label>
                                        <input type="file" name="image_multiple[]" multiple id="image_extra_edit" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Mô Tả Ngắn">
                                        <div class="mt-2 flex items-center flex-warp" id="preview_image_extra_edit"></div>
                                    </div>

                                    <div class="sm:col-span-2">
                                        <label for="title_edit" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Mô Tả Ngắn</label>
                                        <input type="text" name="title" id="title_edit" value=""   class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Mô Tả Ngắn" required="">
                                    </div>

                                    <div class="sm:col-span-2">
                                        <label for="title_detail_edit" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Mô Tả Chi Tiết</label>
                                        <textarea id="title_detail_edit" rows="8" name="title_detail" value="" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Mô Tả Chi Tiết"></textarea>
                                    </div>
                                </div>

                                <div class="flex justify-center">
                                    <button type="submit" class="inline-flex items-center px-5 py-2.5 mt-4 sm:mt-6 text-sm font-medium text-center text-white rounded-lg bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300">
                                        CẬP NHẬP SẢN PHẨM
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <!-- Modal footer -->
                    <div class="flex justify-end items-center p-4 md:p-5 border-t border-gray-200 rounded-b dark:border-gray-600">
                        <button type="button" class="cancel_popup_product py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">Đóng</button>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection

