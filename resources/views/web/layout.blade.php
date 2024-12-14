@include('includes._metahead')
<body>
    <!-- Main outter WRAPPER -->
    <div class="wrapper">
        <!-- HEADER -->
        @include('includes._header')
        <!-- HEADER ./ -->
        @yield('content')
        <!-- FOOTER -->
        @include('includes._footer')
        <!-- FOOTER ./ -->
    </div>
    @include('includes._scripts')
</body>
</html>
