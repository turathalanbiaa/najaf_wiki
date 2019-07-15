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
<div class="container-fluid">
    <div class="row align-items-baseline">
        <div class="col-sm-2 px-1">
            <div class="py-2 sticky-top flex-grow-1">
                <div class="nav flex-sm-column">
                    <div class="text-center">
                        <img src="{{ asset('logo.png') }}" alt="no logo"/>
                    </div>
                    <ul class="nav nav-pills flex-column">
                        @foreach ($categories as $category)
                            <h5 class="border-bottom px-3 mt-3">{{$category->name}}</h5>
                            @foreach ($category->subcategories as $subcategory)
                                <li class="nav-item">
                                    <a class="nav-link pb-0" style="color:#0645ad"
                                       href="{{route('post',$subcategory->id)}}">{{$subcategory->name}}</a>
                                </li>
                            @endforeach
                        @endforeach

                    </ul>
                </div>
            </div>
        </div>
            <div class="col">
          <ul class="nav nav-tabs"  role="tablist" style="border-bottom: 1px solid #a7d7f9;">
                    <li class="nav-item">
                        <a class="nav-link active" data-toggle="tab" href="{{url('/')}}" >المقالة</a>
                    </li>
                   {{-- <li class="nav-item" >
                        <a class="nav-link" data-toggle="tab" href="#" >تعليق</a>
                    </li>--}}

                </ul>
                <div class="articale border-top-0">
                    @forelse  ($posts as $post)
                        <h2>{!! $post->title!!} </h2>
                        <p>
                            {!!$post->description!!}
                        </p>
                        @empty
                        <p>
                           لايوجد بيانات
                            <a class="nav-link pb-0" style="color:#0645ad"
                               href="{{url('/')}}">رجوع</a>
                        </p>

                    @endforelse
                </div>

                <footer class="col p-0">
                    <ul class="nav pr-0 mb-5">
                        <li class="nav-item mr-0">
                            <a class="nav-link mr-0" style="color:#0645ad" href="#">معهد تراث الانبياء</a>
                        </li>
                        <li class="nav-item mr-0">
                            <a class="nav-link mr-0" style="color:#0645ad" href="#">القيس بوك</a>
                        </li>
                        <li class="nav-item mr-0">
                            <a class="nav-link mr-0" style="color:#0645ad" href="#">تليكرام</a>
                        </li>
                    </ul>
                </footer>
            </div>



        </div>
    </div>

</body>
</html>
