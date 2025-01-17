@extends('back.layouts.master')
@section('title', 'Ürünler')
@section('content')
@php
    $locale = app()->getLocale();
@endphp
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
                        <li class="breadcrumb-item text-muted">Ürünler</li>
                    </ul>
                </div>
                <div class="d-flex align-items-center gap-2 gap-lg-3">
                    <button type="button" class="btn btn-sm btn-success" data-bs-toggle="modal" data-bs-target="#staticBackdropPrice">
                       Toplu Fiyat Güncelle
                    </button>
                    <a href="{{asset('assets/media/import/urun-ice-aktarma-sablonu.xlsx')}}" class="btn btn-sm btn-secondary">
                        İçe Aktarma Şablonu
                    </a>
                    <button type="button" class="btn btn-sm btn-secondary" data-bs-toggle="modal" data-bs-target="#staticBackdropImport">
                        İçe Aktar
                    </button>
                    <button type="button" class="btn btn-sm fw-bold btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                        Ürün Oluştur
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
                    <div class="card-body" id="filters">
                        <form method="GET" action="{{ route('products.index') }}">
                            <div class="row mb-5">
                                <div class="col-sm-12 col-lg-6 col-xl-3 py-lg-0 mt-5 mt-sm-0">
                                    <label for="categorySelect" class="form-label">Kategori</label>
                                    <select class="form-select form-select-lg" id="categorySelect" name="category">
                                        <option value="">Kategori Seçiniz</option>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}"
                                                {{ request('category') == $category->id ? 'selected' : '' }}>
                                                {{ $category->path }}</option>
                                            @foreach($category->childs as $child)
                                            <option value="{{ $child->id }}"
                                                {{ request('category') == $child->id ? 'selected' : '' }}>
                                                {{ $child->path }}</option>
                                              @foreach($child->childs as $subchild)
                                                 <option value="{{ $subchild->id }}"
                                                {{ request('category') == $subchild->id ? 'selected' : '' }}>
                                                {{ $subchild->path }}</option>
                                              @endforeach
                                            @endforeach
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-sm-12 col-lg-6 col-xl-3 py-lg-0 mt-5 mt-sm-0">
                                    <label for="activetedSelect" class="form-label">Aktiflik Durumu</label>
                                    <select class="form-select form-select-lg" id="activetedSelect" name="status">
                                        <option value="">Bir seçenek seçin</option>
                                        <option value="1" {{ request('status') == '1' ? 'selected' : '' }}>Aktif
                                        </option>
                                        <option value="2" {{ request('status') == '2' ? 'selected' : '' }}>Pasif
                                        </option>
                                    </select>
                                </div>
                                <div class="col-sm-12 col-lg-6 col-xl-3 py-lg-0 mt-5 mt-sm-0">
                                    <label for="priceSelect" class="form-label">Fiyat</label>
                                    <select class="form-select form-select-lg" id="priceSelect" name="price_filter">
                                        <option value="">Bir seçenek seçin</option>
                                        <option value="small" {{ request('price_filter') == 'small' ? 'selected' : '' }}>
                                            Küçükten Büyüğe</option>
                                        <option value="big" {{ request('price_filter') == 'big' ? 'selected' : '' }}>
                                            Büyükten Küçüğe
                                        </option>
                                    </select>
                                </div>
                                <div class="col-sm-12 col-lg-6 col-xl-3 row m-0 p-0">
                                    <div class="col-12 col-md-6">
                                        <button type="submit" class="btn btn-sm fw-bold btn-danger w-100"
                                            style="padding: 15px 0; margin-top: 27px;">Filtrele</button>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <a href="{{ route('products.index') }}"
                                            class="btn btn-sm fw-bold btn-secondary w-100"
                                            style="padding: 15px 0; margin-top: 27px;">Filtreleri Sıfırla</a>
                                    </div>
                                </div>
                            </div>
                        </form>

                        <table
                            class="kt_datatable_example table table-striped border rounded table-row-dashed fs-6  px-0 mx-0 overflow-x-scroll"
                            id="kt_datatable_products">
                            <thead class="py-12 px-2">
                                <tr class="text-gray-700 fw-bold text-uppercase bg-light w-100 px-0 mx-0">
                                    <th class="text-start px-12">Ürün Adı</th>
                                    <th class="text-start px-12">Ürün Resimleri</th>
                                    <th class="text-start px-12">Fiyat</th>
                                    <th class="text-start px-12">Kategori Adı</th>
                                    <th class="text-start px-12">Durum</th>
                                    <th class="text-start px-12">Varyant</th>
                                    <th class="text-end px-12">İşlemler</th>
                                </tr>
                            </thead>
                            <tbody class="fw-semibold text-gray-600" id="tablecontents">
                                @foreach ($products as $product)
                                    <tr old-class="row1" data-id="{{ $product->id }}" data-category-id="{{$product->category->id}}">
                                        <td class="text-start px-md-12 px-12 py-6 productNameContent">
                                            <p class="productNameText">{{ $product->name }}</p>
                                            <input type="text" class="form-control d-none productName"
                                                value="{{ $product->name }}">
                                        </td>
                                        <td class="text-start px-md-12 px-12 py-6">
                                            <div class="position-relative">
                                                @if($product->images)
                                                   <a href="javascript:void(0)" 
                                                       class="btn btn-danger btn-sm position-absolute top-0 start-0 translate-middle rounded-circle p-0 d-flex align-items-center justify-content-center" 
                                                       style="width: 24px; height: 24px;" 
                                                       onclick="deleteImage('{{route('products.deleteImage',$product->id)}}')">
                                                       &times;
                                                   </a>
                                                @endif
                                                    <img src="{{ $product->origin_image }}" alt="{{ $product->name }}"
                                                       class="object-fit-cover" width="100px" height="60px">
                                               </div>
                                        </td>
                                        <td class="text-start px-md-12 px-12 py-6 productPriceContent">
                                            <p class="productPriceText d-block">
                                                {{ number_format($product->price,2) ?? '-' }}{{ $product->currency }}</p>
                                            <input type="text" class="form-control d-none productPrice"
                                                placeholder="Ürün Fiyatı: 119.00" value="{{ number_format($product->price,2) }}">
                                        </td>
                                        <td class="text-start px-md-12 px-12 py-6 categoryContent">
                                            <p class="categoryText">{{ str()->limit($product->category->name, 50) }}</p>
                                            <select class="form-control d-none categorySelect"></select>
                                        </td>
                                        <td class="text-start px-md-12 px-12 py-6 productStatusContent">
                                            <div class="form-check form-switch">
                                                <input class="form-check-input productStatus" type="checkbox"
                                                    @checked($product->status) role="switch">
                                            </div>
                                        </td>
                                        <td class="text-start px-md-12 px-12 py-6">
                                            <span class="badge badge-sm badge-light-{{$product->is_variant ? 'success' : 'danger'}}">{{$product->is_variant ? 'Evet' : 'Hayır'}}</span>    
                                        </td>
                                        <td class="text-end px-md-12 px-12 py-4">
                                            <div class="text-start">
                                                <div class="d-flex align-items-center justify-content-end">
                                                  <!--
                                                      <a href="{{route('variants.index',$product->id)}}"
                                                        class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1 bg-gray-200i">
                                                        <span class="svg-icon svg-icon-3">
                                                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                <path opacity="0.3" d="M3 13V11C3 10.4 3.4 10 4 10H20C20.6 10 21 10.4 21 11V13C21 13.6 20.6 14 20 14H4C3.4 14 3 13.6 3 13Z" fill="currentColor"/>
                                                                <path d="M13 21H11C10.4 21 10 20.6 10 20V4C10 3.4 10.4 3 11 3H13C13.6 3 14 3.4 14 4V20C14 20.6 13.6 21 13 21Z" fill="currentColor"/>
                                                                </svg>
                                                        </span>
                                                    </a> -->
                                                    <a onclick="modal({{ $product->id }})"
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
                                                    <a onclick="deleteProduct('{{ route('products.delete', $product->id) }}')"
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

    <div class="modal fade" id="staticBackdropImport" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">İçe Aktar</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="POST" action="{{ route('products.import') }}" enctype="multipart/form-data">
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

    <div class="modal fade" id="staticBackdropPrice" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Toplu Fiyat Güncelle</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" action="{{ route('products.updateprices') }}" enctype="multipart/form-data">
               @csrf
               <div class="modal-body">
                <div class="row mb-3">
                    <div class="col-12">
                        <label for="categorie_ids" class="form-label">Kategoriler</label>
                        <select class="form-select @error('categorie_ids') border-danger @enderror"
                            name="categorie_ids[]" id="categorie_ids" data-dropdown-parent="#staticBackdropPrice"
                            data-control="select2" data-placeholder="Kategori Seçiniz" data-allow-clear="true"
                            multiple>
                            <option value="0" disabled>Kategori Seçiniz</option>
                            @foreach ($categories as $categorie)
                                <option value="{{ $categorie->id }}" @if (is_array(old('categorie_ids')) && in_array($categorie->id, old('categorie_ids'))) selected @endif>
                                    {{ $categorie->path }}
                                </option>
                                @foreach ($categorie->childs as $child)
                                    <option value="{{ $child->id }}" @if (is_array(old('categorie_ids')) && in_array($child->id, old('categorie_ids'))) selected @endif>
                                        {{ $child->path }}
                                    </option>
                                    @foreach ($child->childs as $subchild)
                                        <option value="{{ $subchild->id }}" @if (is_array(old('categorie_ids')) && in_array($subchild->id, old('categorie_ids'))) selected @endif>
                                            {{ $subchild->path }}
                                        </option>
                                    @endforeach
                                @endforeach
                            @endforeach
                        </select>
                        <p class="my-4 text-muted">Kategori seçilmezse tüm ürünler güncellenecektir.</p>
                        @error('categorie_ids')
                            <div class="invalid-feedback d-block text-danger f-11">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-6">
                        <label for="update_type" class="form-label mb-4">Güncelleme Tipi <span
                                class="text-danger text-medium">*</span></label>
                        <div class="d-flex">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="update_type"
                                    id="update_type_amount" value="amount" onchange="updateDynamicInput()"
                                    {{ old('update_type') == 'amount' ? 'checked' : '' }}>
                                <label class="form-check-label" for="update_type_amount">
                                    Tutar
                                </label>
                            </div>
                            &nbsp;&nbsp;
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="update_type"
                                    id="update_type_percentage" value="percentage" onchange="updateDynamicInput()"
                                    {{ old('update_type') == 'percentage' ? 'checked' : '' }}>
                                <label class="form-check-label" for="update_type_percentage">
                                    Yüzde
                                </label>
                            </div>
                        </div>
                        @error('update_type')
                            <div class="invalid-feedback d-block text-danger f-11">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-6">
                        <label for="operation_type" class="form-label mb-4">İşlem Türü <span
                                class="text-danger text-medium">*</span></label>
                        <div class="d-flex">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="operation_type"
                                    id="operation_type_increase" value="increase"
                                    {{ old('operation_type') == 'increase' ? 'checked' : '' }}>
                                <label class="form-check-label" for="operation_type_increase">
                                    Arttırma
                                </label>
                            </div>
                            &nbsp;&nbsp;
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="operation_type"
                                    id="operation_type_decrease" value="decrease"
                                    {{ old('operation_type') == 'decrease' ? 'checked' : '' }}>
                                <label class="form-check-label" for="operation_type_decrease">
                                    Azaltma
                                </label>
                            </div>
                        </div>
                        @error('operation_type')
                            <div class="invalid-feedback d-block text-danger f-11">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-12">
                        <label for="dynamic_input" id="dynamic_label" class="form-label mt-3">Tutar <span
                                class="text-danger text-medium">*</span></label>
                        <input type="text" id="dynamic_input" name="dynamic_input"
                            class="form-control @error('dynamic_input') border-danger @enderror"
                            value="{{ old('dynamic_input') }}">
                        @error('dynamic_input')
                            <div class="invalid-feedback d-block text-danger f-11">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-12 mt-4">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="rounding_option" id="rounding_option"
                                {{ old('rounding_option') ? 'checked' : '' }} onchange="toggleRoundingInput()">
                            <label class="form-check-label" for="rounding_option">
                                Yuvarla
                            </label>
                        </div>
                        <div id="rounding_input_container" class="mt-3"
                            style="display: {{ old('rounding_option') ? 'block' : 'none' }};">
                            <label for="rounding_amount" class="form-label">Yuvarlama Tutarı <span
                                    class="text-danger text-medium">*</span></label>
                            <input type="text" id="rounding_amount" name="rounding_amount"
                                class="form-control @error('rounding_amount') border-danger @enderror"
                                value="{{ old('rounding_amount') }}">
                            @error('rounding_amount')
                                <div class="invalid-feedback d-block text-danger f-11">{{ $message }}</div>
                            @enderror
                            <p class="my-4 text-muted">En yakın kaçın katına yuvarlanacağını belirtin.</p>
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

    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Ürün Oluştur</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="POST" action="{{ route('products.store') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="row mb-3">
                            <div class="col-12">
                                <label for="{{$locale}}_name" class="form-label">Ürün Adı</label>
                                <input type="text" name="{{$locale}}_name"
                                    class="form-control @error($locale.'_name') border-danger @enderror" id="{{$locale}}_name"
                                    value="{{ old($locale.'_name') }}" required>
                                @error($locale.'_name')
                                    <div class="invalid-feedback d-block text-danger f-11">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="images" class="form-label">Ürün Fotoğrafları</label>
                            <input type="file" class="form-control @error('images') border-danger @enderror"
                                name="images[]" id="images" multiple>
                            @error('images')
                                <div class="invalid-feedback d-block text-danger f-11">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="row mb-3">
                            <div class="col-12">
                                <label for="categorie_id" class="form-label">Kategori</label>
                                <select class="form-select form-select-lg @error('categorie_id') border-danger @enderror"
                                    name="categorie_id" id="categorie_id" data-dropdown-parent="#staticBackdrop" data-control="select2" data-placeholder="Kategori Seçiniz" data-allow-clear="true" required>
                                    <option value="0" selected>Kategori Seçiniz</option>
                                    @foreach ($categories as $categorie)
                                        <option @selected(old('categorie_id') == $categorie->id) value="{{ $categorie->id }}">
                                            {{ $categorie->path }}</option>
                                        @foreach($categorie->childs as $child)
                                          <option @selected(old('categorie_id') == $child->id) value="{{ $child->id }}">
                                            {{ $child->path }}</option>
                                            @foreach($child->childs as $subchild)
                                            <option @selected(old('categorie_id') == $subchild->id) value="{{ $subchild->id }}">
                                            {{ $subchild->path }}</option>
                                            @endforeach
                                        @endforeach
                                    @endforeach
                                </select>
                                @error('categorie_id')
                                    <div class="invalid-feedback d-block text-danger f-11">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-6">
                                <label for="{{$locale}}_price" class="form-label">Fiyat</label>
                                <input type="text" class="form-control @error($locale.'_price') border-danger @enderror"
                                    name="{{$locale}}_price" value="{{ old($locale.'_price') }}" id="{{$locale}}_price">
                                @error($locale.'_price')
                                    <div class="invalid-feedback d-block text-danger f-11">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-6">
                                <label for="{{$locale}}_currency" class="form-label">Para Birimi</label>
                                <select class="form-select @error($locale.'_currency') border-danger @enderror"
                                    name="{{$locale}}_currency" id="{{$locale}}_currency" required>
                                    <option value="₺" selected>₺</option>
                                    <option value="$">$</option>
                                    <option value="$">€</option>
                                </select>
                                @error($locale.'_currency')
                                    <div class="invalid-feedback d-block text-danger f-11">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <hr>
                        <div class="accordion" id="accordionExample">
                             <div class="accordion-item">
                                <h2 class="accordion-header" id="headingOne">
                                    <button class="accordion-button collapsed bg-secondary" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                         Varyantlar
                                    </button>
                                </h2>
                                <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                        <div class="row mb-3">
                            <div class="col-6">
                                <label for="{{$locale}}_variant_name_1" class="form-label">Varyant Adı</label>
                                <input type="text" class="form-control @error($locale.'_variant_name_1') border-danger @enderror"
                                    name="{{$locale}}_variant_name_1" value="{{ old($locale.'_variant_name_1') }}" id="{{$locale}}_variant_name_1">
                                @error($locale.'_variant_name_1')
                                    <div class="invalid-feedback d-block text-danger f-11">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-6">
                                <label for="{{$locale}}_variant_price_1" class="form-label">Varyant Fiyatı</label>
                                <input type="number" class="form-control @error($locale.'_variant_price_1') border-danger @enderror"
                                    name="{{$locale}}_variant_price_1" value="{{ old($locale.'_variant_price_1') }}" id="{{$locale}}_variant_price_1">
                                @error($locale.'_variant_price_1')
                                    <div class="invalid-feedback d-block text-danger f-11">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-6">
                                <label for="{{$locale}}_variant_name_2" class="form-label">Varyant Adı</label>
                                <input type="text" class="form-control @error($locale.'_variant_name_2') border-danger @enderror"
                                    name="{{$locale}}_variant_name_2" value="{{ old($locale.'_variant_name_2') }}" id="{{$locale}}_variant_name_2">
                                @error($locale.'_variant_name_2')
                                    <div class="invalid-feedback d-block text-danger f-11">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-6">
                                <label for="{{$locale}}_variant_price_2" class="form-label">Varyant Fiyatı</label>
                                <input type="number" class="form-control @error($locale.'_variant_price_2') border-danger @enderror"
                                    name="{{$locale}}_variant_price_2" value="{{ old($locale.'_variant_price_2') }}" id="{{$locale}}_variant_price_2">
                                @error($locale.'_variant_price_2')
                                    <div class="invalid-feedback d-block text-danger f-11">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-6">
                                <label for="{{$locale}}_variant_name_3" class="form-label">Varyant Adı</label>
                                <input type="text" class="form-control @error($locale.'_variant_name_3') border-danger @enderror"
                                    name="{{$locale}}_variant_name_3" value="{{ old($locale.'_variant_name_3') }}" id="{{$locale}}_variant_name_3">
                                @error($locale.'_variant_name_3')
                                    <div class="invalid-feedback d-block text-danger f-11">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-6">
                                <label for="{{$locale}}_variant_price_3" class="form-label">Varyant Fiyatı</label>
                                <input type="number" class="form-control @error($locale.'_variant_price_3') border-danger @enderror"
                                    name="{{$locale}}_variant_price_3" value="{{ old($locale.'_variant_price_3') }}" id="{{$locale}}_variant_price_3">
                                @error($locale.'_variant_price_3')
                                    <div class="invalid-feedback d-block text-danger f-11">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-6">
                                <label for="{{$locale}}_variant_name_4" class="form-label">Varyant Adı</label>
                                <input type="text" class="form-control @error($locale.'_variant_name_4') border-danger @enderror"
                                    name="{{$locale}}_variant_name_4" value="{{ old($locale.'_variant_name_4') }}" id="{{$locale}}_variant_name_4">
                                @error($locale.'_variant_name_4')
                                    <div class="invalid-feedback d-block text-danger f-11">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-6">
                                <label for="{{$locale}}_variant_price_4" class="form-label">Varyant Fiyatı</label>
                                <input type="number" class="form-control @error($locale.'_variant_price_4') border-danger @enderror"
                                    name="{{$locale}}_variant_price_4" value="{{ old($locale.'_variant_price_4') }}" id="{{$locale}}_variant_price_4">
                                @error($locale.'_variant_price_4')
                                    <div class="invalid-feedback d-block text-danger f-11">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-6">
                                <label for="{{$locale}}_variant_name_5" class="form-label">Varyant Adı</label>
                                <input type="text" class="form-control @error($locale.'_variant_name_5') border-danger @enderror"
                                    name="{{$locale}}_variant_name_5" value="{{ old($locale.'_variant_name_5') }}" id="{{$locale}}_variant_name_5">
                                @error($locale.'_variant_name_5')
                                    <div class="invalid-feedback d-block text-danger f-11">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-6">
                                <label for="{{$locale}}_variant_price_5" class="form-label">Varyant Fiyatı</label>
                                <input type="number" class="form-control @error($locale.'_variant_price_5') border-danger @enderror"
                                    name="{{$locale}}_variant_price_5" value="{{ old($locale.'_variant_price_5') }}" id="{{$locale}}_variant_price_5">
                                @error($locale.'_variant_price_5')
                                    <div class="invalid-feedback d-block text-danger f-11">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-6">
                                <label for="{{$locale}}_variant_name_6" class="form-label">Varyant Adı</label>
                                <input type="text" class="form-control @error($locale.'_variant_name_6') border-danger @enderror"
                                    name="{{$locale}}_variant_name_6" value="{{ old($locale.'_variant_name_6') }}" id="{{$locale}}_variant_name_6">
                                @error($locale.'_variant_name_6')
                                    <div class="invalid-feedback d-block text-danger f-11">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-6">
                                <label for="{{$locale}}_variant_price_6" class="form-label">Varyant Fiyatı</label>
                                <input type="number" class="form-control @error($locale.'_variant_price_6') border-danger @enderror"
                                    name="{{$locale}}_variant_price_6" value="{{ old($locale.'_variant_price_6') }}" id="{{$locale}}_variant_price_6">
                                @error($locale.'_variant_price_6')
                                    <div class="invalid-feedback d-block text-danger f-11">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-6">
                                <label for="{{$locale}}_variant_name_7" class="form-label">Varyant Adı</label>
                                <input type="text" class="form-control @error($locale.'_variant_name_7') border-danger @enderror"
                                    name="{{$locale}}_variant_name_7" value="{{ old($locale.'_variant_name_7') }}" id="{{$locale}}_variant_name_7">
                                @error($locale.'_variant_name_7')
                                    <div class="invalid-feedback d-block text-danger f-11">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-6">
                                <label for="{{$locale}}_variant_price_7" class="form-label">Varyant Fiyatı</label>
                                <input type="number" class="form-control @error($locale.'_variant_price_7') border-danger @enderror"
                                    name="{{$locale}}_variant_price_7" value="{{ old($locale.'_variant_price_7') }}" id="{{$locale}}_variant_price_7">
                                @error($locale.'_variant_price_7')
                                    <div class="invalid-feedback d-block text-danger f-11">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-6">
                                <label for="{{$locale}}_variant_name_8" class="form-label">Varyant Adı</label>
                                <input type="text" class="form-control @error($locale.'_variant_name_8') border-danger @enderror"
                                    name="{{$locale}}_variant_name_8" value="{{ old($locale.'_variant_name_8') }}" id="{{$locale}}_variant_name_8">
                                @error($locale.'_variant_name_8')
                                    <div class="invalid-feedback d-block text-danger f-11">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-6">
                                <label for="{{$locale}}_variant_price_8" class="form-label">Varyant Fiyatı</label>
                                <input type="number" class="form-control @error($locale.'_variant_price_8') border-danger @enderror"
                                    name="{{$locale}}_variant_price_8" value="{{ old($locale.'_variant_price_8') }}" id="{{$locale}}_variant_price_8">
                                @error($locale.'_variant_price_8')
                                    <div class="invalid-feedback d-block text-danger f-11">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-6">
                                <label for="{{$locale}}_variant_name_9" class="form-label">Varyant Adı</label>
                                <input type="text" class="form-control @error($locale.'_variant_name_9') border-danger @enderror"
                                    name="{{$locale}}_variant_name_9" value="{{ old($locale.'_variant_name_9') }}" id="{{$locale}}_variant_name_9">
                                @error($locale.'_variant_name_9')
                                    <div class="invalid-feedback d-block text-danger f-11">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-6">
                                <label for="{{$locale}}_variant_price_9" class="form-label">Varyant Fiyatı</label>
                                <input type="number" class="form-control @error($locale.'_variant_price_9') border-danger @enderror"
                                    name="{{$locale}}_variant_price_9" value="{{ old($locale.'_variant_price_9') }}" id="{{$locale}}_variant_price_9">
                                @error($locale.'_variant_price_9')
                                    <div class="invalid-feedback d-block text-danger f-11">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-6">
                                <label for="{{$locale}}_variant_name_10" class="form-label">Varyant Adı</label>
                                <input type="text" class="form-control @error($locale.'_variant_name_10') border-danger @enderror"
                                    name="{{$locale}}_variant_name_10" value="{{ old($locale.'_variant_name_10') }}" id="{{$locale}}_variant_name_10">
                                @error($locale.'_variant_name_10')
                                    <div class="invalid-feedback d-block text-danger f-11">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-6">
                                <label for="{{$locale}}_variant_price_10" class="form-label">Varyant Fiyatı</label>
                                <input type="number" class="form-control @error($locale.'_variant_price_10') border-danger @enderror"
                                    name="{{$locale}}_variant_price_10" value="{{ old($locale.'_variant_price_10') }}" id="{{$locale}}_variant_price_10">
                                @error($locale.'_variant_price_10')
                                    <div class="invalid-feedback d-block text-danger f-11">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-6">
                                <label for="{{$locale}}_variant_name_11" class="form-label">Varyant Adı</label>
                                <input type="text" class="form-control @error($locale.'_variant_name_11') border-danger @enderror"
                                    name="{{$locale}}_variant_name_11" value="{{ old($locale.'_variant_name_11') }}" id="{{$locale}}_variant_name_11">
                                @error($locale.'_variant_name_11')
                                    <div class="invalid-feedback d-block text-danger f-11">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-6">
                                <label for="{{$locale}}_variant_price_11" class="form-label">Varyant Fiyatı</label>
                                <input type="number" class="form-control @error($locale.'_variant_price_11') border-danger @enderror"
                                    name="{{$locale}}_variant_price_11" value="{{ old($locale.'_variant_price_11') }}" id="{{$locale}}_variant_price_11">
                                @error($locale.'_variant_price_11')
                                    <div class="invalid-feedback d-block text-danger f-11">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-6">
                                <label for="{{$locale}}_variant_name_12" class="form-label">Varyant Adı</label>
                                <input type="text" class="form-control @error($locale.'_variant_name_12') border-danger @enderror"
                                    name="{{$locale}}_variant_name_12" value="{{ old($locale.'_variant_name_12') }}" id="{{$locale}}_variant_name_12">
                                @error($locale.'_variant_name_12')
                                    <div class="invalid-feedback d-block text-danger f-11">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-6">
                                <label for="{{$locale}}_variant_price_12" class="form-label">Varyant Fiyatı</label>
                                <input type="number" class="form-control @error($locale.'_variant_price_12') border-danger @enderror"
                                    name="{{$locale}}_variant_price_12" value="{{ old($locale.'_variant_price_12') }}" id="{{$locale}}_variant_price_12">
                                @error($locale.'_variant_price_12')
                                    <div class="invalid-feedback d-block text-danger f-11">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-6">
                                <label for="{{$locale}}_variant_name_13" class="form-label">Varyant Adı</label>
                                <input type="text" class="form-control @error($locale.'_variant_name_13') border-danger @enderror"
                                    name="{{$locale}}_variant_name_13" value="{{ old($locale.'_variant_name_13') }}" id="{{$locale}}_variant_name_13">
                                @error($locale.'_variant_name_13')
                                    <div class="invalid-feedback d-block text-danger f-11">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-6">
                                <label for="{{$locale}}_variant_price_13" class="form-label">Varyant Fiyatı</label>
                                <input type="number" class="form-control @error($locale.'_variant_price_13') border-danger @enderror"
                                    name="{{$locale}}_variant_price_13" value="{{ old($locale.'_variant_price_13') }}" id="{{$locale}}_variant_price_13">
                                @error($locale.'_variant_price_13')
                                    <div class="invalid-feedback d-block text-danger f-11">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-6">
                                <label for="{{$locale}}_variant_name_14" class="form-label">Varyant Adı</label>
                                <input type="text" class="form-control @error($locale.'_variant_name_14') border-danger @enderror"
                                    name="{{$locale}}_variant_name_14" value="{{ old($locale.'_variant_name_14') }}" id="{{$locale}}_variant_name_14">
                                @error($locale.'_variant_name_14')
                                    <div class="invalid-feedback d-block text-danger f-11">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-6">
                                <label for="{{$locale}}_variant_price_14" class="form-label">Varyant Fiyatı</label>
                                <input type="number" class="form-control @error($locale.'_variant_price_14') border-danger @enderror"
                                    name="{{$locale}}_variant_price_14" value="{{ old($locale.'_variant_price_14') }}" id="{{$locale}}_variant_price_14">
                                @error($locale.'_variant_price_14')
                                    <div class="invalid-feedback d-block text-danger f-11">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-6">
                                <label for="{{$locale}}_variant_name_15" class="form-label">Varyant Adı</label>
                                <input type="text" class="form-control @error($locale.'_variant_name_15') border-danger @enderror"
                                    name="{{$locale}}_variant_name_15" value="{{ old($locale.'_variant_name_15') }}" id="{{$locale}}_variant_name_15">
                                @error($locale.'_variant_name_15')
                                    <div class="invalid-feedback d-block text-danger f-11">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-6">
                                <label for="{{$locale}}_variant_price_15" class="form-label">Varyant Fiyatı</label>
                                <input type="number" class="form-control @error($locale.'_variant_price_15') border-danger @enderror"
                                    name="{{$locale}}_variant_price_15" value="{{ old($locale.'_variant_price_15') }}" id="{{$locale}}_variant_price_15">
                                @error($locale.'_variant_price_15')
                                    <div class="invalid-feedback d-block text-danger f-11">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                                    </div>
                                </div>
                             </div>
                        </div>
                        
                        <hr>
                        <div class="mb-3">
                            <label for="{{$locale}}_contents" class="form-label">Menü İçeriği</label>
                            <textarea class="form-control ck-editor1 @error($locale.'_contents') border-danger @enderror" name="{{$locale}}_contents" id="{{$locale}}_contents"
                                style="height: 200px;">
                           {{ old($locale.'_contents') }}
                        </textarea>
                            @error($locale.'_contents')
                                <div class="invalid-feedback d-block text-danger f-11">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="{{$locale}}_allergens" class="form-label">Alerjenler</label>
                            <textarea class="form-control ck-editor2  @error($locale.'_allergens') border-danger @enderror" name="{{$locale}}_allergens"
                                id="{{$locale}}_allergens" style="height: 200px;">
                           {{ old($locale.'_allergens') }}
                        </textarea>
                        </div>
                        <div class="mb-3">
                            <div class="row gap-3">
                                <div class="col-auto">
                                    <label for="status" class="form-label">Durum</label>
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" role="switch" name="status"
                                            checked id="status">
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

    <div class="modal fade" id="staticBackdrop2" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Ürün Güncelle</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="product_update_form" method="POST" enctype="multipart/form-data">
                    @method('PUT')
                    @csrf
                    <div class="modal-body">
                        <div class="row mb-3">
                            <div class="col-12">
                                <label for="update_{{$locale}}_name" class="form-label">Ürün Adı</label>
                                <input type="text" name="update_{{$locale}}_name"
                                    class="form-control @error('update_'.$locale.'_name') border-danger @enderror" id="update_{{$locale}}_name"
                                    value="{{ old('update_'.$locale.'_name') }}" required>
                                @error('update_'.$locale.'_name')
                                    <div class="invalid-feedback d-block text-danger f-11">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="update_images" class="form-label">Ürün Fotoğrafları</label>
                            <input type="file" class="form-control @error('update_images') border-danger @enderror"
                                name="update_images[]" id="update_images" multiple>
                            @error('update_images')
                                <div class="invalid-feedback d-block text-danger f-11">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="row mb-3">
                            <div class="col-12">
                                <label for="update_categorie_id" class="form-label">Kategori</label>
                                <select class="form-select form-select-lg @error('update_categorie_id') border-danger @enderror"
                                    name="update_categorie_id" id="update_categorie_id" data-dropdown-parent="#staticBackdrop2" data-control="select2" data-placeholder="Kategori Seçiniz" data-allow-clear="true" required>
                                    <option value="0" selected>Kategori Seçiniz</option>
                                    @foreach ($categories as $categorie)
                                        <option value="{{ $categorie->id }}">{{ $categorie->path }}</option>
                                        @foreach($categorie->childs as $child)
                                          <option value="{{ $child->id }}">{{ $child->path }}</option>
                                          @foreach($child->childs as $subchild)
                                             <option value="{{ $subchild->id }}">{{ $subchild->path }}</option>
                                          @endforeach
                                        @endforeach
                                    @endforeach
                                </select>
                                @error('update_categorie_id')
                                    <div class="invalid-feedback d-block text-danger f-11">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-6">
                                <label for="update_{{$locale}}_price" class="form-label">Fiyat</label>
                                <input type="text" class="form-control @error('update_'.$locale.'_price') border-danger @enderror"
                                    name="update_{{$locale}}_price" value="{{ old('update_'.$locale.'_price') }}" id="update_{{$locale}}_price">
                                @error('update_'.$locale.'_price')
                                    <div class="invalid-feedback d-block text-danger f-11">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-6">
                                <label for="update_{{$locale}}_currency" class="form-label">Para Birimi</label>
                                <select class="form-select @error('update_'.$locale.'_currency') border-danger @enderror"
                                    name="update_{{$locale}}_currency" id="update_{{$locale}}_currency" required>
                                    <option value="₺">₺</option>
                                    <option value="$">$</option>
                                    <option value="$">€</option>
                                </select>
                                @error('update_'.$locale.'_currency')
                                    <div class="invalid-feedback d-block text-danger f-11">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <hr>
                        <div class="accordion" id="accordionExample">
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="headingTwo">
                                       <button class="accordion-button collapsed bg-secondary" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                              Varyantlar
                                        </button>
                                    </h2>
                                <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                          <div class="row mb-3">
                            <div class="col-6">
                                <label for="update_{{$locale}}_variant_name_1" class="form-label">Varyant Adı</label>
                                <input type="text" class="form-control @error('update_'.$locale.'_variant_name_1') border-danger @enderror"
                                    name="update_{{$locale}}_variant_name_1" value="{{ old('update_'.$locale.'_variant_name_1') }}" id="update_{{$locale}}_variant_name_1">
                                @error('update_'.$locale.'_variant_name_1')
                                    <div class="invalid-feedback d-block text-danger f-11">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-6">
                                <label for="update_{{$locale}}_variant_price_1" class="form-label">Varyant Fiyatı</label>
                                <input type="number" class="form-control @error('update_'.$locale.'_variant_price_1') border-danger @enderror"
                                    name="update_{{$locale}}_variant_price_1" value="{{ old('update_'.$locale.'_variant_price_1') }}" id="update_{{$locale}}_variant_price_1">
                                @error('update_'.$locale.'_variant_price_1')
                                    <div class="invalid-feedback d-block text-danger f-11">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-6">
                                <label for="update_{{$locale}}_variant_name_2" class="form-label">Varyant Adı</label>
                                <input type="text" class="form-control @error('update_'.$locale.'_variant_name_2') border-danger @enderror"
                                    name="update_{{$locale}}_variant_name_2" value="{{ old('update_'.$locale.'_variant_name_2') }}" id="update_{{$locale}}_variant_name_2">
                                @error('update_'.$locale.'_variant_name_2')
                                    <div class="invalid-feedback d-block text-danger f-11">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-6">
                                <label for="update_{{$locale}}_variant_price_2" class="form-label">Varyant Fiyatı</label>
                                <input type="number" class="form-control @error('update_'.$locale.'_variant_price_2') border-danger @enderror"
                                    name="update_{{$locale}}_variant_price_2" value="{{ old('update_'.$locale.'_variant_price_2') }}" id="update_{{$locale}}_variant_price_2">
                                @error('update_'.$locale.'_variant_price_2')
                                    <div class="invalid-feedback d-block text-danger f-11">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-6">
                                <label for="update_{{$locale}}_variant_name_3" class="form-label">Varyant Adı</label>
                                <input type="text" class="form-control @error('update_'.$locale.'_variant_name_3') border-danger @enderror"
                                    name="update_{{$locale}}_variant_name_3" value="{{ old('update_'.$locale.'_variant_name_3') }}" id="update_{{$locale}}_variant_name_3">
                                @error('update_'.$locale.'_variant_name_3')
                                    <div class="invalid-feedback d-block text-danger f-11">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-6">
                                <label for="update_{{$locale}}_variant_price_3" class="form-label">Varyant Fiyatı</label>
                                <input type="number" class="form-control @error('update_'.$locale.'_variant_price_3') border-danger @enderror"
                                    name="update_{{$locale}}_variant_price_3" value="{{ old('update_'.$locale.'_variant_price_3') }}" id="update_{{$locale}}_variant_price_3">
                                @error('update_'.$locale.'_variant_price_3')
                                    <div class="invalid-feedback d-block text-danger f-11">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-6">
                                <label for="update_{{$locale}}_variant_name_4" class="form-label">Varyant Adı</label>
                                <input type="text" class="form-control @error('update_'.$locale.'_variant_name_4') border-danger @enderror"
                                    name="update_{{$locale}}_variant_name_4" value="{{ old('update_'.$locale.'_variant_name_4') }}" id="update_{{$locale}}_variant_name_4">
                                @error('update_'.$locale.'_variant_name_4')
                                    <div class="invalid-feedback d-block text-danger f-11">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-6">
                                <label for="update_{{$locale}}_variant_price_4" class="form-label">Varyant Fiyatı</label>
                                <input type="number" class="form-control @error('update_'.$locale.'_variant_price_4') border-danger @enderror"
                                    name="update_{{$locale}}_variant_price_4" value="{{ old('update_'.$locale.'_variant_price_4') }}" id="update_{{$locale}}_variant_price_4">
                                @error('update_'.$locale.'_variant_price_4')
                                    <div class="invalid-feedback d-block text-danger f-11">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-6">
                                <label for="update_{{$locale}}_variant_name_5" class="form-label">Varyant Adı</label>
                                <input type="text" class="form-control @error('update_'.$locale.'_variant_name_5') border-danger @enderror"
                                    name="update_{{$locale}}_variant_name_5" value="{{ old('update_'.$locale.'_variant_name_5') }}" id="update_{{$locale}}_variant_name_5">
                                @error('update_'.$locale.'_variant_name_5')
                                    <div class="invalid-feedback d-block text-danger f-11">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-6">
                                <label for="update_{{$locale}}_variant_price_5" class="form-label">Varyant Fiyatı</label>
                                <input type="number" class="form-control @error('update_'.$locale.'_variant_price_5') border-danger @enderror"
                                    name="update_{{$locale}}_variant_price_5" value="{{ old('update_'.$locale.'_variant_price_5') }}" id="update_{{$locale}}_variant_price_5">
                                @error('update_'.$locale.'_variant_price_5')
                                    <div class="invalid-feedback d-block text-danger f-11">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-6">
                                <label for="update_{{$locale}}_variant_name_6" class="form-label">Varyant Adı</label>
                                <input type="text" class="form-control @error('update_'.$locale.'_variant_name_6') border-danger @enderror"
                                    name="update_{{$locale}}_variant_name_6" value="{{ old('update_'.$locale.'_variant_name_6') }}" id="update_{{$locale}}_variant_name_6">
                                @error('update_'.$locale.'_variant_name_6')
                                    <div class="invalid-feedback d-block text-danger f-11">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-6">
                                <label for="update_{{$locale}}_variant_price_6" class="form-label">Varyant Fiyatı</label>
                                <input type="number" class="form-control @error('update_'.$locale.'_variant_price_6') border-danger @enderror"
                                    name="update_{{$locale}}_variant_price_6" value="{{ old('update_'.$locale.'_variant_price_6') }}" id="update_{{$locale}}_variant_price_6">
                                @error('update_'.$locale.'_variant_price_6')
                                    <div class="invalid-feedback d-block text-danger f-11">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-6">
                                <label for="update_{{$locale}}_variant_name_7" class="form-label">Varyant Adı</label>
                                <input type="text" class="form-control @error('update_'.$locale.'_variant_name_7') border-danger @enderror"
                                    name="update_{{$locale}}_variant_name_7" value="{{ old('update_'.$locale.'_variant_name_7') }}" id="update_{{$locale}}_variant_name_7">
                                @error('update_'.$locale.'_variant_name_7')
                                    <div class="invalid-feedback d-block text-danger f-11">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-6">
                                <label for="update_{{$locale}}_variant_price_7" class="form-label">Varyant Fiyatı</label>
                                <input type="number" class="form-control @error('update_'.$locale.'_variant_price_7') border-danger @enderror"
                                    name="update_{{$locale}}_variant_price_7" value="{{ old('update_'.$locale.'_variant_price_7') }}" id="update_{{$locale}}_variant_price_7">
                                @error('update_'.$locale.'_variant_price_7')
                                    <div class="invalid-feedback d-block text-danger f-11">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-6">
                                <label for="update_{{$locale}}_variant_name_8" class="form-label">Varyant Adı</label>
                                <input type="text" class="form-control @error('update_'.$locale.'_variant_name_8') border-danger @enderror"
                                    name="update_{{$locale}}_variant_name_8" value="{{ old('update_'.$locale.'_variant_name_8') }}" id="update_{{$locale}}_variant_name_8">
                                @error('update_'.$locale.'_variant_name_8')
                                    <div class="invalid-feedback d-block text-danger f-11">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-6">
                                <label for="update_{{$locale}}_variant_price_8" class="form-label">Varyant Fiyatı</label>
                                <input type="number" class="form-control @error('update_'.$locale.'_variant_price_8') border-danger @enderror"
                                    name="update_{{$locale}}_variant_price_8" value="{{ old('update_'.$locale.'_variant_price_8') }}" id="update_{{$locale}}_variant_price_8">
                                @error('update_'.$locale.'_variant_price_8')
                                    <div class="invalid-feedback d-block text-danger f-11">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-6">
                                <label for="update_{{$locale}}_variant_name_9" class="form-label">Varyant Adı</label>
                                <input type="text" class="form-control @error('update_'.$locale.'_variant_name_9') border-danger @enderror"
                                    name="update_{{$locale}}_variant_name_9" value="{{ old('update_'.$locale.'_variant_name_9') }}" id="update_{{$locale}}_variant_name_9">
                                @error('update_'.$locale.'_variant_name_9')
                                    <div class="invalid-feedback d-block text-danger f-11">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-6">
                                <label for="update_{{$locale}}_variant_price_9" class="form-label">Varyant Fiyatı</label>
                                <input type="number" class="form-control @error('update_'.$locale.'_variant_price_9') border-danger @enderror"
                                    name="update_{{$locale}}_variant_price_9" value="{{ old('update_'.$locale.'_variant_price_9') }}" id="update_{{$locale}}_variant_price_9">
                                @error('update_'.$locale.'_variant_price_9')
                                    <div class="invalid-feedback d-block text-danger f-11">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                         <div class="row mb-3">
                            <div class="col-6">
                                <label for="update_{{$locale}}_variant_name_10" class="form-label">Varyant Adı</label>
                                <input type="text" class="form-control @error('update_'.$locale.'_variant_name_10') border-danger @enderror"
                                    name="update_{{$locale}}_variant_name_10" value="{{ old('update_'.$locale.'_variant_name_10') }}" id="update_{{$locale}}_variant_name_10">
                                @error('update_'.$locale.'_variant_name_10')
                                    <div class="invalid-feedback d-block text-danger f-11">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-6">
                                <label for="update_{{$locale}}_variant_price_10" class="form-label">Varyant Fiyatı</label>
                                <input type="number" class="form-control @error('update_'.$locale.'_variant_price_10') border-danger @enderror"
                                    name="update_{{$locale}}_variant_price_10" value="{{ old('update_'.$locale.'_variant_price_10') }}" id="update_{{$locale}}_variant_price_10">
                                @error('update_'.$locale.'_variant_price_10')
                                    <div class="invalid-feedback d-block text-danger f-11">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-6">
                                <label for="update_{{$locale}}_variant_name_11" class="form-label">Varyant Adı</label>
                                <input type="text" class="form-control @error('update_'.$locale.'_variant_name_11') border-danger @enderror"
                                    name="update_{{$locale}}_variant_name_11" value="{{ old('update_'.$locale.'_variant_name_11') }}" id="update_{{$locale}}_variant_name_11">
                                @error('update_'.$locale.'_variant_name_11')
                                    <div class="invalid-feedback d-block text-danger f-11">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-6">
                                <label for="update_{{$locale}}_variant_price_11" class="form-label">Varyant Fiyatı</label>
                                <input type="number" class="form-control @error('update_'.$locale.'_variant_price_11') border-danger @enderror"
                                    name="update_{{$locale}}_variant_price_11" value="{{ old('update_'.$locale.'_variant_price_11') }}" id="update_{{$locale}}_variant_price_11">
                                @error('update_'.$locale.'_variant_price_11')
                                    <div class="invalid-feedback d-block text-danger f-11">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-6">
                                <label for="update_{{$locale}}_variant_name_12" class="form-label">Varyant Adı</label>
                                <input type="text" class="form-control @error('update_'.$locale.'_variant_name_12') border-danger @enderror"
                                    name="update_{{$locale}}_variant_name_12" value="{{ old('update_'.$locale.'_variant_name_12') }}" id="update_{{$locale}}_variant_name_12">
                                @error('update_'.$locale.'_variant_name_12')
                                    <div class="invalid-feedback d-block text-danger f-11">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-6">
                                <label for="update_{{$locale}}_variant_price_12" class="form-label">Varyant Fiyatı</label>
                                <input type="number" class="form-control @error('update_'.$locale.'_variant_price_12') border-danger @enderror"
                                    name="update_{{$locale}}_variant_price_12" value="{{ old('update_'.$locale.'_variant_price_12') }}" id="update_{{$locale}}_variant_price_12">
                                @error('update_'.$locale.'_variant_price_12')
                                    <div class="invalid-feedback d-block text-danger f-11">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-6">
                                <label for="update_{{$locale}}_variant_name_13" class="form-label">Varyant Adı</label>
                                <input type="text" class="form-control @error('update_'.$locale.'_variant_name_13') border-danger @enderror"
                                    name="update_{{$locale}}_variant_name_13" value="{{ old('update_'.$locale.'_variant_name_13') }}" id="update_{{$locale}}_variant_name_13">
                                @error('update_'.$locale.'_variant_name_13')
                                    <div class="invalid-feedback d-block text-danger f-11">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-6">
                                <label for="update_{{$locale}}_variant_price_13" class="form-label">Varyant Fiyatı</label>
                                <input type="number" class="form-control @error('update_'.$locale.'_variant_price_13') border-danger @enderror"
                                    name="update_{{$locale}}_variant_price_13" value="{{ old('update_'.$locale.'_variant_price_13') }}" id="update_{{$locale}}_variant_price_13">
                                @error('update_'.$locale.'_variant_price_13')
                                    <div class="invalid-feedback d-block text-danger f-11">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-6">
                                <label for="update_{{$locale}}_variant_name_14" class="form-label">Varyant Adı</label>
                                <input type="text" class="form-control @error('update_'.$locale.'_variant_name_14') border-danger @enderror"
                                    name="update_{{$locale}}_variant_name_14" value="{{ old('update_'.$locale.'_variant_name_14') }}" id="update_{{$locale}}_variant_name_14">
                                @error('update_'.$locale.'_variant_name_14')
                                    <div class="invalid-feedback d-block text-danger f-11">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-6">
                                <label for="update_{{$locale}}_variant_price_14" class="form-label">Varyant Fiyatı</label>
                                <input type="number" class="form-control @error('update_'.$locale.'_variant_price_14') border-danger @enderror"
                                    name="update_{{$locale}}_variant_price_14" value="{{ old('update_'.$locale.'_variant_price_14') }}" id="update_{{$locale}}_variant_price_14">
                                @error('update_'.$locale.'_variant_price_14')
                                    <div class="invalid-feedback d-block text-danger f-11">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-6">
                                <label for="update_{{$locale}}_variant_name_15" class="form-label">Varyant Adı</label>
                                <input type="text" class="form-control @error('update_'.$locale.'_variant_name_15') border-danger @enderror"
                                    name="update_{{$locale}}_variant_name_15" value="{{ old('update_'.$locale.'_variant_name_15') }}" id="update_{{$locale}}_variant_name_15">
                                @error('update_'.$locale.'_variant_name_15')
                                    <div class="invalid-feedback d-block text-danger f-11">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-6">
                                <label for="update_{{$locale}}_variant_price_15" class="form-label">Varyant Fiyatı</label>
                                <input type="number" class="form-control @error('update_'.$locale.'_variant_price_15') border-danger @enderror"
                                    name="update_{{$locale}}_variant_price_15" value="{{ old('update_'.$locale.'_variant_price_15') }}" id="update_{{$locale}}_variant_price_15">
                                @error('update_'.$locale.'_variant_price_15')
                                    <div class="invalid-feedback d-block text-danger f-11">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                                     </div>
                                </div>
                              </div>
                        </div>
                        
                        <hr>
                        <div class="mb-3">
                            <label for="update_{{$locale}}_contents" class="form-label">Menü İçeriği</label>
                            <textarea class="form-control ck-editor3 @error('update_'.$locale.'_contents') border-danger @enderror" name="update_{{$locale}}_contents"
                                id="update_{{$locale}}_contents" style="height: 200px;">
                                    {{ old('update_'.$locale.'_contents') }}
                            </textarea>
                            @error('update_'.$locale.'_contents')
                                <div class="invalid-feedback d-block text-danger f-11">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="update_{{$locale}}_allergens" class="form-label">Alerjenler</label>
                            <textarea class="form-control ck-editor4  @error('update_'.$locale.'_allergens') border-danger @enderror" name="update_{{$locale}}_allergens"
                                id="update_{{$locale}}_allergens" style="height: 200px;">
                           {{ old('update_'.$locale.'_allergens') }}
                        </textarea>
                        </div>
                        <div class="mb-3">
                            <div class="row gap-3">
                                <div class="col-auto">
                                    <label for="update_status" class="form-label">Durum</label>
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" role="switch"
                                            name="update_status" id="update_status">
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
    <script src="{{ asset('assets/js/datatable.js') }}"></script>
    <script src="{{asset('assets/js/file.js')}}"></script>
    <script src="{{ asset('assets/plugins/custom/ckeditor/ckeditor-classic.bundle.js') }}"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const table = $('#kt_datatable_products').DataTable({
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
            "infoFiltered": "(_MAX_ Kayıt Arasından Arandı.)"
        },
        responsive: true,
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
                    return  $(node).find('img').attr('src').split('/').pop();
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
                    return  $(node).find('img').attr('src').split('/').pop();
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
                    return  $(node).find('img').attr('src').split('/').pop();
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
                    return  $(node).find('img').attr('src').split('/').pop();
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
            const productPriceContent = row.querySelector('.productPriceContent');
            const productPriceText = row.querySelector('.productPriceText');
            const productPrice = row.querySelector('.productPrice');
            const productId = row.getAttribute('data-id');

            let originalValue = productPrice.value;

            if (productPriceContent && productPriceText && productPrice) {
                productPriceContent.addEventListener('click', function(event) {
                    event.stopPropagation();
                    productPriceText.classList.add('d-none');
                    productPrice.classList.remove('d-none');
                    productPrice.classList.add('d-block');
                    productPrice.focus();
                });

                document.addEventListener('click', function(event) {
                    if (productPrice.classList.contains('d-block') &&
                        event.target !== productPrice &&
                        !productPrice.contains(event.target) &&
                        event.target !== productPriceContent &&
                        !productPriceContent.contains(event.target)) {

                        const newValue = productPrice.value;

                        if (newValue !== originalValue) {
                            updatePrice(newValue, productId);
                            originalValue = newValue;
                        }

                        productPriceText.classList.remove('d-none');
                        productPrice.classList.add('d-none');
                        productPrice.classList.remove('d-block');
                    }
                });

                productPrice.addEventListener('click', function(event) {
                    event.stopPropagation();
                });
            }

            const productNameContent = row.querySelector('.productNameContent');
            const productNameText = row.querySelector('.productNameText');
            const productName = row.querySelector('.productName');

            let originalNameValue = productName.value;

            if (productNameContent && productNameText && productName) {
                productNameContent.addEventListener('click', function(event) {
                    event.stopPropagation();
                    productNameText.classList.add('d-none');
                    productName.classList.remove('d-none');
                    productName.classList.add('d-block');
                    productName.focus();
                });

                document.addEventListener('click', function(event) {
                    if (productName.classList.contains('d-block') &&
                        event.target !== productName &&
                        !productName.contains(event.target) &&
                        event.target !== productNameContent &&
                        !productNameContent.contains(event.target)) {

                        const newValue = productName.value;

                        if (newValue !== originalNameValue) {
                            updateProductName(newValue, productId);
                            originalNameValue = newValue;
                        }

                        productNameText.classList.remove('d-none');
                        productName.classList.add('d-none');
                        productName.classList.remove('d-block');
                    }
                });

                productName.addEventListener('click', function(event) {
                    event.stopPropagation();
                });
            }

            const productStatus = row.querySelector('.productStatus');
            let originalStatusValue = productStatus.checked ? 1 : 0;

            if (productStatus) {
                productStatus.addEventListener('change', function() {
                    const newStatus = productStatus.checked ? 1 : 0;

                    if (newStatus !== originalStatusValue) {
                        updateProductStatus(newStatus, productId);
                        originalStatusValue = newStatus;
                    }
                });
            }
            
            const categoryContent = row.querySelector('.categoryContent');
            const categoryText = row.querySelector('.categoryText');
            const categorySelect = row.querySelector('.categorySelect');
            let currentCategoryId = row.getAttribute('data-category-id');

            if (categoryContent && categoryText && categorySelect) {
                 categoryContent.addEventListener('click', async function(event) {
                    event.stopPropagation();
        
                if (!categories.length) {
                     await fetchCategories();
                }

            categorySelect.innerHTML = categories.map(category => 
               `<option value="${category.id}" ${category.id == currentCategoryId ? 'selected' : ''}>
                 ${category.path}
                </option>`).join('');
           /*     
            $(categorySelect).select2({
                dropdownParent: $('#tablecontents'),
                width: '100%'
            });
            
            */
                
           
        
            categoryText.classList.add('d-none');
            categorySelect.classList.remove('d-none');
            categorySelect.classList.add('d-block');
            $(categorySelect).focus();
           // $(categorySelect).select2('open');
    });

    document.addEventListener('click', function(event) {
        if (categorySelect.classList.contains('d-block') &&
            event.target !== categorySelect &&
            !categorySelect.contains(event.target) &&
            event.target !== categoryContent &&
            !categoryContent.contains(event.target)) {

            const newCategoryId = categorySelect.value;

            if (newCategoryId != currentCategoryId) {
                updateCategory(newCategoryId, productId);
                currentCategoryId = newCategoryId;
            }

            categoryText.classList.remove('d-none');
            categorySelect.classList.add('d-none');
            categorySelect.classList.remove('d-block');
        }
    });

    categorySelect.addEventListener('click', function(event) {
        event.stopPropagation();
    });
}
        });
    }

    setupRowEvents();

    table.on('draw', function() {
        setupRowEvents();
    });

    function updatePrice(newPrice, productId) {
        var token = $('meta[name="csrf-token"]').attr('content');
        var Ajaxurl = '{{ route('products.updatePrice', ':productId') }}';
        Ajaxurl = Ajaxurl.replace(':productId', productId);

        $.ajax({
            type: "POST",
            url: Ajaxurl,
            dataType: "json",
            data: {
                price: newPrice,
                _token: token
            },
            success: function(response) {
                if (response.success) {
                    console.log('Başarılı:', response.message);
                    document.querySelector(`tr[data-id="${productId}"] .productPriceText`)
                        .textContent = `${response.product.price?.{{$locale}}} ${response.product.currency?.{{$locale}}}`;
                } else {
                    console.error('Başarısız:', response.message);
                }
            },
            error: function(xhr) {
                console.error('Hata:', xhr.responseText);
            }
        });
    }

    function updateProductName(newName, productId) {
        var token = $('meta[name="csrf-token"]').attr('content');
        var Ajaxurl = '{{ route('products.updateName', ':productId') }}';
        Ajaxurl = Ajaxurl.replace(':productId', productId);

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
                    document.querySelector(`tr[data-id="${productId}"] .productNameText`)
                        .textContent = response.product.name?.{{$locale}};
                } else {
                    console.error('Başarısız:', response.message);
                }
            },
            error: function(xhr) {
                console.error('Hata:', xhr.responseText);
            }
        });
    }

    function updateProductStatus(newStatus, productId) {
        var token = $('meta[name="csrf-token"]').attr('content');
        var Ajaxurl = '{{ route('products.updateStatus', ':productId') }}';
        Ajaxurl = Ajaxurl.replace(':productId', productId);

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



let categories = []; 

function fetchCategories() {
    return new Promise((resolve, reject) => {
        $.ajax({
            url: '{{ route("categories.json") }}',
            method: 'GET',
            success: function(response) {
                if (response.categories) {
                    categories = response.categories;
                    resolve(categories);
                } else {
                    reject('Kategoriler alınamadı');
                }
            },
            error: function(xhr) {
                reject(xhr.responseText);
            }
        });
    });
}

function updateCategory(newCategoryId, productId) {
    var token = $('meta[name="csrf-token"]').attr('content');
    var Ajaxurl = '{{ route('products.updateCategory', ':productId') }}';
    Ajaxurl = Ajaxurl.replace(':productId', productId);

    $.ajax({
        type: "POST",
        url: Ajaxurl,
        dataType: "json",
        data: {
            category_id: newCategoryId,
            _token: token
        },
        success: function(response) {
            if (response.success) {
                console.log('Başarılı:', response.message);
                document.querySelector(`tr[data-id="${productId}"] .categoryText`)
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
            .then(ckEditor => {
                editor = ckEditor;
            })
            .catch(error => {
                console.error(error);
            });
        ClassicEditor
            .create(document.querySelector('.ck-editor4'))
            .then(ckEditor => {
                editor2 = ckEditor;
            })
            .catch(error => {
                console.error(error);
            });
            
    function updateDynamicInput() {
        const dynamicLabel = document.getElementById('dynamic_label');
        const updateTypeAmount = document.getElementById('update_type_amount').checked;

        if (updateTypeAmount) {
            dynamicLabel.innerHTML = 'Tutar <span class="text-danger text-medium">*</span>';
        } else {
            dynamicLabel.innerHTML = 'Yüzde <span class="text-danger text-medium">*</span>';
        }
    }

    function toggleRoundingInput() {
        const roundingCheckbox = document.getElementById('rounding_option');
        const roundingInputContainer = document.getElementById('rounding_input_container');
        roundingInputContainer.style.display = roundingCheckbox.checked ? 'block' : 'none';
    }

    document.addEventListener('DOMContentLoaded', updateDynamicInput);


        function modal(id) {
            localStorage.setItem('id', id);
            var Ajaxurl = '{{ route('products.show', ':id') }}';
            Ajaxurl = Ajaxurl.replace(':id', id);
            var url = '{{ route('products.update', ':id') }}';
            url = url.replace(':id', id);
            $.ajax({
                type: "get",
                url: Ajaxurl,
                data: {
                    id: id
                },
                success: function(response) {
                    $('#update_{{$locale}}_name').val(response.product.name.{{$locale}});
                    $('#update_{{$locale}}_price').val(response.product.price.{{$locale}});
                    $('#update_{{$locale}}_currency').val(response.product.currency.{{$locale}});
                    $('#update_{{$locale}}_variant_name_1').val(response.product.variant_name_1?.{{$locale}});
                    $('#update_{{$locale}}_variant_price_1').val(response.product.variant_price_1?.{{$locale}});
                    $('#update_{{$locale}}_variant_name_2').val(response.product.variant_name_2?.{{$locale}});
                    $('#update_{{$locale}}_variant_price_2').val(response.product.variant_price_2?.{{$locale}});
                    $('#update_{{$locale}}_variant_name_3').val(response.product.variant_name_3?.{{$locale}});
                    $('#update_{{$locale}}_variant_price_3').val(response.product.variant_price_3?.{{$locale}});
                    $('#update_{{$locale}}_variant_name_4').val(response.product.variant_name_4?.{{$locale}});
                    $('#update_{{$locale}}_variant_price_4').val(response.product.variant_price_4?.{{$locale}});
                    $('#update_{{$locale}}_variant_name_5').val(response.product.variant_name_5?.{{$locale}});
                    $('#update_{{$locale}}_variant_price_5').val(response.product.variant_price_5?.{{$locale}});
                    $('#update_{{$locale}}_variant_name_6').val(response.product.variant_name_6?.{{$locale}});
                    $('#update_{{$locale}}_variant_price_6').val(response.product.variant_price_6?.{{$locale}});
                    $('#update_{{$locale}}_variant_name_7').val(response.product.variant_name_7?.{{$locale}});
                    $('#update_{{$locale}}_variant_price_7').val(response.product.variant_price_7?.{{$locale}});
                    $('#update_{{$locale}}_variant_name_8').val(response.product.variant_name_8?.{{$locale}});
                    $('#update_{{$locale}}_variant_price_8').val(response.product.variant_price_8?.{{$locale}});
                    $('#update_{{$locale}}_variant_name_9').val(response.product.variant_name_9?.{{$locale}});
                    $('#update_{{$locale}}_variant_price_9').val(response.product.variant_price_9?.{{$locale}});
                    $('#update_{{$locale}}_variant_name_10').val(response.product.variant_name_10?.{{$locale}});
                    $('#update_{{$locale}}_variant_price_10').val(response.product.variant_price_10?.{{$locale}});
                    $('#update_{{$locale}}_variant_name_11').val(response.product.variant_name_11?.{{$locale}});
                    $('#update_{{$locale}}_variant_price_11').val(response.product.variant_price_11?.{{$locale}});
                    $('#update_{{$locale}}_variant_name_12').val(response.product.variant_name_12?.{{$locale}});
                    $('#update_{{$locale}}_variant_price_12').val(response.product.variant_price_12?.{{$locale}});
                    $('#update_{{$locale}}_variant_name_13').val(response.product.variant_name_13?.{{$locale}});
                    $('#update_{{$locale}}_variant_price_13').val(response.product.variant_price_13?.{{$locale}});
                    $('#update_{{$locale}}_variant_name_14').val(response.product.variant_name_14?.{{$locale}});
                    $('#update_{{$locale}}_variant_price_14').val(response.product.variant_price_14?.{{$locale}});
                    $('#update_{{$locale}}_variant_name_15').val(response.product.variant_name_15?.{{$locale}});
                    $('#update_{{$locale}}_variant_price_15').val(response.product.variant_price_15?.{{$locale}});
                    editor.setData(response.product.contents.{{$locale}} ?? '');
                    editor2.setData(response.product.allergens.{{$locale}} ?? '');
                    
                    var categorySelect = $('#update_categorie_id').select2();
                    categorySelect.find('option').each(function() {
                         var optionValue = $(this).val();
                         if (optionValue == response.product.categorie_id) {
                             $(this).prop('selected', true);
                               categorySelect.trigger('change');
                          }
                    });
                    $('#update_status').attr('checked', response.product.status == 1 ? true : false);
                    $('#product_update_form').attr('action', url);
                    $('#staticBackdrop2').modal('show');
                }
            });
        }

        function deleteProduct(url) {
            Swal.fire({
                title: 'Dikkat',
                text: 'Ürünü silmek istediğinizden emin misiniz?',
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

        function deleteImage(url) {
            Swal.fire({
                title: 'Dikkat',
                text: 'Ürün resmini silmek istediğinizden emin misiniz?',
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
    @if (array_intersect($modals['edit'], $errors->keys()))
        <script>
            $(document).ready(() => {
                var url = '{{ route('products.update', ':id') }}';
                url = url.replace(':id', localStorage.getItem('id'));
                $('#product_update_form').attr('action', url);
                setTimeout(function() {
                    $("#staticBackdrop2").modal("show");
                }, 500);
            });
        </script>
    @endif
    @if (array_intersect($modals['update_prices'], $errors->keys()))
    <script>
        $(document).ready(() => {
            setTimeout(function() {
                $("#staticBackdropPrice").modal("show");
            }, 500);
        });
    </script>
   @endif
   @if (array_intersect($modals['import'], $errors->keys()))
   <script>
       $(document).ready(() => {
           setTimeout(function() {
               $("#staticBackdropImport").modal("show");
           }, 500);
       });
   </script>
  @endif
@endsection
