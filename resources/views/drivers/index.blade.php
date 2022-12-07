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
                    <h4 class="text-center bg-success rounded justify-content-between">
                        مشاهدة السائقين
                        <a href="{{ route('driver.create') }}" class="btn btn-primary my-2">إضافة سائق</a>
                    </h4>
                    <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>الإسم</th>
                            <th>الرصيد</th>
                            <th>شركة الشحن</th>
                            <th>الموبايل</th>
                            <th>المدينة</th>
                            <th>إدارة</th>
                        </tr>
                        </thead>
                        <tbody>
                        @php($no=1)
                        @php($total=0)
                        @foreach ($drivers as $driver)
                            @php($total += $driver->person->cash)
                            {{--@php($img = !empty($driver->person->getFirstMediaUrl('image')) ?
                            $driver->person->getFirstMediaUrl('image') : asset('assets/images/users/user.png')) --}}
                        <tr>
                            <td>{{ $no++ }}</td>
                            {{--<td><img src="{{ $img }}" class="img-thumbnail" /> </td> --}}
                            <td>{{ $driver->person->name }}</td>
                            <td>{{ $driver->person->cash }}</td>
                            <td>{{ $driver->Transportation->company->name }}</td>
                            <td>{{ $driver->person->mobile }}</td>
                            <td>{{ $driver->person->City->city }}</td>
                            <td>
                                <form action="{{ route('driver.destroy',$driver->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <a class="btn btn-success" href="{{ route('driver.show',$driver->id) }}">
                                        <i class="fas fa-eye text-white"></i>
                                    </a>
                                    <a class="btn btn-warning" href="{{ route('driver.edit',$driver->id) }}">
                                        <i class="fas fa-user-edit text-white p-1"></i>
                                    </a>
                                    <button type="submit" class="btn btn-danger">
                                        <i class="fas fa-user-alt-slash text-white p-1"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                        </tbody>
                        <tfoot class="text-white bg-dark">
                        <tr>
                            <td colspan="2">
                                إجمالى المبالغ
                            </td>
                            <td colspan="5"><span class="font-weight-bold">{{ $total }}</span> </td>
                        </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div> <!-- end col -->
    </div> <!-- end row -->

    <div class="modal fade" id="clients-no" tabindex="-1" role="dialog" aria-labelledby="clients-noLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title mt-0" id="clients-noLabel">اسماء عملاء المندوب <span id="driver"></span></h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body print">
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
                    <button type="button" class="btn btn-info" data-bs-dismiss="modal" id="btnPrint">Print</button>
                </div>
            </div>
        </div>
    </div>

    <script>


/*
        function printElement() {
            var domClone = document.getElementById("printThis");

            var printSection = document.getElementById("printSection");

            if (!printSection) {
                printSection = document.createElement("div");
                printSection.id = "printSection";
                document.body.appendChild(printSection);
            }

            printSection.innerHTML = "";
            printSection.appendChild(domClone);
            window.print();
        }
        /*document.getElementById("btnPrint").onclick( function () {
            printElement(document.getElementById("printThis"));
        });
        */
        $('#btnPrint').click(function (){
           // printElement();
            window.print($('.print'));
            return false;
        });
/*
        document.getElementById("btnPrint").onclick = function () {
            printElement(document.getElementById("printThis"));
        }

        function printElement(elem) {
            var domClone = elem.cloneNode(true);

            var $printSection = document.getElementById("printSection");

            if (!$printSection) {
                var $printSection = document.createElement("div");
                $printSection.id = "printSection";
                document.body.appendChild($printSection);
            }

            $printSection.innerHTML = "";
            $printSection.appendChild(domClone);
            window.print();
        }
*/
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
                        $('#driver').html(data['driver']);
                        $('#clients-no').modal('show');
                    }
                });
            });
            // Hide Success div after 5 seconds
            setTimeout(function (){ $('.alert-success').fadeOut('slow'); }, 5000);
        })


    </script>
@endsection
