@extends('auth.layouts.master')
@section('title','Şifreyi değiştir')
@section('content')
<form class="form w-100" method="POST" action="{{route('password.update')}}">
    @csrf
    <div class="text-center mb-10">
        <h1 class="text-dark fw-bolder mb-3">Şifreyi Sıfırla</h1>
        <div class="text-gray-500 fw-semibold fs-6">Şifreyi zaten sıfırladınız mı?
            <a href="{{route('login')}}" class="link-primary fw-bold">Giriş Yap</a></div>
    </div>
    <div class="form-floating mb-5">
        <input type="email" name="email" class="form-control bg-transparent  @error('email') border-danger @enderror" id="floatingInput" placeholder="E-Posta Adresi" value="{{old('email')}}"  required>
        <label class="text-{{$errors->has('email') ? 'danger' : 'gray-500'}}" for="floatingInput">E-posta adresi</label>
        @error('email')
        <div class="invalid-feedback d-block text-danger f-11">{{$message}}</div>
        @enderror
    </div>

    <div class="form-floating mb-2" data-kt-password-meter="true">
        <div class="mb">
            <div class="form-floating mb-5 position-relative">
                <input class="form-control bg-transparent  @error('password') border-danger @enderror" type="password" placeholder="Parola" name="password" value="{{old('password')}}" autocomplete="on" required />
                <label class="text-{{$errors->has('password') ? 'danger' : 'gray-500'}}" for="floatingInput">Parola</label>
                <span class="btn btn-sm btn-icon position-absolute translate-middle top-50 end-0 {{$errors->has('password') ? 'pb-5' : ''}}" data-kt-password-meter-control="visibility">
                    <i class="bi bi-eye-slash fs-2"></i>
                    <i class="bi bi-eye fs-2 d-none"></i>
                </span>
                @error('password')
                <div class="invalid-feedback d-block text-danger f-11">{{$message}}</div>
                @enderror
            </div>
            <div class="d-flex align-items-center mb-3" data-kt-password-meter-control="highlight">
                <div class="flex-grow-1 bg-secondary bg-active-success rounded h-3px me-2"></div>
                <div class="flex-grow-1 bg-secondary bg-active-success rounded h-3px me-2"></div>
                <div class="flex-grow-1 bg-secondary bg-active-success rounded h-3px me-2"></div>
                <div class="flex-grow-1 bg-secondary bg-active-success rounded h-3px"></div>
            </div>
        </div>
        <div class="text-muted" style="font-size: 12px;">Harflerin, sayıların ve sembollerin bir karışımıyla 8 veya daha fazla karakter kullanın.</div>
    </div>
    <div class="form-floating mb-5" data-kt-password-meter="true">
        <input type="password" name="password_confirmation" class="form-control bg-transparent  @error('password') border-danger @enderror" id="floatingInput" placeholder="Parola tekrar" autocomplete="on" value="{{old('password_confirmation')}}"  required>
        <label class="text-{{$errors->has('password') ? 'danger' : 'gray-500'}}" for="floatingInput">Parola tekrar</label>
        <span class="btn btn-sm btn-icon position-absolute translate-middle top-50 end-0 {{$errors->has('password') ? 'pb-5' : ''}}" data-kt-password-meter-control="visibility">
            <i class="bi bi-eye-slash fs-2"></i>
            <i class="bi bi-eye fs-2 d-none"></i>
        </span>
        @error('password')
        <div class="invalid-feedback d-block text-danger f-11">{{$message}}</div>
        @enderror
    </div>
     <input type="hidden" value="{{ $token }}" name="token">
    <div class="d-grid mb-10">
        <button type="submit" id="kt_new_password_submit" class="btn btn-primary">
           Sıfırla
        </button>
    </div>
</form>
@endsection
@section('js')
<script src="{{asset('assets/js/custom/authentication/reset-password/new-password.js')}}"></script>
@endsection