@extends('layout_client')

@section('content')
    <section class="selling_products">
        <div calss="w-full bg-red-50 relative "  style="background: linear-gradient(rgb(246, 247, 251) 0%, rgba(89, 110, 147, 0.124) 100%);">
            <div class="product_list w-4/5 mx-auto py-14">
                <div class="bg-white rounded-lg p-10 mt-5">
                    <div class="font-bold text-3xl my-2">
                        {{$news->title}}
                    </div>

                    <div class="text-xl my-2">
                        {!! nl2br($news->short_description) !!}
                    </div>

                    @php
                        $embedUrl = '';
                        $url = $news->image;
                        $parsedUrl = parse_url($url);
                        parse_str($parsedUrl['query'], $query);

                        if (isset($query['v'])) {
                            $videoId = $query['v'];
                            $embedUrl = "https://www.youtube.com/embed/$videoId";
                        }
                    @endphp

                    <iframe class="w-full my-2" style="aspect-ratio: 8/4;" src="{{$embedUrl}}" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>

                    <div class="font-bold text-2xl">
                        Mô tả Chi tiết
                    </div>
                    <p class="pl-2">
                        {!! nl2br($news->detailed_description) !!}
                    </p>
                </div>
            </div>
        </div>
    </section>
@endsection
