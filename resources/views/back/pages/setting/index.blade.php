@extends('back.layouts.master')
@section('title','Sistem Bilgileri')
@section('content')
<div id="kt_app_content" class="app-content flex-column-fluid mt-5">
    <div id="kt_app_content_container" class="app-container container-fluid">
        <div class="card card-bordered">
            <div class="card-header">
                <div class="card-title m-0">
                    <h3 class="fw-bolder m-0">Sistem Bilgileriniz
                        <div class="fs-8 text-gray-600 mt-1">Sistem bilgilerinizi bu bölümden düzenleyebilirsiniz.</div>
                    </h3>
                </div>
            </div>
            <div id="kt_account_profile_details" class="collapse show">
                <form class="form needs-validation" method="post" action="{{route('setting.update')}}" enctype="multipart/form-data" autocomplete="off">
                    @method('PUT')
                    @csrf
                    <div class="card-body border-top p-9">
                        <div class="row mb-6">
                            <div class="col-lg-6 mb-5 mb-md-0">
                                <div class="image-input image-input-outline" data-kt-image-input="true" style="background-image: url({{ $setting->logo ? asset('storage/'.$setting->logo) : asset('assets/media/other/logoyok.png')}})">
                                    <div class="image-input-wrapper w-200px h-70px" style="background-image: url({{ $setting->logo ? asset('storage/'.$setting->logo) : asset('assets/media/other/logoyok.png')}})">
                                    </div>
                                    <label class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-white shadow" data-kt-image-input-action="change" data-bs-toggle="tooltip" title="" data-bs-original-title="Resim Değiştir / Yükle" data-kt-initialized="1">
                                        <i class="bi bi-pencil-fill fs-7"></i>
                                        <input type="file" name="logo" accept=".png, .jpg, .jpeg">
                                    </label>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="image-input image-input-outline" data-kt-image-input="true" style="background-image: url({{ $setting->logo_small ? asset('storage/'.$setting->logo_small) : asset('assets/media/other/logoyok.png')}})">
                                    <div class="image-input-wrapper w-200px h-70px" style="background-image: url({{ $setting->logo_small ? asset('storage/'.$setting->logo_small) : asset('assets/media/other/logoyok.png')}})">
                                    </div>
                                    <label class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-white shadow" data-kt-image-input-action="change" data-bs-toggle="tooltip" title="" data-bs-original-title="Resim Değiştir / Yükle" data-kt-initialized="1">
                                        <i class="bi bi-pencil-fill fs-7"></i>
                                        <input type="file" name="logo_small" accept=".png, .jpg, .jpeg">
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-lg-12 fv-row">
                                <label class="form-label">Sistem adı</label>
                                <input type="text" name="site_name" class="form-control form-control-lg bg-transparent  mb-3 mb-lg-0 @error('site_name') border-danger @enderror" value="{{ old('site_name') ?? $setting->site_name }}" placeholder="Sistem Adı" required>
                                @error('site_name')
                                <div class="invalid-feedback d-block text-danger f-11">{{$message}}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="row">
                                    <div class="col-lg-6 fv-row mb-3">
                                        <label class="form-label">E-posta adresi</label>
                                        <input type="email" name="email" class="form-control form-control-lg bg-transparent mb-3 mb-lg-0 @error('email') border-danger @enderror" value="{{old('email') ?? $setting->email}}" placeholder="E-posta Adresi">
                                        @error('email')
                                        <div class="invalid-feedback d-block text-danger f-11">{{$message}}</div>
                                        @enderror
                                    </div>
                                    <div class="col-lg-6 fv-row mb-3">
                                        <label class="form-label">Telefon numarası</label>
                                        <input type="text" name="phone" class="form-control form-control-lg bg-transparent mb-3 mb-lg-0 @error('phone') border-danger @enderror" value="{{old('phone') ?? $setting->phone}}" placeholder="Telefon numarası">
                                        @error('phone')
                                        <div class="invalid-feedback d-block text-danger f-11">{{$message}}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="row">
                                    <div class="col-lg-6 fv-row mb-3">
                                        <label class="form-label">Facebook</label>
                                        <input type="text" name="facebook" class="form-control form-control-lg bg-transparent mb-3 mb-lg-0 @error('facebook') border-danger @enderror" value="{{old('facebook') ?? $setting->facebook}}" placeholder="Facebook">
                                        @error('facebook')
                                        <div class="invalid-feedback d-block text-danger f-11">{{$message}}</div>
                                        @enderror
                                    </div>
                                    <div class="col-lg-6 fv-row mb-3">
                                        <label class="form-label">Twitter</label>
                                        <input type="text" name="twitter" class="form-control form-control-lg bg-transparent mb-3 mb-lg-0 @error('twitter') border-danger @enderror" value="{{old('twitter') ?? $setting->twitter}}" placeholder="Twitter">
                                        @error('twitter')
                                        <div class="invalid-feedback d-block text-danger f-11">{{$message}}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="fv-row mb-3">
                            <label class="form-label">Adres</label>
                            <textarea type="text" name="address" class="form-control form-control-lg bg-transparent mb-3 mb-lg-0 @error('address') border-danger @enderror" placeholder="Adres">{{ old('address') ?? $setting->address }}</textarea>
                            @error('address')
                            <div class="invalid-feedback d-block text-danger f-11">{{$message}}</div>
                            @enderror
                        </div>
                        <div class="fv-row mb-3">
                            <label class="form-label">Açıklama</label>
                            <textarea type="text" name="site_description" class="form-control form-control-lg bg-transparent mb-3 mb-lg-0 ck-editor1 @error('site_description') border-danger @enderror" placeholder="Açıklama">{!! old('site_description') ?? $setting->site_description !!}</textarea>
                            @error('site_description')
                            <div class="invalid-feedback d-block text-danger f-11">{{$message}}</div>
                            @enderror
                        </div>
                        <div class="fv-row mb-3">
                            <label class="form-label">Hakkımızda</label>
                            <textarea type="text" name="site_about" class="form-control form-control-lg bg-transparent mb-3 mb-lg-0 ck-editor2 @error('site_description') border-danger @enderror" placeholder="Hakkımızda">{!! old('site_about') ?? $setting->site_about !!}</textarea>
                            @error('site_about')
                            <div class="invalid-feedback d-block text-danger f-11">{{$message}}</div>
                            @enderror
                        </div>
                        <div class="fv-row mb-3">
                            <label class="form-label">Kullanıcı Sözleşmesi</label>
                            <textarea type="text" name="user_agreement" class="form-control form-control-lg bg-transparent mb-3 mb-lg-0 ck-editor3 @error('user_agreement') border-danger @enderror" placeholder="Kullanıcı Sözleşmesi">{!! old('user_agreement') ?? $setting->user_agreement !!}</textarea>
                            @error('user_agreement')
                            <div class="invalid-feedback d-block text-danger f-11">{{$message}}</div>
                            @enderror
                        </div>
                        <div class="fv-row mb-3">
                            <label class="form-label">Gizlilik Politikası</label>
                            <textarea type="text" name="privacy_policy" class="form-control form-control-lg bg-transparent mb-3 mb-lg-0 ck-editor4 @error('privacy_policy') border-danger @enderror" placeholder="Gizlilik Politikası">{!! old('privacy_policy') ?? $setting->privacy_policy !!}</textarea>
                            @error('privacy_policy')
                            <div class="invalid-feedback d-block text-danger f-11">{{$message}}</div>
                            @enderror
                        </div>
                        <div class="fv-row mb-3">
                            <label class="form-label">Çerez Politikası</label>
                            <textarea type="text" name="cookie_policy" class="form-control form-control-lg bg-transparent mb-3 mb-lg-0 ck-editor5 @error('cookie_policy') border-danger @enderror" placeholder="Çerez Politikası">{!! old('cookie_policy') ?? $setting->cookie_policy !!}</textarea>
                            @error('cookie_policy')
                            <div class="invalid-feedback d-block text-danger f-11">{{$message}}</div>
                            @enderror
                        </div>
                         <div class="fv-row mb-3">
                            <label class="form-label">Mesafeli Satış Sözleşmesi</label>
                            <textarea type="text" name="sales_policy" class="form-control form-control-lg bg-transparent mb-3 mb-lg-0 ck-editor6 @error('sales_policy') border-danger @enderror" placeholder="Mesafeli Satış Sözleşmesi">{!! old('sales_policy') ?? $setting->sales_policy !!}</textarea>
                            @error('sales_policy')
                            <div class="invalid-feedback d-block text-danger f-11">{{$message}}</div>
                            @enderror
                        </div>
                        <div class="fv-row mb-3">
                            <label class="form-label">Aydınlatma Metni</label>
                            <textarea type="text" name="lighting_text" class="form-control form-control-lg bg-transparent mb-3 mb-lg-0 ck-editor7 @error('lighting_text') border-danger @enderror" placeholder="Aydınlatma Metni">{!! old('lighting_text') ?? $setting->lighting_text !!}</textarea>
                            @error('lighting_text')
                            <div class="invalid-feedback d-block text-danger f-11">{{$message}}</div>
                            @enderror
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="row">
                                    <div class="col-lg-6 fv-row mb-3">
                                        <label class="form-label">Android App Id</label>
                                        <input type="text" name="android_app_id" class="form-control form-control-lg bg-transparent mb-3 mb-lg-0 @error('android_app_id') border-danger @enderror" value="{{old('android_app_id') ?? $setting->android_app_id}}" placeholder="Android App Id">
                                        @error('android_app_id')
                                        <div class="invalid-feedback d-block text-danger f-11">{{$message}}</div>
                                        @enderror
                                    </div>
                                    <div class="col-lg-6 fv-row mb-3">
                                        <label class="form-label">IOS App Id</label>
                                        <input type="text" name="ios_app_id" class="form-control form-control-lg bg-transparent mb-3 mb-lg-0 @error('ios_app_id') border-danger @enderror" value="{{old('ios_app_id') ?? $setting->ios_app_id}}" placeholder="IOS App Id">
                                        @error('ios_app_id')
                                        <div class="invalid-feedback d-block text-danger f-11">{{$message}}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12 fv-row">
                                <label class="form-label">Versiyon</label>
                                <input type="text" step="0.01" name="version" class="form-control form-control-lg bg-transparent  mb-3 mb-lg-0 @error('version') border-danger @enderror" value="{{ old('version') ?? $setting->version }}" placeholder="Version" required>
                                @error('version')
                                <div class="invalid-feedback d-block text-danger f-11">{{$message}}</div>
                                @enderror
                            </div>

                        @if(session()->has('success'))
                        <div class="alert alert-success d-flex align-items-center p-5 ">
                            <span class="svg-icon svg-icon-2hx svg-icon-success me-4">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path opacity="0.3" d="M20.5543 4.37824L12.1798 2.02473C12.0626 1.99176 11.9376 1.99176 11.8203 2.02473L3.44572 4.37824C3.18118 4.45258 3 4.6807 3 4.93945V13.569C3 14.6914 3.48509 15.8404 4.4417 16.984C5.17231 17.8575 6.18314 18.7345 7.446 19.5909C9.56752 21.0295 11.6566 21.912 11.7445 21.9488C11.8258 21.9829 11.9129 22 12.0001 22C12.0872 22 12.1744 21.983 12.2557 21.9488C12.3435 21.912 14.4326 21.0295 16.5541 19.5909C17.8169 18.7345 18.8277 17.8575 19.5584 16.984C20.515 15.8404 21 14.6914 21 13.569V4.93945C21 4.6807 20.8189 4.45258 20.5543 4.37824Z" fill="currentColor"></path>
                                    <path d="M10.5606 11.3042L9.57283 10.3018C9.28174 10.0065 8.80522 10.0065 8.51412 10.3018C8.22897 10.5912 8.22897 11.0559 8.51412 11.3452L10.4182 13.2773C10.8099 13.6747 11.451 13.6747 11.8427 13.2773L15.4859 9.58051C15.771 9.29117 15.771 8.82648 15.4859 8.53714C15.1948 8.24176 14.7183 8.24176 14.4272 8.53714L11.7002 11.3042C11.3869 11.6221 10.874 11.6221 10.5606 11.3042Z" fill="currentColor"></path>
                                </svg>
                            </span>
                            <div class="d-flex flex-column">
                                <h4 class="mb-1 text-success">İşlem Başarılı.</h4>
                                <span>{{session()->get('success')}}</span>
                            </div>
                        </div>
                        @endif
                    </div>
                    <div class="card-footer d-flex justify-content-end py-6 px-9">
                        <button type="submit" class="btn btn-primary">Sistem Bilgilerini Kaydet</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
@section('js')
<script src="{{asset('assets/plugins/custom/ckeditor/ckeditor-classic.bundle.js')}}"></script>
<script>
    ClassicEditor
        .create(document.querySelector('.ck-editor1'))
        .catch(error => {
            console.error(error);
        });
    ClassicEditor
        .create(document.querySelector('.ck-editor2'))
        .catch(error => {
            console.error(error);
        });
    ClassicEditor
        .create(document.querySelector('.ck-editor3'))
        .catch(error => {
            console.error(error);
        });

    ClassicEditor
        .create(document.querySelector('.ck-editor4'))
        .catch(error => {
            console.error(error);
        });
    ClassicEditor
        .create(document.querySelector('.ck-editor5'))
        .catch(error => {
            console.error(error);
        });
          ClassicEditor
        .create(document.querySelector('.ck-editor6'))
        .catch(error => {
            console.error(error);
        });
          ClassicEditor
        .create(document.querySelector('.ck-editor7'))
        .catch(error => {
            console.error(error);
        });
</script>
@endsection