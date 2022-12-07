@extends('layouts.manufactories')
@section('title', 'حركات '.$transportation)

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

    <div class="row px-2 mt-2">
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
                        شركة
                        {{ $transportation }}
                    </h1>

                    <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap"
                           style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>الحركة</th>
                            <th>تاريخ الحركة</th>
                            <th>مصنع الأسمنت</th>
                            <th>الحمولة</th>
                            <th>النوع</th>
                            <th>السعر</th>
                            <th>تكلفة النقل</th>
                            <th>الإجمالى</th>
                            <th>ملاحظات</th>
                        </tr>
                        </thead>
                        <tbody>
                        @php($no=1)
                        @php($trans=0)
                        @php($total_trans=0)
                        @foreach ($shipments as $shipment)
                            @php($trans += $shipment->trans * floor($shipment->payload / 20 ))
                            @php($total_trans += $trans)
                            <tr>
                                <td>{{ $no++ }}</td>
                                <td>
                                    <a class="btn btn-info" href="{{ route('shipment.show',$shipment->id) }}">
                                        {{ $shipment->id }}
                                    </a>
                                </td>
                                <td>{{ $shipment->created_at }}</td>
                                <td>{{ $shipment->Manufactory->Company->name }}</td>
                                <td>
                                    {{ floor($shipment->payload / 20 ) }} طن
                                    {{ $shipment->payload % 20 != 0  ? ' و '.$shipment->payload % 20 . ' ش' : ''}}
                                </td>
                                <td>{{ $shipment->Coupon[0]->CementType->name }}</td>
                                <td>{{ $shipment->cost }}</td>
                                <td>{{ $trans }}</td>
                                <td>{{ $shipment->total }}</td>
                                <td>{{ $shipment->notes }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                        <tfoot>
                        <tr>
                            <td colspan="6"></td>
                            <td>إجمالى المبالغ</td>
                            <td colspan="3">{{ $total_trans }}</td>
                        </tr>
                        </tfoot>
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
