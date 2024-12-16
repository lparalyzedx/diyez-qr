@extends('front.layouts.master')
@section('content')
    <div class="likeRow sarea">
        <div class="swiper-container xx_slider">
            <div class="swiper-wrapper">
                <div class="swiper-slide" id="detailTop">
                    <div>
                        <div>
                            <img src="{{ asset('storage/' . $account->banner_logo) }}" alt="{{ $account->name }}">
                        </div>
                        <img src="{{ asset('storage/' . $account->banner_image) }}" />
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="yellow_lane">
        <div class="odin_list">
            @if($account->status)
                    @forelse ($products as $product)
                        @if ($product->is_variant)
                            <div class="multi_item">
                                <a href="{{ asset('storage/' . (!is_null($product->image_url) ? $product->image_url : $account->placeholder_image)) }}" title="{{$product->name}}" data-caption="<h4>{{$product->name}}</h4>" data-fancybox="gallery">
                                    <div>
                                        <img src="{{ asset('storage/' . (!is_null($product->image_url) ? $product->image_url : $account->placeholder_image)) }}"
                                            alt="{{ $product->name }}">
                                    </div>
                                    <div style="color:{{$account->body_color}}">
                                        <span>{{ $product->name }}</span>
                                        <ul>
                                            @foreach ($product->variants as $variant)
                                                <li>
                                                    <div style="color:{{$account->body_color}}">{{ $variant->name }}</div>
                                                    <div></div>
                                                    <div style="color:{{$account->body_color}}"><strong>{{ $variant->price }}</strong>{{ $product->currency }}
                                                    </div>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </a>
                            </div>
                        @else
                            <div class="alone_item">
                                <a href="{{ asset('storage/' . (!is_null($product->image_url) ? $product->image_url : $account->placeholder_image)) }}" title="{{$product->name}}" data-caption="<h4>{{$product->name}} - {{$product->price}}{{ $product->currency }}</h4>" data-fancybox="gallery">
                                    <div>
                                        <img src="{{ asset('storage/' . (!is_null($product->image_url) ? $product->image_url : $account->placeholder_image)) }}"
                                            alt="{{ $product->name }}">
                                    </div>
                                    <div style="color:{{$account->body_color}}">
                                        <span>{{ $product->name }}</span>
                                        <p>{!! $product->contents !!}</p>
                                    </div>
                                    <div>
                                        <strong>{{ $product->price ?? '-' }}</strong>{{ $product->currency }}
                                    </div>
                                </a>
                            </div>
                        @endif
                        @empty
                        <h1 style="color:#fff; text-align:center; width:100%;">Ürün Bulunamadı!</h1>
                    @endforelse
                @else
                <h4 style="text-align:center; font-weight:200; color:{{$account->text_color}}">Bu QR Menü şu anda hizmet verememektedir.
         Lütfen daha sonra tekrar deneyiniz veya altyapı sağlayıcınız ile İletişime geçiniz.</h4>
         @endif
        </div>
    </div>
@endsection
