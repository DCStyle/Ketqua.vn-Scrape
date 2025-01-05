<!DOCTYPE html>
<html>
<head>
    <title>@yield('title', setting('site_name'))</title>

    <meta charset="utf-8">
    <meta name="description" content="@yield('description', setting('site_description'))">
    <meta name="keywords" content="@yield('keywords', setting('site_keywords'))">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="theme-color" content="#ffffff">

    <meta property="og:title" content="@yield('title', setting('site_name'))">
    <meta property="og:description" content="@yield('description', setting('site_description'))">
    <meta property="og:image" content="@yield('image', setting('site_og_image', 'https://placehold.co/126'))">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:type" content="website">
    <meta property="og:site_name" content="{{ setting('site_name') }}">
    <meta property="og:locale" content="vi_VN">
    <meta property="og:locale:alternate" content="en_US">

    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="@yield('title', setting('site_name'))">
    <meta name="twitter:description" content="@yield('description', setting('site_description'))">
    <meta name="twitter:image" content="@yield('image', setting('site_og_image', 'https://placehold.co/126'))">
    <meta name="twitter:site" content="{{ setting('site_name') }}">
    <meta name="twitter:creator" content="Kết Quả Xổ Số">

    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{ setting('site_favicon', 'https://placehold.co/32x32') }}">

    <meta name="robots" content="noindex,nofollow">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    @vite(['resources/css/app.css'])

    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
</head>
<body>

@include('partials.sticky-header')
<button class="scroll-to-top" style="display: none;">
    <i class="fas fa-chevron-up"></i>
</button>
<div class="bg-color"></div>
<div class="sidebar-overlay d-none" id="sidebar-overlay"></div>

@include('partials.header')
<main class="container max-w-1140px position-relative">
    @yield('content')
</main>
@include('partials.footer')

<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.30.1/moment-with-locales.min.js" integrity="sha512-4F1cxYdMiAW98oomSLaygEwmCnIP38pb4Kx70yQYqRwLVCs3DbRumfBq82T08g/4LJ/smbFGFpmeFlQgoDccgg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="{{ asset('js/zebra_datepicker.min.js') }}"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<script src="{{ asset('js/main.min.js') }}"></script>


<script src="https://cdnjs.cloudflare.com/ajax/libs/howler/2.2.4/howler.min.js"></script>
<script src="https://www.gstatic.com/firebasejs/8.10.0/firebase-app.js"></script>
<script src="https://www.gstatic.com/firebasejs/8.10.0/firebase-database.js"></script>
<script type="module" src="{{ asset('js/app.js') }}"></script>

@vite(['resources/js/app.js'])

@stack('scripts')
</body>
</html>
