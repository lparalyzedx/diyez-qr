@extends('auth.layouts.master')
@section('title','Kaydol')
@section('content')
<form class="form w-100" method="post" action="{{route('register.post')}}">
    @csrf
    <div class="text-center mb-5">
        <h1 class="text-gray-500 fw-bolder mb-3">Kayıt Olun</h1>
    </div>
    <div class="form-floating mb-5">
        <input type="text" name="company_name" class="form-control bg-transparent  @error('company_name') border-danger @enderror" id="floatingInput" placeholder="Firma Ünvanı" autocomplete="off" value="{{old('company_name')}}" data-gtm-form-interact-field-id="0" required>
        <label class="text-{{$errors->has('company_name') ? 'danger' : 'gray-500'}}" for="floatingInput">Firma Ünvanı</label>
       @error('company_name')
            <div class="invalid-feedback d-block text-danger f-11">{{$message}}</div>
       @enderror
    </div>

    <div class="form-floating mb-5">
        <input type="text" name="name" class="form-control bg-transparent  @error('name') border-danger @enderror" id="floatingInput" placeholder="Ad Soyad" autocomplete="off" value="{{old('name')}}" data-gtm-form-interact-field-id="0" required>
        <label class="text-{{$errors->has('name') ? 'danger' : 'gray-500'}}" for="floatingInput">Ad Soyad</label>
        @error('name')
        <div class="invalid-feedback d-block text-danger f-11">{{$message}}</div>
        @enderror
    </div>

    <div class="form-floating mb-5">
        <input type="email" name="email" class="form-control bg-transparent  @error('email') border-danger @enderror" id="floatingInput" placeholder="E-Posta Adresi" autocomplete="off" value="{{old('email')}}" data-gtm-form-interact-field-id="0" required>
        <label class="text-{{$errors->has('email') ? 'danger' : 'gray-500'}}" for="floatingInput">E-posta adresi</label>
        @error('email')
        <div class="invalid-feedback d-block text-danger f-11">{{$message}}</div>
        @enderror
    </div>

    <div class="form-floating mb-5">
        <input type="text" name="phone" class="form-control bg-transparent @error('phone') border-danger @enderror" id="floatingInput" placeholder="GSM numarası" autocomplete="off" value="{{old('phone')}}" data-gtm-form-interact-field-id="0" required>
        <label class="text-{{$errors->has('phone') ? 'danger' : 'gray-500'}}" for="floatingInput">GSM numarası</label>
        @error('phone')
        <div class="invalid-feedback d-block text-danger f-11">{{$message}}</div>
        @enderror
    </div>

    <div class="form-floating mb-2" data-kt-password-meter="true">
        <div class="mb">
            <div class="form-floating mb-5 position-relative">
                <input class="form-control bg-transparent  @error('password') border-danger @enderror" type="password" placeholder="Parola" name="password" value="{{old('password')}}" autocomplete="off" required />
                <label class="text-{{$errors->has('password') ? 'danger' : 'gray-500'}}" for="floatingInput">Parola</label>
                <span class="btn btn-sm btn-icon position-absolute translate-middle top-50 end-0 {{$errors->has('password') ? 'pb-5' : ''}}" data-kt-password-meter-control="visibility">
                    <i class="bi bi-eye-slash fs-2"></i>
                    <i class="bi bi-eye fs-2 d-none"></i>
                </span>
                 @error('password')
                 <div class="invalid-feedback d-block text-danger f-11">{{$message}}</div>
                 @enderror
            </div>
            <div class="d-flex align-items-center mb-2" data-kt-password-meter-control="highlight">
                <div class="flex-grow-1 bg-secondary bg-active-success rounded h-3px me-2"></div>
                <div class="flex-grow-1 bg-secondary bg-active-success rounded h-3px me-2"></div>
                <div class="flex-grow-1 bg-secondary bg-active-success rounded h-3px me-2"></div>
                <div class="flex-grow-1 bg-secondary bg-active-success rounded h-3px"></div>
            </div>
        </div>
        <div class="text-muted" style="font-size: 12px;">Harflerin, sayıların ve sembollerin bir karışımıyla 8 veya daha fazla karakter kullanın.</div>
    </div>
   <div class="form-floating mb-5" data-kt-password-meter="true">
       <input type="password" name="password_confirmation" class="form-control bg-transparent  @error('password') border-danger @enderror" id="floatingInput" placeholder="Parola tekrar" autocomplete="off" value="{{old('password_confirmation')}}" data-gtm-form-interact-field-id="0" required>
       <label class="text-{{$errors->has('password') ? 'danger' : 'gray-500'}}" for="floatingInput">Parola tekrar</label>
        <span class="btn btn-sm btn-icon position-absolute translate-middle top-50 end-0 {{$errors->has('password') ? 'pb-5' : ''}}" data-kt-password-meter-control="visibility">
            <i class="bi bi-eye-slash fs-2"></i>
            <i class="bi bi-eye fs-2 d-none"></i>
        </span>
       @error('password')
       <div class="invalid-feedback d-block text-danger f-11">{{$message}}</div>
       @enderror
   </div>
    <div class="fv-row mb-8">
        <label class="form-check form-check-inline">
            <input class="form-check-input mt-2" type="checkbox" name="toc" value="1" @checked(old('toc')) required />
            <span class="form-check-label fw-semibold text-gray-500 fs-base ms-1">
                Hesap oluşturarak <a href="giris" data-bs-toggle="modal" data-bs-target="#KullaniciSozlesmesi">Kullanıcı Sözleşmesi, </a><a href="giris" data-bs-toggle="modal" data-bs-target="#AydinlatmaMetni">Aydınlatma Metni,</a> <a href="giris" data-bs-toggle="modal" data-bs-target="#GizlilikPolitikasi">Gizlilik
                    Politikası</a> ve <a href="giris" data-bs-toggle="modal" data-bs-target="#CerezPolitikasi"> Çerez Politikasını </a> Kabul Etmiş
                Olursunuz.
            </span>
        </label>
    </div>
    <div class="d-grid mb-5">
        <button type="submit" id="kt_sign_up_submit" class="btn btn-primary">
           Kayıt Ol
        </button>
    </div>
    <div class="d-grid mb-5">
        <a href="{{route('login')}}" class="btn btn-outline btn-lg btn-outline-dashed btn-outline-primary btn-active-light-primary">Hesabınız
            Var mı? Giriş Yapın</a>
    </div>
