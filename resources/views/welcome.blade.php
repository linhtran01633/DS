@extends('layout_client')

@section('carusel')
    <section class="w-full py-4 " style="background: linear-gradient(rgb(246, 247, 251) 0%, rgb(236, 241, 248) 100%);">
        <div id="default-carousel" class="relative w-10/12 mx-auto" data-carousel="slide">
            <!-- Carousel wrapper -->
            <div class="relative h-56 overflow-hidden rounded-lg md:h-96">
                <!-- Item 1 -->
                <div class="hidden duration-700 ease-in-out" data-carousel-item>
                    <img src="/carousel/slide1.webp" class="absolute block w-full h-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2" alt="...">
                </div>
                <!-- Item 2 -->
                <div class="hidden duration-700 ease-in-out" data-carousel-item>
                    <img src="/carousel/slide2.webp" class="absolute block w-full h-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2" alt="...">
                </div>
                <!-- Item 3 -->
                <div class="hidden duration-700 ease-in-out" data-carousel-item>
                    <img src="/carousel/slide3.webp" class="absolute block w-full h-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2" alt="...">
                </div>
                <!-- Item 4 -->
                <div class="hidden duration-700 ease-in-out" data-carousel-item>
                    <img src="/carousel/slide4.webp" class="absolute block w-full h-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2" alt="...">
                </div>
            </div>
            <!-- Slider indicators -->
            <div class="absolute z-30 flex -translate-x-1/2 bottom-5 left-1/2 space-x-3 rtl:space-x-reverse">
                <button type="button" class="w-3 h-3 rounded-full" aria-current="true" aria-label="Slide 1" data-carousel-slide-to="0"></button>
                <button type="button" class="w-3 h-3 rounded-full" aria-current="false" aria-label="Slide 2" data-carousel-slide-to="1"></button>
                <button type="button" class="w-3 h-3 rounded-full" aria-current="false" aria-label="Slide 3" data-carousel-slide-to="2"></button>
                <button type="button" class="w-3 h-3 rounded-full" aria-current="false" aria-label="Slide 4" data-carousel-slide-to="3"></button>
            </div>
            <!-- Slider controls -->
            <button type="button" class="absolute top-0 start-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none" data-carousel-prev>
                <span class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-white/30 dark:bg-gray-800/30 group-hover:bg-white/50 dark:group-hover:bg-gray-800/60 group-focus:ring-4 group-focus:ring-white dark:group-focus:ring-gray-800/70 group-focus:outline-none">
                    <svg class="w-4 h-4 text-white dark:text-gray-800 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 1 1 5l4 4"/>
                    </svg>
                    <span class="sr-only">Previous</span>
                </span>
            </button>
            <button type="button" class="absolute top-0 end-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none" data-carousel-next>
                <span class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-white/30 dark:bg-gray-800/30 group-hover:bg-white/50 dark:group-hover:bg-gray-800/60 group-focus:ring-4 group-focus:ring-white dark:group-focus:ring-gray-800/70 group-focus:outline-none">
                    <svg class="w-4 h-4 text-white dark:text-gray-800 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/>
                    </svg>
                    <span class="sr-only">Next</span>
                </span>
            </button>
        </div>
    </section>
@endsection

