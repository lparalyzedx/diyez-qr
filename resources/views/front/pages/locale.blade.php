@extends('front.layouts.master')
@section('title','Menü')
@section('content')
<div class="likeRow sarea" style="height:100%">
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
<div class="modal-overlay" id="languageModal">
    <div class="modal">
        <div>
            <p>Lütfen dilinizi seçin <br><span style="font-size:14px; opacity:0.6;">Please select your language</span></p>
        <ul>
            @foreach ($locales as $locale)
            <li>
                <a href="{{route('locale',['locale' => $locale->language_code,'accountSlug' => $account->slug])}}" id="select-{{$locale->language_code}}">
                    <img src="{{ asset('storage/'.$locale->flag) }}" alt="{{$locale->name}}">
                </a>
            </li>
            @endforeach
        </ul>
        </div>
    </div>
</div>
@endsection