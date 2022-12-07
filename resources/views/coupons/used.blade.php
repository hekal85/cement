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

                    <h4 class="mt-0 header-title">مشاهدة البونات التى تم استخدامها</h4>
                    <p class="text-muted mb-3">
                        بيانات العملاء ويمكنك تعديل وحذف ومتابعة آخر عمليات
                    </p>

                    <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>رقم البون</th>
                            <th>الفئة</th>
                            <th>النوع</th>
                            <th>التكلفة</th>
                            <th>مصنع الأسمنت</th>
                            <th>شركة الشحن</th>
                            <th>نوع الأسمنت</th>
                            <th>رقم الشحنة</th>
                            <th>تاريخ الاستخدام</th>
                            <th>تاريخ الإصدار</th>
                        </tr>
                        </thead>
                        <tbody>
                        @php($no=1)
                        @foreach ($coupons as $coupon)
                    <tr>
                        <td>{{ $no++ }}</td>
                        <td>{{ $coupon->id }}</td>
                        <td>{{ $coupon->value }}</td>
                        <td>{{ $coupon->CementType->name }}</td>
                        <td>{{ $coupon->cost * $coupon->value }}</td>
                        <td>{{ $coupon->manufactory->company->name }}</td>
                        <td>{{ $coupon->transportation->company->name }}</td>
                        <td>{{ @($coupon->packed) ? 'معبأ' : 'سايب' }}</td>
                        <td>{{ $coupon->shipment->id }}</td>
                        <td>{{ $coupon->shipment->created_at }}</td>
                        <td>{{ $coupon->created_at }}</td>
                    </tr>
                        @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div> <!-- end col -->
    </div> <!-- end row -->



@endsection
