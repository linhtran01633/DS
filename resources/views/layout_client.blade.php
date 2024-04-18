<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale = 1.0, maximum-scale=1.0, user-scalable=no">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.css"  rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"  rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css" rel="stylesheet">
    <style>
        .name-product {
            overflow: hidden;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
        }

        .img_logo {
            top: -23px;
            left: -135px;
            height: 100px;
            width: 100px;
            position: absolute;
            border-radius: 50%;
        }

        .title-news {
            overflow: hidden;
            display: -webkit-box;
            -webkit-line-clamp: 5;
            -webkit-box-orient: vertical;
        }

        .bg_2167dd {
            --tw-bg-opacity: 1;
            background-color: rgb(33 103 221 / var(--tw-bg-opacity));
        }

        .z_1 {
            z-index: -1;
        }

        .h_36px {
            height: 36px;
        }

		@media (min-width: 768px) {
			.w_750px {
				width: 750px;
			}
		}

        .rounded_35px {
            border-radius: 35px;
        }

        .p_6px {
            padding: 6px;
        }

        .h_40px {
            height: 40px;
        }

        .h_50px {
            height: 50px;
        }

        .w_40px {
            width: 40px;
        }

        .p_10px {
            padding: 10px
        }

        .px_7px {
            padding-left:7px;
            padding-right:7px;
        }

        .py_1px {
            padding-top:1px;
            padding-bottom:1px;
        }
        .text_8px {
            font-size: 8px;
        }

        .detail_products {
            min-width: 84px;
        }


    </style>
