@extends('back.layouts.master')
@section('title', 'Kategoriler')
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
                        <li class="breadcrumb-item text-muted">Kategoriler</li>
                    </ul>
                </div>
                <div class="d-flex align-items-center gap-2 gap-lg-3">
                    <a href="{{route('categories.list')}}" class="btn btn-sm btn-secondary">Sıralama</a>
                    <a href="{{asset('assets/media/import/kategori_ice_aktarma_sablonu.xlsx')}}" class="btn btn-sm btn-secondary">
                    İçe Aktarma Şablonu
                   </a>
                    <button type="button" class="btn btn-sm btn-secondary" data-bs-toggle="modal"
                        data-bs-target="#staticBackdropImport">
                        İçe Aktar
                    </button>
                    <button type="button" class="btn btn-sm fw-bold btn-primary" data-bs-toggle="modal"
                        data-bs-target="#staticBackdrop">
                        Kategori Oluştur
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
                                <div class="menu-item px-3">
                                    <a href="#" class="menu-link px-3" data-kt-export="csv">
                                        CSV olarak dışa aktarma
                                    </a>
                                </div>
                                <div class="menu-item px-3">
                                    <a href="#" class="menu-link px-3" data-kt-export="pdf">
                                        PDF olarak dışa aktarma
                                    </a>
                                </div>
                            </div>
                            <div id="kt_datatable_example_buttons" class="d-none"></div>
                        </div>
                    </div>
                    <div class="card-body">
                        <table
                            class="table table-striped border rounded table-row-dashed fs-6  px-0 mx-0 overflow-x-scroll"
                            id="kt_datatable_categories">
                            <thead class="py-12 px-2">
                                <tr class="text-gray-700 fw-bold text-uppercase bg-light w-100 px-0 mx-0">
                                    <th class="text-start px-12">Kategori Adı</th>
                                    <th class="text-start px-12">Kategori Yolu</th>
                                    <th class="text-start px-12">Kategori Resmi</th>
                                    <th class="text-start px-12">Ürün Sayısı</th>
                                    <th class="text-start px-12">Durum</th>
                                    <th class="text-end px-12">İşlemler</th>
                                </tr>
                            </thead>
                            <tbody class="fw-semibold text-gray-600" id="sortable">
                                @foreach ($categories as $categorie)
                                    <tr  old-class="row1 ui-state-default" data-id="{{ $categorie->id }}">
                                        <td class="text-start px-md-12 px-12 py-6 categoryNameContent">
                                            <p class="categoryNameText">{{ $categorie->name }}</p>
                                            <input type="text" class="form-control d-none categoryName"
                                                value="{{ $categorie->name }}">
                                        </td>
                                        <td class="text-start px-md-12 px-12 py-6">
                                          <span class="badge badge-sm badge-light-primary"> {{!empty($categorie->real_path) ? $categorie->real_path : '/'}}</span>
                                        </td>
                                        <td class="text-start px-md-12 px-12 py-6">
                                            <img src="{{ $categorie->origin_image }}" width="80px"
                                                height="50px" class=" object-fit-contain" alt="{{ $categorie->name }}">
                                        </td>
                                        <td class="text-start px-md-12 px-12 py-6">
                                            {{ $categorie->products_count }}
                                        </td>
                                        <td class="text-start px-md-12 px-12 py-6 categoryStatusContent">
                                            <div class="form-check form-switch">
                                                <input class="form-check-input categoryStatus" type="checkbox"
                                                    @checked($categorie->status) role="switch">
                                            </div>
                                        </td>
                                        <td class="text-end px-md-12 px-12 py-4">
                                            <div class="text-start">
                                                <div class="d-flex align-items-center justify-content-end">
                                                     <a href="{{route('products.list',$categorie->id)}}"
                                                        class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1 bg-gray-200i">
                                                        <span class="svg-icon svg-icon-3">
                                                            <svg width="16" height="15" viewBox="0 0 16 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                  <rect y="6" width="16" height="3" rx="1.5" fill="currentColor"/>
                                                                  <rect opacity="0.3" y="12" width="8" height="3" rx="1.5" fill="currentColor"/>
                                                                  <rect opacity="0.3" width="12" height="3" rx="1.5" fill="currentColor"/>
                                                            </svg>
                                                        </span>
                                                    </a>
                                                    <a onclick="modal({{ $categorie->id }})"
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
                                                    <a onclick="deleteCategorie('{{ route('categories.delete', $categorie->id) }}')"
                                                        class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm bg-gray-200i">
                                                        <span class="svg-icon svg-icon-3"><svg width="24"
                                                                height="24" viewBox="0 0 24 24" fill="none"
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
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="staticBackdropImport" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">İçe Aktar</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" action="{{ route('categories.import') }}" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="file-drop-area @error('xlsx') border-danger @enderror">
                        <span class="fake-btn">Dosya Seçin</span>
                        <span class="file-msg">Veya sürükleyip bırakın.</span>
                        <input class="file-input" type="file" name="xlsx" accept=".xlsx" required>
                    </div>
                    @error('xlsx')
                    <div class="invalid-feedback d-block text-danger f-11">{{ $message }}
                    </div>
                    @enderror
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">İptal Et</button>
                    <button type="submit" class="btn btn-success">İçe Aktar</button>
                </div>
            </form>
        </div>
    </div>
    </div>
    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Kategori Oluştur</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="POST" action="{{ route('categories.store') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="row mb-3">
                            <div class="col-12">
                                <label for="example1" class="form-label">Kategori Adı</label>
                                <input type="text" class="form-control @error('name') border-danger @enderror"
                                    name="name" id="example1" value="{{ old('name') }}" required>
                                @error('name')
                                    <div class="invalid-feedback d-block text-danger f-11">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-12">
                                <label for="example2" class="form-label">Kategori Resmi</label>
                                <input type="file" class="form-control" name="image" id="example2" required>
                                @error('image')
                                    <div class="invalid-feedback d-block text-danger f-11">{{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="example3" class="form-label">Üst Kategori</label>
                            <select class="form-select form-select-lg @error('categorie_id') border-danger @enderror" name="categorie_id"
                                id="example3" data-dropdown-parent="#staticBackdrop" data-control="select2" data-placeholder="Kategori Seçiniz" data-allow-clear="true">
                                <option value="0">Üst Kategori Seçiniz</option>
                                @foreach ($categories as $categorie)
                                    <option value="{{ $categorie->id }}">{{ $categorie->path }}</option>
                                @endforeach
                            </select>
                            @error('categorie_id')
                                <div class="invalid-feedback d-block text-danger f-11">{{ $message }}
                                </div>
                            @enderror
                        </div>
                        
                        <div class="mb-3">
                            <label for="example4" class="form-label">Boyut</label>
                            <select class="form-select @error('width') border-danger @enderror" name="width"
                                id="example4">
                                <option value="100" selected>%100</option>
                                <option value="75">%75</option>
                                <option value="50">%50</option>
                                <option value="25">%25</option>
                            </select>
                            @error('width')
                                <div class="invalid-feedback d-block text-danger f-11">{{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <div class="row gap-3">
                                <div class="col-auto">
                                    <label for="example5" class="form-label">Durum</label>
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" name="status" type="checkbox" checked
                                            role="switch" @checked(old('status')) id="example5">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">İptal Et</button>
                        <button type="submit" class="btn btn-success">Oluştur</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="modal fade" id="staticBackdrop2" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Kategori Güncelle</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="POST" id="category_update_form" enctype="multipart/form-data">
                    @method('PUT')
                    @csrf
                    <div class="modal-body">
                        <div class="row mb-3">
                            <div class="col-12">
                                <label for="update_name" class="form-label">Kategori Adı</label>
                                <input type="text" class="form-control @error('update_name') border-danger @enderror"
                                    name="update_name" id="update_name" value="{{ old('update_name') }}"
                                    id="update_name" required>
                                @error('update_name')
                                    <div class="invalid-feedback d-block text-danger f-11">{{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-12">
                                <label for="update_image" class="form-label">Kategori Resmi</label>
                                <br>
                                <img id="categorie_image" class="img-fluid border" width="100px">
                                <input type="file" class="form-control" name="update_image" id="update_image">
                                @error('update_image')
                                    <div class="invalid-feedback d-block text-danger f-11">{{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="update_categorie_id" class="form-label">Üst Kategori</label>
                            <select class="form-select form-select-lg @error('update_categorie_id') border-danger @enderror"
                                name="update_categorie_id" id="update_categorie_id" data-dropdown-parent="#staticBackdrop2" data-control="select2" data-placeholder="Kategori Seçiniz" data-allow-clear="true">
                                <option value="0">Üst Kategori Seçiniz</option>
                                @foreach ($categories as $categorie)
                                    <option value="{{ $categorie->id }}">{{ $categorie->path }}</option>
                                @endforeach
                            </select>
                            @error('update_categorie_id')
                                <div class="invalid-feedback d-block text-danger f-11">{{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="update_width" class="form-label">Boyut</label>
                            <select class="form-select @error('update_width') border-danger @enderror" name="update_width"
                                id="update_width">
                                <option value="100">%100</option>
                                <option value="75">%75</option>
                                <option value="50">%50</option>
                                <option value="25">%25</option>
                            </select>
                            @error('update_width')
                                <div class="invalid-feedback d-block text-danger f-11">{{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <div class="row gap-3">
                                <div class="col-auto">
                                    <label for="update_status" class="form-label">Durum</label>
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" name="update_status" type="checkbox"
                                            role="switch" @checked(old('update_status')) id="update_status">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">İptal Et</button>
                        <button type="submit" class="btn btn-success">Güncelle</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@section('js')
<script src="{{asset('assets/js/file.js')}}"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
    const table = $('#kt_datatable_categories').DataTable({
        "info": true,
            'order': [],
            'pageLength': 10,
            "columnDefs": [{
                "targets": -1,
                "orderable": false
            }],
            "language": {
                "info": "Gösterilen _START_  / _END_ Toplam Kayıt",
                "infoEmpty": "Gösterilecek Kayıt Bulunamadı.",
                "infoFiltered": "(_MAX_ Kayıt Arasında Arandı.)"
            },
            responsive:true,
             buttons: [
            {
                extend: 'copyHtml5',
                 exportOptions: {
                 columns: ':visible:not(:last)',
                  format: {
            body: function (data, row, column, node) {
               
                if ($(node).find('input[type="checkbox"]').length > 0) {
                    return $(node).find('input[type="checkbox"]').is(':checked') ? 'Aktif' : 'Pasif';
                }
                
               
                if ($(node).find('img').length > 0) {
                    return  $(node).find('img').attr('src');
                }
                
               
                return $(data).text() || data;
            }
        }
    },
                className: 'btn btn-light-primary me-3'
            },
            {
                extend: 'excelHtml5',
                 exportOptions: {
                 columns: ':visible:not(:last)',
                  format: {
            body: function (data, row, column, node) {
               
                if ($(node).find('input[type="checkbox"]').length > 0) {
                    return $(node).find('input[type="checkbox"]').is(':checked') ? 'Aktif' : 'Pasif';
                }
                
               
                if ($(node).find('img').length > 0) {
                    return  $(node).find('img').attr('src');
                }
                
               
                return $(data).text() || data;
            }
        }
    },
                className: 'btn btn-light-success me-3'
            },
            {
                extend: 'csvHtml5',
                 exportOptions: {
                 columns: ':visible:not(:last)',
                  format: {
            body: function (data, row, column, node) {
               
                if ($(node).find('input[type="checkbox"]').length > 0) {
                    return $(node).find('input[type="checkbox"]').is(':checked') ? 'Aktif' : 'Pasif';
                }
                
               
                if ($(node).find('img').length > 0) {
                    return  $(node).find('img').attr('src');
                }
                
               
                return $(data).text() || data;
            }
        }
    },
                className: 'btn btn-light-success me-3'
            },
            {
                extend: 'pdfHtml5',
                 exportOptions: {
                 columns: ':visible:not(:last)',
                  format: {
            body: function (data, row, column, node) {
               
                if ($(node).find('input[type="checkbox"]').length > 0) {
                    return $(node).find('input[type="checkbox"]').is(':checked') ? 'Aktif' : 'Pasif';
                }
                
               
                if ($(node).find('img').length > 0) {
                    return  $(node).find('img').attr('src');
                }
                
               
                return $(data).text() || data;
            }
        }
    },
                className: 'btn btn-light-success me-3'
            },
            
        ],
    });
    

    $('[data-kt-filter="search"]').on('keyup', function() {
        table.search($(this).val()).draw();
    });

    $('#kt_datatable_example_export_menu [data-kt-export]').on('click', function(e) {
        e.preventDefault();
        const exportType = $(this).data('kt-export');
        
        switch(exportType) {
            case 'copy':
                table.button('.buttons-copy').trigger();
                break;
            case 'excel':
                table.button('.buttons-excel').trigger();
                break;
            case 'csv':
                table.button('.buttons-csv').trigger();
                break;
            case 'pdf':
                table.button('.buttons-pdf').trigger();
                break;
        }
    });


    function setupRowEvents() {
        const rows = document.querySelectorAll('tbody tr');

        rows.forEach(row => {
            const categoryId = row.getAttribute('data-id');

            const categoryNameContent = row.querySelector('.categoryNameContent');
            const categoryNameText = row.querySelector('.categoryNameText');
            const categoryName = row.querySelector('.categoryName');

            let originalNameValue = categoryName.value;

            if (categoryNameContent && categoryNameText && categoryName) {
                categoryNameContent.addEventListener('click', function(event) {
                    event.stopPropagation();
                    categoryNameText.classList.add('d-none');
                    categoryName.classList.remove('d-none');
                    categoryName.classList.add('d-block');
                    categoryName.focus();
                });

                document.addEventListener('click', function(event) {
                    if (categoryName.classList.contains('d-block') &&
                        event.target !== categoryName &&
                        !categoryName.contains(event.target) &&
                        event.target !== categoryNameContent &&
                        !categoryNameContent.contains(event.target)) {

                        const newValue = categoryName.value;

                        if (newValue !== originalNameValue) {
                            updateCategoryName(newValue, categoryId);
                            originalNameValue = newValue;
                        }

                        categoryNameText.classList.remove('d-none');
                        categoryName.classList.add('d-none');
                        categoryName.classList.remove('d-block');
                    }
                });

                categoryName.addEventListener('click', function(event) {
                    event.stopPropagation();
                });
            }

            const categoryStatus = row.querySelector('.categoryStatus');
            let originalStatusValue = categoryStatus.checked ? 1 : 0;

            if (categoryStatus) {
                categoryStatus.addEventListener('change', function() {
                    const newStatus = categoryStatus.checked ? 1 : 0;

                    if (newStatus !== originalStatusValue) {
                        updateCategoryStatus(newStatus, categoryId);
                        originalStatusValue = newStatus;
                    }
                });
            }
        });
    }

    setupRowEvents();

    table.on('draw', function() {
        setupRowEvents();
    });

    function updateCategoryName(newName, categoryId) {
        var token = $('meta[name="csrf-token"]').attr('content');
        var Ajaxurl = '{{ route('categories.updateName', ':categoryId') }}';
        Ajaxurl = Ajaxurl.replace(':categoryId', categoryId);

        $.ajax({
            type: "POST",
            url: Ajaxurl,
            dataType: "json",
            data: {
                name: newName,
                _token: token
            },
            success: function(response) {
                if (response.success) {
                    console.log('Başarılı:', response.message);
                    document.querySelector(`tr[data-id="${categoryId}"] .categoryNameText`)
                        .textContent = response.category.name;
                } else {
                    console.error('Başarısız:', response.message);
                }
            },
            error: function(xhr) {
                console.error('Hata:', xhr.responseText);
            }
        });
    }

    function updateCategoryStatus(newStatus, categoryId) {
        var token = $('meta[name="csrf-token"]').attr('content');
        var Ajaxurl = '{{ route('categories.updateStatus', ':categoryId') }}';
        Ajaxurl = Ajaxurl.replace(':categoryId', categoryId);

        $.ajax({
            type: "POST",
            url: Ajaxurl,
            dataType: "json",
            data: {
                status: newStatus,
                _token: token
            },
            success: function(response) {
                if (response.success) {
                    console.log('Başarılı:', response.message);
                } else {
                    console.error('Başarısız:', response.message);
                }
            },
            error: function(xhr) {
                console.error('Hata:', xhr.responseText);
            }
        });
    }
});

        function modal(id) {
            localStorage.setItem('id', id);
            var Ajaxurl = '{{ route('categories.show', ':id') }}';
            Ajaxurl = Ajaxurl.replace(':id', id);
            var url = '{{ route('categories.update', ':id') }}';
            url = url.replace(':id', id);
            $.ajax({
                type: "get",
                url: Ajaxurl,
                data: {
                    id: id
                },
                success: function(response) {
                    $('#update_name').val(response.category.name);
                    var categorySelect = $('#update_categorie_id').select2();
                    categorySelect.find('option').each(function() {
                         var optionValue = $(this).val();
                         if (optionValue == response.category.categorie_id) {
                             $(this).prop('selected', true);
                               categorySelect.trigger('change');
                          }
                    });
                    $('#update_width').val(response.category.width ?? 1);
                    $('#categorie_image').attr('src', response.category.origin_image);
                    $('#update_status').attr('checked', response.category.status == 1 ? true : false);
                    $('#category_update_form').attr('action', url);
                    $('#staticBackdrop2').modal('show');
                }
            });
        }

        function deleteCategorie(url) {
            Swal.fire({
                title: 'Dikkat',
                text: 'Kategoriyi silmek istediğinizden emin misiniz?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Evet, Sil',
                cancelButtonText: 'İptal'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = url;
                }
            });
        }

    </script>
    @if (array_intersect($modals['create'], $errors->keys()))
        <script>
            $(document).ready(() => {
                setTimeout(() => {
                    $('#staticBackdrop').modal('show');
                }, 500);
            });
        </script>
    @endif
    @if (array_intersect($modals['import'], $errors->keys()))
    <script>
        $(document).ready(() => {
            setTimeout(() => {
                $('#staticBackdropImport').modal('show');
            }, 500);
        });
    </script>
@endif
    @if (array_intersect($modals['edit'], $errors->keys()))
        <script>
            $(document).ready(() => {
                var url = '{{ route('categories.update', ':id') }}';
                url = url.replace(':id', localStorage.getItem('id'));
                $('#category_update_form').attr('action', url);
                setTimeout(function() {
                    $("#staticBackdrop2").modal("show");
                }, 500);
            });
        </script>
    @endif
@endsection
