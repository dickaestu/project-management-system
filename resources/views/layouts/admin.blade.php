<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta
      content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no"
      name="viewport"
    />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title')</title>
    @stack('prepend-style')
    @include('includes.admin.style')
    @stack('addon-style')
  </head>

  <body>
    <div class="loader"></div>
    <div id="">
      <div class="main-wrapper main-wrapper-1">
       
        @include('includes.admin.navbar')
        @include('includes.admin.sidebar')
        <!-- Main Content -->
        @yield('content')
        @include('includes.admin.footer')
      </div>
    </div>
    @stack('prepend-script')
    @include('includes.admin.script')
    @stack('addon-script')
  </body>

</html>
