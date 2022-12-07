@extends('layouts.manufactories')
@section('title', $client->name)
@section('content')
    <div class="row d-flex justify-content-center">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-body">

                    <table class="table table-striped table-bordered">
                        <tbody>
                        <tr>
                            <th scope="row">الاسم</th>
                            <td>{{ $client->name }}</td>
                        </tr>
                        <tr>
                            <th scope="row">الموبايل</th>
                            <td>{{ $client->mobile }}</td>
                        </tr>
                        <tr>
                            <th scope="row">الهاتف</th>
                            <td>{{ $client->phone }}</td>
                        </tr>
                        <tr>
                            <th scope="row">الإيميل</th>
                            <td>{{ $client->email }}</td>
                        </tr>
                        <tr>
                            <th scope="row">الرقم القومى</th>
                            <td>{{ $client->ssn }}</td>
                        </tr>
                        <tr>
                            <th scope="row">الرصيد</th>
                            <td>{{ $client->credit }}</td>
                        </tr>
                        <tr>
                            <th scope="row">المحافظة</th>
                            <td>{{ $client->state }}</td>
                        </tr>
                        <tr>
                            <th scope="row">المركز</th>
                            <td>{{ $client->city }}</td>
                        </tr>
                        <tr>
                            <th scope="row">العنوان</th>
                            <td>{{ $client->address }}</td>
                        </tr>
                        <tr>
                            <th scope="row">ملاحظات</th>
                            <td>{{ $client->notes }}</td>
                        </tr>
                        </tbody>
                    </table>
                </div><!--end card-body-->
            </div><!--end card-->
        </div><!--end col-->

    </div><!--end row-->

    <script>
        $(function () {
            $('#state').on('change',function(e){
                $('#city').find('option').remove();
                let state = $(this).val();
                let info=$.get("{{url('fetch_cities')}}",{state:state});
                info.done(function(data){
                    $.each(data,function(index,c){
                        $('#city').append('<option value="'+c.city+'">'+ c.city+'</option>');
                    });
                });
            });
        })
    </script>
@endsection