</head>
<body>
    <header class="sticky top-0 z-50 bg_2167dd transition-[height] md:relative css-33afvg">
        <div class="inner relative css-0">
            <div class="relative md:static py-8">
                <picture class="absolute top-0 left-0 h-full w-full z_1">
                    <source media="(min-width: 769px)" type="image/webp" srcset="https://cdn.nhathuoclongchau.com.vn/unsafe/0x0/filters:quality(90)/https://cms-prod.s3-sgn09.fptcloud.com/Desk_5a13cc1228.png">
                    <source media="(max-width: 768px)" type="image/webp" srcset="https://cdn.nhathuoclongchau.com.vn/unsafe/0x0/filters:quality(90)/https://cms-prod.s3-sgn09.fptcloud.com/Res_be8c5ee754.png">
                    <img alt="bg-section-banner" decoding="async" data-nimg="fill" class="h-full w-full object-cover" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAQAAAC1HAwCAAAAC0lEQVR42mP8/w8AAwAB/31/3KwAAAAASUVORK5CYII=" style="position: absolute; height: 100%; width: 100%; inset: 0px; color: transparent;">
                </picture>
                <div class="container md:container h-[100%] md:relative md:h-[auto] css-1zrptk">
                    <div></div>
                </div>
                <div class="search-section col-span-full mt-1.5 grid content-center transition-[margin] md:col-start-2 md:col-end-3 md:row-start-1 md:row-end-2 md:mx-auto md:mt-0 md:h-auto w_750px">
                    <div class="cs-search-wrapper relative">
                        <div class="flex flex-wrap items-center mx-auto sm:w-full w-11/12">
                            <div class="w-4/6 relative inline-flex items-center bg-white rounded_35px p_6px pl-4 span-padding-mobile">
                                <input id="search_header" placeholder="Tìm tên thuốc, bệnh lý, thực phẩm chức năng..." autocomplete="off" class="w-full h_40px  border-0 focus:outline-none input-search" value="" style="">
                                <button class="shrink-0 rounded-full bg-layer-blue-1,5 text-text-focus w_40px h_40px p_10px ml-3">
                                    <svg width="100%" height="100%" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M10.9414 1.93125C5.98269 1.93125 1.94336 5.97057 1.94336 10.9293C1.94336 15.888 5.98269 19.9352 10.9414 19.9352C13.0594 19.9352 15.0074 19.193 16.5469 17.9606L20.2949 21.7066C20.4841 21.888 20.7367 21.988 20.9987 21.9853C21.2607 21.9826 21.5112 21.8775 21.6966 21.6923C21.882 21.5072 21.9875 21.2569 21.9906 20.9949C21.9936 20.7329 21.8939 20.4801 21.7129 20.2907L17.9648 16.5427C19.1983 15.0008 19.9414 13.0498 19.9414 10.9293C19.9414 5.97057 15.9001 1.93125 10.9414 1.93125ZM10.9414 3.93128C14.8192 3.93128 17.9395 7.05148 17.9395 10.9293C17.9395 14.8071 14.8192 17.9352 10.9414 17.9352C7.06357 17.9352 3.94336 14.8071 3.94336 10.9293C3.94336 7.05148 7.06357 3.93128 10.9414 3.93128Z" fill="currentColor"></path>
                                    </svg>
                                </button>
                                <a href="{{route('client.index')}}">
                                    <img src="/logo/logo_1.jpg" class="img_logo" alt="">
                                </a>
                            </div>
                            <div class="w-2/6 pl-2 flex flex-wrap justify-center">
                                <a href="{{route('login.index')}}">
                                    <button type="button" class="mx-2 text-xs inline-flex items-center px-2 py-2.5 text-sm font-medium text-center text-white rounded-lg sm:bg-transparent bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300">
                                        <i class="fa-solid fa-user"></i>
                                        <span class="sm:block hidden">đăng nhập</span>
                                    </button>
                                </a>

                                <a href="{{route('client.shoppingCard')}}">
                                    <button type="button" class="relative mx-2 text-xs inline-flex items-center px-2 py-2.5 text-sm font-medium text-center text-white rounded-lg sm:bg-transparent bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300">
                                        <i class="fa-solid fa-cart-shopping"></i>
                                        <span class="sm:block hidden"> giỏ hàng</span>
                                        <span class="count_cards px_7px py_1px bg-yellow-500 left-1 -top-2 absolute text_8px text-white rounded-full"></span>
                                    </button>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <section class="menu-client">
        <div class="w-full flex items-center justify-between bg-white">
            <nav class="border-gray-200 dark:bg-gray-900 w-10/12 mx-auto">
                <div class="flex flex-wrap items-center justify-between w-full mx-auto p-4">
                    <div class="flex items-center md:order-2 space-x-1 md:space-x-2 rtl:space-x-reverse">
                        <button data-collapse-toggle="mega-menu" type="button" class="inline-flex items-center p-2 w-10 h-10 justify-center text-sm text-gray-500 rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600" aria-controls="mega-menu" aria-expanded="false">
                            <span class="sr-only">Open main menu</span>
                            <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 17 14">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 1h15M1 7h15M1 13h15"/>
                            </svg>
                        </button>
                    </div>
                    <div id="mega-menu" class="items-center justify-between hidden w-full md:flex md:w-auto md:order-1">
                        <ul class="flex flex-col mt-4 font-medium md:flex-row md:mt-0 md:space-x-8 rtl:space-x-reverse">
                            <li>
                                <a href="{{route('client.index')}}" class="block py-2 px-3 text-gray-900 border-b border-gray-100 hover:bg-gray-50 md:hover:bg-transparent md:border-0 md:hover:text-blue-600 md:p-0 dark:text-white md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-blue-500 md:dark:hover:bg-transparent dark:border-gray-700">
                                    Trang Chủ
                                </a>
                            </li>
                            <li>
                                <button id="mega-menu-dropdown-button" data-dropdown-toggle="mega-menu-dropdown" class="flex items-center justify-between w-full py-2 px-3 font-medium text-gray-900 border-b border-gray-100 md:w-auto hover:bg-gray-50 md:hover:bg-transparent md:border-0 md:hover:text-blue-600 md:p-0 dark:text-white md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-blue-500 md:dark:hover:bg-transparent dark:border-gray-700">
                                    Danh mục Sản phẩm
                                    <svg class="w-2.5 h-2.5 ms-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4"/>
                                    </svg>
                                </button>
                                <div id="mega-menu-dropdown" class="absolute z-40 hidden w-auto text-sm bg-white border border-gray-100 rounded-lg shadow-md dark:border-gray-700 md:grid-cols-3 dark:bg-gray-700">
                                    <div class="p-4 pb-0 text-gray-900 md:pb-4 dark:text-white">
                                        <ul class="space-y-4" aria-labelledby="mega-menu-dropdown-button">

                                            @foreach ($categorys_menu as $item)
                                                <li>
                                                    <a href="{{route('client.index', ['category_id' => $item->id])}}" class="text-gray-500 dark:text-gray-400 hover:text-blue-600 dark:hover:text-blue-500">
                                                        {{$item->name}}
                                                    </a>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <a href="{{route('client.introduce')}}" class="block py-2 px-3 text-gray-900 border-b border-gray-100 hover:bg-gray-50 md:hover:bg-transparent md:border-0 md:hover:text-blue-600 md:p-0 dark:text-white md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-blue-500 md:dark:hover:bg-transparent dark:border-gray-700">
                                    Giới Thiệu
                                </a>
                            </li>
                            <li>
                                <a href="{{route('client.news')}}" class="block py-2 px-3 text-gray-900 border-b border-gray-100 hover:bg-gray-50 md:hover:bg-transparent md:border-0 md:hover:text-blue-600 md:p-0 dark:text-white md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-blue-500 md:dark:hover:bg-transparent dark:border-gray-700">
                                    Tin Tức
                                </a>
                            </li>
                            <li>
                                <a href="{{route('client.contact')}}" class="block py-2 px-3 text-gray-900 border-b border-gray-100 hover:bg-gray-50 md:hover:bg-transparent md:border-0 md:hover:text-blue-600 md:p-0 dark:text-white md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-blue-500 md:dark:hover:bg-transparent dark:border-gray-700">
                                    Liên hệ
                                </a>
                            </li>
                            <li>
                                <a href="#" class="block py-2 px-3 text-gray-900 border-b border-gray-100 hover:bg-gray-50 md:hover:bg-transparent md:border-0 md:hover:text-blue-600 md:p-0 dark:text-white md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-blue-500 md:dark:hover:bg-transparent dark:border-gray-700">
                                    Chuyên Gia
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
        </div>
    </section>

    @yield('carusel')
    @yield('content')

    <footer class="py-10" style="background: linear-gradient(rgb(246, 247, 251) 0%, rgb(236, 241, 248) 100%);">
        <div class="w-4/5 mx-auto flex items-start justify-between flex-wrap grid md:grid-cols-3 grid-cols-1 gap-2">
            <div>
                <div class="text-2xl font-bold pb-3">LIÊN HỆ</div>
                <div class="">Diện thoại : {{$hot_line}}</div>
                <div class="">Email: vietchaupharmacy@gmail.com</div>
                <div class="">
                    Dịa chỉ:  Số 525A Đường Lũy Bán Bích, Phường Phú Thạnh, Quận Tân Phú, Thành phố Hồ Chí Minh
                </div>
                <div class="">Giờ làm việc: 6h30-21h Thứ 2-CN (Không nghỉ lễ)</div>
            </div>

            <div>
                <div class="text-2xl font-bold pb-3">NHÀ THUỐC VIỆT CHÂU</div>
                <div>
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d346.43344388497064!2d106.6339822570948!3d10.777035900899389!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31752ea6a5506309%3A0xd68188bddea51531!2zTmjDoCBUaHXhu5FjIFZp4buHdCBDaMOidQ!5e0!3m2!1svi!2s!4v1711700921703!5m2!1svi!2s" width="100%" height="300" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>
            </div>

            <div>
                <div class="text-2xl font-bold pb-3">KẾT NỐI VỚI CHÚNG TÔI</div>
                <div>
                    <a href="#" class="text-blue-600 hover:text-blue-800">
                        <i class="fab fa-facebook fa-3x"></i>
                    </a>

                    <a href="#" class="text-blue-600 hover:text-blue-800">
                        <i class="fab fa-zalo fa-3x"></i>
                    </a>
                    <a href="#" class="text-blue-600 hover:text-blue-800">
                        <i class="fab fa-zalo fa-3x"></i>
                    </a>
                    <a href="#" class="text-blue-600 hover:text-blue-800">
                        <i class="fab fa-zalo fa-3x"></i>
                    </a>
                </div>
            </div>
        </div>
    </footer>

    @if (Session::has('message'))
        <input type="hidden" id="message_input" value="{{ Session::get('message') }}">

        <script>
            let text = $('#message_input').val();
            let divThongBao = document.createElement('div');
            divThongBao.textContent = text;
            divThongBao.style.padding = '50px';
            divThongBao.style.position = 'fixed';
            divThongBao.style.backgroundColor = 'royalblue';
            divThongBao.style.top = '30vh';
            divThongBao.style.left = 'calc(50% - 200px)';
            divThongBao.style.zIndex = '9999';
            divThongBao.style.width = '400px';
            divThongBao.style.textAlign = 'center';
            divThongBao.style.borderRadius = '1rem';
            divThongBao.style.color = 'white';

            document.body.appendChild(divThongBao);

            setTimeout(function() {
                // Ẩn hoặc xóa thông báo sau 3 giây
                document.body.removeChild(divThongBao)
            }, 1000);
        </script>

        @php
            Session::forget('message');
        @endphp
    @endif

    <script>
        var getShoppingCard = '{!! route('client.shopping_card') !!}';
    </script>
    <script src="{{ URL::asset('js/main.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/js/all.min.js" integrity="sha256-KzZiKy0DWYsnwMF+X1DvQngQ2/FxF7MF3Ff72XcpuPs=" crossorigin="anonymous"></script>
</body>
</html>
