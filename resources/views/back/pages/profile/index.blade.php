@extends('back.layouts.master')
@section('title','Profilim')
@section('content')
<div class="app-main flex-column flex-row-fluid" id="kt_app_main">
    <div class="d-flex flex-column flex-column-fluid">
        <div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
            <div id="kt_app_toolbar_container" class="app-container container-fluid d-flex flex-stack">
                <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
                    <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
                        <li class="breadcrumb-item text-muted">
                            <a href="{{route('dashboard')}}" class="text-muted text-hover-primary">Anasayfa</a>
                        </li>
                        <li class="breadcrumb-item">
                            <span class="bullet bg-gray-400 w-5px h-2px"></span>
                        </li>
                        <li class="breadcrumb-item text-muted">Hesabım</li>
                    </ul>
                </div>
            </div>
        </div>
        <div id="kt_app_content" class="app-content flex-column-fluid">
            <div id="kt_app_content_container" class="app-container container-fluid">
                <div class="card mb-5 mb-xl-5">
                    <div class="card-body pt-9 pb-0">
                        <div class="d-flex flex-wrap flex-sm-nowrap mb-3">
                            <div class="me-7 mb-4">
                                <div class="symbol symbol-75px symbol-lg-160px symbol-fixed position-relative">
                                    <img src="{{auth()->user()->profile_img}}" alt="{{auth()->user()->name}}" class="object-fit-cover w-100px h-100px" />
                                    <div class="position-absolute translate-middle bottom-0 start-100 mb-6 bg-success rounded-circle border border-4 border-body h-20px w-20px"></div>
                                </div>
                            </div>
                            <div class="flex-grow-1">
                                <div class="d-flex justify-content-between align-items-start flex-wrap mb-2">
                                    <div class="d-flex flex-column">
                                        <div class="d-flex align-items-center mb-2">
                                            <a class="text-gray-900 text-hover-primary fs-2 fw-bold me-1">{{auth()->user()->name}}</a>
                                        </div>
                                        <div class="d-flex flex-wrap fw-semibold fs-6 mb-4 pe-2">
                                            <a  class="d-flex align-items-center text-gray-400 text-hover-primary me-5 mb-2">
                                                <span class="svg-icon svg-icon-4 me-1">
                                                    <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path opacity="0.3" d="M16.5 9C16.5 13.125 13.125 16.5 9 16.5C4.875 16.5 1.5 13.125 1.5 9C1.5 4.875 4.875 1.5 9 1.5C13.125 1.5 16.5 4.875 16.5 9Z" fill="currentColor" />
                                                        <path d="M9 16.5C10.95 16.5 12.75 15.75 14.025 14.55C13.425 12.675 11.4 11.25 9 11.25C6.6 11.25 4.57499 12.675 3.97499 14.55C5.24999 15.75 7.05 16.5 9 16.5Z" fill="currentColor" />
                                                        <rect x="7" y="6" width="4" height="4" rx="2" fill="currentColor" />
                                                    </svg>
                                                </span>{{auth()->user()->account->name ?? ''}}</a>
                                            <a class="d-flex align-items-center text-gray-400 text-hover-primary me-5 mb-2">
                                                <span class="svg-icon svg-icon-4 me-1">
                                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path opacity="0.3" d="M18.0624 15.3453L13.1624 20.7453C12.5624 21.4453 11.5624 21.4453 10.9624 20.7453L6.06242 15.3453C4.56242 13.6453 3.76242 11.4453 4.06242 8.94534C4.56242 5.34534 7.46242 2.44534 11.0624 2.04534C15.8624 1.54534 19.9624 5.24534 19.9624 9.94534C20.0624 12.0453 19.2624 13.9453 18.0624 15.3453Z" fill="currentColor" />
                                                        <path d="M12.0624 13.0453C13.7193 13.0453 15.0624 11.7022 15.0624 10.0453C15.0624 8.38849 13.7193 7.04535 12.0624 7.04535C10.4056 7.04535 9.06241 8.38849 9.06241 10.0453C9.06241 11.7022 10.4056 13.0453 12.0624 13.0453Z" fill="currentColor" />
                                                    </svg>
                                                </span>
                                              {{auth()->user()->account->city->name ?? 'Turkey'}}, {{auth()->user()->account->district->name ?? 'Unknown'}}</a>
                                            <a  class="d-flex align-items-center text-gray-400 text-hover-primary mb-2">
                                                <span class="svg-icon svg-icon-4 me-1">
                                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path opacity="0.3" d="M21 19H3C2.4 19 2 18.6 2 18V6C2 5.4 2.4 5 3 5H21C21.6 5 22 5.4 22 6V18C22 18.6 21.6 19 21 19Z" fill="currentColor" />
                                                        <path d="M21 5H2.99999C2.69999 5 2.49999 5.10005 2.29999 5.30005L11.2 13.3C11.7 13.7 12.4 13.7 12.8 13.3L21.7 5.30005C21.5 5.10005 21.3 5 21 5Z" fill="currentColor" />
                                                    </svg>
                                                </span>
                                                {{auth()->user()->email}}</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card mb-5 mb-xl-5">
                    <div class="card-header border-0 py-4 cursor-pointer" role="button" data-bs-toggle="collapse" data-bs-target="#kt_account_profile_details" aria-expanded="true" aria-controls="kt_account_profile_details">
                        <div class="card-title m-0 py-0">
                            <h3 class="fw-bold m-0">Kişisel Bilgiler</h3>
                        </div>
                    </div>
                    <div id="kt_account_settings_profile_details" class="collapse show">
                        <form id="kt_account_profile_details_form" class="form" method="post" action="{{route('profile.update')}}" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="card-body border-top p-9">
                                <div class="row mb-6">
                                    <label class="col-lg-4 col-form-label fw-semibold fs-6">Avatar</label>
                                    <div class="col-lg-8">
                                        <div class="image-input image-input-outline" data-kt-image-input="true" style="background-image: url('assets/media/svg/avatars/blank.svg')">
                                            <div class="image-input-wrapper w-100px h-100px object-fit-cover" style="background-image: url('{{auth()->user()->profile_img}}')"></div>
                                            <label class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="change" data-bs-toggle="tooltip" title="Avatar'ı Değiştir">
                                                <i class="bi bi-pencil-fill fs-7"></i>
                                                <input type="file" name="profile_image" accept=".png, .jpg, .jpeg" />
                                                <input type="hidden" name="avatar_remove" />
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-6">
										<label class="col-lg-4 col-form-label required fw-semibold fs-6">Ad Soyad</label>
											<div class="col-lg-8">
												<div class="row">
												<div class="col-lg-12 fv-row">
											<input type="text" name="name" class="form-control form-control-lg form-control-solid @error('name') border-danger @enderror" placeholder="Ad Soyad" value="{{old('name') ?? auth()->user()->name}}" required>
                                             @error('name')
                                             <div class="invalid-feedback d-block text-danger f-11">{{$message}}</div>
                                             @enderror
										</div>
									</div>
								</div>
								</div>                               
                                <div class="row mb-6">
                                    <label class="col-lg-4 col-form-label fw-semibold fs-6 required">Telefon Numarası</label>
                                    <div class="col-lg-8 fv-row">
                                        <input type="text" name="phone" class="form-control form-control-lg form-control-solid @error('phone') border-danger @enderror" placeholder="Telefon Numarası" value="{{ old('phone') ?? auth()->user()->phone}}" required />
                                        @error('phone')
                                        <div class="invalid-feedback d-block text-danger f-11">{{$message}}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row mb-6">
                                    <label class="col-lg-4 col-form-label fw-semibold fs-6 required">E-posta Adresi</label>
                                    <div class="col-lg-8 fv-row">
                                        <input type="email" name="email" class="form-control form-control-lg form-control-solid disabled" placeholder="E-posta Adresi" value="{{auth()->user()->email}}" disabled />
                                    </div>
                                </div>
                                 @if(session()->has('profile_success'))
                                 <div class="alert alert-success d-flex align-items-center p-5 ">
                                     <span class="svg-icon svg-icon-2hx svg-icon-success me-4">
                                         <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                             <path opacity="0.3" d="M20.5543 4.37824L12.1798 2.02473C12.0626 1.99176 11.9376 1.99176 11.8203 2.02473L3.44572 4.37824C3.18118 4.45258 3 4.6807 3 4.93945V13.569C3 14.6914 3.48509 15.8404 4.4417 16.984C5.17231 17.8575 6.18314 18.7345 7.446 19.5909C9.56752 21.0295 11.6566 21.912 11.7445 21.9488C11.8258 21.9829 11.9129 22 12.0001 22C12.0872 22 12.1744 21.983 12.2557 21.9488C12.3435 21.912 14.4326 21.0295 16.5541 19.5909C17.8169 18.7345 18.8277 17.8575 19.5584 16.984C20.515 15.8404 21 14.6914 21 13.569V4.93945C21 4.6807 20.8189 4.45258 20.5543 4.37824Z" fill="currentColor"></path>
                                             <path d="M10.5606 11.3042L9.57283 10.3018C9.28174 10.0065 8.80522 10.0065 8.51412 10.3018C8.22897 10.5912 8.22897 11.0559 8.51412 11.3452L10.4182 13.2773C10.8099 13.6747 11.451 13.6747 11.8427 13.2773L15.4859 9.58051C15.771 9.29117 15.771 8.82648 15.4859 8.53714C15.1948 8.24176 14.7183 8.24176 14.4272 8.53714L11.7002 11.3042C11.3869 11.6221 10.874 11.6221 10.5606 11.3042Z" fill="currentColor"></path>
                                         </svg>
                                     </span>
                                     <div class="d-flex flex-column">
                                         <h4 class="mb-1 text-success">İşlem Başarılı.</h4>
                                         <span>{{session()->get('profile_success')}}</span>
                                     </div>
                                 </div>
                                @endif
                            </div>
                            <div class="card-footer d-flex justify-content-end py-6 px-9">
                                <button type="reset" class="btn btn-light btn-active-light-primary me-2">Sıfırla</button>
                                <button type="submit" class="btn btn-primary" id="kt_account_profile_details_submit">Değişiklikleri Kaydet</button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="card mb-5 mb-xl-10">
                    <div class="card-header border-0 cursor-pointer py-4" role="button" data-bs-toggle="collapse" data-bs-target="#kt_account_signin_method">
                        <div class="card-title m-0 py-0">
                            <h3 class="fw-bold m-0">Oturum açma yöntemi</h3>
                        </div>
                    </div>
                    <div id="kt_account_settings_signin_method" class="collapse show">
                        <div class="card-body border-top p-9">
                            <div class="d-flex flex-wrap align-items-center">
                                <div id="kt_signin_email" class="{{ array_intersect(['email','confirmemailpassword'], $errors->keys()) ? 'd-none':'' }}">
                                    <div class="fs-6 fw-bold mb-1">E-posta Adresi</div>
                                    <div class="fw-semibold text-gray-600">{{auth()->user()->email}}</div>
                                </div>
                                <div id="kt_signin_email_edit" class="flex-row-fluid {{ array_intersect(['email','confirmemailpassword'], $errors->keys()) ? '':'d-none' }}">
                                    <form id="kt_signin_change_emails" class="form" method="post" action="{{route('profile.email')}}">
                                        @csrf
                                        @method('PUT')
                                        <div class="row mb-6">
                                            <div class="col-lg-6 mb-4 mb-lg-0">
                                                <div class="fv-row mb-0">
                                                    <label for="emailaddress" class="form-label fs-6 fw-bold mb-3">Yeni E-posta Adresini Girin</label>
                                                    <input type="email" class="form-control form-control-lg form-control-solid @error('email') border-danger @enderror" id="emailaddress" placeholder="E-posta Adresi" name="email" value="{{old('email') ?? auth()->user()->email}}" required />
                                                    @error('email')
                                                    <div class="invalid-feedback d-block text-danger f-11">{{$message}}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="fv-row mb-0">
                                                    <label for="confirmemailpassword" class="form-label fs-6 fw-bold mb-3">Parolayı Onayla</label>
                                                    <input type="password" class="form-control form-control-lg form-control-solid @error('confirmemailpassword') border-danger @enderror" name="confirmemailpassword" id="confirmemailpassword" required  value="{{old('confirmemailpassword')}}"/>
                                                    <input type="hidden" name="id" value="{{auth()->user()->id}}">
                                                     @error('confirmemailpassword')
                                                     <div class="invalid-feedback d-block text-danger f-11">{{$message}}</div>
                                                     @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="d-flex">
                                            <button id="kt_signin_submit" type="submit" class="btn btn-primary me-2 px-6">E-postayı Güncelle</button>
                                            <button id="kt_signin_cancel" type="button" class="btn btn-color-gray-400 btn-active-light-primary px-6">Vazgeç</button>
                                        </div>
                                    </form>
                                </div>
                                <div id="kt_signin_email_button" class="ms-auto {{ array_intersect(['email','confirmemailpassword'], $errors->keys()) ? 'd-none':'' }}">
                                    <button class="btn btn-light btn-active-light-primary">E-postayı Değiştir</button>
                                </div>
                            </div>
                            <div class="separator separator-dashed my-6"></div>
                            <div class="d-flex flex-wrap align-items-center mb-10">
                                <div id="kt_signin_password" class="{{ array_intersect(['currentpassword','password','password_confirmation'], $errors->keys()) ? 'd-none':'' }}">
                                    <div class="fs-6 fw-bold mb-1">Parola</div>
                                    <div class="fw-semibold text-gray-600">************</div>
                                </div>
                                <div id="kt_signin_password_edit" class="flex-row-fluid {{ array_intersect(['currentpassword','password','password_confirmation'], $errors->keys()) ? '':'d-none' }}">
                                    <form id="kt_signin_change_passwords" class="form" method="post" action="{{route('profile.password')}}">
                                        @csrf
                                        @method('PUT')
                                        <div class="row mb-1">
                                            <div class="col-lg-4">
                                                <div class="fv-row mb-0">
                                                    <label for="currentpassword" class="form-label fs-6 fw-bold mb-3">Güncel Parola</label>
                                                    <input type="password" class="form-control form-control-lg form-control-solid  @error('currentpassword') border-danger @enderror" name="currentpassword" id="currentpassword" value="{{old('currentpassword')}}" required />
                                                     @error('currentpassword')
                                                     <div class="invalid-feedback d-block text-danger f-11">{{$message}}</div>
                                                     @enderror
                                                </div>
                                            </div>
                                            <div class="col-lg-4">
                                                <div class="fv-row mb-0">
                                                    <label for="newpassword" class="form-label fs-6 fw-bold mb-3">Yeni Parola</label>
                                                    <input type="password" class="form-control form-control-lg form-control-solid @error('password') border-danger @enderror" name="password" id="newpassword" value="{{old('password')}}"  required/>
                                                      @error('password')
                                                      <div class="invalid-feedback d-block text-danger f-11">{{$message}}</div>
                                                      @enderror
                                                </div>
                                            </div>
                                            <div class="col-lg-4">
                                                <div class="fv-row mb-0">
                                                    <label for="confirmpassword" class="form-label fs-6 fw-bold mb-3">Yeni Parola Tekrar</label>
                                                    <input type="password" class="form-control form-control-lg form-control-solid  @error('password') border-danger @enderror" name="password_confirmation" id="confirmpassword" value="{{old('password_confirmation')}}" required/>
                                                      @error('password')
                                                     <div class="invalid-feedback d-block text-danger f-11">{{$message}}</div>
                                                     @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-text mb-5">Şifre en az 8 karakter olmalı ve semboller içermelidir</div>
                                        <div class="d-flex">
                                            <button id="kt_password_submit" type="submit" class="btn btn-primary me-2 px-6">Parolayı Güncelle</button>
                                            <button id="kt_password_cancel" type="button" class="btn btn-color-gray-400 btn-active-light-primary px-6">Vazgeç</button>
                                        </div>
                                    </form>
                                </div>
                                <div id="kt_signin_password_button" class="ms-auto {{ array_intersect(['currentpassword','password','password_confirmation'], $errors->keys()) ? 'd-none':'' }}">
                                    <button class="btn btn-light btn-active-light-primary">Parolayı Değiştir</button>
                                </div>
                            </div>
                            @if(session()->has('email_success'))
                            <div class="alert alert-success d-flex align-items-center p-5 ">
                                <span class="svg-icon svg-icon-2hx svg-icon-success me-4">
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path opacity="0.3" d="M20.5543 4.37824L12.1798 2.02473C12.0626 1.99176 11.9376 1.99176 11.8203 2.02473L3.44572 4.37824C3.18118 4.45258 3 4.6807 3 4.93945V13.569C3 14.6914 3.48509 15.8404 4.4417 16.984C5.17231 17.8575 6.18314 18.7345 7.446 19.5909C9.56752 21.0295 11.6566 21.912 11.7445 21.9488C11.8258 21.9829 11.9129 22 12.0001 22C12.0872 22 12.1744 21.983 12.2557 21.9488C12.3435 21.912 14.4326 21.0295 16.5541 19.5909C17.8169 18.7345 18.8277 17.8575 19.5584 16.984C20.515 15.8404 21 14.6914 21 13.569V4.93945C21 4.6807 20.8189 4.45258 20.5543 4.37824Z" fill="currentColor"></path>
                                        <path d="M10.5606 11.3042L9.57283 10.3018C9.28174 10.0065 8.80522 10.0065 8.51412 10.3018C8.22897 10.5912 8.22897 11.0559 8.51412 11.3452L10.4182 13.2773C10.8099 13.6747 11.451 13.6747 11.8427 13.2773L15.4859 9.58051C15.771 9.29117 15.771 8.82648 15.4859 8.53714C15.1948 8.24176 14.7183 8.24176 14.4272 8.53714L11.7002 11.3042C11.3869 11.6221 10.874 11.6221 10.5606 11.3042Z" fill="currentColor"></path>
                                    </svg>
                                </span>
                                <div class="d-flex flex-column">
                                    <h4 class="mb-1 text-success">İşlem Başarılı.</h4>
                                    <span>{{session()->get('email_success')}}</span>
                                </div>
                            </div>
                            @endif
                             @if(session()->has('password_success'))
                             <div class="alert alert-success d-flex align-items-center p-5 ">
                                 <span class="svg-icon svg-icon-2hx svg-icon-success me-4">
                                     <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                         <path opacity="0.3" d="M20.5543 4.37824L12.1798 2.02473C12.0626 1.99176 11.9376 1.99176 11.8203 2.02473L3.44572 4.37824C3.18118 4.45258 3 4.6807 3 4.93945V13.569C3 14.6914 3.48509 15.8404 4.4417 16.984C5.17231 17.8575 6.18314 18.7345 7.446 19.5909C9.56752 21.0295 11.6566 21.912 11.7445 21.9488C11.8258 21.9829 11.9129 22 12.0001 22C12.0872 22 12.1744 21.983 12.2557 21.9488C12.3435 21.912 14.4326 21.0295 16.5541 19.5909C17.8169 18.7345 18.8277 17.8575 19.5584 16.984C20.515 15.8404 21 14.6914 21 13.569V4.93945C21 4.6807 20.8189 4.45258 20.5543 4.37824Z" fill="currentColor"></path>
                                         <path d="M10.5606 11.3042L9.57283 10.3018C9.28174 10.0065 8.80522 10.0065 8.51412 10.3018C8.22897 10.5912 8.22897 11.0559 8.51412 11.3452L10.4182 13.2773C10.8099 13.6747 11.451 13.6747 11.8427 13.2773L15.4859 9.58051C15.771 9.29117 15.771 8.82648 15.4859 8.53714C15.1948 8.24176 14.7183 8.24176 14.4272 8.53714L11.7002 11.3042C11.3869 11.6221 10.874 11.6221 10.5606 11.3042Z" fill="currentColor"></path>
                                     </svg>
                                 </span>
                                 <div class="d-flex flex-column">
                                     <h4 class="mb-1 text-success">İşlem Başarılı.</h4>
                                     <span>{{session()->get('password_success')}}</span>
                                 </div>
                             </div>
                             @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
@endsection
@section('js')
<script src="{{asset('assets/js/custom/account/settings/signin-methods.js')}}"></script>
<script src="{{asset('assets/js/custom/pages/user-profile/general.js')}}"></script>
<script src="{{asset('assets/js/custom/utilities/modals/two-factor-authentication.js')}}"></script>
@endsection
