<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <title>Spectrum</title>
      <!-- <link href="{{asset('css/app.css')}}" rel="stylesheet"> -->
      <!-- css -->
      <link href="{{asset('public/assets/css/bootstrap.min')}}.css" rel="stylesheet" type="text/css">
      <link href="{{asset('public/assets/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet" type="text/css" />
      <link href="{{asset('public/assets/css/nivo-lightbox.css')}}" rel="stylesheet" />
      <link href="{{asset('public/assets/css/nivo-lightbox-theme/default/default.css')}}" rel="stylesheet" type="text/css" />
      <link href="{{asset('public/assets/css/animate.css')}}" rel="stylesheet" />
      <link href="{{asset('public/assets/css/style.css')}}" rel="stylesheet">
      <link href="{{asset('public/assets/css/layout.css')}}" rel="stylesheet">
      <link href="{{asset('public/assets/css/datepicker.css')}}" rel="stylesheet">
      <!-- template skin -->
      <!-- Fonts -->
      <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
      <!-- Styles -->
    </head>
    <body>
       <div class="" id="app">
            <App /> 
       </div>
    </body>
      <script src="{{asset('public/js/app.js')}}"></script>
      <!-- Core JavaScript Files -->
      <script src="{{asset('public/assets/js/jquery.min.js')}}"></script>
      <script src="{{asset('public/assets/js/bootstrap.min.js')}}"></script>
      <script src="{{asset('public/assets/js/jquery.easing.min.js')}}"></script>
      <script src="{{asset('public/assets/js/wow.min.js')}}"></script>
      <script src="{{asset('public/assets/js/jquery.scrollTo.js')}}"></script>
      <script src="{{asset('public/assets/js/nivo-lightbox.min.js')}}"></script>
      <script src="{{asset('public/assets/js/custom.js')}}"></script> 
      <script src="{{asset('public/assets/js/datepicker.js')}}"></script>
      <!-- <script src="{{asset('public/assets/js/language.js')}}"></script> -->
</html>
