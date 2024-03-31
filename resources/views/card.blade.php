@extends('layout_client')

@section('content')
    <section class="selling_products">
        <div calss="w-full bg-red-50 relative "  style="background: linear-gradient(rgb(246, 247, 251) 0%, rgba(89, 110, 147, 0.124) 100%);">
            <div class="product_list w-4/5 mx-auto py-14">
                <div class="text-2xl font-bold pb-3 text-center text-blue-600">Giỏ Hàng Của Bạn</div>
                <div class="pl-2"> Danh sách sản phẩm </div>
                <input type="hidden" id="page_shopping_card" value="1">
                <form action="{{route('client.invoice')}}" method="POST" id="form_submit_shopping_card">
                    @csrf
                    <div class="flex items-start justify-between flex-wrap">
                        <div class="w-7/12 p-2">
                            <div class="bg-white rounded-lg p-5">
                                <div class="append_product_card">

                                </div>
                            </div>
                            <div class="bg-white rounded-lg p-5 mt-2">
                                <div>
                                    <i class="fa-solid fa-user text-blue-600"></i>
                                    <span class="pl-1">Thông tin người đặt</span>
                                </div>
                                <div class="flex flex-warp">
                                    <div class="w-6/12 pr-1">
                                        <input type="text" name="name_from" class="w-full rounded-lg border-gray-300" required placeholder="Họ và tên">
                                    </div>
                                    <div class="w-6/12 pl-1">
                                        <input type="text" name="phone_from" class="w-full rounded-lg border-gray-300" required placeholder="Số điện thoại">
                                    </div>
                                </div>

                                <div class="w-full mt-2">
                                    <input type="text" name="email_from" class="w-full rounded-lg border-gray-300" placeholder="Email (Không bắt buộc)">
                                </div>
                                <div class="border-b my-3"></div>

                                <div>
                                    <i class="fa-solid fa-location-dot text-blue-600"></i>
                                    <span class="pl-1">Thông tin người nhận</span>
                                </div>

                                <div class="flex flex-warp">
                                    <div class="w-6/12 pr-1">
                                        <input type="text" name="name_to" class="w-full rounded-lg border-gray-300" required placeholder="Họ và tên người nhận">
                                    </div>
                                    <div class="w-6/12 pl-1">
                                        <input type="text" name="phone_to" class="w-full rounded-lg border-gray-300" required placeholder="Số điện thoại người nhận">
                                    </div>
                                </div>

                                <div class="flex flex-warp mt-2">
                                    <div class="w-6/12 pr-1">
                                        <input type="text" name="name_city" class="w-full rounded-lg border-gray-300" required placeholder="Nhập tỉnh thành phố">
                                    </div>
                                    <div class="w-6/12 pl-1">
                                        <input type="text" name="name_district" class="w-full rounded-lg border-gray-300" required placeholder="Nhập quận huyện">
                                    </div>
                                </div>

                                <div class="w-full mt-2">
                                    <input type="text" name="name_ward" class="w-full rounded-lg border-gray-300" required placeholder="Nhập phường, xã">
                                </div>

                                <div class="w-full mt-2">
                                    <input type="text" name="address_to" class="w-full rounded-lg border-gray-300" required placeholder="Nhập địa chỉ cụ thể">
                                </div>
                                <div class="w-full mt-2">
                                    <input type="text" name="note_to" class="w-full rounded-lg border-gray-300" placeholder="Thêm ghi chú (không bắt buộc)">
                                </div>
                            </div>
                        </div>
                        <div class="w-5/12 p-2">
                            <div class="bg-white rounded-lg p-5">
                                <div class="w-full h-14 flex items-center bg-gray-200 rounded-xl px-2">
                                    <i class="fa-solid fa-tags text-blue-600"></i>
                                    <span class="text-blue-600 pl-2">Mã giảm giá</span>

                                </div>
                                <div class="flex items-center justify-between mt-3">
                                    <div>Tổng tiền</div>
                                    <div>
                                        <span class="total_amount">0</span>
                                        VND
                                    </div>
                                </div>

                                <div class="flex items-center justify-between mt-3">
                                    <div>Thành tiền</div>
                                    <div>
                                        <span class="total_amount">0</span>
                                        VND
                                    </div>
                                </div>

                                <div class="my-5">
                                    <button type="button" class="submit_shopping_card w-full text-center px-5 py-2.5 text-sm font-medium text-center text-white rounded-lg bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300">
                                        Đặt hàng
                                    </button>
                                </div>
                                <div class="border-b my-3"></div>
                                <div>
                                    <p class="text-red-600 text-2xl font-bold">Hỗ trợ mua hàng</p>
                                    <p class="text-blue-600 text-2xl font-bold">Hotline:09x.xxx.xxxx</p>
                                    <p>(Bán hàng cả Thứ 7 và Chủ nhật)</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection
