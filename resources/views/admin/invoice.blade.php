@extends('admin.layout_admin')

@section('content')
    <main class="w-full flex-grow p-6">
        <div>
            <form action="{{route('category.create')}}" method="POST" >
                @csrf

                <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
                    THÊM DANH MỤC MỚI
                </button>
            </form>

        </div>
        <div class="w-full mt-6">
            <p class="text-xl pb-3 flex items-center">
                <i class="fas fa-list mr-3"></i> Danh Mục Thuốc
            </p>
            <div class="bg-white overflow-auto">
                <table class="min-w-full bg-white">
                    <thead class="bg-gray-800 text-white">
                        <tr>
                            <th class="w-1/5 text-left py-3 px-4 uppercase font-semibold text-sm">STT</th>
                            <th class="w-3/5 text-left py-3 px-4 uppercase font-semibold text-sm">TÊN DANH MỤC</th>
                            <th class="w-1/5 text-left py-3 px-4 uppercase font-semibold text-sm">TRẠNG THÁI</th>
                        </tr>
                    </thead>
                    <tbody class="text-gray-700">
                        <tr>
                            <td class="w-1/5 text-left py-2 px-2">1</td>
                            <td class="w-3/5 text-left py-2 px-2">Smith</td>
                            <td class="w-1/5 text-left py-2 px-2">
                                <button type="button" class="focus:outline-none text-white bg-yellow-400 hover:bg-yellow-500 focus:ring-4 focus:ring-yellow-300 font-medium rounded-lg text-sm px-3 py-1 me-2 dark:focus:ring-yellow-900">
                                    CẬP NHẬP
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </main>
@endsection

