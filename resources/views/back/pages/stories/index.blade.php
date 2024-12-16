@extends('back.layouts.master')
@section('title', 'Storyler')
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
                        <li class="breadcrumb-item text-muted">Storyler</li>
                    </ul>
                </div>
                <div class="d-flex align-items-center gap-2 gap-lg-3">
                    <button type="button" class="btn btn-sm fw-bold btn-primary" data-bs-toggle="modal"
                        data-bs-target="#staticBackdrop">
                        Story Oluştur
                    </button>
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
                        <div class="card-title">
                            <div class="d-flex align-items-center position-relative my-1">
                                <span class="svg-icon svg-icon-1 position-absolute ms-4">
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <rect opacity="0.5" x="17.0365" y="15.1223" width="8.15546" height="2"
                                            rx="1" transform="rotate(45 17.0365 15.1223)" fill="currentColor">
                                        </rect>
                                        <path
                                            d="M11 19C6.55556 19 3 15.4444 3 11C3 6.55556 6.55556 3 11 3C15.4444 3 19 6.55556 19 11C19 15.4444 15.4444 19 11 19ZM11 5C7.53333 5 5 7.53333 5 11C5 14.4667 7.53333 17 11 17C14.4667 17 17 14.4667 17 11C17 7.53333 14.4667 5 11 5Z"
                                            fill="currentColor"></path>
                                    </svg>
                                </span>
                                <input type="text" data-kt-filter="search"
                                    class="form-control form-control-sm form-control-solid md-w-250px w-200px ps-14"
                                    placeholder="Ara.." />
                            </div>
                            <div id="kt_datatable_example_1_export" class="d-none"></div>
                        </div>
                        <div class="card-toolbar flex-row-fluid justify-content-end gap-5 d-none d-md-grid">
                            <button type="button" class="btn btn-sm btn-light-primary" data-kt-menu-trigger="click"
                                data-kt-menu-placement="bottom-end">
                                <span class="svg-icon svg-icon-2"><svg width="24" height="24" viewBox="0 0 24 24"
                                        fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <rect opacity="0.3" width="12" height="2" rx="1"
                                            transform="matrix(0 -1 -1 0 12.75 19.75)" fill="currentColor"></rect>
                                        <path
                                            d="M12.0573 17.8813L13.5203 16.1256C13.9121 15.6554 14.6232 15.6232 15.056 16.056C15.4457 16.4457 15.4641 17.0716 15.0979 17.4836L12.4974 20.4092C12.0996 20.8567 11.4004 20.8567 11.0026 20.4092L8.40206 17.4836C8.0359 17.0716 8.0543 16.4457 8.44401 16.056C8.87683 15.6232 9.58785 15.6554 9.9797 16.1256L11.4427 17.8813C11.6026 18.0732 11.8974 18.0732 12.0573 17.8813Z"
                                            fill="currentColor"></path>
                                        <path opacity="0.3"
                                            d="M18.75 15.75H17.75C17.1977 15.75 16.75 15.3023 16.75 14.75C16.75 14.1977 17.1977 13.75 17.75 13.75C18.3023 13.75 18.75 13.3023 18.75 12.75V5.75C18.75 5.19771 18.3023 4.75 17.75 4.75L5.75 4.75C5.19772 4.75 4.75 5.19771 4.75 5.75V12.75C4.75 13.3023 5.19771 13.75 5.75 13.75C6.30229 13.75 6.75 14.1977 6.75 14.75C6.75 15.3023 6.30229 15.75 5.75 15.75H4.75C3.64543 15.75 2.75 14.8546 2.75 13.75V4.75C2.75 3.64543 3.64543 2.75 4.75 2.75L18.75 2.75C19.8546 2.75 20.75 3.64543 20.75 4.75V13.75C20.75 14.8546 19.8546 15.75 18.75 15.75Z"
                                            fill="currentColor"></path>
                                    </svg>
                                </span>
                                Dışa aktar
                            </button>
                            <div id="kt_datatable_example_export_menu"
                                class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-200px py-4"
                                data-kt-menu="true">
                                <div class="menu-item px-3">
                                    <a href="#" class="menu-link px-3" data-kt-export="copy">
                                        Panoya Kopyala
                                    </a>
                                </div>
                                <div class="menu-item px-3">
                                    <a href="#" class="menu-link px-3" data-kt-export="excel">
                                        Excel olarak dışa aktarma
                                    </a>
                                </div>
                            </div>
                            <div id="kt_datatable_example_buttons" class="d-none"></div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row mb-5">
                            <div class="col-sm-12 col-lg-6 col-xl-4">
                                <label for="restaurantSelect" class="form-label">Restaurant</label>
                                <select class="form-select form-select-lg" id="restaurantSelect">
                                    <option selected>Tümü</option>
                                    <option value="vitrin">Vitrin</option>
                                </select>
                            </div>
                            <div class="col-sm-12 col-lg-6 col-xl-4">
                                <label for="activetedSelect" class="form-label">Aktiflik Durumu</label>
                                <select class="form-select form-select-lg" id="activetedSelect">
                                    <option selected>Bir seçenek seçin</option>
                                    <option value="aktif">Aktif</option>
                                    <option value="pasif">Pasif</option>
                                </select>
                            </div>
                            <div class="col-sm-12 col-lg-6 col-xl-4">
                                <button type="button" class="btn btn-sm fw-bold btn-danger w-100"
                                    style="padding: 13px 0; margin-top: 27px;" data-bs-toggle="modal"
                                    data-bs-target="#kt_modal_create_restaurant">Filtreleri Sıfırla</button>
                            </div>
                        </div>
                        <table
                            class="table table-striped border rounded table-row-dashed fs-6  px-0 mx-0 overflow-x-scroll"
                            id="kt_datatable_example">
                            <thead class="py-12 px-2">
                                <tr class="text-gray-700 fw-bold text-uppercase bg-light w-100 px-0 mx-0">
                                    <th class="text-start px-12">
                                        <div class="form-check pl-23px">
                                            <input class="form-check-input" type="checkbox" id="headerCheckbox">
                                        </div>
                                    </th>
                                    <th class="text-start px-12">Story Fotoğrafı</th>
                                    <th class="text-start px-12">Story Adı</th>
                                    <th class="text-start px-12">Restaurant Adı</th>
                                    <th class="text-start px-12">Yayından Kalkma Tarihi</th>
                                    <th class="text-start px-12">Aktif</th>
                                    <th class="text-end px-12">İşlemler</th>
                                </tr>
                            </thead>
                            <tbody class="fw-semibold text-gray-600">
                                <tr>
                                    <td class="text-start px-md-10 px-12 py-6">
                                        <div class="form-check">
                                            <input class="form-check-input select-row" type="checkbox">
                                        </div>
                                    </td>
                                    <td class="text-start px-md-10 px-12 py-6">
                                        <img src="https://www.superprof.com.tr/blog/wp-content/uploads/2020/02/fotograf-cekme-ipuclari.jpg"
                                            width="150" height="150" class="rounded object-fit-cover">
                                    </td>
                                    <td class="text-start px-md-10 px-12 py-6">
                                        Deneme 1
                                    </td>
                                    <td class="text-start px-md-10 px-12 py-6">
                                        Vitrin
                                    </td>
                                    <td class="text-start px-md-10 px-12 py-6">
                                        30/07/2024
                                    </td>
                                    <td class="text-start px-md-10 px-12 py-6">
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" type="checkbox" role="switch">
                                        </div>
                                    </td>
                                    <td class="text-end px-md-12 px-12 py-4">
                                        <div class="text-start">
                                            <div class="d-flex align-items-center justify-content-end">
                                                <a onclick="modal(1)"
                                                    class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1 bg-gray-200i">
                                                    <span class="svg-icon svg-icon-3">
                                                        <svg width="24" height="24" viewBox="0 0 24 24"
                                                            fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <path opacity="0.3"
                                                                d="M21.4 8.35303L19.241 10.511L13.485 4.755L15.643 2.59595C16.0248 2.21423 16.5426 1.99988 17.0825 1.99988C17.6224 1.99988 18.1402 2.21423 18.522 2.59595L21.4 5.474C21.7817 5.85581 21.9962 6.37355 21.9962 6.91345C21.9962 7.45335 21.7817 7.97122 21.4 8.35303ZM3.68699 21.932L9.88699 19.865L4.13099 14.109L2.06399 20.309C1.98815 20.5354 1.97703 20.7787 2.03189 21.0111C2.08674 21.2436 2.2054 21.4561 2.37449 21.6248C2.54359 21.7934 2.75641 21.9115 2.989 21.9658C3.22158 22.0201 3.4647 22.0084 3.69099 21.932H3.68699Z"
                                                                fill="currentColor"></path>
                                                            <path
                                                                d="M5.574 21.3L3.692 21.928C3.46591 22.0032 3.22334 22.0141 2.99144 21.9594C2.75954 21.9046 2.54744 21.7864 2.3789 21.6179C2.21036 21.4495 2.09202 21.2375 2.03711 21.0056C1.9822 20.7737 1.99289 20.5312 2.06799 20.3051L2.696 18.422L5.574 21.3ZM4.13499 14.105L9.891 19.861L19.245 10.507L13.489 4.75098L4.13499 14.105Z"
                                                                fill="currentColor"></path>
                                                        </svg>
                                                    </span>
                                                </a>
                                                <a onclick="deleteRestaurant(1)"
                                                    class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm bg-gray-200i">
                                                    <span class="svg-icon svg-icon-3"><svg width="24" height="24"
                                                            viewBox="0 0 24 24" fill="none"
                                                            xmlns="http://www.w3.org/2000/svg">
                                                            <path
                                                                d="M5 9C5 8.44772 5.44772 8 6 8H18C18.5523 8 19 8.44772 19 9V18C19 19.6569 17.6569 21 16 21H8C6.34315 21 5 19.6569 5 18V9Z"
                                                                fill="currentColor"></path>
                                                            <path opacity="0.5"
                                                                d="M5 5C5 4.44772 5.44772 4 6 4H18C18.5523 4 19 4.44772 19 5V5C19 5.55228 18.5523 6 18 6H6C5.44772 6 5 5.55228 5 5V5Z"
                                                                fill="currentColor"></path>
                                                            <path opacity="0.5"
                                                                d="M9 4C9 3.44772 9.44772 3 10 3H14C14.5523 3 15 3.44772 15 4V4H9V4Z"
                                                                fill="currentColor"></path>
                                                        </svg>
                                                    </span>
                                                </a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Story Oluştur</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="example1" class="form-label">Story Adı</label>
                        <input type="text" class="form-control" id="example1">
                    </div>
                    <div class="mb-3">
                        <label for="example2" class="form-label">Kapak Fotoğrafı</label>
                        <input type="file" class="form-control" id="example2">
                    </div>
                    <div class="mb-3">
                        <label for="example3" class="form-label">Yayından Kaldırılıcağı Gün</label>
                        <input type="date" class="form-control" id="example3">
                    </div>
                    <div class="mb-3">
                        <label for="example5" class="form-label">Restaurant</label>
                        <select class="form-select" id="example5">
                            <option selected>Restaurant Seçiniz</option>
                            <option value="1">One</option>
                            <option value="2">Two</option>
                            <option value="3">Three</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="example4" class="form-label">Aktif</label>
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" role="switch" id="example4">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">İptal Et</button>
                    <button type="button" class="btn btn-success">Oluştur</button>
                </div>
            </div>
        </div>
    </div>

@endsection
@section('js')
    <script src="{{ asset('assets/js/datatable.js') }}"></script>
    <script>
        document.getElementById('headerCheckbox').addEventListener('change', function() {
            const isChecked = this.checked;
            const checkboxes = document.querySelectorAll('#kt_datatable_example tbody .select-row');
            checkboxes.forEach(checkbox => checkbox.checked = isChecked);
        });
    </script>
@endsection
