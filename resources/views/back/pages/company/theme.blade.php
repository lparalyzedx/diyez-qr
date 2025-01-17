@extends('back.layouts.master')
@section('title', 'Tema Ayarları')
@section('content')
    <div class="d-flex flex-column flex-column-fluid">
        <div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6 col-12">
            <div id="kt_app_toolbar_container" class="app-container container-fluid d-flex flex-stack">
                <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
                    <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
                        <li class="breadcrumb-item text-muted">
                            <a href="{{ route('dashboard') }}" class="text-muted text-hover-primary">Anasayfa</a>
                        </li>
                        <li class="breadcrumb-item">
                            <span class="bullet bg-gray-400 w-5px h-2px"></span>
                        </li>
                        <li class="breadcrumb-item text-muted">Tema Ayarları</li>
                    </ul>
                </div>
            </div>
        </div>
        <div id="kt_app_content" class="app-content flex-column-fluid">
            <div id="kt_app_content_container" class="app-container container-fluid">
                @error('warning')
                    <div class="alert alert-danger d-flex align-items-center p-5 mb-5">
                        <span class="svg-icon svg-icon-2hx svg-icon-danger me-4">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg">15
                                <path opacity="0.3"
                                    d="M20.5543 4.37824L12.1798 2.02473C12.0626 1.99176 11.9376 1.99176 11.8203 2.02473L3.44572 4.37824C3.18118 4.45258 3 4.6807 3 4.93945V13.569C3 14.6914 3.48509 15.8404 4.4417 16.984C5.17231 17.8575 6.18314 18.7345 7.446 19.5909C9.56752 21.0295 11.6566 21.912 11.7445 21.9488C11.8258 21.9829 11.9129 22 12.0001 22C12.0872 22 12.1744 21.983 12.2557 21.9488C12.3435 21.912 14.4326 21.0295 16.5541 19.5909C17.8169 18.7345 18.8277 17.8575 19.5584 16.984C20.515 15.8404 21 14.6914 21 13.569V4.93945C21 4.6807 20.8189 4.45258 20.5543 4.37824Z"
                                    fill="currentColor"></path>
                                <path
                                    d="M10.5606 11.3042L9.57283 10.3018C9.28174 10.0065 8.80522 10.0065 8.51412 10.3018C8.22897 10.5912 8.22897 11.0559 8.51412 11.3452L10.4182 13.2773C10.8099 13.6747 11.451 13.6747 11.8427 13.2773L15.4859 9.58051C15.771 9.29117 15.771 8.82648 15.4859 8.53714C15.1948 8.24176 14.7183 8.24176 14.4272 8.53714L11.7002 11.3042C11.3869 11.6221 10.874 11.6221 10.5606 11.3042Z"
                                    fill="currentColor"></path>
                            </svg>
                        </span>
                        <div class="d-flex flex-column">
                            <h4 class="mb-1 text-danger">Hata Oluştu..!</h4>
                            <span>{{ $message }}</span>
                        </div>
                    </div>
                @enderror
                <div class="card card card-flush">
                    <div class="card-header align-items-center d-flex align-items-center">
                        <div class="d-flex flex-column">
                            <h2>Tema Ayarları</h2>
                            <p class="mb-0">Tema ayarlarınızı bu bölümden düzenleyebilirsiniz.</p>
                        </div>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('theme_settings.update') }}" enctype="multipart/form-data" class="p-4">
                            @csrf
                            @method('PUT')
                        
                            <div class="mb-4">
                                <label for="header_color" class="form-label fw-bold">Header Rengi</label>
                                <div class="input-group">
                                    <span class="input-group-text">
                                        <i class="bi bi-palette-fill"></i>
                                    </span>
                                    <input 
                                        class="form-control form-control-color" 
                                        type="color" 
                                        id="header_color" 
                                        name="header_color"
                                        value="{{ old('header_color') ?? auth()->user()->account->header_color }}" 
                                        title="Header Rengi Seçin">
                                </div>
                            </div>
                        
                            <div class="mb-4">
                                <label for="body_color" class="form-label fw-bold">Body Rengi</label>
                                <div class="input-group">
                                    <span class="input-group-text">
                                        <i class="bi bi-brush"></i>
                                    </span>
                                    <input 
                                        class="form-control form-control-color" 
                                        type="color" 
                                        id="body_color" 
                                        name="body_color"
                                        value="{{ old('body_color') ?? auth()->user()->account->body_color }}" 
                                        title="Body Rengi Seçin">
                                </div>
                            </div>
                        
                            <div class="mb-4">
                                <label for="text_color" class="form-label fw-bold">Yazı Rengi</label>
                                <div class="input-group">
                                    <span class="input-group-text">
                                        <i class="bi bi-fonts"></i>
                                    </span>
                                    <input 
                                        class="form-control form-control-color" 
                                        type="color" 
                                        id="text_color" 
                                        name="text_color"
                                        value="{{ old('text_color') ?? auth()->user()->account->text_color }}" 
                                        title="Yazı Rengi Seçin">
                                </div>
                            </div>
                            <hr>
                            <div class="mb-4">
                                <label for="call_button_color" class="form-label fw-bold">Ara Buton Rengi</label>
                                <div class="input-group">
                                    <span class="input-group-text">
                                        <i class="bi bi-palette2"></i>
                                    </span>
                                    <input 
                                        class="form-control form-control-color" 
                                        type="color" 
                                        id="call_button_color" 
                                        name="call_button_color"
                                        value="{{ old('call_button_color') ?? auth()->user()->account->call_button_color }}" 
                                        title="Buton Rengi Seçin">
                                </div>
                            </div>

                            <div class="mb-4">
                                <label for="whatsapp_button_color" class="form-label fw-bold">Whatsapp Buton Rengi</label>
                                <div class="input-group">
                                    <span class="input-group-text">
                                        <i class="bi bi-palette2"></i>
                                    </span>
                                    <input 
                                        class="form-control form-control-color" 
                                        type="color" 
                                        id="whatsapp_button_color" 
                                        name="whatsapp_button_color"
                                        value="{{ old('whatsapp_button_color') ?? auth()->user()->account->whatsapp_button_color }}" 
                                        title="Buton Rengi Seçin">
                                </div>
                            </div>

                            <div class="mb-4">
                                <label for="map_button_color" class="form-label fw-bold">Yol Tarifi Buton Rengi</label>
                                <div class="input-group">
                                    <span class="input-group-text">
                                        <i class="bi bi-palette2"></i>
                                    </span>
                                    <input 
                                        class="form-control form-control-color" 
                                        type="color" 
                                        id="map_button_color" 
                                        name="map_button_color"
                                        value="{{ old('map_button_color') ?? auth()->user()->account->map_button_color }}" 
                                        title="Buton Rengi Seçin">
                                </div>
                            </div>

                            <hr>

                            <div class="mb-4">
                                <label for="logo_width" class="form-label fw-bold">Logo Boyutu (px)</label>
                                <div class="input-group">
                                    <span class="input-group-text">
                                        <i class="bi bi-123"></i>
                                    </span>
                                    <input 
                                        class="form-control" 
                                        type="number" 
                                        id="logo_width" 
                                        name="logo_width"
                                        value="{{ old('logo_width') ?? auth()->user()->account->logo_width }}" 
                                        title="Logo Boyutu Giriniz">
                                </div>
                            </div>

                            <div class="mb-4">
                                <label for="category_logo_width" class="form-label fw-bold">Kategori Logo Boyutu (px)</label>
                                <div class="input-group">
                                    <span class="input-group-text">
                                        <i class="bi bi-123"></i>
                                    </span>
                                    <input 
                                        class="form-control" 
                                        type="number" 
                                        id="category_logo_width" 
                                        name="category_logo_width"
                                        value="{{ old('category_logo_width') ?? auth()->user()->account->category_logo_width }}" 
                                        title="Logo Boyutu Giriniz">
                                </div>
                            </div>
                        
                            @if ($errors->any())
                                <div class="alert alert-danger mt-3">
                                    {{ $errors->first() }}
                                </div>
                            @endif
                        
                            <div class="d-flex justify-content-end">
                                <button type="submit" class="btn btn-success px-4 py-2">
                                    Kaydet
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
