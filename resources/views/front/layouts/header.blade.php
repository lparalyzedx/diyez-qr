<!DOCTYPE html>
<html lang="tr" class="v2_html">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0">
		<title>{{$account->name}} | @yield('title','Menü')</title>
		<link rel="shortcut icon" href="{{ asset('front/img/diyez.svg') }}" />
		<link rel="stylesheet" type="text/css" href="{{asset('front/css/bootstrap.min.css')}}">
		<link rel="stylesheet" type="text/css" href="{{asset('front/css/style.css')}}"/>
		<link rel="stylesheet" type="text/css" href="{{asset('front/css/font-awesome.min.css')}}"/>
		<link rel="stylesheet" type="text/css" href="{{asset('front/css/swiper.css')}}"/>
		<link rel="stylesheet" type="text/css" href="{{asset('front/css/fancybox.css')}}"/>
		<link rel="stylesheet" type="text/css" href="{{asset('front/css/swiper.css')}}"/>
	</head>
	<style>
       .yellow_lane::before {
        background-color: {{ $account->header_color }};
        }
   </style>
	<body class="v2_body" style="background-color:{{$account->body_color}}">
		<div id="preloader" class="v2_themeBackground">
			<div class="loader1">
				<img src="{{asset('storage/'.$account->logo)}}"/>
			</div>
		</div>
		<div class="v2_themeColor v2_themeBackground v2_category_menu" style="background-color:{{$account->header_color}}">
			<ul style="color:{{$account->text_color}}">
				@foreach ($categories as $categorie)
					@if($categorie->childs->isNotEmpty() && !$categorie->categorie_id)
					    <li>
						    <a href="javascript:void(0)" class="v2_drop_action">{{$categorie->name}}</a>
							@include('front.partials.category-child', ['categories' => $categorie->childs])
					    </li>
					@elseif(!$categorie->categorie_id)
					   <li>
						   <a href="{{route('category',['accountSlug' => $account->slug, 'slug' => $categorie->slug])}}">{{$categorie->name}}</a>
					   </li> 
					@endif
				@endforeach
			</ul>
			<div class="v2_menu_footer_inner v2_themeColor" style="color:{{$account->text_color}}">
				<ul>
					<li>
						<a href="{{$account->instagram}}"><i class="fa fa-instagram"></i></a>
					</li>
					<li>
						<a href="{{$account->twitter}}"><i class="icon-x"></i></a>
					</li>
				</ul>
				<span class="v2_themeColor" style="color:{{$account->text_color}}">©{{now()->format('Y')}} {{$account->name}}.</span>
			</div>
		</div>
		<div class="v2_forFooter">
			<div class="v2_header" style="background-color:{{$account->header_color}}">
				<form method="get" action="{{route('menu',$account->slug)}}" class="v2_src_outer v2_themeColor {{request()->has('search') ? 'v2_src_outer_act' : ''}}">
					    <input type="text" name="search" placeholder="{{__('all.search')}}" value="{{request()->get('search')}}" style="color:{{$account->text_color}}" required/>
					    <button type="submit" class="v2_themeColor v2_src_action" style="color:{{$account->text_color}}"><i class="icon-loupe"></i></button>
				</form>
				<button type="button" class="v2_themeColor v2_src_btn {{request()->has('search') ? 'v2_src_btn_act' : ''}}" style="color:{{$account->text_color}}"><i class="icon-loupe"></i><i class="icon-close-1"></i></button>
				<a href="{{ route('index',$account->slug) }}" class="v2_logo {{request()->has('search') ? 'v2_hidden_class' : ''}}">
					<img src="{{asset('storage/'.$account->logo)}}" style="width:{{$account->logo_width}}px;" />
				</a>	
				<button type="button" class="v2_themeColor v2_menu_btn {{request()->has('search') ? 'v2_hidden_class' : ''}}" style="color:{{$account->text_color}}"><i class="icon-rm"></i><i class="icon-close-1"></i></button>
			</div>
