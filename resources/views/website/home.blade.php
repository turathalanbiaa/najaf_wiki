@extends('layouts.website')
@section('content')
    <a href="#" class="d-block text-center pb-3" style="padding-top: 10vh">
        <img  src="{{ asset('main_logo.png') }}" alt="no logo"/>
    </a>


    <form id="frmSearch" method="GET" action="{{ url('/search') }}" class="d-flex justify-content-center">
        @csrf
        <input name="search" class="form-control w-25 shadow-sm"   placeholder="ادخل كلمة للبحث عنها ...">
    </form>

    <div class= "text-center pt-3">
        <input class="btn btn-sm btn-primary" type="submit" form="frmSearch" value="ابحث" >
        <a class="btn btn-sm btn-secondary" href={{url('/post')}} >الصفحة الرئيسية</a>
    </div>
@endsection