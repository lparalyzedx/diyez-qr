@extends('back.layouts.master')
@section('title', 'Firma Bilgileri')
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
                        <li class="breadcrumb-item text-muted">Firma Bilgileri</li>
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
                            <h2>Firma Bilgileriniz</h2>
                            <p class="mb-0">Firma bilgilerinizi bu bölümden düzenleyebilirsiniz.</p>
                        </div>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('company_settings.update') }}" enctype="multipart/form-data" class="p-4">
                            @csrf
                            @method('PUT')
                        
                            <div class="row mb-5">
                                <div class="col-12 col-md-6">
                                    <h5 class="mb-0">Firma Logosu</h5>
                                </div>
                                <div class="col-12 col-md-6">
                                    <div class="box border w-100px shadow position-relative">
                                        @if(auth()->user()->account->logo)
                                       <a href="javascript:void(0)" class="btn btn-danger btn-sm position-absolute top-0 start-0 translate-middle rounded-circle p-0 d-flex align-items-center justify-content-center" style="width: 24px; height: 24px;" onclick="deleteLogo()">
                                               &times;
                                        </a>
                                        @endif
                                        <img src="{{ auth()->user()->account->logo ? asset('storage/'.auth()->user()->account->logo) : asset('assets/media/other/gorselyok.png') }}" 
                                         alt="{{ auth()->user()->account->name }}" 
                                         class="img-fluid" 
                                         style="width: 100px;">
                                    </div>
                                    <input class="form-control" type="file" name="logo" id="formFile">
                                </div>
                            </div>
                            <div class="row mb-5">
                                <div class="col-12 col-md-6">
                                    <h5 class="mb-0">Firma Banner</h5>
                                </div>
                                <div class="col-12 col-md-6">
                                    <div class="box border w-100px shadow position-relative">
                                     @if(auth()->user()->account->banner_image)
                                     <a href="javascript:void(0)" 
                                     class="btn btn-danger btn-sm position-absolute top-0 start-0 translate-middle rounded-circle p-0 d-flex align-items-center justify-content-center" 
                                     style="width: 24px; height: 24px;" 
                                     onclick="deleteBanner()">
                                          &times;
                                     </a>
                                    @endif
                                    <img src="{{ auth()->user()->account->banner_image ? asset('storage/'.auth()->user()->account->banner_image) : asset('assets/media/other/gorselyok.png') }}" 
                                    alt="{{ auth()->user()->account->name }}" 
                                    class="img-fluid" 
                                    style="width: 100px;">
                                    </div>
                                    <input class="form-control" type="file" name="banner_image" id="formFile2">
                                </div>
                            </div>
                            <div class="row mb-5">
                                <div class="col-12 col-md-6">
                                    <h5 class="mb-0">Firma Banner Logo</h5>
                                </div>
                                <div class="col-12 col-md-6">
                                    <div class="box border w-100px shadow position-relative">
                                    @if(auth()->user()->account->banner_logo)
                                    <a href="javascript:void(0)" 
                                    class="btn btn-danger btn-sm position-absolute top-0 start-0 translate-middle rounded-circle p-0 d-flex align-items-center justify-content-center" 
                                    style="width: 24px; height: 24px;" 
                                    onclick="deleteBannerLogo()">
                                          &times;
                                    </a>
                                    @endif
                                    <img src="{{ auth()->user()->account->banner_logo ? asset('storage/'.auth()->user()->account->banner_logo) : asset('assets/media/other/gorselyok.png') }}" 
                                    alt="{{ auth()->user()->account->name }}" 
                                    class="img-fluid" 
                                    style="width: 100px;">
                                    </div>
                                    <input class="form-control" type="file" name="banner_logo" id="formFile3">
                                </div>
                            </div>
                            <div class="row mb-5">
                                <div class="col-12 col-md-6">
                                    <h5 class="mb-0">Placeholder</h5>
                                </div>
                                <div class="col-12 col-md-6">
                                 <div class="box border w-100px shadow position-relative">
                                 @if(auth()->user()->account->placeholder_image)
                                 <a href="javascript:void(0)" 
                                 class="btn btn-danger btn-sm position-absolute top-0 start-0 translate-middle rounded-circle p-0 d-flex align-items-center justify-content-center" 
                                 style="width: 24px; height: 24px;" 
                                 onclick="deletePlaceholder()">
                                       &times;
                                 </a>
                                @endif
                                <img src="{{ auth()->user()->account->placeholder_image ? asset('storage/'.auth()->user()->account->placeholder_image) : asset('assets/media/other/gorselyok.png') }}" 
                                alt="{{ auth()->user()->account->name }}" 
                                class="img-fluid" 
                                style="width: 100px;">
                                </div>
                                <input class="form-control" type="file" name="placeholder_image" id="formFile4">
                                </div>
                            </div>
                        
                            <div class="row mb-4">
                                <div class="col-12 col-md-6">
                                    <h5 class="mb-0">Firma Ünvanı</h5>
                                </div>
                                <div class="col-12 col-md-6">
                                    <input class="form-control" type="text" name="name" id="formName" placeholder="Firma Ünvanı" value="{{ old('name') ?? auth()->user()->account->name }}">
                                </div>
                            </div>
                        
                            <div class="row mb-4">
                                <div class="col-12 col-md-6">
                                    <h5 class="mb-0 text-muted">Menü Linki</h5>
                                </div>
                                <div class="col-12 col-md-6">
                                    <input class="form-control" type="text" value="{{config('app.url') . '/menu/'. auth()->user()->account->slug}}" disabled>
                                </div>
                            </div>
                        
                            <div class="row mb-4">
                                <div class="col-12 col-md-6">
                                    <h5 class="mb-0">İl / İlçe</h5>
                                </div>
                                <div class="col-12 col-md-6 row">
                                    <div class="col-12 col-md-6">
                                        <select class="form-select" name="city_id" id="citySelect">
                                            <option selected>İl Seçiniz</option>
                                            @foreach ($cities as $city)
                                                <option @selected(old('city_id') ?? auth()->user()->account->city_id == $city->id) value="{{ $city->id }}" data-id="{{$city->id}}">{{ $city->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-12 col-md-6 mt-3 mt-md-0">
                                        <select class="form-select" name="district_id" id="districtSelect">
                                            <option selected>İlçe Seçiniz</option>
                                            @foreach ($districts as $district)
                                                <option @selected(old('district_id') ?? auth()->user()->account->district_id == $district->id) value="{{ $district->id }}">{{ $district->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                        
                            <div class="row mb-4">
                                <div class="col-12 col-md-6">
                                    <h5 class="mb-0">Firma Adresi</h5>
                                </div>
                                <div class="col-12 col-md-6">
                                    <input class="form-control" type="text" id="formName" name="adress" placeholder="Firma Adresi" value="{{ old('adress') ?? auth()->user()->account->adress }}">
                                </div>
                            </div>
                        
                            <div class="row mb-4">
                                <div class="col-12 col-md-6">
                                    <h5 class="mb-0">Telefon</h5>
                                </div>
                                <div class="col-12 col-md-6">
                                    <input class="form-control" type="text" id="formName" name="phone" placeholder="Telefon" value="{{ old('phone') ?? auth()->user()->account->phone }}">
                                </div>
                            </div>
                        
                            <div class="row mb-4">
                                <div class="col-12 col-md-6">
                                    <h5 class="mb-0">Whatsapp</h5>
                                </div>
                                <div class="col-12 col-md-6">
                                    <input class="form-control" type="text" id="formName" name="whatsapp" placeholder="Whatsapp" value="{{ old('whatsapp') ?? auth()->user()->account->whatsapp }}">
                                </div>
                            </div>

                            <div class="row mb-4">
                                <div class="col-12 col-md-6">
                                    <h5 class="mb-0">Yol Tarifi</h5>
                                </div>
                                <div class="col-12 col-md-6">
                                    <input class="form-control" type="text" id="formName" name="map_url" placeholder="Yol Tarifi" value="{{ old('map_url') ?? auth()->user()->account->map_url }}">
                                </div>
                            </div>
                        
                            <div class="row mb-4">
                                <div class="col-12 col-md-6">
                                    <h5 class="mb-0">Facebook</h5>
                                </div>
                                <div class="col-12 col-md-6">
                                    <input class="form-control" type="text" id="facebook" name="facebook" placeholder="Facebook" value="{{ old('facebook') ?? auth()->user()->account->facebook }}">
                                </div>
                            </div>
                        
                            <div class="row mb-4">
                                <div class="col-12 col-md-6">
                                    <h5 class="mb-0">İnstagram</h5>
                                </div>
                                <div class="col-12 col-md-6">
                                    <input class="form-control" type="text" id="instagram" name="instagram" placeholder="İnstagram" value="{{ old('instagram') ?? auth()->user()->account->instagram }}">
                                </div>
                            </div>
                        
                            <div class="row mb-4">
                                <div class="col-12 col-md-6">
                                    <h5 class="mb-0">Twitter</h5>
                                </div>
                                <div class="col-12 col-md-6">
                                    <input class="form-control" type="text" id="twitter" name="twitter" placeholder="Twitter" value="{{ old('twitter') ?? auth()->user()->account->twitter }}">
                                </div>
                            </div>
                        
                            <div class="row mb-4">
                                <div class="col-12 col-md-6">
                                    <h5 class="mb-0">Website</h5>
                                </div>
                                <div class="col-12 col-md-6">
                                    <input class="form-control" type="text" id="website" name="website" placeholder="Website" value="{{ old('website') ?? auth()->user()->account->website }}">
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
@section('js')
<script>
     $('#citySelect').change(function() {
        const selectedOption = this.options[this.selectedIndex];
         const dataId = $(selectedOption).data('id'); 
            $.ajax({
                type: "POST",
                url: "{{ route('district') }}",
                data: {
                    id: dataId
                },
                success: function(response) {
                    $('#districtSelect').html('');
                    $('#districtSelect').html(
                        '<option value="none" selected disabled hidden>-Seçiniz-</option>');
                    if (response.districts.length > 0) {
                        response.districts.forEach(element => {
                            const opt = document.createElement('option');
                            opt.setAttribute('value', element.id);
                            opt.textContent = element.name;
                            $('#districtSelect').append(opt);
                        });
                    } else {
                        $('#districtSelect').html(
                            '<option value="none" selected disabled hidden>-Seçiniz-</option>');
                    }
                }
            });
        });

        function deleteLogo(){
      Swal.fire({
          title:'Dikkat!',
          text: 'Logoyu kaldırmak istediğinizden emin misiniz?',
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Evet, Kaldır',
          cancelButtonText: 'İptal'
      }).then((result) => {
      if (result.isConfirmed) {
       window.location.href = "{{route('company_settings.removeLogo')}}";
      }
      });
    }
    
    function deleteBanner(){
      Swal.fire({
          title:'Dikkat!',
          text: 'Bannerı kaldırmak istediğinizden emin misiniz?',
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Evet, Kaldır',
          cancelButtonText: 'İptal'
      }).then((result) => {
      if (result.isConfirmed) {
       window.location.href ="{{route('company_settings.removeBanner')}}";
      }
      });
    }
    
    function deleteBannerLogo(){
      Swal.fire({
          title:'Dikkat!',
          text: 'Banner logoyu kaldırmak istediğinizden emin misiniz?',
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Evet, Kaldır',
          cancelButtonText: 'İptal'
      }).then((result) => {
      if (result.isConfirmed) {
       window.location.href = "{{route('company_settings.removeBannerLogo')}}";
      }
      });
    }
    
    
    function deletePlaceholder(){
      Swal.fire({
          title:'Dikkat!',
          text: 'Placeholderı kaldırmak istediğinizden emin misiniz?',
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Evet, Kaldır',
          cancelButtonText: 'İptal'
      }).then((result) => {
      if (result.isConfirmed) {
       window.location.href = "{{route('company_settings.removePlaceholder')}}";
      }
      });
    }
</script>
@endsection
