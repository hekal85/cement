@extends('layouts.manufactories')
@section('css')
    <link href="{{asset('assets/plugins/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet" />
    <link href="{{asset('assets/plugins/datatables/buttons.bootstrap4.min.css')}}" rel="stylesheet" />
    <link href="{{asset('assets/plugins/datatables/responsive.bootstrap4.min.css')}}" rel="stylesheet" />
@endsection

@section('js')
    <script src="{{asset('assets/plugins/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('assets/plugins/datatables/dataTables.bootstrap4.min.js')}}"></script>
    <script src="{{asset('assets/plugins/datatables/dataTables.buttons.min.js')}}"></script>
    <script src="{{asset('assets/plugins/datatables/buttons.bootstrap4.min.js')}}"></script>
    <script src="{{asset('assets/plugins/datatables/jszip.min.js')}}"></script>
    <script src="{{asset('assets/plugins/datatables/pdfmake.min.js')}}"></script>
    <script src="{{asset('assets/plugins/datatables/vfs_fonts.js')}}"></script>
    <script src="{{asset('assets/plugins/datatables/buttons.html5.min.js')}}"></script>
    <script src="{{asset('assets/plugins/datatables/buttons.print.min.js')}}"></script>
    <script src="{{asset('assets/plugins/datatables/buttons.colVis.min.js')}}"></script>
    <script src="{{asset('assets/plugins/datatables/dataTables.responsive.min.js')}}"></script>
    <script src="{{asset('assets/plugins/datatables/responsive.bootstrap4.min.js')}}"></script>
    <script src="{{asset('assets/pages/jquery.datatable.init.js')}}"></script>
@endsection

@section('title', 'Mahmoud Hekal')

@section('content')

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body" id="data">
                    <h4 class="text-center bg-success rounded mb-2 py-2">
                        <button onclick="javascript:window.print()" class="btn btn-primary my-2">طباعة</button>
                        بيان بحركة خط سير المندوب
                        <span class="font-weight-bold text-danger">{{ $representative->person->name }}</span>
                    </h4>

                    @php($no=1)
                        <div class="row">
                            @foreach ($representative->Itinerary as $itinerary)
                                <div class="col">
                                    <h2>{{ $itinerary->name }}</h2>
                                    <p class="text-center">
                                    @foreach($itinerary->ItineraryDetails as $details)
                                       {{ $details->City->city }} -
                                    @endforeach
                                    </p>
                                    <table class="table table-bordered table-striped table-hover">
                                        <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">الاسم</th>
                                            <th scope="col">المبلغ</th>
                                        </tr>
                                        </thead>
                                        <tbody id="test">
                                        @php($n=1)
                                        @foreach($itinerary->ItineraryDetails as $details)
                                        @foreach($details->Client as $client)
                                                <tr>
                                                    <th scope="row">{{ $n++ }}</th>
                                                    <td>{{ $client->person->name }}</td>
                                                    <td>{{ $client->person->cash }}</td>
                                                </tr>
                                        @endforeach
                                        @endforeach
                                        <tbody>
                                    </table>
                                </div>
                            @endforeach
                        </div>
                </div>
            </div>
        </div> <!-- end col -->
    </div> <!-- end row -->
@endsection
