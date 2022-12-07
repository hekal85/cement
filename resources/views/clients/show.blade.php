@extends('layouts.manufactories')
@section('title', $client->person->name)

@section('content')
    <div class="row">
        <div class="col-lg-8 mx-auto">
            <div class="card">
                <div class="card-body">
                    <h2 class="m-0 py-2 text-center bg-success"> مشاهدة بيانات العميل {{ $client->person->name }}</h2>

                    <table class="table table-striped table-bordered" id="printThisDiv">
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
                            <td>{{ $client->person->City->state }}</td>
                            <td>المركز: </td>
                            <td>{{ $client->person->City->city }}</td>
                        </tr>
                        <tr>
                            <th scope="row">العنوان: </th>
                            <td colspan="3">{{ $client->person->address }}</td>
                        </tr>
                        <tr>
                            <th scope="row"> ملاحظات: </th>
                            <td colspan="3">{{ $client->person->notes }}</td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <a href="{{route('client_movements', ['id' => $client->id])}}" target="_blank"
                                class="btn btn-primary w-100" >
                                    متابعة حركة البضاعة
                                </a>
                            </td>
                            <td colspan="2">
                                <a href="{{route('client_movements', ['id' => $client->id])}}" target="_blank"
                                class="btn btn-warning w-100" >
                                    متابعة حركة النقدية
                                </a>
                            </td>
                        </tr>
                        </tbody>
                    </table>

                </div><!--end card-body-->
            </div><!--end card-->
        </div><!--end col-->
    </div><!--end row-->


    <input type="button" onclick="printDiv('printThisDiv')" value="Print a Div" />
    <script>
        function printDiv(elem)
        {
            var mywindow = window.open();
            var content = document.getElementById(elem).innerHTML;
            var realContent = document.body.innerHTML;
            mywindow.document.write(content);
            mywindow.document.close(); // necessary for IE >= 10
            mywindow.focus(); // necessary for IE >= 10*/
            mywindow.print();
            document.body.innerHTML = realContent;
            mywindow.close();
            return true;
        }
    </script>





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
