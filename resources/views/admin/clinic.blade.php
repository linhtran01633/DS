@extends('admin.layout_admin')

@section('content')
    <main class="w-full flex-grow p-6 h-full">
        <!-- component -->
        <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>
        @php
            $tab = 1;
            if(request()->tab != null) $tab = request()->tab;
        @endphp
        <div class="w-full" x-data="{activeTab: {{$tab}}}">
            <!-- tabs -->
                <div class="relative">
                    <header class="flex items-end text-sm flex-wrap">
                        <button class="border border-b-0 px-3 py-1 focus:outline-none rounded-tl-md" :class="activeTab===1 ? 'font-semibold' : ''" @click="activeTab=1" >
                            1.Bệnh Nhân
                        </button>
                        <button class="border border-b-0 px-3 py-1 focus:outline-none" :class="activeTab===2 ? 'font-semibold' : ''" @click="activeTab=2" >
                            2.Khám Bệnh
                        </button>
                        <button class="border border-b-0 px-3 py-1 focus:outline-none" :class="activeTab===3 ? 'font-semibold' : ''" @click="activeTab=3">
                            3.Hoạt Chất
                        </button>
                        <button class="border border-b-0 px-3 py-1 focus:outline-none" :class="activeTab===4 ? 'font-semibold' : ''" @click="activeTab=4">
                            4.Đơn Vị Thuốc
                        </button>
                        <button class="border border-b-0 px-3 py-1 focus:outline-none" :class="activeTab===5 ? 'font-semibold' : ''" @click="activeTab=5">
                            5.Dược Phẩm
                        </button>
                        <button class="border border-b-0 px-3 py-1 focus:outline-none rounded-tr-md" :class="activeTab===6 ? 'font-semibold' : ''" @click="activeTab=6">
                            6.Cách Dùng
                        </button>
                    </header>
                    <div class="border p-2 overflow-y-auto rounded-b-xl rounded-tr-xl bg-white" id="tabs-contents" style="height:70vh">
                        <div x-show="activeTab===1">
                            <div class="p-2 grid gap-4 sm:grid-cols-2 sm:gap-6">
                                <form action="{{route('admin.patient.add')}}" method="post" class="grid gap-1 sm:grid-cols-2 sm:gap-2">
                                    @csrf
                                    <h2 class="sm:col-span-2">THÔNG TIN BỆNH NHÂN</h2>
                                    <div class="w-full">
                                        <label for="name_patient" class="block mb-1 text-sm font-medium text-gray-900 dark:text-white">Họ và tên</label>
                                        <input type="text" name="name" id="name_patient" value="{{old('name')}}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Họ và tên" required="">
                                    </div>
                                    <div class="w-full">
                                        <label for="set_patient" class="block mb-1 text-sm font-medium text-gray-900 dark:text-white">Giới Tính</label>
                                        <select id="set_patient" required name="sex" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                            <option value="0">Nam</option>
                                            <option value="1">Nữ</option>
                                        </select>
                                    </div>

                                    <div class="w-full">
                                        <label for="date_patient" class="block mb-1 text-sm font-medium text-gray-900 dark:text-white">Ngày Sinh</label>
                                        <input type="date" name="date" id="date_patient" value="{{old('date')}}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Họ và tên" required="">
                                    </div>
                                    <div class="w-full">
                                        <label for="ethnic_patient" class="block mb-1 text-sm font-medium text-gray-900 dark:text-white">Dân Tộc</label>
                                        <select id="ethnic_patient" required name="ethnic" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                            <option value="0">Kinh</option>
                                            <option value="1">Dân Tộc Thiểu Số</option>
                                        </select>
                                    </div>

                                    <div class="sm:col-span-2">
                                        <label for="address_patient" class="block mb-1 text-sm font-medium text-gray-900 dark:text-white">Địa Chỉ</label>
                                        <input type="text" name="address" id="address_patient" value="{{old('address')}}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Địa chỉ" required="">
                                    </div>

                                    <div class="sm:col-span-2">
                                        <label for="workshop_patient" class="block mb-1 text-sm font-medium text-gray-900 dark:text-white">Nơi Làm Việc</label>
                                        <input type="text" name="workshop" id="workshop_patient" value="{{old('workshop')}}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Nơi Làm Việc" required="">
                                    </div>

                                    <div class="sm:col-span-2">
                                        <label for="phone_patient" class="block mb-1 text-sm font-medium text-gray-900 dark:text-white">Số Điện Thoại</label>
                                        <input type="text" name="phone" id="phone_patient" value="{{old('phone')}}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Số Điện Thoại" required="">
                                    </div>
                                    <div class="sm:col-span-2">
                                        <div class="flex justify-center">
                                            <button type="submit" class="inline-flex items-center px-5 py-2.5 mt-4 sm:mt-6 text-sm font-medium text-center text-white rounded-lg bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300">
                                                ĐĂNG KÍ BỆNH NHÂN
                                            </button>
                                        </div>
                                    </div>
                                </form>
                                <form action="{{route('admin.sick.add')}}" method="post" class="grid gap-1 sm:grid-cols-2 sm:gap-2">
                                    @csrf
                                    <input type="hidden" name="id_patient" id="id_patient_sick">
                                    <h2 class="sm:col-span-2">THÔNG TIN VÀO CỦA BỆNH NHÂN</h2>
                                    <div class="w-full">
                                        <label for="date_sick" class="block mb-1 text-sm font-medium text-gray-900 dark:text-white">Ngày Khám</label>
                                        <input type="date" name="date" id="date_sick" value="{{old('date')}}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Họ và tên" required="">
                                    </div>
                                    <div class="w-full">
                                        <label for="hours_sick" class="block mb-1 text-sm font-medium text-gray-900 dark:text-white">Giờ Khám</label>
                                        <input type="time" name="hours" id="hours_sick" value="{{old('hours')}}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" required="">
                                    </div>

                                    <div class="w-full grid gap-1 sm:grid-cols-2 sm:gap-2">
                                        <div class="w-full">
                                            <label for="circuit_sick" class="block mb-1 text-sm font-medium text-gray-900 dark:text-white">Mạch</label>
                                            <input type="number" name="circuit" id="circuit_sick" value="{{old('circuit')}}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                        </div>

                                        <div class="w-full">
                                            <label for="T_sick" class="block mb-1 text-sm font-medium text-gray-900 dark:text-white">T</label>
                                            <input type="number" name="T" id="T_sick" value="{{old('T')}}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                        </div>
                                    </div>
                                    <div class="w-full grid gap-1 sm:grid-cols-2 sm:gap-2">
                                        <div class="w-full">
                                            <label for="HA_sick" class="block mb-1 text-sm font-medium text-gray-900 dark:text-white">HA</label>
                                            <input type="text" name="HA" id="HA_sick" value="{{old('HA')}}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                        </div>
                                        <div class="w-full">
                                            <label for="blood_sugar_sick" class="block mb-1 text-sm font-medium text-gray-900 dark:text-white">Đường huyết</label>
                                            <input type="number" name="blood_sugar" id="blood_sugar_sick" value="{{old('blood_sugar')}}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                        </div>
                                    </div>

                                    <div class="w-full grid gap-1 sm:grid-cols-2 sm:gap-2">
                                        <div class="w-full">
                                            <label for="breathing_sick" class="block mb-1 text-sm font-medium text-gray-900 dark:text-white">Nhịp Thở</label>
                                            <input type="number" name="breathing" id="breathing_sick" value="{{old('breathing')}}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                        </div>

                                        <div class="w-full">
                                            <label for="tall_sick" class="block mb-1 text-sm font-medium text-gray-900 dark:text-white">Chiều cao</label>
                                            <input type="number" name="tall" id="tall_sick" value="{{old('tall')}}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                        </div>
                                    </div>
                                    <div class="w-full grid gap-1 sm:grid-cols-2 sm:gap-2">
                                        <div class="w-full">
                                            <label for="weight_sick" class="block mb-1 text-sm font-medium text-gray-900 dark:text-white">Cân nặng</label>
                                            <input type="number" name="weight" id="weight_sick" value="{{old('weight')}}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                        </div>
                                        <div class="w-full">
                                            <label for="BMI_sick" class="block mb-1 text-sm font-medium text-gray-900 dark:text-white">BMI</label>
                                            <input type="number" name="BMI" id="BMI_sick" value="{{old('BMI')}}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                        </div>
                                    </div>

                                    <div class="sm:col-span-2">
                                        <label for="symptom_sick" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Triệu Chứng Lâm Sàn Ban Đầu</label>
                                        <textarea id="symptom_sick" rows="5" name="symptom" value="{{old('symptom')}}" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Mô Tả Chi Tiết"></textarea>
                                    </div>

                                    <div class="sm:col-span-2">
                                        <div class="flex justify-center">
                                            <button type="submit" class="inline-flex items-center px-5 py-2.5 mt-4 sm:mt-6 text-sm font-medium text-center text-white rounded-lg bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300">
                                                ĐĂNG KÍ KHÁM BỆNH
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>

                            <section class="w-full mt-6">
                                <p class="text-xl pb-3 flex items-center">
                                    <i class="fas fa-list mr-3"></i> Danh Sách Bệnh Nhân
                                </p>

                                <div class="flex justify-between my-2">
                                    <div></div>
                                    <div>
                                        <form method="GET" action="{{ route('admin.clinic.index')}}" class="flex">
                                            <div class="sm:co-span-2">
                                                <input type="ltext" name="search_name"  value="{{old('search_name')}}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Tìm theo tên bệnh nhân...">
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
                                                <th class="w-1/12 text-left py-3 px-4 uppercase font-semibold text-sm"></th>
                                                <th class="w-2/12 text-left py-3 px-4 uppercase font-semibold text-sm">Mã Bệnh Nhân</th>
                                                <th class="w-3/12 text-left py-3 px-4 uppercase font-semibold text-sm">Tên Bệnh Nhân</th>
                                                <th class="w-2/12 text-left py-3 px-4 uppercase font-semibold text-sm">Ngày Sinh</th>
                                                <th class="w-2/12 text-left py-3 px-4 uppercase font-semibold text-sm">Giới Tính</th>
                                                <th class="w-2/12 text-left py-3 px-4 uppercase font-semibold text-sm">Điện thoại</th>
                                            </tr>
                                        </thead>
                                        <tbody class="text-gray-700">
                                            @foreach ($patient as $index=>$item)
                                                <tr>
                                                    <td class="text-left py-2 px-2">{{$index + 1}}</td>
                                                    <td class="text-left py-2 px-2">{{$item->id}}</td>
                                                    <td class="text-left py-2 px-2">{{$item->name}}</td>
                                                    <td class="text-left py-2 px-2">{{$item->date}}</td>
                                                    <td class="text-left py-2 px-2">
                                                        @if ($item->sex == 0)
                                                            Nam
                                                        @else
                                                            Nữ
                                                        @endif
                                                    </td>
                                                    <td class="text-left py-2 px-2">{{$item->phone}}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </section>
                        </div>
                        <div x-show="activeTab===2">
                        </div>
                        <div x-show="activeTab===3">
                            <form action="{{route('admin.generic.add')}}" method="post" class="py-2 px-4 mx-auto max-w-2xl lg:py-4">
                                @csrf
                                <div class="grid gap-4 sm:grid-cols-2 sm:gap-6">
                                    <div class="sm:col-span-2">
                                        <label for="name_generic" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Tên Hoạt Chất</label>
                                        <input type="text" name="name" id="name_generic" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Tên hoạt chất" required="">
                                    </div>
                                </div>
                                <div class="flex justify-center">
                                    <button type="submit" class="inline-flex items-center px-5 py-2.5 mt-4 sm:mt-6 text-sm font-medium text-center text-white rounded-lg bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300">
                                        THÊM HOẠT CHẤT
                                    </button>
                                </div>
                            </form>
                            <section class="w-full mt-6">
                                <p class="text-xl pb-3 flex items-center">
                                    <i class="fas fa-list mr-3"></i> Danh Sách Hoạt Chất
                                </p>

                                <div class="flex justify-between my-2">
                                    <div>
                                        {{-- @if (count($products) > 0)
                                            {{ $products->appends(array(
                                                'search_name' => old('search_name'),
                                            ))->links() }}
                                        @endif --}}
                                    </div>

                                    <div>
                                        <form method="GET" action="{{ route('admin.product.index')}}" class="flex">
                                            <div class="sm:co-span-2">
                                                <input type="ltext" name="search_name"  value="{{old('search_name')}}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Tìm theo tên hoạt chất...">
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
                                                <th class="w-2/12 text-left py-3 px-4 uppercase font-semibold text-sm">STT</th>
                                                <th class="w-2/12 text-left py-3 px-4 uppercase font-semibold text-sm">Mã Hoạt Chất</th>
                                                <th class="w-4/12 text-left py-3 px-4 uppercase font-semibold text-sm">Tên Hoạt Chất</th>
                                                <th class="w-2/12 text-left py-3 px-4 uppercase font-semibold text-sm">Trạng Thái</th>
                                                <th class="w-2/12 text-left py-3 px-4 uppercase font-semibold text-sm">Option</th>
                                            </tr>
                                        </thead>
                                        <tbody class="text-gray-700">
                                            @if(count($generic) > 0)
                                                @foreach ($generic as $index=>$item)
                                                    <tr>
                                                        <td class="text-left py-2 px-2">{{$index + 1}}</td>
                                                        <td class="text-left py-2 px-2">{{$item->id}}</td>
                                                        <td class="text-left py-2 px-2">{{$item->name}}</td>
                                                        <td class="text-left py-2 px-2">
                                                            @if ($item->status == 0)
                                                                còn sử dụng
                                                            @else
                                                                không sử dụng
                                                            @endif
                                                        </td>
                                                        <td class="text-left py-2 px-2">
                                                            <button type="button" data-id="{{$item->id}}" class="update_generic focus:outline-none text-white bg-yellow-400 hover:bg-yellow-500 focus:ring-4 focus:ring-yellow-300 font-medium rounded-lg text-sm px-3 py-1 mr-1 dark:focus:ring-yellow-900">
                                                                Cập nhập
                                                            </button>

                                                            <button type="button" data-id="{{$item->id}}" class="delete_generic mt-1 focus:outline-none text-white bg-red-400 hover:bg-red-500 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-3 py-1 dark:focus:ring-red-900">
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
                        </div>
                        <div x-show="activeTab===4">
                            <form action="{{route('admin.drugUnit.add')}}" method="post" class="py-2 px-4 mx-auto max-w-2xl lg:py-4">
                                @csrf
                                <div class="grid gap-4 sm:grid-cols-2 sm:gap-6">
                                    <div class="sm:col-span-2">
                                        <label for="name_drug_unit" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Tên Đơn Vị Thuốc</label>
                                        <input type="text" name="name" id="name_drug_unit" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Đơn vị thuốc" required="">
                                    </div>
                                </div>
                                <div class="flex justify-center">
                                    <button type="submit" class="inline-flex items-center px-5 py-2.5 mt-4 sm:mt-6 text-sm font-medium text-center text-white rounded-lg bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300">
                                        THÊM ĐƠN VỊ THUỐC
                                    </button>
                                </div>
                            </form>
                            <section class="w-full mt-6">
                                <p class="text-xl pb-3 flex items-center">
                                    <i class="fas fa-list mr-3"></i> Danh Sách Đơn Vị Thuốc
                                </p>

                                <div class="flex justify-between my-2">
                                    <div></div>

                                    <div>
                                        <form method="GET" action="{{ route('admin.product.index')}}" class="flex">
                                            <div class="sm:co-span-2">
                                                <input type="ltext" name="search_name"  value="{{old('search_name')}}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Tìm theo tên đơn vị thuốc...">
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
                                                <th class="w-2/12 text-left py-3 px-4 uppercase font-semibold text-sm">STT</th>
                                                <th class="w-2/12 text-left py-3 px-4 uppercase font-semibold text-sm">Mã DVT</th>
                                                <th class="w-4/12 text-left py-3 px-4 uppercase font-semibold text-sm">Tên DVT</th>
                                                <th class="w-2/12 text-left py-3 px-4 uppercase font-semibold text-sm">Trạng Thái</th>
                                                <th class="w-2/12 text-left py-3 px-4 uppercase font-semibold text-sm">Option</th>
                                            </tr>
                                        </thead>
                                        <tbody class="text-gray-700">
                                            @if (count($drugUnit) > 0)
                                                @foreach ($drugUnit as $index=>$item)
                                                    <tr>
                                                        <td class="text-left py-2 px-2">{{$index + 1}}</td>
                                                        <td class="text-left py-2 px-2">{{$item->id}}</td>
                                                        <td class="text-left py-2 px-2">{{$item->name}}</td>
                                                        <td class="text-left py-2 px-2">
                                                            @if ($item->status == 0)
                                                                còn sử dụng
                                                            @else
                                                                không sử dụng
                                                            @endif
                                                        </td>
                                                        <td class="text-left py-2 px-2">
                                                            <button type="button" data-id="{{$item->id}}" class="update_generic focus:outline-none text-white bg-yellow-400 hover:bg-yellow-500 focus:ring-4 focus:ring-yellow-300 font-medium rounded-lg text-sm px-3 py-1 mr-1 dark:focus:ring-yellow-900">
                                                                Cập nhập
                                                            </button>

                                                            <button type="button" data-id="{{$item->id}}" class="delete_generic mt-1 focus:outline-none text-white bg-red-400 hover:bg-red-500 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-3 py-1 dark:focus:ring-red-900">
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
                        </div>
                        <div x-show="activeTab===5">
                            <form action="{{route('admin.drug.add')}}" method="post" class="py-2 px-4 mx-auto max-w-2xl lg:py-4">
                                @csrf
                                <div class="grid gap-1 sm:grid-cols-2 sm:gap-2">
                                    <div class="w-full">
                                        <label for="name_drug" class="block mb-1 text-sm font-medium text-gray-900 dark:text-white">Tên Dược Phẩm</label>
                                        <input type="text" name="name" id="name_drug" value="{{old('name')}}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Họ và tên" required="">
                                    </div>
                                    <div class="w-full">
                                        <label for="price_drug" class="block mb-1 text-sm font-medium text-gray-900 dark:text-white">Giá Dược Phẩm</label>
                                        <input type="number" name="price" id="price_drug" value="{{old('price')}}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" required="">
                                    </div>

                                    <div class="w-full">
                                        <label for="id_generic" class="block mb-1 text-sm font-medium text-gray-900 dark:text-white">Loại Hoạt Chất</label>
                                        <select id="id_generic" required name="id_generic" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                            <option value="">Chọn Hoạt Chất</option>
                                            @foreach ($generic as $item)
                                                <option value="{{$item->id}}">{{$item->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="w-full">
                                        <label for="id_drug_unit" class="block mb-1 text-sm font-medium text-gray-900 dark:text-white">Đơn Vị Thuốc</label>
                                        <select id="id_drug_unit" required name="id_drug_unit" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                            <option value="">Chọn Đơn Vị Thuốc</option>
                                            @foreach ($drugUnit as $item)
                                                <option value="{{$item->id}}">{{$item->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                </div>
                                <div class="flex justify-center">
                                    <button type="submit" class="inline-flex items-center px-5 py-2.5 mt-4 sm:mt-6 text-sm font-medium text-center text-white rounded-lg bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300">
                                        THÊM DƯỢC PHẨM
                                    </button>
                                </div>
                            </form>
                            <section class="w-full mt-6">
                                <p class="text-xl pb-3 flex items-center">
                                    <i class="fas fa-list mr-3"></i> Danh Sách Cách Dùng
                                </p>

                                <div class="flex justify-between my-2">
                                    <div></div>

                                    <div>
                                        <form method="GET" action="{{ route('admin.product.index')}}" class="flex">
                                            <div class="sm:co-span-2">
                                                <input type="ltext" name="search_name"  value="{{old('search_name')}}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Tìm theo tên dược phẩm...">
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
                                                <th class="w-2/12 text-left py-3 px-4 uppercase font-semibold text-sm">Mã DP</th>
                                                <th class="w-3/12 text-left py-3 px-4 uppercase font-semibold text-sm">Tên DP</th>
                                                <th class="w-2/12 text-left py-3 px-4 uppercase font-semibold text-sm">Tên HC</th>
                                                <th class="w-2/12 text-left py-3 px-4 uppercase font-semibold text-sm">ĐVT</th>
                                                <th class="w-2/12 text-left py-3 px-4 uppercase font-semibold text-sm">Option</th>
                                            </tr>
                                        </thead>
                                        <tbody class="text-gray-700">
                                            @foreach ($drug as $index=>$item)
                                                <tr>
                                                    <td class="text-left py-2 px-2">{{$index + 1}}</td>
                                                    <td class="text-left py-2 px-2">{{$item->id}}</td>
                                                    <td class="text-left py-2 px-2">{{$item->name}}</td>
                                                    <td class="text-left py-2 px-2">{{$item->Generic ? $item->Generic->name : ''}}</td>
                                                    <td class="text-left py-2 px-2">{{$item->DrugUnit ? $item->DrugUnit->name : ''}}</td>
                                                    <td class="text-left py-2 px-2">
                                                        <button type="button" data-id="{{$item->id}}" class="update_drug focus:outline-none text-white bg-yellow-400 hover:bg-yellow-500 focus:ring-4 focus:ring-yellow-300 font-medium rounded-lg text-sm px-3 py-1 mr-1 dark:focus:ring-yellow-900">
                                                            Cập nhập
                                                        </button>

                                                        <button type="button" data-id="{{$item->id}}" class="delete_drug mt-1 focus:outline-none text-white bg-red-400 hover:bg-red-500 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-3 py-1 dark:focus:ring-red-900">
                                                            Xoá
                                                        </button>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </section>
                        </div>
                        <div x-show="activeTab===6">
                            <form action="{{route('admin.usage.add')}}" method="post" class="py-2 px-4 mx-auto max-w-2xl lg:py-4">
                                @csrf
                                <div class="grid gap-4 sm:grid-cols-2 sm:gap-6">
                                    <div class="sm:col-span-2">
                                        <label for="name_cach_dung" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Tên Cách Dùng</label>
                                        <input type="text" name="name" id="name_cach_dung" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Tên cách dùng" required="">
                                    </div>
                                </div>
                                <div class="flex justify-center">
                                    <button type="submit" class="inline-flex items-center px-5 py-2.5 mt-4 sm:mt-6 text-sm font-medium text-center text-white rounded-lg bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300">
                                        THÊM CÁCH DÙNG
                                    </button>
                                </div>
                            </form>
                            <section class="w-full mt-6">
                                <p class="text-xl pb-3 flex items-center">
                                    <i class="fas fa-list mr-3"></i> Danh Sách Cách Dùng
                                </p>

                                <div class="flex justify-between my-2">
                                    <div>
                                        {{-- @if (count($products) > 0)
                                            {{ $products->appends(array(
                                                'search_name' => old('search_name'),
                                            ))->links() }}
                                        @endif --}}
                                    </div>

                                    <div>
                                        <form method="GET" action="{{ route('admin.product.index')}}" class="flex">
                                            <div class="sm:co-span-2">
                                                <input type="ltext" name="search_name"  value="{{old('search_name')}}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Tìm theo Tên sản phẩm...">
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
                                                <th class="w-2/12 text-left py-3 px-4 uppercase font-semibold text-sm">STT</th>
                                                <th class="w-2/12 text-left py-3 px-4 uppercase font-semibold text-sm">Mã CD</th>
                                                <th class="w-4/12 text-left py-3 px-4 uppercase font-semibold text-sm">Tên CD</th>
                                                <th class="w-2/12 text-left py-3 px-4 uppercase font-semibold text-sm">Trạng Thái</th>
                                                <th class="w-2/12 text-left py-3 px-4 uppercase font-semibold text-sm">Option</th>
                                            </tr>
                                        </thead>
                                        <tbody class="text-gray-700">
                                            @foreach ($usage as $index=>$item)
                                                <tr>
                                                    <td class="text-left py-2 px-2">{{$index + 1}}</td>
                                                    <td class="text-left py-2 px-2">{{$item->id}}</td>
                                                    <td class="text-left py-2 px-2">{{$item->name}}</td>
                                                    <td class="text-left py-2 px-2">
                                                        @if ($item->status == 0)
                                                            <button type="button" class="focus:outline-none text-white bg-yellow-400 hover:bg-yellow-500 focus:ring-4 focus:ring-yellow-300 font-medium rounded-lg text-sm px-3 py-1 mr-1 dark:focus:ring-yellow-900">
                                                                còn sử dụng
                                                            </button>
                                                        @else
                                                            <button type="button" class="focus:outline-none text-white bg-yellow-400 hover:bg-yellow-500 focus:ring-4 focus:ring-yellow-300 font-medium rounded-lg text-sm px-3 py-1 mr-1 dark:focus:ring-yellow-900">
                                                                không sử dụng
                                                            </button>
                                                        @endif
                                                    </td>
                                                    <td class="text-left py-2 px-2">
                                                        @if ($item->status == 0)
                                                            <button type="button" data-id="{{$item->id}}" class="update_generic focus:outline-none text-white bg-yellow-400 hover:bg-yellow-500 focus:ring-4 focus:ring-yellow-300 font-medium rounded-lg text-sm px-3 py-1 mr-1 dark:focus:ring-yellow-900">
                                                                Cập nhập
                                                            </button>

                                                            <button type="button" data-id="{{$item->id}}" class="delete_generic mt-1 focus:outline-none text-white bg-red-400 hover:bg-red-500 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-3 py-1 dark:focus:ring-red-900">
                                                                Xoá
                                                            </button>
                                                        @endif
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </section>
                        </div>
                    </div>
                </div>
            <!-- action buttons -->
        </div>
    </main>
@endsection

