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
        <div class="form-group">
          <strong>الحالة: </strong>
          <br/>
          <input type="checkbox" {{ $post->status ? 'checked' : '' }} name="status" onclick="return false;">
        </div>
      </div>
      <div class="col-md-12 d-flex">
        <a href="{{route('posts.edit', $post->id)}}" class="btn  btn-sm btn-primary px-4">تعديل</a>
        @auth
          @if(Auth::user()->hasRole('مدير'))
            <a href="{{route('accept',$post->id)}}" class="btn btn-sm btn-success px-4 ml-1">موافقة</a>
            <form class="delFrm" action="{{route('posts.destroy',$post->id)}}" method="post">
              @csrf
              @method('DELETE')
              <button class="btn btn-sm btn-danger px-4 mx-1" type="submit">حذف</button>
            </form>
          @endif
        @endauth

        <a href="{{route('posts.index')}}" class="btn btn-sm btn-secondary px-4 ml-1">رجوع</a>
      </div>
    </div>

<script>
    $('.delFrm').on('submit',function (e) {
        e.preventDefault();
        let form=this;
        bootbox.confirm({
            locale:'ar',
            size: "small",
            message: "هل انت متاكد؟",
            buttons: {
                confirm: {
                    label: 'تاكيد',
                    className: 'btn-sm btn-success px-4'
                },
                cancel: {
                    label: 'الغاء',
                    className: ' btn-sm btn-danger px-4'
                }
            },

            callback: function (result) {
                if(result===true){
                    form.submit();
                }

            }
        });

    });


</script>
  </div>

@endsection