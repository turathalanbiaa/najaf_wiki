@extends('layouts.website')
@section('content')
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
                        <a class="nav-link active" style="color:#0645ad"  @isset($post) href="{{route('post',$post->subcategory_id)}}" @endisset >المقالة</a>
                    </li>
           <li class="nav-item" >
                         <a class="nav-link" style="color:#0645ad"  @isset($post) href="{{route('comments',$post->subcategory_id)}}" @endisset>التعليقات</a>
                    </li>

                </ul>
                <div class="articale border-top-0">
                    @isset($post)
                        <h2>{!! $post->title!!} </h2>
                        <p>
                            {!!$post->description!!}
                        </p>
                    @endisset
                        @empty($post)
                        <p>
                           لايوجد بيانات
                            <a class="nav-link pb-0" style="color:#0645ad"
                               href="{{url('/post')}}">رجوع</a>
                        </p>

                        @endempty
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


@endsection
