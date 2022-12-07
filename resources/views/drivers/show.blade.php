@extends('layouts.manufactories')
@section('title', $driver->person->name)

@section('content')
    <div class="row">
        <div class="col-lg-8 mx-auto">
            <div class="card">
                <div class="card-body">
                    <h2 class="m-0 py-2 text-center bg-success"> السائق {{ $driver->person->name }}</h2>

                    <table class="table table-striped table-bordered">
                        <tbody>
                        <tr>
                            <td>الاسم : </td>
                            <td>{{ $driver->person->name }}</td>
                            <td>الرصيد: </td>
                            <td>{{ $driver->person->cash }}</td>
                        </tr>
                        <tr>
                            <td>شركة الشحن: </td>
                            <td colspan="3">{{ $driver->Transportation->company->name }}</td>
                        </tr>
                        <tr>
                            <td>الموبايل: </td>
                            <td>{{ $driver->person->mobile }}</td>
                            <td>الهاتف: </td>
                            <td>{{ $driver->person->phone }}</td>
                        </tr>
                        <tr>
                            <td>المحافظة: </td>
                            <td>{{ $driver->person->City->state }}</td>
                            <td>المركز: </td>
                            <td>{{ $driver->person->City->city }}</td>
                        </tr>
                        <tr>
                            <td>العنوان: </td>
                            <td>{{ $driver->person->address }}</td>
                            <td>الإيميل: </td>
                            <td>{{ $driver->person->email }}</td>
                        </tr>
                        <tr>
                            <td>الملاحظات: </td>
                            <td colspan="3">{{ $driver->person->notes }}</td>
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
                let state_id = $(tdis).val();
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
