@extends('layout_client')

@section('content')
    <section class="selling_products">
        <div calss="w-full bg-red-50 relative "  style="background: linear-gradient(rgb(246, 247, 251) 0%, rgba(89, 110, 147, 0.124) 100%);">
            <div class="product_list w-4/5 mx-auto py-14">
                <div class="flex items-start justify-between flex-wrap grid md:grid-cols-2 grid-cols-1  gap-2">
                    <div class="w-9/12">
                        <div class="w-full py-5">
                            <img style="aspect-ratio: 4/5" src="{{ asset('/storage/'. $product_detail->image) }}" alt="">
                        </div>

                        <div class="flex flex-wrap items-start">
                            @foreach ($product_detail->productImg as $item)
                                <div class="w-28 h-28 border rounded-lg mx-1">
                                    <img class="w-full h-full rounded-lg" src="{{ asset('/storage/'. $item->path . '/' . $item->file_name) }}" alt="">
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <div class="w-full">
                        <div class=" py-3">
                            Thương hiệu: {{$product_detail->brand}}
                        </div>
                        <div class="font-bold text-3xl py-3">
                            {{$product_detail->name}}
                        </div>

                        <div class="font-bold text-4xl text-blue-600 py-3">
                            {{ number_format($product_detail->price)}}đ
                        </div>

                        <div class="py-3">
                            Danh mục : {{$product_detail->Category->name}}
                        </div>

                        <div class="py-3">
                            Mô tả ngắn : {{$product_detail->title}}
                        </div>

                        <div class="py-3">
                            Chọn số lượng
                            <div class="inline-block items-center">
                                <input type="number" min="1" max="999" id="quatity_product_detail" class="border rounded-full text-center py-1" value="1">
                            </div>
                        </div>

                        <div class="py-3">
                            Tình trạng
                            <i class="fa-solid fa-circle-check text-blue-600 pl-3"></i>
                            <span class="text-blue-600"> Còn hàng</span>
                        </div>

                        <div>
                            <button type="button" data-id="{{$product_detail->id}}" class="add_cards inline-flex items-center px-5 py-2.5 mt-3 text-sm font-medium text-center text-white rounded-lg bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300">
                                Thêm vào giỏ hàng
                            </button>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-lg p-10 mt-5">
                    <div class="font-bold text-3xl">
                        Mô tả sản phẩm
                    </div>
                    <p class="pl-2">
                        {!! nl2br($product_detail->title_detail) !!}
                    </p>
                </div>
            </div>
        </div>
    </section>
@endsection
