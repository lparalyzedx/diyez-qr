@extends('front.layouts.master')
@section('title','Menü')
@section('content')
<div class="likeRow sarea">
    <div class="swiper-container xx_slider">
        <div class="swiper-wrapper">
            <div class="swiper-slide">
                <div>
                    <div>
                        <img src="{{asset('storage/'.$account->banner_logo)}}" alt="">
                    </div>
                    <img src="{{asset('storage/'.$account->banner_image)}}" />
                </div>
            </div>
        </div>
    </div>
</div>
<div class="yellow_lane">
    <div class="odin_categories">
        @if($account->status)
        @foreach ($categories as $categorie)
        @if(!$categorie->categorie_id)
            <div style="width: calc({{$categorie->width}}% - 10px);">
                <a href="{{route('category',['accountSlug' => $account->slug, 'slug' => $categorie->slug])}}">
                    <span>{{$categorie->name}}</span>
                    <img src="{{$categorie->origin_image}}" alt="{{$categorie->name}}">
                </a>
            </div>
            @endif
        @endforeach
        @else
         <h4 style="text-align:center; font-weight:200; color:{{$account->text_color}}">Bu QR Menü şu anda hizmet verememektedir.
         Lütfen daha sonra tekrar deneyiniz veya altyapı sağlayıcınız ile İletişime geçiniz.</h4>
        @endif
    </div>
</div>
</div>
@endsection