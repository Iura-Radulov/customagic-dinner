<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Customagic-dinner</title>
{{--    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">--}}
</head>
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
<link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap.min.css') }}">
<link rel="stylesheet" href="{{asset('css/home.css')}}">

    <!-- Styles -->
    <style>
   </style>
</head>
<body>

    <header class="header">
        <div class="container d-flex align-items-center">
        <img src="{{asset('images/logo-home.png')}}" alt="logo" width="200px">
        <h2 class="title">Заказ еды сотрудниками Customagic</h2>
        </div>
    </header>
    <div class="form_container">
        @if(Session::has('message-success'))
            <div style="position: absolute; top: 150px; right: 50px;" >
            <div id="alert" class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>{!! session('message-success') !!}</strong>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            </div>
        @endif
            @if(Session::has('message-error'))
                <div style="position: absolute; top: 150px; right: 50px;" >
                    <div id="alert" class="alert alert-danger alert-dismissible fade show" role="alert">
{{--                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">×</button>--}}
                        <strong>{!! session('message-error') !!}</strong>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                </div>
            @endif
        <form class="form" method="post" action="{{ url('check') }}">
            @csrf
            <h3 class="mb-5 ">Просканируйте или введите вручную номер карты</h3>
            <div class="input-group mb-5 w-50">
                <div class="input-group-text">
                    <input class="form-check-input mt-0 " type="checkbox" value="" aria-label="Checkbox for following text input">
                </div>
                <input type="text" name="number" class="form-control " aria-label="Text input with checkbox">
            </div>
            <button type="submit" class="btn btn-primary">Проверить</button>

        </form>
    </div>




    <script type="text/javascript" src="{{ asset('js/jquery-2.1.4.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/bootstrap.min-5.3.js') }}"></script>

    <script type="text/javascript">
        setTimeout(function () {

            // Closing the alert
            $('#alert').alert('close');
        }, 2000);
    </script>

{{--<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>--}}
</body>
</html>
