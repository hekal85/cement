@extends('layouts.manufactories')

@section('css')
    <link href="../assets/plugins/datatables/dataTables.bootstrap4.min.css" rel="stylesheet"/>
    <link href="../assets/plugins/datatables/buttons.bootstrap4.min.css" rel="stylesheet"/>
    <link href="../assets/plugins/datatables/responsive.bootstrap4.min.css" rel="stylesheet"/>
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

@section('title', 'Mahmoud Hekal')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h2 class="text-center bg-success rounded mb-2 py-2">مشاهدة حركات التوريد</h2>
                    @if(session()->get('process'))
                        <div class="alert alert-success">
                            <span class="text-primary">{{ session()->get('process') }}</span>
                            <span class="text-danger">{{ session()->get('name') }}</span>
                        </div>
                    @endif
                    <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap"
                           style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>الحركة</th>
                            <th>مصنع الأسمنت</th>
                            <th>شركة الشحن</th>
                            <th>الحمولة</th>
                            <th>#</th>
                            <!-- <th>الحالة</th> -->
                            <th>البونات</th>
                            <th>تاريخ الحركة</th>
                            <th>المتبقي</th>
                            <th>تسليم</th>
                        </tr>
                        </thead>
                        <tbody>
                        @php($no=1)
                        <ol>
                        @foreach ($shipments as $shipment)
                            <tr>
                                <td>{{ $no++ }}</td>
                                <td>

                                    @if(count($shipment->ShipmentDetails ) >= 1 )
                                        <a class="btn btn-warning" href="{{ route('shipment.show',$shipment->id) }}">
                                            {{ $shipment->id }}
                                        </a>
                                    @else
                                        <span class="btn btn-info">
                                            {{ $shipment->id }}
                                        </span>
                                    @endif

                                </td>
                                <td>{{ $shipment->manufactory->Company->name }}</td>
                                <td>{{ $shipment->transportation->Company->name }}</td>
                                <td>
                                    {{ floor($shipment->payload / 20 ) }} طن
                                    {{ $shipment->payload % 20 != 0  ? ' و '.$shipment->payload % 20 . ' ش' : ''}}
                                </td>
                                <td>
                                    @if(count($shipment->ShipmentDetails ) >= 1 )
                                    <button class="btn btn-warning clients" data-toggle="modal"
                                            data-id="{{ $shipment->id }}">
                                        {{ count($shipment->ShipmentDetails) }}
                                    </button>
                                    @else
                                        <button class="btn btn-info">
                                            {{ count($shipment->ShipmentDetails) }}
                                        </button>
                                    @endif
                                </td>
                                <!-- <td>{{ (@$shipment->done) ? 'تم التسليم' : 'لم تسلم' }}</td> -->
                                <td>
                                    <ul style="list-style: none; padding: 0; margin: 0">
                                        @foreach($shipment->Coupon as $coupon)
                                            <li>{{ $coupon->Coupon }} [{{ $coupon->value }}]</li>
                                        @endforeach
                                    </ul>
                                </td>
                                <td>{{ $shipment->created_at }}</td>
                                <td>
                                    {{ ($shipment->remaining > 0) ? floor($shipment->remaining / 20 ). ' طن و '.($shipment->remaining % 20). ' ش' : 0}}
                                </td>
                                <td>
                                    @if(!@$shipment->done)
                                        <a class="btn"
                                           href="{{ route('shipmentDetails.create', ['id' => $shipment->id ]) }}">
                                            <i class="fas fa-truck-loading"></i>
                                        </a>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                        </ol>
                        </tbody>
                    </table>

                </div>
            </div>
        </div> <!-- end col -->
    </div> <!-- end row -->

    <div class="modal fade bd-example-modal-xl" id="clients-no" tabindex="-1" role="dialog"
         aria-labelledby="clients-noLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title mt-0" id="clients-noLabel">العملاء الذى تم تسليمهم الأسمنت بالشحنة رقم: <span
                            id="shipment"></span></h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="table-responsive">
                        <table class="table mb-0">
                            <thead class="thead-light">
                                <tr>
                                    <th>#</th>
                                    <th>العميل</th>
                                    <th>الأطنان</th>
                                    <th>الشكاير</th>
                                    <th>السعر</th>
                                    <th>الإجمالى</th>
                                    <th>الخصم</th>
                                    <th>النقل</th>
                                    <th>المدفوع</th>
                                    <th>المتبقى</th>
                                    <th>التاريخ</th>
                                    <th>ملاحظات</th>
                                </tr>
                            </thead>
                            <tbody id="clients_details"></tbody>
                        </table>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(function () {
            $(".clients").click(function (e) {
                e.preventDefault();
                let shipment = +$(this).attr('data-id');
                $.ajax({
                    url: "{{ route('GetClientsOFShipment') }}",
                    type: 'get',
                    data: {shipment: shipment, _token: '{{csrf_token()}}'},
                    success: function (data) {
                        $('#clients_details').html(data['data']);
                        $('#shipment').html(data['shipment']);
                        $('#clients-no').modal('show');
                    }
                });
            });
            // Hide Success div after 5 seconds
            setTimeout(function () {
                $('.alert-success').fadeOut('slow');
            }, 5000);
        })
    </script>
@endsection
