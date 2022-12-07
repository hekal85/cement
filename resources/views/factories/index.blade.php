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
                    <h4 class="mt-0 header-title">مشاهدة المندوبين</h4>
                        @if(session()->get('process'))
                            <div class="alert alert-success">
                                <span class="text-primary">{{ session()->get('process') }}</span>
                                <span class="text-danger">{{ session()->get('name') }}</span>
                            </div>
                        @endif
                    <p class="text-muted mb-3">
                        بيانات العملاء ويمكنك تعديل وحذف ومتابعة آخر عمليات
                    </p>

                    <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>الإسم</th>
                            <th>العملاء</th>
                            <th>الموبايل</th>
                            <th>الهاتف</th>
                            <th>الرصيد</th>
                            <th>إدارة</th>
                        </tr>
                        </thead>
                        <tbody>
                        @php($no=1)
                        @foreach ($representatives as $representative)
                        <tr>
                            <td>{{ $no++ }}</td>
                            <td>{{ $representative->person->name }}</td>
                            <td>
                                <button class="btn btn-info clients" data-toggle="modal" data-id="{{ $representative->id }}">
                                    {{ sizeof($representative->client) }}
                                </button>
                            </td>
                            <td>{{ $representative->person->mobile }}</td>
                            <td>{{ $representative->person->phone }}</td>
                            <td>{{ $representative->person->cash }}</td>
                            <td>
                                <form action="{{ route('representative.destroy',$representative->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <a class="btn btn-success" href="{{ route('representative.show',$representative->id) }}"><i class="fas fa-eye text-white"></i></a>
                                    <a class="btn btn-warning" href="{{ route('representative.edit',$representative->id) }}"><i class="fas fa-user-edit text-white p-1"></i></a>
                                    <button type="submit" class="btn btn-danger"><i class="fas fa-user-alt-slash text-white p-1"></i></button>
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
