<!doctype html>
<html lang="{{ htmlLang() }}" @langrtl dir="rtl" @endlangrtl>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ appName() }} | @yield('title')</title>
    <meta name="description" content="@yield('meta_description', appName())">
    <meta name="author" content="@yield('meta_author', 'Hasib Kamal Chowdhury')">
    @yield('meta')

    @stack('before-styles')
    <link href="{{ mix('css/backend.css') }}" rel="stylesheet">
    <link href="{{ url('/css/bootstrap4-toggle.min.css') }}" rel="stylesheet">
    <link href="{{ url('/css/sweetalert.min.css') }}" rel="stylesheet">
    <link href="{{ url('/css/custom.css') }}" rel="stylesheet">
    <link href="{{ asset('/css/style.css') }}" rel="stylesheet">

    <!-- font family cdn -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300&display=swap" rel="stylesheet">

    <!-- Font Awesome CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/js/all.min.js" integrity="sha512-6PM0qYu5KExuNcKt5bURAoT6KCThUmHRewN3zUFNaoI6Di7XJPTMoT6K0nsagZKk2OB4L7E3q1uQKHNHd4stIQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <livewire:styles />
    @stack('after-styles')
    @yield('header-css')
</head>
<body class="c-app" id="vebo-app">
    @include('backend.includes.sidebar')

    <div class="c-wrapper c-fixed-components">
        @include('backend.includes.header')
        @include('includes.partials.read-only')
        @include('includes.partials.logged-in-as')

        <div class="c-body">
            <main class="c-main vebo-main">
                <div class="container-fluid vebo-wrapper">
                    <div class="fade-in">
                        @include('includes.partials.messages')
                        @yield('content')
                    </div><!--fade-in-->
                </div><!--container-fluid-->
            </main>
        </div><!--c-body-->

        @include('backend.includes.footer')
    </div><!--c-wrapper-->

    @stack('before-scripts')
    <script src="{{ url('/js/jquery.min.js') }}"></script>
    <script src="{{ mix('js/manifest.js') }}"></script>
    <script src="{{ mix('js/vendor.js') }}"></script>
    <script src="{{ mix('js/backend.js') }}"></script>
    <script src="{{ url('/js/jquery.validate.js') }}"></script>
    <script src="{{ url('/js/bootstrap4-toggle.min.js') }}"></script>
    <script src="{{ url('/js/sweetalert.min.js') }}"></script>
    <script src="{{ url('/js/custom.js') }}"></script>
    <livewire:scripts />
    @stack('after-scripts')
    @yield('footer-script')
</body>
</html>
