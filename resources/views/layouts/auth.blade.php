<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta
      content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no"
      name="viewport"
    />  
    <title>@yield('title')</title>
    @stack('prepend-style')
    @include('includes.style')
    @stack('addon-style')
  </head>

<body style="background: #fcfcfc;">
  <div class="loader"></div>
  <div id="app">
    @yield('content')
  </div>
     @stack('prepend-script')
    @include('includes.script')
    @stack('addon-script')
</body>


</html>