@extends('front.layouts.master')
@section('title', $categorie->name)
@section('content')
    <div class="likeRow sarea">
        <div class="swiper-container xx_slider">
            <div class="swiper-wrapper">
                <div class="swiper-slide" id="detailTop">
                    <div>
                        <div>
                            <img src="{{ asset('storage/' . $account->banner_logo) }}" alt="{{ $account->name }}">
                            <h3>{{ $categorie->name }}</h3>
                            <a href="{{ route('menu', $account->slug) }}">Menüye Dön</a>
                        </div>
                        <img src="{{ $categorie->origin_image }}" />
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="yellow_lane">
        <div class="odin_list">
            
            @if ($categorie->childs->isNotEmpty())
                @foreach ($categorie->childs as $child)
                @if($child->products->isNotEmpty())
                <h3 style="color: #ffff">{{ $child->name }}</h3>
                    @foreach ($child->products as $product)
                        @if ($product->is_variant)
                            <div class="multi_item">
                                <a href="{{ $product->origin_image }}" data-caption="<h4>{{$product->name}}</h4>" data-fancybox="gallery">
                                    <div>
                                        <img src="{{ $product->origin_image }}"
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
                                <a href="{{ $product->origin_image }}" data-caption="<h4>{{$product->name}} - {{$product->price}}{{ $product->currency }}</h4>" data-fancybox="gallery">
                                    <div>
                                        <img src="{{ $product->origin_image  }}"
                                            alt="{{ $product->name }}">
                                    </div>
                                    <div style="color:{{$account->body_color}}">
                                        <span>{{ $product->name }}</span>
                                        <p>{!! $product->contents !!}</p>
                                    </div>
                                    <div style="color:{{$account->body_color}}">
                                        <strong>{{ $product->price ?? '-' }}</strong>{{ $product->currency }}
                                    </div>
                                </a>
                            </div>
                        @endif
                    @endforeach
                    @endif
                @endforeach
            @endif
            @foreach ($categorie->products as $product)
            @if ($product->is_variant)
                <div class="multi_item">
                    <a href="{{ $product->origin_image }}" data-caption="<h4>{{$product->name}}</h4>" data-fancybox="gallery">
                        <div>
                            <img src="{{ $product->origin_image }}"
                                alt="{{ $product->name }}">
                        </div>
                        <div style="color:{{$account->body_color}}">
                            <span>{{ $product->name }}</span>
                            <ul>
                                @foreach ($product->variants as $variant)
                                    <li>
                                        <div style="color:{{$account->body_color}}">{{ $variant->name }}</div>
                                        <div></div>
                                        <div style="color:{{$account->body_color}}"><strong>{{ $variant->price }}</strong>{{ $product->currency }}</div>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </a>
                </div>
            @else
                <div class="alone_item">
                    <a href="{{ $product->origin_image  }}" data-caption="<h4>{{$product->name}} - {{$product->price}}{{ $product->currency }}</h4>" data-fancybox="gallery">
                        <div>
                            <img src="{{ $product->origin_image }}"
                                alt="{{ $product->name }}">
                        </div>
                        <div style="color:{{$account->body_color}}">
                            <span>{{ $product->name }}</span>
                            <p>{!! $product->contents !!}</p>
                        </div>
                        <div style="color:{{$account->body_color}}">
                            <strong>{{ $product->price ?? '-' }}</strong>{{ $product->currency }}
                        </div>
                    </a>
                </div>
            @endif
        @endforeach
        </div>
    </div>
@endsection
