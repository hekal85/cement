@extends('layouts.manufactories')
@section('title', $representative->person->name)

@section('content')
    <div class="row">
        <div class="col-lg-8 mx-auto">
            <div class="card">
                <div class="card-body">
                    <h2 class="m-0 py-2 text-center bg-success"> المندب {{ $representative->person->name }}</h2>

                    <table class="table table-striped table-bordered">
                        <tbody>
                        <tr>
                            <th scope="row">الاسم : </th>
                            <td>{{ $representative->person->name }}</td>
                            <th scope="row">الرصيد: </th>
                            <td>{{ $representative->person->cash }}</td>
                        </tr>
                        <tr>
                            <th scope="row">الموبايل: </th>
                            <td>{{ $representative->person->mobile }}</td>
                            <td>الهاتف: </td>
                            <td>{{ $representative->person->phone }}</td>
                        </tr>
                        <tr>
                            <th scope="row">المحافظة: </th>
                            <td>{{ $representative->person->City->state }}</td>
                            <td>المركز: </td>
                            <td>{{ $representative->person->City->city }}</td>
                        </tr>
                        <tr>
                            <th scope="row">العنوان: </th>
                            <td>{{ $representative->person->address }}</td>
                            <td>الإيميل: </td>
                            <td>{{ $representative->person->email }}</td>
                        </tr>
                        <tr>
                            <td>الملاحظات: </td>
                            <td colspan="3">{{ $representative->person->notes }}</td>
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
