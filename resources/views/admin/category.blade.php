@extends('admin.layout_admin')

@section('content')
    <main class="w-full flex-grow p-6 h-full">
        <section class="bg-white dark:bg-gray-900">
            <div class="py-8 px-4 mx-auto max-w-2xl lg:py-16">
                <h2 class="mb-4 text-xl font-bold text-gray-900 dark:text-white">Thêm Mới Danh Mục</h2>
                <form  action="{{route('admin.category.add')}}" method="POST" >
                    @csrf
                    <div class="grid gap-4 sm:grid-cols-2 sm:gap-6">
                        <div class="sm:col-span-2">
                            <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Tên Danh Mục</label>
                            <input type="text" name="name" id="name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Tên danh mục" required="">
                        </div>
                    </div>
                    <div class="flex justify-center">
                        <button type="submit" class="inline-flex items-center px-5 py-2.5 mt-4 sm:mt-6 text-sm font-medium text-center text-white rounded-lg bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300">
                            THÊM DANH MỤC
                        </button>
                    </div>

                </form>
            </div>
        </section>
        <section class="w-full mt-6">
            <p class="text-xl pb-3 flex items-center">
                <i class="fas fa-list mr-3"></i> Danh Sách Danh Mục
            </p>
            <div class="flex justify-between my-2">
                <div>
                    @if (count($categorys) > 0)
                        {{ $categorys->appends(array(
                            'search_name' => old('search_name'),
                        ))->links() }}
                    @endif
                </div>

                <div>
                    <form method="GET" action="{{ route('admin.news.index')}}" class="flex">
                        <div class="sm:col-span-2">
                            <input type="text" name="search_name"  value="{{old('search_name')}}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Tìm theo Tên danh mục...">
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
                            <th class="w-8/12 text-left py-3 px-4 uppercase font-semibold text-sm">TÊN DANH MỤC</th>
                            <th class="w-3/12 text-left py-3 px-4 uppercase font-semibold text-sm">TRẠNG THÁI</th>
                        </tr>
                    </thead>
                    <tbody class="text-gray-700">
                        @if (count($categorys) <= 0)
                            <tr>
                                <td colspan="3" class="text-center">không có dữ liệu</td>
                            </tr>
                        @else
                            @foreach ($categorys as $index=>$category)
                                <tr>
                                    <td class="w-1/12 text-left py-2 px-2">{{$index + 1}}</td>
                                    <td class="w-8/12 text-left py-2 px-2">{{$category->name}}</td>
                                    <td class="w-3/12 text-left py-2 px-2">
                                        <button type="button" data-id="{{$category->id}}" data-name="{{$category->name}}" class="update_category focus:outline-none text-white bg-yellow-400 hover:bg-yellow-500 focus:ring-4 focus:ring-yellow-300 font-medium rounded-lg text-sm px-3 py-1 mr-1 dark:focus:ring-yellow-900">
                                            Cập nhập
                                        </button>

                                        <button type="button" data-id="{{$category->id}}" class="delete_category mt-1 focus:outline-none text-white bg-red-400 hover:bg-red-500 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-3 py-1 dark:focus:ring-red-900">
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
        <div id="default-modal" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
            <div class="relative p-4 w-full max-w-2xl max-h-full mx-auto pt-28">
                <!-- Modal content -->
                <form method="post" action="{{route('admin.category.edit')}}">
                    @csrf
                    <input type="hidden" name="id" id="input_id_category">
                    <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                        <!-- Modal header -->
                        <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                            <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                                Cập Nhập Danh Mục
                            </h3>
                            <button type="button" class="cancel_popup text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="default-modal">
                                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                                </svg>
                                <span class="sr-only">Close modal</span>
                            </button>
                        </div>
                        <!-- Modal body -->
                        <div class="p-4 md:p-5 space-y-4">
                            <div class="grid gap-4 sm:grid-cols-2 sm:gap-6">
                                <div class="sm:col-span-2">
                                    <label for="name_popup" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Tên Danh Mục</label>
                                    <input type="text" name="name" id="name_popup" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Tên Danh Mục" required="">
                                </div>
                            </div>
                        </div>
                        <!-- Modal footer -->
                        <div class="flex justify-end items-center p-4 md:p-5 border-t border-gray-200 rounded-b dark:border-gray-600">
                            <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Cập Nhập</button>
                            <button type="button" class="cancel_popup py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">Huỷ</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </main>
@endsection