</form>
<div class="modal bg-white fade" tabindex="-1" id="KullaniciSozlesmesi">
    <div class="modal-dialog modal-fullscreen">
        <div class="modal-content shadow-none">
            <div class="modal-header">
                <h1 class="modal-title">Kullanıcı Sözleşmesi</h1>
                <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                    <span class="svg-icon svg-icon-2x">
                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                            <g transform="translate(12.000000, 12.000000) rotate(-45.000000) translate(-12.000000, -12.000000) translate(4.000000, 4.000000)" fill="#000000">
                                <rect fill="#000000" x="0" y="7" width="16" height="2" rx="1"></rect>
                                <rect fill="#000000" opacity="0.5" transform="translate(8.000000, 8.000000) rotate(-270.000000) translate(-8.000000, -8.000000)" x="0" y="7" width="16" height="2" rx="1"></rect>
                            </g>
                        </svg>
                    </span>
                </div>
            </div>
            <div class="modal-body">
                {!!$setting->user_agreement ?? ''!!}
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Kapat</button>
            </div>
        </div>
    </div>
</div>
<div class="modal bg-white fade" tabindex="-1" id="AydinlatmaMetni">
    <div class="modal-dialog modal-fullscreen">
        <div class="modal-content shadow-none">
            <div class="modal-header">
                <h1 class="modal-title">Aydınlatma Metni</h1>
                <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                    <span class="svg-icon svg-icon-2x">
                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                            <g transform="translate(12.000000, 12.000000) rotate(-45.000000) translate(-12.000000, -12.000000) translate(4.000000, 4.000000)" fill="#000000">
                                <rect fill="#000000" x="0" y="7" width="16" height="2" rx="1"></rect>
                                <rect fill="#000000" opacity="0.5" transform="translate(8.000000, 8.000000) rotate(-270.000000) translate(-8.000000, -8.000000)" x="0" y="7" width="16" height="2" rx="1"></rect>
                            </g>
                        </svg>
                    </span>
                </div>
            </div>
            <div class="modal-body">
               {!!$setting->lighting_text ?? ''!!}
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Kapat</button>
            </div>
        </div>
    </div>
</div>
<div class="modal bg-white fade" tabindex="-1" id="GizlilikPolitikasi">
    <div class="modal-dialog modal-fullscreen">
        <div class="modal-content shadow-none">
            <div class="modal-header">
                <h1 class="modal-title">Gizlilik Politikası</h1>
                <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                    <span class="svg-icon svg-icon-2x">
                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                            <g transform="translate(12.000000, 12.000000) rotate(-45.000000) translate(-12.000000, -12.000000) translate(4.000000, 4.000000)" fill="#000000">
                                <rect fill="#000000" x="0" y="7" width="16" height="2" rx="1"></rect>
                                <rect fill="#000000" opacity="0.5" transform="translate(8.000000, 8.000000) rotate(-270.000000) translate(-8.000000, -8.000000)" x="0" y="7" width="16" height="2" rx="1"></rect>
                            </g>
                        </svg>
                    </span>
                </div>
            </div>
            <div class="modal-body">
               {!!$setting->privacy_policy ?? ''!!}
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Kapat</button>
            </div>
        </div>
    </div>
</div>
<div class="modal bg-white fade" tabindex="-1" id="CerezPolitikasi">
    <div class="modal-dialog modal-fullscreen">
        <div class="modal-content shadow-none">
            <div class="modal-header">
                <h1 class="modal-title">Çerez Politikası</h1>
                <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                    <span class="svg-icon svg-icon-2x">
                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                            <g transform="translate(12.000000, 12.000000) rotate(-45.000000) translate(-12.000000, -12.000000) translate(4.000000, 4.000000)" fill="#000000">
                                <rect fill="#000000" x="0" y="7" width="16" height="2" rx="1"></rect>
                                <rect fill="#000000" opacity="0.5" transform="translate(8.000000, 8.000000) rotate(-270.000000) translate(-8.000000, -8.000000)" x="0" y="7" width="16" height="2" rx="1"></rect>
                            </g>
                        </svg>
                    </span>
                </div>
            </div>
            <div class="modal-body">
                {!!$setting->cookie_policy ?? ''!!}
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Kapat</button>
            </div>
        </div>
    </div>
</div>

@endsection
@section('js')
<script src="{{asset('assets/js/custom/authentication/sign-up/general.js')}}"></script>
<script src="{{asset('assets/js/widgets.bundle.js')}}"></script>
<script src="{{asset('assets/js/custom/widgets.js')}}"></script>
@endsection