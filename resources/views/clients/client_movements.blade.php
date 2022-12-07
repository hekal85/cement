@extends('layouts.manufactories')

@section('css')
    <link href="../assets/plugins/datatables/dataTables.bootstrap4.min.css" rel="stylesheet" />
    <link href="../assets/plugins/datatables/buttons.bootstrap4.min.css" rel="stylesheet" />
    <link href="../assets/plugins/datatables/responsive.bootstrap4.min.css" rel="stylesheet" />
@endsection

@section('js')
    <script src="../assets/plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="../assets/plugins/datatables/dataTables.bootstrap4.min.js"></script>
    <script src="../assets/plugins/datatables/dataTables.buttons.min.js"></script>
    <script src="../assets/plugins/datatables/buttons.bootstrap4.min.js"></script>
    <script src="../assets/plugins/datatables/jszip.min.js"></script>
    <script src="../assets/plugins/datatables/pdfmake.min.js"></script>
    <script src="../assets/plugins/datatables/vfs_fonts.js"></script>
    <script src="../assets/plugins/datatables/buttons.html5.min.js"></script>
    <script src="../assets/plugins/datatables/buttons.print.min.js"></script>
    <script src="../assets/plugins/datatables/buttons.colVis.min.js"></script>
    <script src="../assets/plugins/datatables/dataTables.responsive.min.js"></script>
    <script src="../assets/plugins/datatables/responsive.bootstrap4.min.js"></script>
    <script src="../assets/pages/jquery.datatable.init.js"></script>
@endsection

@section('content')
    <div class="row mt-3 pt-2">
        <div class="col-12 mx-auto">
            <div class="card">
                <div class="card-body">
                    @if(session()->get('success'))
                        <div class="alert alert-success">
                            <span class="text-primary">{{ session()->get('success') }}</span>
                            <span class="text-danger">{{ session()->get('name') }}</span>
                        </div>
                    @endif

                    <h1 class="mb-2 py-2 text-center bg-success rounded">
                        حركات البضاعة للعميل
                        {{ $client->name }}
                    </h1>

                    <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap"
                           style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>التاريخ</th>
                            <th>الحركة</th>
                            <th>الحمولة</th>
                            <th>النوع</th>
                            <th>السعر</th>
                            <th>الإجمالى</th>
                            <th>الخصم</th>
                            <th>المدفوع</th>
                            <th>سابق</th>
                            <th>المتبقى</th>
                        </tr>
                        </thead>
                        <tbody>
                        @php($no=1)
                        @foreach ($shipmentDetails as $details)
                            @php($paid = $details->transportation + $details->paid)
                            @php($prev = $paid + $details->owed)
                            <tr>
                                <td>{{ $no++ }}</td>
                                <td>{{ $details->created_at }}</td>
                                <td>{{ $details->shipment_id }}</td>
                                <td>
                                    {{ floor($details->payload / 20 ) }} طن
                                    {{ $details->payload % 20 != 0  ? ' و '.$details->payload % 20 . ' ش' : ''}}
                                </td>
                                <td>{{ $details->Shipment->Coupon[0]->CementType->name }}</td>
                                <td>{{ $details->cost }}</td>
                                <td>{{ $details->total }}</td>
                                <td>{{ $details->discount }}</td>
                                <td>{{ $paid }}</td>
                                <td>{{ $prev }}</td>
                                <td>{{ $details->owed }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div> <!-- end col -->
    </div> <!-- end row -->

    <script>
        $(function () {
            // Hide Success div after 5 seconds
            setTimeout(function () {
                $('.alert-success').fadeOut('slow');
            }, 5000);
        })
    </script>
@endsection
