@extends('back.layouts.master')
@section('title','Bildirimler')
@section('content')
<div class="d-flex flex-column flex-column-fluid">
    <div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6 col-12">
        <div id="kt_app_toolbar_container" class="app-container container-fluid d-flex flex-stack">
            <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
                <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
                    <li class="breadcrumb-item text-muted">
                        <a href="{{route('dashboard')}}" class="text-muted text-hover-primary">Anasayfa</a>
                    </li>
                    <li class="breadcrumb-item">
                        <span class="bullet bg-gray-400 w-5px h-2px"></span>
                    </li>
                    <li class="breadcrumb-item text-muted">Bildirimler</li>
                </ul>
            </div>
        </div>
    </div>
    <div id="kt_app_content" class="app-content flex-column-fluid">
        <div id="kt_app_content_container" class="app-container container-fluid">
             @forelse ($__notifications as $notification)
                         <div class="d-flex flex-stack p-5 shadow mt-2">
                 <div class="d-flex align-items-center">
                    <div class="symbol symbol-50px me-3">
                        <img class="object-fit-cover" src="{{$notification?->product?->image}}" alt="">
                    </div>
                     <div class="mb-0 me-2">
                         <a class="fs-6 text-gray-800 text-hover-primary fw-bold">{{$notification?->product?->market?->name }}</a>
                         <div class="text-gray-400 fs-7">{{$notification?->product?->name}} - <strong>{{$notification?->product?->product_id}}</strong></div>
                     </div>
                 </div>
                 <span class="badge badge-light fs-8">{{$notification->created_at->diffForHumans()}}</span>
             </div>
             @empty
             <div class="d-flex flex-column px-9">
                 <div class="pt-10 pb-0">
                     <h3 class="text-dark text-center fw-bold">Bildiriminiz yok</h3>
                     <div class="text-center text-gray-600 fw-semibold pt-1">Anahatlar sizi dürüst tutar. Sizi sürüş konusunda inanılmaz derecede kötü bir şekilde engelliyorlar</div>
                 </div>
                 <div class="text-center px-4">
                     <img class="mw-100 mh-200px" alt="image" src="{{asset('assets/media/illustrations/sketchy-1/1.png')}}" />
                 </div>
             </div>
             @endforelse
             <div class="d-flex align-items-center justify-content-end mt-3">
             {{$__notifications->links('pagination::bootstrap-4')}}
         </div>
        </div>
    </div>
</div>
@endsection
