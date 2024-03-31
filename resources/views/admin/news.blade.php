@extends('admin.layout_admin')

@section('content')
    <main class="w-full flex-grow p-6 h-full">
        <section class="bg-white dark:bg-gray-900">
            <div class="pl-2 pb-2">
                <button type="button" class="open_sesion_add_product inline-flex items-center px-5 py-2.5 mt-4 sm:mt-6 text-sm font-medium text-center text-white rounded-lg bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300">
                    THÊM TIN TỨC MỚI
                </button>

                <button type="button" class="hidden close_sesion_add_product inline-flex items-center px-5 py-2.5 mt-4 sm:mt-6 text-sm font-medium text-center text-white rounded-lg bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300">
                    ẨN THÊM MỚI
                </button>
            </div>

            <div class="flex justify-center">
                @if (Session::has('message'))
                    <div class="text-red-600 pt-3">
                        {{ Session::get('message') }}
                        @php
                            Session::forget('message');
                        @endphp
                    </div>
                @endif
            </div>

            <div class="hidden sesion-propduct py-8 px-4 mx-auto max-w-2xl lg:py-16">
                <h2 class="mb-4 text-xl font-bold text-gray-900 dark:text-white">Thêm Mới Tin Tức</h2>
                <form  action="{{route('admin.news.add')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="grid gap-4 sm:grid-cols-2 sm:gap-6">
                        <div class="sm:col-span-2">
                            <label for="title" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Tên Sản Phẩm</label>
                            <input type="text" title="title" id="title" value="{{old('title')}}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Tiêu đề tin tức" required="">
                        </div>

                        <div class="sm:col-span-2">
                            <label for="image" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Hình Ảnh Về Tin Tức</label>
                            <input type="file" name="image" id="image" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Hình Ảnh Về Tin Tức" required="">
                        </div>

                        <div class="sm:col-span-2">
                            <label for="short_description" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Mô Tả Ngắn</label>
                            <input type="text" name="short_description" id="short_description" value="{{old('short_description')}}"   class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Mô Tả Ngắn" required="">
                        </div>

                        <div class="sm:col-span-2">
                            <label for="detailed_description" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Mô Tả Chi Tiết</label>
                            <textarea id="detailed_description" rows="10" name="detailed_description" value="{{old('detailed_description')}}" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Mô Tả Chi Tiết"></textarea>
                        </div>
                    </div>

                    <div class="flex justify-center">
                        <button type="submit" class="inline-flex items-center px-5 py-2.5 mt-4 sm:mt-6 text-sm font-medium text-center text-white rounded-lg bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300">
                            THÊM MỚI TIN TỨC
                        </button>
                    </div>
                </form>
            </div>
        </section>
        <section class="w-full mt-6">
            <p class="text-xl pb-3 flex items-center">
                <i class="fas fa-list mr-3"></i> Danh Sách Tin Tức
            </p>
            <div class="bg-white overflow-auto">
                <table class="min-w-full bg-white">
                    <thead class="bg-gray-800 text-white">
                        <tr>
                            <th class="w-1/12 text-left py-3 px-4 uppercase font-semibold text-sm">STT</th>
                            <th class="w-4/12 text-left py-3 px-4 uppercase font-semibold text-sm">TIN TỨC</th>
                            <th class="w-5/12 text-left py-3 px-4 uppercase font-semibold text-sm">MÔ Tả NGẮN</th>
                            <th class="w-2/12 text-left py-3 px-4 uppercase font-semibold text-sm">TRẠNG THÁI</th>
                        </tr>
                    </thead>
                    <tbody class="text-gray-700">

                        @if (count($news) <= 0)
                            <tr>
                                <td colspan="4" class="text-center">không có dữ liệu</td>
                            </tr>
                        @else
                            @foreach ($news as $index=>$new)
                                <tr>
                                    <td class="text-left py-2 px-2">{{ $index + 1 }}</td>
                                    <td class="text-left py-2 px-2">{{$new->title}}</td>
                                    <td class="text-left py-2 px-2">{{$new->short_description}}</td>
                                    <td class="text-left py-2 px-2">
                                        <button type="button" data-id="{{$new->id}}" class="update_product focus:outline-none text-white bg-yellow-400 hover:bg-yellow-500 focus:ring-4 focus:ring-yellow-300 font-medium rounded-lg text-sm px-3 py-1 me-2 dark:focus:ring-yellow-900">
                                            CẬP NHẬP
                                        </button>

                                        <button type="button" data-id="{{$new->id}}" class="delete_product ml-1 focus:outline-none text-white bg-red-400 hover:bg-red-500 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-3 py-1 me-2 dark:focus:ring-red-900">
                                            XOÁ
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
        </section>
    </main>
@endsection
