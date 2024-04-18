<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Việt Châu</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="author" content="David Grzyb">
    <meta name="description" content="">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css" rel="stylesheet">
    <!-- Tailwind -->
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap');
        .font-family-karla { font-family: karla; }
        .bg-sidebar { background: #3d68ff; }
        .cta-btn { color: #3d68ff; }
        .upgrade-btn { background: #1947ee; }
        .upgrade-btn:hover { background: #0038fd; }
        .active-nav-link { background: #1947ee; }
        .nav-item:hover { background: #1947ee; }
        .account-link:hover { background: #3d68ff; }
    </style>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>
<body class="bg-gray-100 font-family-karla flex">

    <aside class="fixed bg-sidebar h-screen w-64 hidden sm:block shadow-xl">
        <div class="p-6">
            <a href="{{route('admin.index')}}" class="text-white text-3xl font-semibold uppercase hover:text-gray-300">
                @if(Auth::check())
                    {{Auth::user()->name}}
                @endif
            </a>
        </div>
        <nav class="text-white text-base font-semibold pt-3">
            <a href="{{route('admin.index')}}" class="@if(isset($page_current) && $page_current == 'home') active-nav-link @endif flex items-center text-white opacity-75 hover:opacity-100 py-4 pl-6 nav-item">
                <i class="fas fa-tachometer-alt mr-3"></i>
                Trang chủ
            </a>
            <a href="{{route('admin.category.index')}}" class="@if(isset($page_current) && $page_current == 'category') active-nav-link @endif flex items-center text-white py-4 pl-4 nav-item">
                <i class="fas fa-table mr-3"></i>
                Quản Lý Danh Mục
            </a>

            <a href="{{route('admin.product.index')}}" class="@if(isset($page_current) && $page_current == 'product') active-nav-link @endif flex items-center text-white py-4 pl-4 nav-item">
                <i class="fas fa-table mr-3"></i>
                Quản Lý Sản Phẩm
            </a>

            <a href="{{route('admin.news.index')}}" class="@if(isset($page_current) && $page_current == 'news') active-nav-link @endif flex items-center text-white py-4 pl-4 nav-item">
                <i class="fas fa-table mr-3"></i>
                Quản Lý Tin Tức
            </a>

            <a href="{{route('admin.invoice.index')}}" class="@if(isset($page_current) && $page_current == 'invoice') active-nav-link @endif flex items-center text-white py-4 pl-4 nav-item">
                <i class="fas fa-table mr-3"></i>
                Quản Lý Hoá Đơn
            </a>

            <a href="{{route('admin.user.index')}}" class="@if(isset($page_current) && $page_current == 'user') active-nav-link @endif flex items-center text-white py-4 pl-4 nav-item">
                <i class="fas fa-table mr-3"></i>
                Quản Lý Users
            </a>

            <a href="{{route('client.index')}}" class="flex items-center text-white py-4 pl-4 nav-item">
                <i class="fas fa-table mr-3"></i>
                Quay Về Trang Người Dùng
            </a>
        </nav>
    </aside>
    {{-- overflow-y-hidden --}}
    <div class="sm:pl-64 w-full">
        <div class="relative w-full flex flex-col h-screen">
            <!-- Desktop Header -->
            <header class="w-full items-center bg-white py-2 px-6 hidden sm:flex">
                <div class="w-1/2"></div>
                <div class="relative w-1/2 flex justify-end">
                    <button class="show_button_logout realtive z-10 w-12 h-12 rounded-full overflow-hidden border-4 border-gray-400 hover:border-gray-300 focus:border-gray-300 focus:outline-none">
                        <img src="{{ asset('/images/img_avatar.png') }}">
                    </button>
                    <button class="div_show_logout h-full hidden w-full fixed inset-0 cursor-default"></button>
                    <div class="div_show_logout hidden absolute w-32 bg-white rounded-lg shadow-lg py-2 mt-16">
                        <form action="{{ route('logout_admin') }}" method="post">
                            @csrf
                            <button type="submit" class="w-11/12 mx-auto rounded-lg block px-4 py-2 account-link hover:text-white">Đăng xuất</button>
                        </form>
                    </div>
                </div>
            </header>

            <!-- Mobile Header & Nav -->
            <header class="w-full bg-sidebar py-5 px-6 sm:hidden">
                <div class="flex items-center justify-between">
                    <a href="{{route('admin.index')}}" class="text-white text-3xl font-semibold uppercase hover:text-gray-300">
                        @if(Auth::check())
                            {{Auth::user()->name}}
                        @endif
                    </a>
                    <button class="text-white text-3xl focus:outline-none show_button_menu">
                        <i class="div_show_menu fas fa-bars"></i>
                        <i class="div_off_menu hidden fas fa-times"></i>
                    </button>
                </div>

                <!-- Dropdown Nav -->
                <nav class="show_menu_admin hidden flex flex-col pt-4">
                    <a href="{{route('admin.index')}}" class="@if(isset($page_current) && $page_current == 'home') active-nav-link @endif flex items-center text-white opacity-75 hover:opacity-100 py-4 pl-6 nav-item">
                        <i class="fas fa-tachometer-alt mr-3"></i>
                        Trang chủ
                    </a>
                    <a href="{{route('admin.category.index')}}" class="@if(isset($page_current) && $page_current == 'category') active-nav-link @endif flex items-center text-white py-4 pl-4 nav-item">
                        <i class="fas fa-table mr-3"></i>
                        Quản Lý Danh Mục
                    </a>

                    <a href="{{route('admin.product.index')}}" class="@if(isset($page_current) && $page_current == 'product') active-nav-link @endif flex items-center text-white py-4 pl-4 nav-item">
                        <i class="fas fa-table mr-3"></i>
                        Quản Lý Sản Phẩm
                    </a>

                    <a href="{{route('admin.news.index')}}" class="@if(isset($page_current) && $page_current == 'news') active-nav-link @endif flex items-center text-white py-4 pl-4 nav-item">
                        <i class="fas fa-table mr-3"></i>
                        Quản Lý Tin Tức
                    </a>

                    <a href="{{route('admin.invoice.index')}}" class="@if(isset($page_current) && $page_current == 'invoice') active-nav-link @endif flex items-center text-white py-4 pl-4 nav-item">
                        <i class="fas fa-table mr-3"></i>
                        Quản Lý Hoá Đơn
                    </a>

                    <a href="{{route('admin.user.index')}}" class="@if(isset($page_current) && $page_current == 'user') active-nav-link @endif flex items-center text-white py-4 pl-4 nav-item">
                        <i class="fas fa-table mr-3"></i>
                        Quản Lý Users
                    </a>

                    <a href="{{route('client.index')}}" class="flex items-center text-white py-4 pl-4 nav-item">
                        <i class="fas fa-table mr-3"></i>
                        Quay Về Trang Người Dùng
                    </a>

                    <form action="{{ route('logout_admin') }}" method="post">
                        @csrf
                        <button type="submit" class="w-11/12 mx-auto rounded-lg block px-4 py-2 account-link hover:text-white">Đăng xuất</button>
                    </form>
                </nav>
            </header>

            <div>
                @yield('content')
            </div>

            <div class="w-full h-screen overflow-x-hidden border-t flex flex-col">
                <footer class="w-full bg-white text-right p-4">
                    Built by <a target="_blank" href="https://davidgrzyb.com" class="underline">VIỆT CHÂU PHARMACY</a>.
                </footer>
            </div>
        </div>
    </div>

    <!-- Font Awesome -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/js/all.min.js" integrity="sha256-KzZiKy0DWYsnwMF+X1DvQngQ2/FxF7MF3Ff72XcpuPs=" crossorigin="anonymous"></script>


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
        var getNews = '{!! route('admin.news.detail') !!}';
        var deleteUser = '{!! route('admin.user.delete') !!}';
        var deleteNews = '{!! route('admin.news.delete') !!}';
        var getProduct = '{!! route('admin.product.detail') !!}';
        var updateInvoice = '{!! route('admin.invoice.edit') !!}';
        var deleteProduct = '{!! route('admin.product.delete') !!}';
        var deleteCategory = '{!! route('admin.category.delete') !!}';
        var getDetailInvoice = '{!! route('admin.invoice.detail') !!}';

        $('.show_button_logout').on('click', function(e){
            if ($('.div_show_logout').hasClass("hidden")) {
                $('.div_show_logout').removeClass('hidden');
            } else {
                $('.div_show_logout').addClass('hidden');
            }
        })

        $('.show_button_menu').on('click', function(e){
            console.log('123');
            if ($('.div_off_menu').hasClass("hidden")) {
                $('.div_show_menu').addClass('hidden');
                $('.div_off_menu').removeClass('hidden');
                $('.show_menu_admin').removeClass('hidden');
            } else {
                $('.div_show_menu').removeClass('hidden');
                $('.div_off_menu').addClass('hidden');
                $('.show_menu_admin').addClass('hidden');
            }
        })
    </script>
    <script src="{{ URL::asset('js/main.js') }}"></script>
</body>
</html>
