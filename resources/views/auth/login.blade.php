@extends('auth.layouts.master')
@section('content')
<form class="form w-100  w-full" method="post" action="{{route('login.post')}}">
    @csrf
    <div class="text-center mb-11">
        <h1 class="text-gray-500 fw-bolder mb-3">Giriş Yapın</h1>
        <div class="separator separator-content my-14">
            <span class="w-125px text-gray-500 fw-semibold fs-5">Hoşgeldiniz</span>
        </div>
        <div class="text-gray-500 fw-semibold fs-6">Hesabınıza giriş yapın, tüm işlerinizi yönetin.</div>
    </div>

    <div class="form-floating mb-5">
        <input type="email" name="email" class="form-control bg-transparent @error('email') border-danger @enderror" id="floatingInput" placeholder="E-Posta Adresi" autocomplete="off" value="{{old('email')}}" data-gtm-form-interact-field-id="0" required>
        <label class="text-{{$errors->has('email') ? 'danger' : 'gray-500'}}" for="floatingInput">E-posta adresi</label>
        @error('email')
        <div class="invalid-feedback d-block text-danger f-11">{{$message}}</div>
        @enderror
    </div>
    <div class="form-floating mb-5 position-relative" data-kt-password-meter="true">
        <input class="form-control bg-transparent @error('password') border-danger @enderror" type="password" placeholder="Parola" name="password" autocomplete="off" value="{{old('password')}}" required />
        <label class="text-{{$errors->has('password') ? 'danger' : 'gray-500'}}" for="floatingInput">Parolanız</label>
        <span class="btn btn-sm btn-icon position-absolute translate-middle top-50 end-0 {{$errors->has('password') ? 'pb-5' : ''}}" data-kt-password-meter-control="visibility">
            <i class="bi bi-eye-slash fs-2"></i>
            <i class="bi bi-eye fs-2 d-none"></i>
        </span>
        @error('password')
        <div class="invalid-feedback d-block text-danger f-11">{{$message}}</div>
        @enderror
    </div>

    <div class="d-flex flex-stack flex-wrap gap-3 fs-base fw-semibold mb-8">
        <label class="form-check form-check-inline">
            <input class="form-check-input" type="checkbox" name="remember" value="1">
            <span class="form-check-label fw-semibold text-gray-500 fs-base ms-1">Beni Hatırla</span>
        </label>
        <a href="{{route('forgot')}}" class="link-primary">Şifremi unuttum?</a>
    </div>
    <div class="d-grid mb-5">
        <button type="submit" id="kt_sign_in_submit" class="btn btn-primary">
           Giriş yap
        </button>
    </div>
    
</form>
    
@endsection
						
