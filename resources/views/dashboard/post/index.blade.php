@extends('layouts.app')
@section('content')
    <div class="container">
        @if (Session::has('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>{{ Session::get('success') }}</strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif
        <table class="table table-bordered">
            <thead>
            <th>العنوان</th>
            <th>الحالة</th>
            <th>العمليات</th>
            </thead>
            <tbody>
            <a class="btn  btn-sm btn-success m-2  px-4" href="{{route('posts.create')}}">جديد</a>
            @foreach ($posts as $post)
                <tr>
                    <td>{{$post->title}}</td>
                    <td><input type="checkbox" {{ $post->status ? 'checked' : '' }} name="status" onclick="return false;"></td>
                    <td class="d-flex">
                        <a  href="{{route('posts.show', $post->id)}}" class="btn  btn-sm btn-primary mr-1">معاينة</a>
                        <a href="{{route('posts.edit', $post->id)}}" class="btn  btn-sm btn-secondary">تعديل</a>
                        @auth
                            @if(Auth::user()->hasRole('مدير'))
                        <form class="delFrm" action="{{route('posts.destroy',$post->id)}}" method="post">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger mx-1" type="submit">حذف</button>
                        </form>
                            @endif
                        @endauth
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>

        {!! $posts->links() !!}
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
