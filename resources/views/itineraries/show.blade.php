@extends('layouts.manufactories')
@section('title', $client->person->name)

@section('content')
    <div class="row">
        <div class="col-lg-8 mx-auto">
            <div class="card">
                <div class="card-body">
                    <h2 class="m-0 py-2 text-center bg-success"> مشاهدة بيانات العميل {{ $client->person->name }}</h2>

                    <table class="table table-striped table-bordered">
                        <tbody>
                        <tr>
                            <th scope="row">الاسم : </th>
                            <td>{{ $client->person->name }}</td>
                            <th scope="row">المندوب : </th>
                            <td>{{ $client->representative->person->name }}</td>
                        </tr>
                        <tr>
                            <td>الإيميل: </td>
                            <td>{{ $client->person->email }}</td>
                            <th scope="row">الرصيد: </th>
                            <td>{{ $client->person->cash }}</td>
                        </tr>
                        <tr>
                            <th scope="row">الموبايل: </th>
                            <td>{{ $client->person->mobile }}</td>
                            <td>الهاتف: </td>
                            <td>{{ $client->person->phone }}</td>
                        </tr>
                        <tr>
                            <th scope="row">المحافظة: </th>
                            <td>{{ $client->person->state }}</td>
                            <td>المركز: </td>
                            <td>{{ $client->person->city }}</td>
                        </tr>
                        <tr>
                            <th scope="row">العنوان: </th>
                            <td colspan="3">{{ $client->person->address }}</td>
                        </tr>
                        <tr>
                            <th scope="row">ملاحظات: </td>
                            <td colspan="3">{{ $client->person->notes }}</td>
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
