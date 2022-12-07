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
                            مشاهدة العملاء
                            <a href="{{ route('client.create') }}" class="btn btn-primary my-2">إضافة عميل</a>
                        </h4>

                    <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>الإسم</th>
                            <th>الرصيد</th>
                            <th>المندوب</th>
                            <th>المدينة</th>
                            <th>الموبايل</th>
                            <th>إدارة</th>
                        </tr>
                        </thead>
                        <tbody>
                        @php($no=1)
                        @php($total=0)
                        @foreach ($clients as $client)
                            @php($total += $client->person->cash)
                            {{--@php($img = !empty($client->person->getFirstMediaUrl('image')) ?
                            $client->person->getFirstMediaUrl('image') : asset('assets/images/users/user.png')) --}}
                            <tr>
                                <td>{{ $no++ }}</td>
                                {{--<td><img src="{{ $img }}" class="img-thumbnail"
                                style="width: 70px; height: 70px" /> </td> --}}
                                <td>{{ $client->person->name }}</td>
                                <td>{{ $client->person->cash }}</td>
                                <td>{{ $client->representative->person->name }}</td>
                                <td>{{ $client->person->City->city }}</td>
                                <td>{{ $client->person->mobile }}</td>
                                <td>
                                    <form action="{{ route('client.destroy',$client->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <a class="btn btn-success" href="{{ route('client.show',$client->id) }}"><i class="fas fa-eye text-white"></i></a>
                                        <a class="btn btn-warning" href="{{ route('client.edit',$client->id) }}"><i class="fas fa-user-edit text-white p-1"></i></a>
                                        <button type="submit" class="btn btn-danger"><i class="fas fa-user-alt-slash text-white p-1"></i></button>
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
                            <td colspan="6"><span class="font-weight-bold">{{ $total }}</span> </td>
                        </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div> <!-- end col -->
    </div> <!-- end row -->

<script>
    $(function(){
        setTimeout(function (){
            $('.alert-success').fadeOut('slow');
        }, 5000);
    })
</script>
@endsection
