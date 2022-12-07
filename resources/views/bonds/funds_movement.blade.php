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
                    @if(session()->get('process'))
                        <div class="alert alert-success">
                            <span class="text-primary">{{ session()->get('process') }}</span>
                            <span class="text-danger">{{ session()->get('name') }}</span>
                        </div>
                    @endif
                    <h3 class="mt-0">مشاهدة المساهمين
                        <a href="{{ route('bond.create') }}" class="btn btn-primary mr-5">إيداع مساهم</a>
                    </h3>

                    <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>اسم المودع</th>
                            <th>المبلغ</th>
                            <th>الأيام</th>
                            <th>الفائدة</th>
                            <th>تاريخ الإيداع</th>
                            <th>الحالة</th>
                            <th>ملاحظات</th>
                        </tr>
                        </thead>
                        <tbody>
                        @php($no=1)
                        @php($total = 0)
                        @php($benefit = 0)
                        @php($benefits = 0)
                        @foreach ($bonds as $bond)
                            <tr>
                                @php($days = Carbon\Carbon::now()->diffInDays($bond->created_at ))
                                @php($benefit = round($days * 0.15 * $bond->amount / 365.25))
                                <td>{{ $no++ }}</td>
                                <td>{{ $bond->person->name }}</td>
                                <td>{{ $bond->amount }}</td>
                                <td>{{ $days }}</td>
                                <td>{{ $benefit }}</td>
                                <td>{{ $bond->created_at }}</td>
                                <td>{{ @$bond->active ? 'نشط' : 'تم التسوية' }}</td>
                                <td>{{ $bond->notes }}</td>
                                @php($total += $bond->amount)
                                @php($benefits += $benefit)
                            </tr>
                        @endforeach
                        </tbody>
                        <tfoot>
                        <tr class="text-white font-weight-bold bg-primary">
                            <td colspan="2">إجمالى المبالغ المودعة</td>
                            <td>{{ $total }}</td>
                            <td colspan="2"></td>
                            <td>إجمالى الفوائد</td>
                            <td colspan="2">{{ $benefits }}</td>
                        </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div> <!-- end col -->
    </div> <!-- end row -->

@endsection
