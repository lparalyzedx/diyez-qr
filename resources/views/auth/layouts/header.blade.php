<!DOCTYPE html>
<html lang="tr">
<head>
    <title>{{config('app.name')}} - @yield('title','Giriş Yap')</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta property="og:locale" content="tr_TR" />
    <meta property="og:site_name" content="{{ env('APP_NAME') }}" />
    <link rel="shortcut icon" href="{{asset('front/img/diyez.svg')}}" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700" />
    <link href="{{asset('assets/plugins/global/plugins.bundle.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('assets/css/style.bundle.css')}}" rel="stylesheet" type="text/css" />
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">

</head>
<body id="kt_body" class="app-blank">
    <script>
        var defaultThemeMode = "light";
        var themeMode;
        if (document.documentElement) {
            if (document.documentElement.hasAttribute("data-bs-theme-mode")) {
                themeMode = document.documentElement.getAttribute("data-bs-theme-mode");
            } else {
                if (localStorage.getItem("data-bs-theme") !== null) {
                    themeMode = localStorage.getItem("data-bs-theme");
                } else {
                    themeMode = defaultThemeMode;
                }
            }
            if (themeMode === "system") {
                themeMode = window.matchMedia("(prefers-color-scheme: dark)").matches ? "dark" : "light";
            }
            document.documentElement.setAttribute("data-bs-theme", themeMode);
        }

    </script>
   <div class="d-flex flex-column flex-root" id="kt_app_root">
       <div class="d-flex flex-column flex-lg-row flex-column-fluid">
           <div class="d-flex flex-column flex-lg-row-fluid w-lg-50 p-5 order-2 order-lg-1">
               <div class="d-flex flex-center flex-column flex-lg-row-fluid">
                   <div class="w-lg-500px  w-100 p-5">
