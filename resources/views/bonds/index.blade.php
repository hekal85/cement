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

                    <p class="text-muted mb-3">
                        بيانات المساهمين يمكنك متابعة آخر حركة الأموال عن طريق الضغط على عدد عمليات الإيداع
                    </p>
                    <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                        <thead>
                        <tr>
                            @for($x=0; $x<2; $x++)
                            <th>#</th>
                            <th>الإسم</th>
                            <th>المبلغ</th>
                            <th>الإيداعات</th>
                            @endfor
                        </tr>
                        </thead>
                        <tbody>
                        @php($no=1)
                        @php($total = 0)
                        <tr>
                        @foreach ($bonds as $bond)
                                <td>{{ $no++ }}</td>
                                <td>{{ $bond->person->name }}</td>
                                @php($total += $bond->sum)
                                <td>{{ $bond->sum }}</td>
                                <td>
                                    <button class="btn btn-info bonds" data-toggle="modal" data-id="{{ $bond->person_id }}">
                                        {{ $bond->no }}
                                    </button>
                                </td>
                                @if($no % 2 != 0 ) </tr><tr> @endif
                        @endforeach
                        </tr>
                        </tbody>
                        <tfoot>
                        <tr class="text-white font-weight-bold bg-primary">
                            <td colspan="2">إجمالى المبالغ المودعة</td>
                            <td colspan="6">{{ $total }}</td>
                        </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div> <!-- end col -->
    </div> <!-- end row -->

    <div class="modal fade bd-example-modal-lg" id="depositor" tabindex="-1" role="dialog" aria-labelledby="depositorLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title mt-0" id="depositorLabel">
                        متابعة عمليات إيداع المودع
                        <span id="depositor_name" class="text-danger"></span>
                    </h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="table-depositor">
                        <table class="table mb-0">
                            <thead class="thead-light">
                            <tr>
                                <th>#</th>
                                <th>المبلغ</th>
                                <th>تاريخ الإيداع</th>
                                <th>الأيام</th>
                                <th>الفائدة</th>
                                <th>الحالة</th>
                                <th>ملاحظات</th>
                            </tr>
                            </thead>
                            <tbody id="depositor_details"></tbody>
                            <tfoot>
                                <tr class="text-danger font-weight-bold bg-soft-info">
                                    <td colspan="2">إجمالى المبالغ المودعة</td>
                                    <td id="deposits"></td>
                                    <td colspan="2">إجمالى الفوائد</td>
                                    <td id="benefits" colspan="2"></td>
                                </tr>
                            </tfoot>
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
            $(".bonds").click(function(e){
                e.preventDefault();
                let person = +$(this).attr('data-id');
                $.ajax({
                    url: "{{ route('personBonds') }}",
                    type:'get',
                    data: {person: person, _token: '{{csrf_token()}}'},
                    success: function(data) {
                        $('#depositor_name').html(data['name']);
                        $('#depositor_details').html(data['data']);
                        $('#deposits').html(data['deposits']);
                        $('#benefits').html(data['benefits']);
                        $('#depositor').modal('show');
                    }
                });
            });
            // Hide Success div after 5 seconds
            setTimeout(function (){ $('.alert-success').fadeOut('slow'); }, 5000);
        })
    </script>
@endsection
