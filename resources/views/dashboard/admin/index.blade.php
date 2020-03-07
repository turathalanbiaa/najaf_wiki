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
        <th>الاسم</th>
        <th>الايميل</th>
        <th>مدير</th>
        <th>محرر</th>
        <th>العمليات</th>
        </thead>
        <tbody>
        <a class="btn  btn-sm btn-success m-2 px-4" href="{{route('admins.create')}}">جديد</a>
        @foreach($admins as $admin)
            <tr>
                    <td>{{ $admin->name }}</td>
                    <td>{{ $admin->email }} <input type="hidden" name="email" value="{{ $admin->email }}"></td>
                    <td><input type="checkbox" {{ $admin->hasRole('مدير') ? 'checked' : '' }} name="role_admin" onclick="return false;"></td>
                    <td><input type="checkbox" {{ $admin->hasRole('محرر') ? 'checked' : '' }} name="role_author" onclick="return false;"></td>


                    <td class="d-flex">
                        <a  href="{{ route('admins.edit',$admin->id)}}" class="btn  btn-sm btn-primary mr-1">تعديل</a>
                        <a href="{{ route('editPassword',$admin->id)}}" class="btn  btn-sm btn-secondary">تغير كلمة المرور</a>
                        <form class="delFrm" action="{{route('admins.destroy',$admin->id)}}" method="post">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger mx-1" type="submit">حذف</button>
                        </form>
                    </td>
            </tr>
        @endforeach
        </tbody>
    </table>
        {!! $admins->links() !!}
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
@endsection
