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
                        <button class="border border-b-0 px-3 py-1 focus:outline-none rounded-tl-md" :class="activeTab===1 ? 'font-semibold' : ''" >
                            <a href="{{route('admin.clinic.index', ['tab'=> 1])}}">
                                1.Bệnh Nhân
                            </a>
                        </button>
                        <button class="border border-b-0 px-3 py-1 focus:outline-none" :class="activeTab===2 ? 'font-semibold' : ''" >
                            <a href="{{route('admin.clinic.index', ['tab'=> 2])}}">
                                2.Khám Bệnh
                            </a>
                        </button>
                        <button class="border border-b-0 px-3 py-1 focus:outline-none" :class="activeTab===3 ? 'font-semibold' : ''">
                            <a href="{{route('admin.clinic.index', ['tab'=> 3])}}">
                                3.Hoạt Chất
                            </a>
                        </button>
                        <button class="border border-b-0 px-3 py-1 focus:outline-none" :class="activeTab===4 ? 'font-semibold' : ''">

                            <a href="{{route('admin.clinic.index', ['tab'=> 4])}}">
                                4.Đơn Vị Thuốc
                            </a>
                        </button>
                        <button class="border border-b-0 px-3 py-1 focus:outline-none" :class="activeTab===5 ? 'font-semibold' : ''">
                            <a href="{{route('admin.clinic.index', ['tab'=> 5])}}">
                                5.Dược Phẩm
                            </a>
                        </button>
                        <button class="border border-b-0 px-3 py-1 focus:outline-none rounded-tr-md" :class="activeTab===6 ? 'font-semibold' : ''">
                            <a href="{{route('admin.clinic.index', ['tab'=> 6])}}">
                                6.Cách Dùng
                            </a>
                        </button>
                    </header>
                    <div class="border p-2 overflow-y-auto rounded-b-xl rounded-tr-xl bg-white" id="tabs-contents" style="height:80vh">
                        <div x-show="activeTab===1">
                            <div class="p-2 grid gap-4 sm:grid-cols-2 sm:gap-6">
                                <form action="{{route('admin.patient.add')}}" method="post" class="grid gap-1 sm:grid-cols-2 sm:gap-2">
                                    @csrf
                                    <h2 class="sm:col-span-2">THÔNG TIN BỆNH NHÂN</h2>
                                    <div class="w-full">
                                        <label for="name_patient" class="block mb-1 text-sm font-medium text-gray-900 dark:text-white">Họ và tên</label>
                                        <input type="text" name="name" id="name_patient" value="{{old('name')}}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-1.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Họ và tên" required="">
                                    </div>
                                    <div class="w-full">
                                        <label for="set_patient" class="block mb-1 text-sm font-medium text-gray-900 dark:text-white">Giới Tính</label>
                                        <select id="set_patient" required name="sex" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-1.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                            <option value="0">Nam</option>
                                            <option value="1">Nữ</option>
                                        </select>
                                    </div>

                                    <div class="w-full">
                                        <label for="date_patient" class="block mb-1 text-sm font-medium text-gray-900 dark:text-white">Ngày Sinh</label>
                                        <input type="date" name="date" id="date_patient" value="{{old('date')}}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-1.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Họ và tên" required="">
                                    </div>
                                    <div class="w-full">
                                        <label for="ethnic_patient" class="block mb-1 text-sm font-medium text-gray-900 dark:text-white">Dân Tộc</label>
                                        <select id="ethnic_patient" required name="ethnic" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-1.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                            <option value="0">Kinh</option>
                                            <option value="1">Dân Tộc Thiểu Số</option>
                                        </select>
                                    </div>

                                    <div class="sm:col-span-2">
                                        <label for="address_patient" class="block mb-1 text-sm font-medium text-gray-900 dark:text-white">Địa Chỉ</label>
                                        <input type="text" name="address" id="address_patient" value="{{old('address')}}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-1.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Địa chỉ" required="">
                                    </div>

                                    <div class="sm:col-span-2">
                                        <label for="workshop_patient" class="block mb-1 text-sm font-medium text-gray-900 dark:text-white">Nơi Làm Việc</label>
                                        <input type="text" name="workshop" id="workshop_patient" value="{{old('workshop')}}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-1.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Nơi Làm Việc" required="">
                                    </div>

                                    <div class="sm:col-span-2">
                                        <label for="phone_patient" class="block mb-1 text-sm font-medium text-gray-900 dark:text-white">Số Điện Thoại</label>
                                        <input type="text" name="phone" id="phone_patient" value="{{old('phone')}}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-1.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Số Điện Thoại" required="">
                                    </div>
                                    <div class="sm:col-span-2">
                                        <div class="flex justify-center">
                                            <button type="submit" class="inline-flex items-center px-5 py-2.5 mt-4 sm:mt-6 text-sm font-medium text-center text-white rounded-lg bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300">
                                                ĐĂNG KÍ BỆNH NHÂN
                                            </button>
                                        </div>
                                    </div>
                                </form>
                                <form action="{{route('admin.sick.add')}}" method="post" id="form_create_patient" class="grid gap-1 sm:grid-cols-2 sm:gap-2">
                                    @csrf
                                    <input type="hidden" name="id_patient" id="id_patient_sick">
                                    <h2 class="sm:col-span-2">THÔNG TIN VÀO CỦA BỆNH NHÂN</h2>
                                    <div class="w-full">
                                        <label for="date_sick" class="block mb-1 text-sm font-medium text-gray-900 dark:text-white">Ngày Khám</label>
                                        <input type="date" required name="date" id="date_sick" value="{{old('date')}}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-1.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Họ và tên">
                                    </div>
                                    <div class="w-full">
                                        <label for="hours_sick" class="block mb-1 text-sm font-medium text-gray-900 dark:text-white">Giờ Khám</label>
                                        <input type="time" required name="hours" id="hours_sick" value="{{old('hours')}}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-1.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                    </div>

                                    <div class="w-full grid gap-1 sm:grid-cols-2 sm:gap-2">
                                        <div class="w-full">
                                            <label for="circuit_sick" class="block mb-1 text-sm font-medium text-gray-900 dark:text-white">Mạch</label>
                                            <input type="number" name="circuit" id="circuit_sick" value="{{old('circuit')}}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-1.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                        </div>

                                        <div class="w-full">
                                            <label for="T_sick" class="block mb-1 text-sm font-medium text-gray-900 dark:text-white">T</label>
                                            <input type="number" name="T" id="T_sick" value="{{old('T')}}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-1.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                        </div>
                                    </div>
                                    <div class="w-full grid gap-1 sm:grid-cols-2 sm:gap-2">
                                        <div class="w-full">
                                            <label for="HA_sick" class="block mb-1 text-sm font-medium text-gray-900 dark:text-white">HA</label>
                                            <input type="text" name="HA" id="HA_sick" value="{{old('HA')}}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-1.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                        </div>
                                        <div class="w-full">
                                            <label for="blood_sugar_sick" class="block mb-1 text-sm font-medium text-gray-900 dark:text-white">Đường huyết</label>
                                            <input type="number" name="blood_sugar" id="blood_sugar_sick" value="{{old('blood_sugar')}}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-1.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                        </div>
                                    </div>

                                    <div class="w-full grid gap-1 sm:grid-cols-2 sm:gap-2">
                                        <div class="w-full">
                                            <label for="breathing_sick" class="block mb-1 text-sm font-medium text-gray-900 dark:text-white">Nhịp Thở</label>
                                            <input type="number" name="breathing" id="breathing_sick" value="{{old('breathing')}}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-1.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                        </div>

                                        <div class="w-full">
                                            <label for="tall_sick" class="block mb-1 text-sm font-medium text-gray-900 dark:text-white">Chiều cao</label>
                                            <input type="number" name="tall" id="tall_sick" value="{{old('tall')}}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-1.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                        </div>
                                    </div>
                                    <div class="w-full grid gap-1 sm:grid-cols-2 sm:gap-2">
                                        <div class="w-full">
                                            <label for="weight_sick" class="block mb-1 text-sm font-medium text-gray-900 dark:text-white">Cân nặng</label>
                                            <input type="number" name="weight" id="weight_sick" value="{{old('weight')}}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-1.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                        </div>
                                        <div class="w-full">
                                            <label for="BMI_sick" class="block mb-1 text-sm font-medium text-gray-900 dark:text-white">BMI</label>
                                            <input type="number" name="BMI" id="BMI_sick" value="{{old('BMI')}}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-1.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                        </div>
                                    </div>

                                    <div class="sm:col-span-2">
                                        <label for="symptom_sick" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Triệu Chứng Lâm Sàn Ban Đầu</label>
                                        <textarea id="symptom_sick" rows="5" name="symptom" value="{{old('symptom')}}" class="block p-1.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Mô Tả Chi Tiết"></textarea>
                                    </div>

                                    <div class="sm:col-span-2">
                                        <div class="flex justify-center">
                                            <button type="button" id="create_patient" class="inline-flex items-center px-5 py-2.5 mt-4 sm:mt-6 text-sm font-medium text-center text-white rounded-lg bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300">
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
                                    <div>
                                        @if(isset($patient) && count($patient) > 0)
                                            {{
                                                $patient->appends(array(
                                                    'tab' => $tab,
                                                    'search_name_tab1' => old('search_name_tab1'),
                                                ))->links()
                                            }}
                                        @endif
                                    </div>
                                    <div>
                                        <form method="GET" action="{{ route('admin.clinic.index')}}" class="flex">
                                            <input type="hidden" name="tab" value="1">
                                            <div class="sm:co-span-2">
                                                <input type="ltext" name="search_name_tab1"  value="{{old('search_name_tab1')}}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-1.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Tìm theo tên bệnh nhân...">
                                            </div>
                                            <div>
                                                <button type="submit" class="inline-flex items-center px-5 py-1.5 mx-2 text-sm font-medium text-center text-white rounded-lg bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300">
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
                                                    <td class="text-left py-2 px-2">
                                                        <input type="checkbox" data-id="{{$item->id}}" class="patient_details">
                                                    </td>
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
                            <div class="p-2 grid gap-4 sm:grid-cols-2 sm:gap-6">
                                <div class="grid gap-1 sm:grid-cols-2 sm:gap-2 content-start">
                                    @csrf
                                    <h2 class="sm:col-span-2">THÔNG TIN BỆNH NHÂN</h2>
                                    <div class="w-full">
                                        <label class="block mb-1 text-sm font-medium text-gray-900 dark:text-white">Họ và tên</label>
                                        <input type="text" id="name_patient_tab2" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-1.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Họ và tên" required="">
                                    </div>
                                    <div class="w-full">
                                        <label class="block mb-1 text-sm font-medium text-gray-900 dark:text-white">Giới Tính</label>
                                        <select id="sex_patient_tab2"  class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-1.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                            <option value="0">Nam</option>
                                            <option value="1">Nữ</option>
                                        </select>
                                    </div>

                                    <div class="sm:col-span-2 grid gap-1 sm:grid-cols-3 sm:gap-2">
                                        <div class="w-full">
                                            <label class="block mb-1 text-sm font-medium text-gray-900 dark:text-white">Ngày Sinh</label>
                                            <input type="date" id="date_patient_tab2" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-1.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Họ và tên" required="">
                                        </div>
                                        <div class="w-full">
                                            <label class="block mb-1 text-sm font-medium text-gray-900 dark:text-white">Dân Tộc</label>
                                            <select id="ethnic_patient_tab2" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-1.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                                <option value="0">Kinh</option>
                                                <option value="1">Dân Tộc Thiểu Số</option>
                                            </select>
                                        </div>

                                        <div class="w-full">
                                            <label class="block mb-1 text-sm font-medium text-gray-900 dark:text-white">Số Điện Thoại</label>
                                            <input type="text" id="phone_patient_tab2" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-1.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Số Điện Thoại" required="">
                                        </div>
                                    </div>

                                    <div class="w-full">
                                        <label class="block mb-1 text-sm font-medium text-gray-900 dark:text-white">Địa Chỉ</label>
                                        <input type="text" id="address_patient_tab2" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-1.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Địa chỉ" required="">
                                    </div>

                                    <div class="w-full">
                                        <label class="block mb-1 text-sm font-medium text-gray-900 dark:text-white">Nơi Làm Việc</label>
                                        <input type="text" id="workshop_patient_tab2" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-1.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Nơi Làm Việc" required="">
                                    </div>

                                    <div class="sm:col-span-2 grid gap-1 sm:grid-cols-2 sm:gap-2">
                                        <div class="w-full">
                                            <label class="block mb-1 text-sm font-medium text-gray-900 dark:text-white">Ngày Khám</label>
                                            <input type="date" id="date_sick_tab2" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-1.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Họ và tên" required="">
                                        </div>
                                        <div class="w-full">
                                            <label class="block mb-1 text-sm font-medium text-gray-900 dark:text-white">Giờ Khám</label>
                                            <input type="time" id="time_sick_tab2" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-1.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Họ và tên">
                                        </div>
                                    </div>

                                    <div class="sm:col-span-2 grid gap-1 sm:grid-cols-2 sm:gap-2">
                                        <div class="w-full flex">
                                            <span class="w-44">Mạch</span>
                                            <input type="text" id="m_sick_tab2" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-1.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Mạch">
                                            <span class="w-24">1/p</span>
                                        </div>
                                        <div class="w-full flex">
                                            <span class="w-44">T</span>
                                            <input type="text" id="t_sick_tab2" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-1.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="T">
                                            <span class="w-24">C</span>
                                        </div>
                                    </div>
                                    <div class="sm:col-span-2 grid gap-1 sm:grid-cols-2 sm:gap-2">

                                        <div class="w-full flex">
                                            <span class="w-44">HA</span>
                                            <input type="text" id="ha_sick_tab2" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-1.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="HA">
                                            <span class="w-24">mmHg</span>
                                        </div>

                                        <div class="w-full flex">
                                            <span class="w-44">Đường huyết</span>
                                            <input type="text" id="dh_sick_tab2" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-1.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Đường huyết">
                                            <span class="w-24"></span>
                                        </div>
                                    </div>

                                    <div class="sm:col-span-2 grid gap-1 sm:grid-cols-2 sm:gap-2">
                                        <div class="w-full flex">
                                            <span class="w-44">Nhịp Thở</span>
                                            <input type="text" id="nt_sick_tab2" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-1.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Nhịp thở">
                                            <span class="w-24">1/p</span>
                                        </div>
                                        <div class="w-full flex">
                                            <span class="w-44">Cao</span>
                                            <input type="text" id="tall_sick_tab2" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-1.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Cao">
                                            <span class="w-24">cm</span>
                                        </div>
                                    </div>
                                    <div class="sm:col-span-2 grid gap-1 sm:grid-cols-2 sm:gap-2">
                                        <div class="w-full flex">
                                            <span class="w-44">Nặng</span>
                                            <input type="text" id="weight_sick_tab2" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-1.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Nặng">
                                            <span class="w-24">kg</span>
                                        </div>

                                        <div class="w-full flex">
                                            <span class="w-44">BMI</span>
                                            <input type="text" id="bmi_sick_tab2" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-1.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="BMI">
                                            <span class="w-24"></span>
                                        </div>
                                    </div>

                                    <div class="sm:col-span-2">
                                        <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Triệu chứng lâm sàn ban đầu</label>
                                        <textarea rows="2" id="symptom_sick_tab2" class="block p-1.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Triệu chứng lâm sàn ban đầu"></textarea>
                                    </div>

                                    <div class="sm:col-span-2">
                                        <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Danh sách các lần khám</label>
                                        <div id="list_stick">

                                        </div>
                                    </div>
                                </div>

                                <form action="{{route('admin.sick.edit')}}" method="post" enctype="multipart/form-data" id="form_update_sick" class="grid gap-1 sm:grid-cols-2 sm:gap-2 content-start">
                                    @csrf
                                    <input type="hidden" name="id_sick" id="id_sick_tab2">
                                    <h2 class="sm:col-span-2">THÔNG TIN RA</h2>

                                    <div class="sm:col-span-2">
                                        <label for="result_sick" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Bệnh Chính</label>
                                        <textarea id="result_sick" rows="5" name="result" value="{{old('result')}}" class="block p-1.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Bệnh chính"></textarea>
                                    </div>

                                    <div class="sm:col-span-2">
                                        <label for="result1_sick" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Bệnh Kèm Theo1</label>
                                        <textarea id="result1_sick" rows="2" name="result1" value="{{old('result1')}}" class="block p-1.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Bệnh kèm theo"></textarea>
                                    </div>

                                    <div class="sm:col-span-2">
                                        <label for="result2_sick" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Bệnh Kèm Theo2</label>
                                        <textarea id="result2_sick" rows="2" name="result2" value="{{old('result2')}}" class="block p-1.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Bệnh kèm theo"></textarea>
                                    </div>

                                    <div class="sm:col-span-2">
                                        <label for="result3_sick" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Bệnh Kèm Theo3</label>
                                        <textarea id="result3_sick" rows="2" name="result3" value="{{old('result3')}}" class="block p-1.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Bệnh kèm theo"></textarea>
                                    </div>

                                    <div class="sm:col-span-2">
                                        <label for="image_sick_edit" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Hình Ảnh Đính Kèm</label>
                                        <input type="file" name="image_multiple[]" accept="image/*" multiple id="image_sick_edit" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-1.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Mô Tả Ngắn" required="">
                                        <div class="mt-2 flex items-center flex-warp" id="preview_image_sick_edit"></div>
                                    </div>

                                    <div class="sm:col-span-2">
                                        <div class="flex justify-center">
                                            <button type="button" id="submit_update_sick" class="inline-flex items-center px-5 py-2.5 ml-2 mt-4 sm:mt-6 text-sm font-medium text-center text-white rounded-lg bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300">
                                                Lưu
                                            </button>

                                            <button type="button" class="btn_medicine_supply inline-flex items-center px-5 py-2.5  ml-2 mt-4 sm:mt-6 text-sm font-medium text-center text-white rounded-lg bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300">
                                                Cấp Thuốc
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
                                    <div>
                                        @if(isset($patient_tab2) && count($patient_tab2) > 0)
                                            {{
                                                $patient_tab2->appends(array(
                                                    'tab' => $tab,
                                                    'search_name_tab2' => old('search_name_tab2'),
                                                ))->links()
                                            }}
                                        @endif
                                    </div>
                                    <div>
                                        <form method="GET" action="{{ route('admin.clinic.index')}}" class="flex">
                                            <input type="hidden" name="tab" value="2">
                                            <div class="sm:co-span-2">
                                                <input type="ltext" name="search_name_tab2"  value="{{old('search_name_tab2')}}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-1.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Tìm theo tên bệnh nhân...">
                                            </div>
                                            <div>
                                                <button type="submit" class="inline-flex items-center px-5 py-1.5 mx-2 text-sm font-medium text-center text-white rounded-lg bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300">
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
                                            @foreach ($patient_tab2 as $index=>$item)
                                                <tr>
                                                    <td class="text-left py-2 px-2">
                                                        <input type="checkbox" data-id="{{$item->id}}" class="patient_sicks">
                                                    </td>
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

                            <!-- Main modal -->
                            <div id="default-modal_medicine_supply" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                                <div class="relative p-4 w-full max-h-full mx-auto">
                                    <!-- Modal content -->
                                    <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                                        <!-- Modal header -->
                                        <div class="flex items-center justify-between px-4 py-1 border-b rounded-t dark:border-gray-600">
                                            <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                                                CẤP THUỐC
                                            </h3>
                                            <button type="button" class="cancel_popup_medicine_supply text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="default-modal">
                                                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                                                </svg>
                                                <span class="sr-only">Close modal</span>
                                            </button>
                                        </div>
                                        <!-- Modal body -->
                                        <div class="p-4 md:p-5 space-y-4">
                                            <form method="post" id="submit_form_save_prescription" class="">
                                                @csrf
                                                <div class="grid gap-4 sm:grid-cols-2 sm:gap-6">
                                                    <div class="w-full">
                                                        <div class="flex w-full mb-1">
                                                            <span class="w-24">Tên BN</span>
                                                            <input type="text" id="name_bn" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-1 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="">
                                                        </div>
                                                        <div class="flex w-full mb-1">
                                                            <span class="w-24">Chuẩn đoán</span>
                                                            <input type="text" id="chuan_doan" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-1 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="">
                                                        </div>

                                                        <div class="flex w-full mb-1">
                                                            <span class="w-24">Kết luận</span>
                                                            <textarea rows="2" id="ket_luan" name="result" value="" class="block p-1 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Lời dặn của bác sĩ"></textarea>
                                                        </div>

                                                        <div class="flex w-full mb-1">
                                                            <span class="w-24">Triệu chứng</span>
                                                            <input type="text" id="trieu_chung" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-1 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="">
                                                        </div>
                                                    </div>
                                                    <div class="w-full flex">
                                                        <span class="w-24">Lời dặn</span>
                                                        <textarea rows="4" id="loi_dan" name="result4" value="" class="block p-1.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Lời dặn của bác sĩ"></textarea>
                                                    </div>
                                                </div>

                                                <div class="flex flex-wrap">
                                                    <span>Mạch: &ensp;</span>
                                                    <span id="mach_popup"></span>
                                                    <span>&ensp; 1/p &emsp;</span>
                                                    <span>T:&ensp;</span>
                                                    <span id="t_popup"></span>
                                                    <span>&ensp;C &emsp;</span>
                                                    <span>HA:</span>
                                                    <span id="ha_popup"></span>
                                                    <span>&ensp;mmHg &emsp;</span>
                                                    <span>Cao: &ensp;</span>
                                                    <span id="cao_popup"></span>
                                                    <span>&ensp;cm &emsp;</span>
                                                    <span>Nặng:&ensp;</span>
                                                    <span id="nang_popup"></span>
                                                    <span>&ensp;kg&emsp;</span>
                                                    <span>Nghỉ phép: &ensp;</span>
                                                    <span>
                                                        <input type="number" id="on_leave_popup" name="on_leave" class="w-24 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block p-1 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="">
                                                    </span>
                                                    <span>&ensp;ngày &emsp;</span>
                                                </div>

                                                <input type="hidden" id="sick_id_drug_add" name="id_sick">
                                                <input type="hidden" id="index_table" value="0">

                                                <div class="flex">
                                                    <div class="w-3/4 h-60 border overflow-auto rounded mr-1 p-2">
                                                        <table class="border rounded w-full" style="min-width: 1458px;">
                                                            <tr>
                                                                <th class="border w-20"></th>
                                                                <th class="border w-96">Tên thuốc</th>
                                                                <th class="border w-40">Hoạt chất</th>
                                                                <th class="border w-48">Đơn vị thuốc</th>
                                                                <th class="border w-32">Mỗi ngày</th>
                                                                <th class="border w-32">Mỗi lần</th>
                                                                <th class="border w-32">Số ngày</th>
                                                                <th class="border w-32">Số lượng</th>
                                                                <th class="border w-32">Đơn giá</th>
                                                                <th class="border w-96">Liều dùng</th>
                                                                <th class="border w-96">Cách dùng</th>
                                                                <th class="border w-32">Buổi</th>
                                                                <th class="border w-40">Chú ý</th>
                                                            </tr>
                                                            <tbody class="table_drug_list">
                                                            </tbody>
                                                        </table>
                                                    </div>

                                                    <div class="w-1/4 h-60 border overflow-auto rounded ml-1 p-2">
                                                        <div class="text-xl text-red-600">
                                                            Bấm vào 1 dòng và chọn cho lại để cho lại thuốc đã cho ở lần trước
                                                        </div>
                                                        <div class="list_sick_popup">

                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="flex my-1 items-center flex-wrap">
                                                    <div class="flex items-center mb-1">
                                                        <span class="w-20">Tên</span>
                                                        <select id="name_drug_add" class="w-48 mr-2 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block p-1.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                                            <option value="">Chọn tên thuốc</option>
                                                            @foreach ($drug as $item)
                                                                <option value="{{$item->id}}">{{$item->name}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>

                                                    <div class="flex items-center mb-1">
                                                        <span class="w-20">Đơn giá</span>
                                                        <input type="number" id="price_drug_add" min="0" class="mr-2 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-40 p-1.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                                    </div>

                                                    <div class="flex items-center mb-1">
                                                        <span class="w-20">Mỗi ngày</span>
                                                        <input type="number" id="every_day_drug_add" min="1" class="w-12 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block p-1.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                                        <span class="w-12 mr-2">lần</span>
                                                    </div>

                                                    <div class="flex items-center mb-1">
                                                        <span class="w-20">Mỗi lần</span>
                                                        <input type="number" id="every_times_drug_add" min="1" class="mr-2 w-12 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block p-1.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                                    </div>
                                                    <div class="flex items-center mb-1">
                                                        <span class="w-20">Số ngày</span>
                                                        <input type="number" id="number_of_day_drug_add" min="1" class="mr-2 w-12 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block p-1.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                                    </div>
                                                    <div class="flex items-center mb-1">
                                                        <span class="w-20">Số lượng</span>
                                                        <input type="number" id="quantity_drug_add" min="1" class="mr-2 w-12 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block p-1.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                                    </div>
                                                </div>

                                                <div class="flex my-1 items-center flex-wrap">
                                                    <div class="flex items-center mb-1">
                                                        <span class="w-20">Liều dùng</span>
                                                        <input type="text" id="dosage_drug_add" class="mr-2 w-56 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block p-1.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                                    </div>

                                                    <div class="flex items-center mb-1">
                                                        <span class="w-20">Cách dùng</span>
                                                        <select id="usage_drug_add" class="w-48 mr-2 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block p-1.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                                            <option value="">Chọn cách dùng</option>
                                                            @foreach ($usage as $item)
                                                                <option value="{{$item->id}}">{{$item->name}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>

                                                    <div class="flex items-center mb-1">
                                                        <span class="w-20">Buổi</span>
                                                        <input type="text" id="session_drug_add" maxlength="512" class="mr-2 w-48 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block p-1.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                                    </div>

                                                    <div class="flex items-center mb-1">
                                                        <span class="w-20">Lưu ý</span>
                                                        <input type="text" id="note_drug_add" maxlength="512" class="mr-2 w-48 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block p-1.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                                    </div>
                                                </div>

                                                <div class="flex my-1 items-center flex-wrap justify-center">
                                                    <div class="flex items-center mb-1">
                                                        <button type="button" class="save_prescription inline-flex items-center px-5 py-2.5 ml-2 mt-4 sm:mt-6 text-sm font-medium text-center text-white rounded-lg bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300">
                                                            Lưu đơn thuốc
                                                        </button>
                                                    </div>

                                                    <div class="flex items-center mb-1">
                                                        <button type="button" class="give_back inline-flex items-center px-5 py-2.5 ml-2 mt-4 sm:mt-6 text-sm font-medium text-center text-white rounded-lg bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300">
                                                            Cho lại
                                                        </button>
                                                    </div>

                                                    <div class="flex items-center mb-1">
                                                        <button type="button" class="add_them_thuoc inline-flex items-center px-5 py-2.5 ml-2 mt-4 sm:mt-6 text-sm font-medium text-center text-white rounded-lg bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300">
                                                            Thêm
                                                        </button>
                                                    </div>

                                                    <div class="flex items-center mb-1">
                                                        <button type="button" class="edit_row_prescription inline-flex items-center px-5 py-2.5 ml-2 mt-4 sm:mt-6 text-sm font-medium text-center text-white rounded-lg bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300">
                                                            Sửa
                                                        </button>
                                                    </div>

                                                    <div class="flex items-center mb-1">
                                                        <button type="button" class="delete_row_prescription inline-flex items-center px-5 py-2.5 ml-2 mt-4 sm:mt-6 text-sm font-medium text-center text-white rounded-lg bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300">
                                                            Xoá
                                                        </button>
                                                    </div>

                                                    <div class="flex items-center mb-1">
                                                        <button type="button" id="printerFile" class="inline-flex items-center px-5 py-2.5 ml-2 mt-4 sm:mt-6 text-sm font-medium text-center text-white rounded-lg bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300">
                                                            In
                                                        </button>
                                                    </div>
                                                </div>

                                            </form>
                                            <form action="{{route('admin.generatePDF')}}" method="get" id="export_pdf">
                                                <input type="hidden" name="id" id="id_sick_export">
                                            </form>
                                        </div>
                                        <!-- Modal footer -->
                                        <div class="flex justify-end items-center px-4 py-1 border-t border-gray-200 rounded-b dark:border-gray-600">
                                            <button type="button" class="cancel_popup_medicine_supply py-1 px-4 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">Đóng</button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div x-show="activeTab===3">
                            <form action="{{route('admin.generic.add')}}" method="post" class="py-2 px-4 mx-auto max-w-2xl lg:py-4">
                                @csrf
                                <div class="grid gap-4 sm:grid-cols-2 sm:gap-6">
                                    <div class="sm:col-span-2">
                                        <label for="name_generic" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Tên Hoạt Chất</label>
                                        <input type="text" name="name" id="name_generic" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-1.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Tên hoạt chất" required="">
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
                                    <div></div>
                                    <div>
                                        <form method="GET" action="{{ route('admin.clinic.index')}}" class="flex">
                                            <input type="hidden" name="tab" value="3">
                                            <div class="sm:co-span-2">
                                                <input type="ltext" name="search_name_tab3"  value="{{old('search_name_tab3')}}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-1.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Tìm theo tên hoạt chất...">
                                            </div>
                                            <div>
                                                <button type="submit" class="inline-flex items-center px-5 py-1.5 mx-2 text-sm font-medium text-center text-white rounded-lg bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300">
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
                                                            <button type="button" data-id="{{$item->id}}" data-name="{{$item->name}}" class="update_generic mb-1 focus:outline-none text-white bg-yellow-400 hover:bg-yellow-500 focus:ring-4 focus:ring-yellow-300 font-medium rounded-lg text-sm px-3 py-1 mr-1 dark:focus:ring-yellow-900">
                                                                Cập nhập
                                                            </button>

                                                            <a href="{{route('admin.generic.delete', ['id' => $item->id])}}" class="focus:outline-none text-white bg-red-400 hover:bg-red-500 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-3 py-1.5 dark:focus:ring-red-900">
                                                                Xoá
                                                            </a>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            @endif
                                        </tbody>
                                    </table>
                                </div>

                                <!-- Main modal -->
                                <div id="default-modal_generic" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                                    <div class="relative p-4 w-full max-w-2xl max-h-full mx-auto pt-10">
                                        <!-- Modal content -->
                                        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                                            <!-- Modal header -->
                                            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                                                <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                                                    CẬP NHẬP HOẠT CHẤT
                                                </h3>
                                                <button type="button" class="cancel_popup_generic text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="default-modal">
                                                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                                                    </svg>
                                                    <span class="sr-only">Close modal</span>
                                                </button>
                                            </div>
                                            <!-- Modal body -->
                                            <div class="p-4 md:p-5 space-y-4">
                                                <div class="">
                                                    <form  action="{{route('admin.generic.edit')}}" method="POST" enctype="multipart/form-data">
                                                        @csrf
                                                        <input type="hidden" name="id" id="id_generic_edit">
                                                        <div class="grid gap-4 sm:grid-cols-2 sm:gap-6">
                                                            <div class="sm:col-span-2">
                                                                <label for="name_generic_edit" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Tên Hoạt Chất</label>
                                                                <input type="text" name="name" id="name_generic_edit" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-1.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Tên hoạt chất" required="">
                                                            </div>
                                                        </div>
                                                        <div class="flex justify-center">
                                                            <button type="submit" class="inline-flex items-center px-5 py-2.5 mt-4 sm:mt-6 text-sm font-medium text-center text-white rounded-lg bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300">
                                                                CẬP NHẬP
                                                            </button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                            <!-- Modal footer -->
                                            <div class="flex justify-end items-center p-4 md:p-5 border-t border-gray-200 rounded-b dark:border-gray-600">
                                                <button type="button" class="cancel_popup_generic py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">Đóng</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </section>
                        </div>
                        <div x-show="activeTab===4">
                            <form action="{{route('admin.drugUnit.add')}}" method="post" class="py-2 px-4 mx-auto max-w-2xl lg:py-4">
                                @csrf
                                <div class="grid gap-4 sm:grid-cols-2 sm:gap-6">
                                    <div class="sm:col-span-2">
                                        <label for="name_drug_unit" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Tên Đơn Vị Thuốc</label>
                                        <input type="text" name="name" id="name_drug_unit" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-1.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Đơn vị thuốc" required="">
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
                                        <form method="GET" action="{{ route('admin.clinic.index')}}" class="flex">
                                            <input type="hidden" name="tab" value="4">
                                            <div class="sm:co-span-2">
                                                <input type="ltext" name="search_name_tab4"  value="{{old('search_name_tab4')}}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-1.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Tìm theo tên đơn vị thuốc...">
                                            </div>
                                            <div>
                                                <button type="submit" class="inline-flex items-center px-5 py-1.5 mx-2 text-sm font-medium text-center text-white rounded-lg bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300">
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
                                                            <button type="button" data-id="{{$item->id}}" data-name="{{$item->name}}" class="update_drugUnit mb-1 focus:outline-none text-white bg-yellow-400 hover:bg-yellow-500 focus:ring-4 focus:ring-yellow-300 font-medium rounded-lg text-sm px-3 py-1 mr-1 dark:focus:ring-yellow-900">
                                                                Cập nhập
                                                            </button>

                                                            <a href="{{route('admin.drugUnit.delete', ['id' => $item->id])}}" class="focus:outline-none text-white bg-red-400 hover:bg-red-500 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-3 py-1.5 dark:focus:ring-red-900">
                                                                Xoá
                                                            </a>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            @endif
                                        </tbody>
                                    </table>
                                </div>

                                <!-- Main modal -->
                                <div id="default-modal_drugUnit" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                                    <div class="relative p-4 w-full max-w-2xl max-h-full mx-auto pt-10">
                                        <!-- Modal content -->
                                        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                                            <!-- Modal header -->
                                            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                                                <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                                                    CẬP NHẬP ĐƠN VỊ THUỐC
                                                </h3>
                                                <button type="button" class="cancel_popup_drugUnit text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="default-modal">
                                                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                                                    </svg>
                                                    <span class="sr-only">Close modal</span>
                                                </button>
                                            </div>
                                            <!-- Modal body -->
                                            <div class="p-4 md:p-5 space-y-4">
                                                <div class="">
                                                    <form  action="{{route('admin.drugUnit.edit')}}" method="POST" enctype="multipart/form-data">
                                                        @csrf
                                                        <input type="hidden" name="id" id="id_drugUnit_edit">
                                                        <div class="grid gap-4 sm:grid-cols-2 sm:gap-6">
                                                            <div class="sm:col-span-2">
                                                                <label for="name_drugUnit_edit" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Tên Hoạt Chất</label>
                                                                <input type="text" name="name" id="name_drugUnit_edit" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-1.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Tên hoạt chất" required="">
                                                            </div>
                                                        </div>
                                                        <div class="flex justify-center">
                                                            <button type="submit" class="inline-flex items-center px-5 py-2.5 mt-4 sm:mt-6 text-sm font-medium text-center text-white rounded-lg bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300">
                                                                CẬP NHẬP
                                                            </button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                            <!-- Modal footer -->
                                            <div class="flex justify-end items-center p-4 md:p-5 border-t border-gray-200 rounded-b dark:border-gray-600">
                                                <button type="button" class="cancel_popup_drugUnit py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">Đóng</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </section>
                        </div>
                        <div x-show="activeTab===5">
                            <form action="{{route('admin.drug.add')}}" method="post" class="py-2 px-4 mx-auto max-w-2xl lg:py-4">
                                @csrf
                                <div class="grid gap-1 sm:grid-cols-2 sm:gap-2">
                                    <div class="w-full">
                                        <label for="name_drug" class="block mb-1 text-sm font-medium text-gray-900 dark:text-white">Tên Dược Phẩm</label>
                                        <input type="text" name="name" id="name_drug" value="{{old('name')}}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-1.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Họ và tên" required="">
                                    </div>
                                    <div class="w-full">
                                        <label for="price_drug" class="block mb-1 text-sm font-medium text-gray-900 dark:text-white">Giá Dược Phẩm</label>
                                        <input type="number" name="price" id="price_drug" value="{{old('price')}}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-1.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" required="">
                                    </div>

                                    <div class="w-full">
                                        <label for="id_generic" class="block mb-1 text-sm font-medium text-gray-900 dark:text-white">Loại Hoạt Chất</label>
                                        <select id="id_generic" required name="id_generic" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-1.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                            <option value="">Chọn Hoạt Chất</option>
                                            @foreach ($generic as $item)
                                                <option value="{{$item->id}}">{{$item->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="w-full">
                                        <label for="id_drug_unit" class="block mb-1 text-sm font-medium text-gray-900 dark:text-white">Đơn Vị Thuốc</label>
                                        <select id="id_drug_unit" required name="id_drug_unit" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-1.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
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
                                        <form method="GET" action="{{ route('admin.clinic.index')}}" class="flex">
                                            <input type="hidden" name="tab" value="5">
                                            <div class="sm:co-span-2">
                                                <input type="ltext" name="search_name_tab5"  value="{{old('search_name_tab5')}}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-1.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Tìm theo tên dược phẩm...">
                                            </div>
                                            <div>
                                                <button type="submit" class="inline-flex items-center px-5 py-1.5 mx-2 text-sm font-medium text-center text-white rounded-lg bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300">
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
                                                        <button type="button" data-id="{{$item->id}}" data-name="{{$item->name}}" data-id_drug_unit="{{$item->id_drug_unit}}" data-id_generic="{{$item->id_generic}}" data-price="{{$item->price}}" class="update_drug mb-1 focus:outline-none text-white bg-yellow-400 hover:bg-yellow-500 focus:ring-4 focus:ring-yellow-300 font-medium rounded-lg text-sm px-3 py-1 mr-1 dark:focus:ring-yellow-900">
                                                            Cập nhập
                                                        </button>

                                                        <a href="{{route('admin.drug.delete', ['id' => $item->id])}}" class="focus:outline-none text-white bg-red-400 hover:bg-red-500 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-3 py-1.5 dark:focus:ring-red-900">
                                                            Xoá
                                                        </a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>

                                  <!-- Main modal -->
                                  <div id="default-modal_drug" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                                    <div class="relative p-4 w-full max-w-2xl max-h-full mx-auto pt-10">
                                        <!-- Modal content -->
                                        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                                            <!-- Modal header -->
                                            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                                                <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                                                    CẬP NHẬP DƯỢC PHẢM
                                                </h3>
                                                <button type="button" class="cancel_popup_drug text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="default-modal">
                                                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                                                    </svg>
                                                    <span class="sr-only">Close modal</span>
                                                </button>
                                            </div>
                                            <!-- Modal body -->
                                            <div class="p-4 md:p-5 space-y-4">
                                                <div class="">
                                                    <form  action="{{route('admin.drug.edit')}}" method="POST" enctype="multipart/form-data">
                                                        @csrf
                                                        <input type="hidden" name="id" id="id_drug_edit">
                                                        <div class="grid gap-1 sm:grid-cols-2 sm:gap-2">
                                                            <div class="w-full">
                                                                <label for="name_drug_edit" class="block mb-1 text-sm font-medium text-gray-900 dark:text-white">Tên Dược Phẩm</label>
                                                                <input type="text" name="name" id="name_drug_edit" value="{{old('name')}}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-1.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Họ và tên" required="">
                                                            </div>
                                                            <div class="w-full">
                                                                <label for="price_drug_edit" class="block mb-1 text-sm font-medium text-gray-900 dark:text-white">Giá Dược Phẩm</label>
                                                                <input type="number" name="price" id="price_drug_edit" value="{{old('price')}}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-1.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" required="">
                                                            </div>

                                                            <div class="w-full">
                                                                <label for="id_generic_edit_tab5" class="block mb-1 text-sm font-medium text-gray-900 dark:text-white">Loại Hoạt Chất</label>
                                                                <select id="id_generic_edit_tab5" required name="id_generic" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-1.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                                                    <option value="">Chọn Hoạt Chất</option>
                                                                    @foreach ($generic as $item)
                                                                        <option value="{{$item->id}}">{{$item->name}}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                            <div class="w-full">
                                                                <label for="id_drug_unit_edit" class="block mb-1 text-sm font-medium text-gray-900 dark:text-white">Đơn Vị Thuốc</label>
                                                                <select id="id_drug_unit_edit" required name="id_drug_unit" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-1.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                                                    <option value="">Chọn Đơn Vị Thuốc</option>
                                                                    @foreach ($drugUnit as $item)
                                                                        <option value="{{$item->id}}">{{$item->name}}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>

                                                        <div class="flex justify-center">
                                                            <button type="submit" class="inline-flex items-center px-5 py-2.5 mt-4 sm:mt-6 text-sm font-medium text-center text-white rounded-lg bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300">
                                                                CẬP NHẬP
                                                            </button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                            <!-- Modal footer -->
                                            <div class="flex justify-end items-center p-4 md:p-5 border-t border-gray-200 rounded-b dark:border-gray-600">
                                                <button type="button" class="cancel_popup_drug py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">Đóng</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </section>
                        </div>
                        <div x-show="activeTab===6">
                            <form action="{{route('admin.usage.add')}}" method="post" class="py-2 px-4 mx-auto max-w-2xl lg:py-4">
                                @csrf
                                <div class="grid gap-4 sm:grid-cols-2 sm:gap-6">
                                    <div class="sm:col-span-2">
                                        <label for="name_cach_dung" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Tên Cách Dùng</label>
                                        <input type="text" name="name" id="name_cach_dung" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-1.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Tên cách dùng" required="">
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
                                    <div></div>
                                    <div>
                                        <form method="GET" action="{{ route('admin.clinic.index')}}" class="flex">
                                            <input type="hidden" name="tab" value="6">
                                            <div class="sm:co-span-2">
                                                <input type="ltext" name="search_name_tab6"  value="{{old('search_name_tab6')}}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-1.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Tìm theo Tên sản phẩm...">
                                            </div>
                                            <div>
                                                <button type="submit" class="inline-flex items-center px-5 py-1.5 mx-2 text-sm font-medium text-center text-white rounded-lg bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300">
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
                                                            <button type="button" data-id="{{$item->id}}" data-name="{{$item->name}}" class="update_usage focus:outline-none text-white bg-yellow-400 hover:bg-yellow-500 focus:ring-4 focus:ring-yellow-300 font-medium rounded-lg text-sm px-3 py-1 mr-1 dark:focus:ring-yellow-900">
                                                                Cập nhập
                                                            </button>
                                                            <a href="{{route('admin.usage.delete', ['id' => $item->id])}}" class="mt-1 focus:outline-none text-white bg-red-400 hover:bg-red-500 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-3 py-1.5 dark:focus:ring-red-900">
                                                                Xoá
                                                            </a>
                                                        @endif
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>

                                <!-- Main modal -->
                                <div id="default-modal_usage" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                                    <div class="relative p-4 w-full max-w-2xl max-h-full mx-auto pt-10">
                                        <!-- Modal content -->
                                        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                                            <!-- Modal header -->
                                            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                                                <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                                                    CẬP NHẬP HOẠT CÁCH DÙNG
                                                </h3>
                                                <button type="button" class="cancel_popup_usage text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="default-modal">
                                                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                                                    </svg>
                                                    <span class="sr-only">Close modal</span>
                                                </button>
                                            </div>
                                            <!-- Modal body -->
                                            <div class="p-4 md:p-5 space-y-4">
                                                <div class="">
                                                    <form  action="{{route('admin.usage.edit')}}" method="POST" enctype="multipart/form-data">
                                                        @csrf
                                                        <input type="hidden" name="id" id="id_usage_edit">
                                                        <div class="grid gap-4 sm:grid-cols-2 sm:gap-6">
                                                            <div class="sm:col-span-2">
                                                                <label for="name_usage_edit" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Tên Hoạt Chất</label>
                                                                <input type="text" name="name" id="name_usage_edit" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-1.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Tên hoạt chất" required="">
                                                            </div>
                                                        </div>
                                                        <div class="flex justify-center">
                                                            <button type="submit" class="inline-flex items-center px-5 py-2.5 mt-4 sm:mt-6 text-sm font-medium text-center text-white rounded-lg bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300">
                                                                CẬP NHẬP
                                                            </button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                            <!-- Modal footer -->
                                            <div class="flex justify-end items-center p-4 md:p-5 border-t border-gray-200 rounded-b dark:border-gray-600">
                                                <button type="button" class="cancel_popup_usage py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">Đóng</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </section>
                        </div>
                    </div>
                </div>
            <!-- action buttons -->
        </div>
    </main>
@endsection

