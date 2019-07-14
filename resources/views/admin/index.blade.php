@extends('layouts.app')

@section('content')
    <div class="container">
    @if ($message = Session::get('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>{{ $message }}</strong>
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
        <th>مشرف</th>
        <th>مستخدم</th>
        <th>العمليات</th>
        </thead>
        <tbody>
        <a class="btn  btn-sm btn-success m-2 px-4" href="{{route('admin.create')}}">جديد</a>
        @foreach($users as $user)
            <tr>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }} <input type="hidden" name="email" value="{{ $user->email }}"></td>
                    <td><input type="checkbox" {{ $user->hasRole('Admin') ? 'checked' : '' }} name="role_admin" onclick="return false;"></td>
                    <td><input type="checkbox" {{ $user->hasRole('Author') ? 'checked' : '' }} name="role_author" onclick="return false;"></td>
                    <td><input type="checkbox" {{ $user->hasRole('User') ? 'checked' : '' }} name="role_user" onclick="return false;"></td>

                    <td class="d-flex">
                        <a  href="{{ route('admin.edit',$user->id)}}" class="btn  btn-sm btn-primary mr-1">تعديل</a>
                        <a href="{{ route('edit-password',$user->id)}}" class="btn  btn-sm btn-warning">تغير الباسورد</a>
                        <form class="delFrm" action="{{route('admin.destroy',$user->id)}}" method="post">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger mx-1" type="submit">حذف</button>
                        </form>
                    </td>
            </tr>
        @endforeach
        </tbody>
    </table>
        {!! $users->links() !!}
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
