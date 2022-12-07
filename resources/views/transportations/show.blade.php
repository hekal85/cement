@extends('layouts.manufactories')
@section('title', $transportation->company->name)

@section('content')
    <div class="row">
        <div class="col-lg-8 mx-auto mt-3">
            <div class="card">
                <div class="card-body">
                    <h2 class="mb-2 py-2 text-center bg-info rounded"> شركة {{ $transportation->company->name }}</h2>

                    <table class="table table-striped table-bordered">
                        <tbody>
                        <tr>
                            <th scope="row">الاسم : </th>
                            <td>{{ $transportation->company->name }}</td>
                            <td>المدير: </td>
                            <td>{{ $transportation->company->director }}</td>
                        </tr>
                        <tr>
                            <th scope="row">الموبايل: </th>
                            <td>{{ $transportation->company->mobile }}</td>
                            <td>الهاتف: </td>
                            <td>{{ $transportation->company->phone }}</td>
                        </tr>
                        <tr>
                            <th scope="row">المحافظة: </th>
                            <td>{{ $transportation->company->City->state }}</td>
                            <td>المركز: </td>
                            <td>{{ $transportation->company->City->city }}</td>
                        </tr>
                        <tr>
                            <th scope="row">العنوان: </th>
                            <td>{{ $transportation->company->address }}</td>
                            <td>الإيميل: </td>
                            <td>{{ $transportation->company->email }}</td>
                        </tr>
                        <tr>
                            <th scope="row">الرصيد: </th>
                            <td>{{ $transportation->company->cash }}</td>
                            <td>حركات النقل: </td>
                            <td>
                                <a class="btn btn-gradient-primary form-control" title="متابعة حركات النقل"
                                   href="{{route('transportation_movements', $transportation)}}">
                                    <i class="fa-solid fa-truck"></i>
                                </a>
                            </td>
                        </tr>
                        <tr>
                            <td>الملاحظات: </td>
                            <td colspan="3">{{ $transportation->company->notes }}</td>
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
