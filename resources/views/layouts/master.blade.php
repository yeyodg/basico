<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <title>@yield('title')</title>
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
        <link rel="stylesheet" type="text/css" href="{{ URL::to('css/main.css') }}">
    </head>
    <body>
        @include('includes.header')
        <div class="container">
            @yield('content')
        </div>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
        <script src="{{URL::to('js/app1.js')}}"></script>

        <script src="https://www.gstatic.com/firebasejs/4.1.3/firebase.js"></script>
        <script>
          // Initialize Firebase
          var config = {
            apiKey: "AIzaSyA-x0c5Gf4i5QcnbiEJkzUzrGpeE5nUTQg",
            authDomain: "imagenes-de-perfil.firebaseapp.com",
            databaseURL: "https://imagenes-de-perfil.firebaseio.com",
            projectId: "imagenes-de-perfil",
            storageBucket: "imagenes-de-perfil.appspot.com",
            messagingSenderId: "859527711841"
          };
          firebase.initializeApp(config);
        </script>
        

    </body>
</html>
