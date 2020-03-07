@extends('layouts.app')
@section('content')
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <h3>التفاصيل</h3>
        <hr>
      </div>
    </div>
    <div class="row">
      <div class="col-md-12">

        <div class="form-group">
          <strong>الصنف الرئيسي: </strong>
          {{$post->subcategory->category->name}}
        </div>
        <div class="form-group">
          <strong>الصنف الفرعي: </strong>
          {{$post->subcategory->name}}
        </div>
        <div class="form-group">
          <strong>العنوان: </strong>
        {{$post->title}}
        </div>
        <div class="form-group">
          <strong>الوصف: </strong>
          {!!$post->description!!}
        </div>
      </div>
      <div class="col-md-12">
        <a href="{{route('posts.edit', $post->id)}}" class="btn  btn-sm btn-primary px-4">تعديل</a>
        <a href="{{route('posts.index')}}" class="btn btn-sm btn-secondary px-4">رجوع</a>
      </div>
    </div>
  </div>
@endsection