@section('content')
    <section class="selling_products">
        <div calss="w-full bg-red-50 relative" style="background: linear-gradient(rgb(246, 247, 251) 0%, rgba(89, 110, 147, 0.124) 100%);">

            @if(count($best_sale) > 0)
                <div class="font-bold text-3xl pt-5 mx-auto text-center">Sản Phẩm Bán Chạy</div>

                <div class="product_list sm:w-4/5 w-11/12 mx-auto py-14">
                    <div class="flex items-center justify-between flex-wrap grid lg:grid-cols-5 md:grid-cols-3 grid-cols-2  gap-2">
                        @foreach ($best_sale as $item)
                            <div class="p-1">
                                <div class="wrap-product p-2 bg-white rounded-lg border-blue-600 hover:border">
                                    <div class="product-des">
                                        <img class="w-11/12 mx-auto" style="aspect-ratio: 4/5" src="{{ asset('/storage/'.$item->image) }}">
                                        <div class="name-product h_50px font-bold">
                                            {{$item->name}}
                                        </div>
                                        <div class="product-price-old">
                                            <span class="price-sale">
                                                Giá:
                                                @if ($item->price > 0)
                                                    {{number_format($item->price)}}VND
                                                @else
                                                    <span class="text-red-500">
                                                        Liên hệ 09x.xxx.xxxx
                                                    </span>
                                                @endif
                                            </span>
                                        </div>
                                        <div class="w-fit rounded-xl bg-gray-200 px-2 p1-1 mt-2 inline-flex">
                                            <p class="w-fit text-caption text-sm text-gray-500 line-clamp-2">
                                                {{$item->quantity}}
                                            </p>
                                        </div>
                                        <div class="flex items-center justify-center mt-3">
                                            <button type="button" data-id="{{$item->id}}" class="detail_products ml-2 inline-flex items-center px-5 py-2.5 text-sm font-medium text-center text-white rounded-lg bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300">
                                                chi tiết
                                            </button>


                                            <button type="button" data-id="{{$item->id}}" class="add_cards ml-2 text-xl inline-flex items-center px-5 py-2.5 text-sm font-medium text-center text-white rounded-lg bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300">
                                                <i class="fa-solid fa-cart-shopping"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif

            <div class="">
                {{-- <div class="font-bold text-3xl pt-5 mx-auto text-center">
                    Sản Phẩm Theo Danh mục
                </div> --}}

                @foreach ($categorys as $category)
                    @if (count($category->Product) > 0)
                        <div class="product_list sm:w-4/5 w-11/12 mx-auto py-14">
                            <div class="font-bold text-3xl pt-5 pb-3 mx-auto text-center text-blue-600">
                                {{$category->name}}
                            </div>
                            <div class="flex items-center justify-between flex-wrap grid lg:grid-cols-5 md:grid-cols-3 grid-cols-2  gap-2">
                                @foreach ($category->Product as $item)
                                    <div class="p-1">
                                        <div class="wrap-product p-2 bg-white rounded-lg border-blue-600 hover:border">
                                            <div class="product-des">
                                                <img class="w-11/12 mx-auto" style="aspect-ratio: 4/5" src="{{ asset('/storage/'.$item->image) }}">
                                                <div class="name-product h_50px font-bold">
                                                    {{$item->name}}
                                                </div>
                                                <div class="product-price-old">
                                                    <span class="price-sale">
                                                        Giá:
                                                        @if ($item->price > 0)
                                                            {{number_format($item->price)}}VND
                                                        @else
                                                            <span class="text-red-500">
                                                                Liên hệ 09x.xxx.xxxx
                                                            </span>
                                                        @endif
                                                    </span>
                                                </div>
                                                <div class="w-fit rounded-xl bg-gray-200 px-2 p1-1 mt-2 inline-flex">
                                                    <p class="w-fit text-caption text-sm text-gray-500 line-clamp-2">
                                                        {{$item->quantity}}
                                                    </p>
                                                </div>
                                                <div class="flex items-center justify-center mt-3">
                                                    <button type="button" data-id="{{$item->id}}" class="detail_products ml-2 inline-flex items-center px-5 py-2.5 text-sm font-medium text-center text-white rounded-lg bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300">
                                                        chi tiết
                                                    </button>

                                                    <button type="button" data-id="{{$item->id}}" class="add_cards ml-2 text-xl inline-flex items-center px-5 py-2.5 text-sm font-medium text-center text-white rounded-lg bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300">
                                                        <i class="fa-solid fa-cart-shopping"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>
        </div>
    </section>
@endsection
