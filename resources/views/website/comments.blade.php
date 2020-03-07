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
    @guest

        <div class="d-flex flex-row-reverse  p-0" >
            <div class="pt-2 px-1">  <a  href="{{ route('login') }}"  style="color:#0645ad">{{ __('دخول') }}</a></div>
            <div class="pt-2 px-1">  <a href="{{ route('register') }}"  style="color:#0645ad">{{ __('انشاء حساب') }}</a></div>
        </div>
    @else

        <div class="d-flex flex-row-reverse" >
            <div class="nav-item dropdown">
                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                    {{ Auth::user()->name }} <span class="caret"></span>
                </a>

                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="{{ route('logout') }}"
                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                        {{ __('خروج') }}
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </div>
            </div>
        </div>
    @endguest

    <div class="row align-items-baseline">
        <div class="col-sm-1 px-1">
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
                <ul class="nav nav-tabs"  style="border-bottom: 1px solid #a7d7f9;">
                    <li class="nav-item">
                        <a class="nav-link"  @isset($post) href="{{route('post',$post->id)}}" @endisset >المقالة</a>
                    </li>
                    <li class="nav-item" >
                        <a class="nav-link active"   @isset($post) href="{{route('comments',$post->id)}}" @endisset>التعليقات</a>
                    </li>

                </ul>
                <div class="articale border-top-0">

                    <div class="row bootstrap snippets">
                        <div class="col-md-6 col-md-offset-2 col-sm-12">
                            <div class="comment-wrapper">


                                @guest
                                    <span>
                                       يرجى تسجيل الدخول او انشاء حساب لتتمكن من اضافة تعليق
                                    </span>
                                @else
                                    <form method="POST" action="{{route('comment',$post->id)}}">
                                        @csrf
                                        <textarea class="form-control" name="text" placeholder="اترك تعليق..." rows="3" required></textarea>
                                        <br>
                                        <button type="submit" class="btn btn-sm btn-info pull-right">
                                            {{ __('اضافة') }}
                                        </button>
                                    </form>
                                    @endguest
                                        <hr>
                                        <ul class="media-list">
                                            @forelse ($post->comments as $comment)
                                                <li class="media">

                                                    <div class="media-body">
                                <span class="text-muted pull-right">

                                </span>
                                                        <strong class="text-success">{{$comment->user_name}}</strong>
                                                        <p>
                                                            {{$comment->text}}
                                                        </p>
                                                        <small class="text-muted"> {{$comment->date}}</small>
                                                    </div>
                                                </li>
                                            @empty
                                                <p>لا توجد تعليقات</p>
                                            @endforelse

                                        </ul>
                                    </div>
                                </div>
                            </div>
                </div>


                <footer class="col p-0">
                    <ul class="nav pr-0 mb-5">
                        <li class="nav-item mr-0">
                            <a class="nav-link mr-0" style="color:#0645ad" href="#">معهد تراث الانبياء</a>
                        </li>
                        <li class="nav-item mr-0">
                            <a class="nav-link mr-0" style="color:#0645ad" href="#">الفيس بوك</a>
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

