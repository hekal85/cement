@extends('layouts.manufactories')
@section('title', $Manufactory->Company->name)

@section('content')
    <div class="row">
        <div class="col-lg-8 mx-auto">
            <div class="card">
                <div class="card-body">
                    <h2 class="m-0 py-2 text-center bg-success"> مصنع {{ $Manufactory->Company->name }}</h2>

                    <table class="table table-striped table-bordered">
                        <tbody>
                        <tr>
                            <th scope="row">الاسم : </th>
                            <td>{{ $Manufactory->Company->name }}</td>
                            <td>المدير: </td>
                            <td>{{ $Manufactory->Company->director }}</td>
                        </tr>
                        <tr>
                            <th scope="row">الموبايل: </th>
                            <td>{{ $Manufactory->Company->mobile }}</td>
                            <td>الهاتف: </td>
                            <td>{{ $Manufactory->Company->phone }}</td>
                        </tr>
                        <tr>
                            <th scope="row">المحافظة: </th>
                            <td>{{ $Manufactory->Company->City->state }}</td>
                            <td>المركز: </td>
                            <td>{{ $Manufactory->Company->City->city }}</td>
                        </tr>
                        <tr>
                            <th scope="row">العنوان: </th>
                            <td>{{ $Manufactory->Company->address }}</td>
                            <td>الإيميل: </td>
                            <td>{{ $Manufactory->Company->email }}</td>
                        </tr>
                        <tr>
                            <th scope="row">الرصيد: </th>
                            <td>{{ $Manufactory->Company->cach }}</td>
                            <td>الملاحظات: </td>
                            <td>{{ $Manufactory->Company->notes }}</td>
                        </tr>
                        </tbody>
                    </table>

                </div><!--end card-body-->
            </div><!--end card-->
        </div><!--end col-->
    </div><!--end row-->

    <script>
        $(function () {
            $('#state').on('change', function () {
                let state_id = $(this).val();
                $("#city").html('');
                $.ajax({
                    url: '{{url('fetch_cities')}}',
                    type: "POST",
                    data: {state_id: state_id, _token: '{{csrf_token()}}'},
                    dataType: 'json',
                    success: function (result) {
                        $.each(result, function (key, value) {
                            $("#city").append('<option value="' + value.city + '">' + value.city + '</option>');
                        });
                    }
                });
            });
        });
    </script>

@endsection
