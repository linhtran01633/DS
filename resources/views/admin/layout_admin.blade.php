<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tailwind Admin Template</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="author" content="David Grzyb">
    <meta name="description" content="">

    <!-- Tailwind -->
  @vite(['resources/css/app.css', 'resources/js/app.js'])
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
            <a href="{{route('admin.index')}}" class="text-white text-3xl font-semibold uppercase hover:text-gray-300">Admin</a>
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

            <a href="{{route('client.index')}}" class="@if(isset($page_current) && $page_current == 'user') active-nav-link @endif flex items-center text-white py-4 pl-4 nav-item">
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
                <div x-data="{ isOpen: false }" class="relative w-1/2 flex justify-end">
                    <button @click="isOpen = !isOpen" class="realtive z-10 w-12 h-12 rounded-full overflow-hidden border-4 border-gray-400 hover:border-gray-300 focus:border-gray-300 focus:outline-none">
                        <img src="{{ asset('/images/img_avatar.png') }}">

                    </button>
                    <button x-show="isOpen" @click="isOpen = false" class="h-full w-full fixed inset-0 cursor-default"></button>
                    <div x-show="isOpen" class="absolute w-32 bg-white rounded-lg shadow-lg py-2 mt-16">
                        <form action="{{ route('logout_admin') }}" method="post">
                            @csrf
                            <button type="submit" class="w-11/12 mx-auto rounded-lg block px-4 py-2 account-link hover:text-white">Đăng xuất</button>
                        </form>
                    </div>
                </div>
            </header>

            <!-- Mobile Header & Nav -->
            <header x-data="{ isOpen: false }" class="w-full bg-sidebar py-5 px-6 sm:hidden">
                <div class="flex items-center justify-between">
                    <a href="{{route('admin.index')}}" class="text-white text-3xl font-semibold uppercase hover:text-gray-300">Admin</a>
                    <button @click="isOpen = !isOpen" class="text-white text-3xl focus:outline-none">
                        <i x-show="!isOpen" class="fas fa-bars"></i>
                        <i x-show="isOpen" class="fas fa-times"></i>
                    </button>
                </div>

                <!-- Dropdown Nav -->
                <nav :class="isOpen ? 'flex': 'hidden'" class="flex flex-col pt-4">
                    <a href="{{route('admin.index')}}" class="flex items-center text-white opacity-75 hover:opacity-100 py-2 pl-4 nav-item">
                        <i class="fas fa-tachometer-alt mr-3"></i>
                        Dashboard
                    </a>
                    <a href="tables.html" class="flex items-center  text-white py-2 pl-4 nav-item">
                        <i class="fas fa-table mr-3"></i>
                        Tables
                    </a>

                    <a href="{{route('admin.category.index')}}" class="flex items-center text-white py-2 pl-4 nav-item">
                        <i class="fas fa-table mr-3"></i>
                        Danh Mục
                    </a>
                    <a href="#" class="flex items-center text-white opacity-75 hover:opacity-100 py-2 pl-4 nav-item">
                        <i class="fas fa-sign-out-alt mr-3"></i>
                        Sign Out
                    </a>
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
        var deleteNews = '{!! route('admin.news.delete') !!}';
        var getProduct = '{!! route('admin.product.detail') !!}';
        var updateInvoice = '{!! route('admin.invoice.edit') !!}';
        var deleteProduct = '{!! route('admin.product.delete') !!}';
        var deleteCategory = '{!! route('admin.category.delete') !!}';
        var getDetailInvoice = '{!! route('admin.invoice.detail') !!}';
    </script>
</body>
</html>
