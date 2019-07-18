<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>موسوعة النجف</title>
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="{{ asset('js/jquery-3.4.1.min.js') }}"></script>
    <!-- Styles -->
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
</head>

<body>
<main class="container-fluid">
    <a href="#" class="d-block text-center pb-3" style="padding-top: 10vh">
        <img  src="{{ asset('main_logo.png') }}" alt="no logo"/>
    </a>


    <form id="frmSearch" method="GET" action="{{ url('/search') }}" class="d-flex justify-content-center">
        @csrf
        <input name="search" class="form-control w-25 shadow-sm"   placeholder="ادخل كلمة للبحث عنها ...">
    </form>

    <div class= "text-center pt-3">
        <input class="btn btn-sm btn-primary" type="submit" form="frmSearch" value="ابحث" >
        <a class="btn btn-sm btn-secondary" href={{url('/posts')}} >الصفحة الرئيسية</a>
    </div>

</main>
</body>
</html>