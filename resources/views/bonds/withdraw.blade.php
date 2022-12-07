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
                        <div class="row">
                            <div class="col-6">
                                <h3 class="mt-0">
                                    إيداعات المساهم:
                                    <span class="text-danger font-weight-bold" id="shareholder_name"></span>
                                </h3>
                            </div>
                            <div class="col-4">
                                <select class="form-control form-control-lg {{ $errors->has('shareholder') ? 'error' : '' }}"
                                        id="shareholder" name="shareholder" required>
                                    <option value="0">اختر المساهم</option>
                                    @foreach ($shareholders as $s)
                                        <option
                                            value="{{ $s->id }}" {{ old('shareholder') == $s->id ? "selected" :""}}>
                                            {{$s->name}}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-2">
                                <button class="btn btn-info clients" data-toggle="modal" data-id="{{ $s->id }}">سحب</button>
                            </div>
                        </div>

                    <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>المبلغ</th>
                            <th>الأيام</th>
                            <th>الفائدة</th>
                            <th>تاريخ الإيداع</th>
                            <th>الحالة</th>
                            <th>ملاحظات</th>
                        </tr>
                        </thead>
                        <tbody id="bonds"></tbody>
                        <tfoot>
                        <tr class="text-white font-weight-bold bg-primary">
                            <td colspan="2">إجمالى المبالغ المودعة</td>
                            <td id="total"></td>
                            <td colspan="2"></td>
                            <td>إجمالى الفوائد</td>
                            <td colspan="2" id="benefits"></td>
                        </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div> <!-- end col -->
    </div> <!-- end row -->

    <script>
        $(function () {
            $('#shareholder').on('change', function () {
                let shareholder = $(this).val();
                $.ajax({
                    url: '{{url('shareholder_bonds')}}',
                    type: "POST",
                    data: {id: shareholder, _token: '{{csrf_token()}}'},
                    dataType: 'json',
                    success: function (result) {
                        $('#bonds').html(result['bonds']);
                        $('#total').html(result['total']);
                        $('#benefits').html(result['benefits']);
                        $('#shareholder_name').html(result['name']);
                    },
                    error: function (result) {
                        $('#bonds').html('');
                        $('#total').html('');
                        $('#benefits').html('');
                        $('#shareholder_name').html('');
                    }
                });
            });
        });
    </script>

@endsection
