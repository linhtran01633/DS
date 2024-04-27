@extends('layout_client')

@section('content')
    <section class="selling_products">
        <div calss="w-full bg-red-50 relative" style="background: linear-gradient(rgb(246, 247, 251) 0%, rgba(89, 110, 147, 0.124) 100%);">

            @if(count($news) > 0)
                <div class="font-bold text-3xl pt-5 mx-auto text-center">Tin Tức</div>

                <div class="product_list w-4/5 mx-auto py-14">
                    <div class="flex items-center justify-between flex-wrap grid md:grid-cols-3 sm:grid-cols-2 grid-cols-1  gap-2">
                        @foreach ($news as $item)
                            <div class="p-1">
                                <div data-id="{{$item->id}}" class="detail_news wrap-product flex p-2 bg-white rounded-lg border-blue-600 hover:border">
                                    <div class="w-4/6">
                                        <img class="w-11/12 mx-auto" style="aspect-ratio: 5/5" src="{{ asset('/images/icon_video.png') }}">
                                    </div>
                                    <div class="w-2/6">
                                        <div class="font-bold">{{$item->title}}</div>
                                        <div class="title-news">{{$item->short_description}}</div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif
        </div>
    </section>
@endsection
