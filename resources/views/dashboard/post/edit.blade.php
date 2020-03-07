@extends('layouts.app')
@section('content')
  <div class="container">
      <h4> تعديل مقالة</h4><br/>
      <form method="post" action="{{route('posts.update', $post->id)}}" enctype="multipart/form-data">
        @csrf
        <input name="_method" type="hidden" value="PATCH">
          <div class="form-group">
              <label for="category">الصنف الرئيسي</label>
              <select id="category" name="category" class="form-control" required>
                  <option selected disabled></option>
                  @foreach($categories as $category)
                      <option value="{{$category->id}}"@if($post->subcategory->category->id==$category->id) selected @endif>{{$category->name}}</option>
                  @endforeach
              </select>
          </div>
          <div class="form-group">
              <label for="subcategory">الصنف الفرعي</label>
              <select id="subcategory" name="subcategory" class="form-control" required>
                  <option value="{{$post->subcategory->id}}">{{$post->subcategory->name}}</option>
              </select>
          </div>

      <div class="form-group">
        <label for="title">العنوان</label>
        <input type="text" class="form-control" id="title" name="title" placeholder="أدخل الأسم" required  value="{{$post->title}}">
      </div>

      <div class="form-group">
        <label for="description">الوصف</label>
        <textarea class="form-control" id="description" name="description" placeholder="أدخل الوصف">{{$post->description}}</textarea>
      </div>
          <button type="submit" class="btn btn-sm btn-primary  px-4">حفظ</button>
          <a href="{{route('posts.index')}}" class="btn btn-sm btn-secondary  px-4">الغاء</a>
    </form>
  </div>
@endsection
@section('js')
    <script src="{{asset('ckeditor/ckeditor.js')}}"></script>
    <script type="text/javascript">
        $(function () {
            $('#category').on('change', function() {
                $('#subcategory').empty();
                $.get('/dashboard/getSubcategory/'+this.value,function(data){
                    $.each(data,function (index,object) {
                        $('#subcategory').append('<option value="'+object.id+'">'+object.name+'</option>')
                    });
                });
            });
        });
        CKEDITOR.replace('description',{
            filebrowserImageBrowseUrl: '/laravel-filemanager?type=Images',
            filebrowserBrowseUrl: '/laravel-filemanager?type=Files',
        });
    </script>
@endsection