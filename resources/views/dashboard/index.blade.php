@extends('layouts.app')
@section('content')
    <div class="container">
        <br />
        @if (\Session::has('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <p>{{ \Session::get('success') }}</p>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div><br />
        @endif
        <table class="table table-bordered">
            <thead>
            <th>العنوان</th>
            <th>العمليات</th>
            </thead>
            <tbody>
            <a class="btn  btn-sm btn-success m-2  px-4" href="{{route('dashboard.create')}}">جديد</a>
            @foreach ($posts as $post)
                <tr>
                    <td>{{$post->title}}</td>

                    <td class="d-flex">
                        <a  href="{{route('dashboard.show', $post->id)}}" class="btn  btn-sm btn-primary mr-1">معاينة</a>
                        <a href="{{route('dashboard.edit', $post->id)}}" class="btn  btn-sm btn-warning">تعديل</a>
                        <form class="delFrm" action="{{route('dashboard.destroy',$post->id)}}" method="post">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger mx-1" type="submit">حذف</button>
                        </form>
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
