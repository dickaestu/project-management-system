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
    @include('includes.leader.style')
    @stack('addon-style')
  </head>

  <body>
    <div class="loader"></div>
    <div id="app">
      <div class="main-wrapper main-wrapper-1">
       
        @include('includes.leader.navbar')
        @include('includes.leader.sidebar')
        <!-- Main Content -->
        @yield('content')
        @include('includes.leader.footer')
      </div>
    </div>
    @stack('prepend-script')
    @include('includes.leader.script')
    @stack('addon-script')
  </body>

</html>
