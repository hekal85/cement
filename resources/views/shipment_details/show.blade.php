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

@section('title', 'Mahmoud Hekal')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h2 class="mt-0 header-title">مشاهدة حركات التوريد</h2>
                    @if(session()->get('process'))
                        <div class="alert alert-success">
                            <span class="text-primary">{{ session()->get('process') }}</span>
                            <span class="text-danger">{{ session()->get('name') }}</span>
                        </div>
                    @endif
                    <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>الشحنة</th>
                            <th>المندوب</th>
                            <th>العميل</th>
                            <th>الشكاير</th>
                            <th>سعر الطن</th>
                            <th>تكلفة النقل</th>
                            <th>التكلفلة الإجمالية</th>
                            <th>المدفوع</th>
                            <th>المتبقى</th>
                            <th>ملاحظات</th>
                        </tr>
                        </thead>
                        <tbody>
                        @php($no=1)
                        @foreach ($shipment_details as $shipment)
                            <tr>
                                <td>
                                    <a class="btn btn-info" href="{{ route('shipment.show',$shipment->id) }}">
                                        {{ $no++ }}
                                    </a>
                                </td>
                                <td>{{ $shipment->id }}</td>
                                <td>{{ $shipment->Manufactory->Company->name }}</td>
                                <td>{{ $shipment->Transportation->Company->name }}</td>
                                <td>{{ $shipment->sacks / 20 }}</td>
                                <td>{{ $shipment->cost }}</td>
                                <td>
                                    <button class="btn btn-info clients" data-toggle="modal" data-id="{{ $shipment->id }}">
                                        {{ sizeof($shipment->Shipment_details) }}
                                    </button>
                                </td>
                                <td>{{ (@$shipment->done) ? 'تم التسليم' : 'لم تسلم' }}</td>
                                <td>
                                    <ul>
                                        @foreach($shipment->Coupon as $coupon)
                                            <li>{{ $coupon->Coupon }} => {{ $coupon->value }}</li>
                                        @endforeach
                                    </ul>
                                </td>
                                <td>{{ $shipment->created_at }}</td>
                                <td>{{ $shipment->price }}</td>
                                <td>{{ $shipment->total }}</td>
                                <td>{{ $shipment->remaining }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div> <!-- end col -->
    </div> <!-- end row -->

    <div class="modal fade bd-example-modal-xl" id="clients-no" tabindex="-1" role="dialog" aria-labelledby="clients-noLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title mt-0" id="clients-noLabel">العملاء الذى تم تسليمهم الأسمنت بالشحنة رقم:  <span id="shipment"></span></h5>
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
                                <th>اسم العميل</th>
                                <th>اسم المندوب</th>
                                <th>رقم الشحنة</th>
                                <th>الأطنان</th>
                                <th>الشكاير</th>
                                <th>سعر الطن</th>
                                <th>تكلفة النقل</th>
                                <th>التكلفة الإجمالية</th>
                                <th>المبلغ المدفوع</th>
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
        $(function(){
            $(".clients").click(function(e){
                e.preventDefault();
                let shipment = +$(this).attr('data-id');
                $.ajax({
                    url: "{{ route('GetClientsOFShipment') }}",
                    type:'get',
                    data: {shipment: shipment, _token: '{{csrf_token()}}'},
                    success: function(data) {
                        $('#clients_details').html(data['data']);
                        $('#shipment').html(data['shipment']);
                        $('#clients-no').modal('show');
                    }
                });
            });
            // Hide Success div after 5 seconds
            setTimeout(function (){ $('.alert-success').fadeOut('slow'); }, 5000);
        })
    </script>
@endsection
