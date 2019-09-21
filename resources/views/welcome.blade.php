<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="login-status" content="{{ Auth::check() }}">
        <title>UOGO</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <link rel="stylesheet" href="animate.min.css">
         <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
         <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.2/animate.min.css">
         <link href="https://cdn.rawgit.com/michalsnik/aos/2.1.1/dist/aos.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
       
    </head>
    <body>
        <div id="app">
            @if(Session::has('message'))
<p class="alert alert-success animated fadeIn">{{ Session::get('message') }} {{ Auth::user()->firstname }}</p>
@endif
<div id="page-loader" style="display:none">
      <div class="d-flex justify-content-center align-items-center h-100">
        <img id="loading-image" src="images/805.gif" alt="Loading..." />
      </div>
    </div>

 
        <nav>            
           <transition name="router-anim" enter-active-class="animated fadeIn slower" leave-active-class="animated fadeOut faster">
            <router-view></router-view>
           </transition>
        </nav>
        

       
        </div>
    </body>
    <script type="text/javascript">      
  window.csrf_token = "{{ csrf_token() }}"
</script>
<script src="https://cdn.rawgit.com/michalsnik/aos/2.1.1/dist/aos.js"></script>
<script src="{{ asset('js/app.js') }}"></script>
</html>

