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
    <div class="row px-2">
        <div class="col-12 mx-auto">
            <div class="card">
                <div class="card-body">
                    <h2 class="mb-2 py-2 text-center bg-success rounded">مشاهدة المصانع</h2>
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
                            <th>اسم المصنع</th>
                            <th>المدير المسئول</th>
                            <th>الرصيد</th>
                            <th>الموبايل</th>
                            <th>الهاتف</th>
                            <th>الإيميل</th>
                            <th>إدارة</th>
                        </tr>
                        </thead>
                        <tbody>
                        @php($no=1)
                        @foreach ($manufactories as $manufactory)

                            <tr>
                                <td>{{ $no++ }}</td>
                                <td>{{ $manufactory->company->name }}</td>
                                <td>{{ $manufactory->company->director }}</td>
                                <td>{{ $manufactory->company->cash }}</td>
                                <td>{{ $manufactory->company->mobile }}</td>
                                <td>{{ $manufactory->company->phone }}</td>
                                <td>{{ $manufactory->company->email }}</td>
                                <td>
                                    <form action="{{ route('transportation.destroy',$manufactory->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <a class="btn btn-success" href="{{ route('manufactory.show',$manufactory->id) }}">
                                            <i
                                                class="fas fa-eye text-white"></i>
                                        </a>
                                        <a class="btn btn-warning" href="{{ route('manufactory.edit',$manufactory->id) }}">
                                            <i
                                                class="fas fa-user-edit text-white p-1"></i>
                                        </a>
                                        <button type="submit" class="btn btn-danger">
                                            <i class="fas fa-user-alt-slash text-white p-1"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>

                        @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div> <!-- end col -->
    </div> <!-- end row -->

    <div class="modal fade" id="clients-no" tabindex="-1" role="dialog" aria-labelledby="clients-noLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title mt-0" id="clients-noLabel">اسماء عملاء المندوب <span id="representative"></span></h5>
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
                                <th>المدينة</th>
                                <th>الرصيد</th>
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
                let clients = +$(this).attr('data-id');
                $.ajax({
                    url: "{{ route('ajaxGetClients') }}",
                    type:'get',
                    data: {clients: clients, _token: '{{csrf_token()}}'},
                    success: function(data) {
                        $('#clients_details').html(data['data']);
                        $('#representative').html(data['representative']);
                        $('#clients-no').modal('show');
                    }
                });
            });
            // Hide Success div after 5 seconds
            setTimeout(function (){ $('.alert-success').fadeOut('slow'); }, 5000);

        })
    </script>
@endsection
