@extends('layouts.dashboard')

@section('dashboard_content')
    <table class="table table-hover">
        <tr>
            <th scope="col">ردیف</th>
            <th scope="col">نام</th>
            <th scope="col">نام کاربری</th>
            <th scope="col">شماره پرسنلی</th>
            <th scope="col">شماره ملی</th>
            <th scope="col">عملیات</th>
        </tr>
        @php($i=1)
        @foreach($users as $user)
            <tr>
                <td>{{$i}}</td>
                <td>{{$user['first_name'].' '.$user['last_name']}}</td>
                <td>{{$user['username']}}</td>
                <td>{{$user['personal_code']}}</td>
                <td>{{$user['national_code']}}</td>
                <td>
                    <button class="btn btn-outline-primary edit-user" data-user-id="{{$user['id']}}"><i
                            class="fa fa-pencil"></i></button>
                    <button class="btn btn-outline-danger delete-user" data-user-id="{{$user['id']}}"><i
                            class="fa fa-trash"></i></button>
                </td>
            </tr>
            @php($i++)
        @endforeach
        <tr>
            <td colspan="6">{{$users->links()}}</td>
        </tr>
    </table>
@endsection
@push('js')
    <script>
        $(document).ready(function () {
            let Axios = axios.create({
                baseURL: 'http://127.0.0.1:8000/api/',
                timeout: 1000,
            });
            $('.edit-user').click(function () {
                let id = $(this).attr('data-user-id');
                console.log('trying to edit user:' + id);
                Axios.get('user')
                    .then(function (response) {
                        console.log('response', response);
                    })
                    .catch(function (error) {
                        console.error(error);
                    })
            });
        });
    </script>
@endpush
