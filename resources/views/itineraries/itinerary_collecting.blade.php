@extends('layouts.manufactories')

@section('title', 'Mahmoud Hekal')

@section('content')
    <div class="row mt-2 pt-2">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    @if(session()->get('process'))
                        <div class="alert alert-success">
                            <span class="text-primary">{{ session()->get('process') }}</span>
                            <span class="text-danger">{{ session()->get('name') }}</span>
                        </div>
                    @endif
                    <h4 class="modal-title mt-0" id="clientsLabel">
                        خط سير
                        <span id="itinerary" class="text-danger"></span>
                        المندوب
                        <span id="representative" class="text-primary"></span>
                    </h4>

                    <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap"
                           style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>اسم العميل</th>
                            <th>المدينة</th>
                            <th>الرصيد</th>
                            <th>المدفوع</th>
                        </tr>
                        </thead>
                        <tbody>
                            <form action="{{ route('shipmentDetails.store') }}" method="POST">
                                @csrf
                            @php($no=1)

                            @foreach ($details as $d)
                                @foreach ($d->Client as $client)
                                    <tr>
                                        <td>{{ $no++ }}</td>
                                        <td>{{ $client->Person->name }}</td>
                                        <td>{{ $client->Person->City->city }}</td>
                                        <td>{{ $client->Person->cash }}</td>
                                        <td>
                                            {{ Form::number('paid', old('paid'), [ 'required', 'id' => "paid", 'class' => 'form-control '.($errors->has( 'paid') ? ' error':''), 'placeholder' => 'المدفوع']) }}
                                        </td>
                                    </tr>
                                @endforeach
                            @endforeach
                            <tr>
                                <td colspan="4"></td>
                                <td>
                                    <input type="submit" class="btn btn-gradient-primary form-control" value="استلم" />
                                </td>
                            </tr>

                            </form>
                        </tbody>
                    </table>
                </div>
            </div>
        </div> <!-- end col -->
    </div> <!-- end row -->

    <div class="modal fade" id="ClientsOfItinerary" tabindex="-1" role="dialog" aria-labelledby="clientsLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title mt-0" id="clientsLabel">
                        خط سير
                        <span id="itinerary" class="text-danger"></span>
                        المندوب
                        <span id="representative" class="text-primary"></span>
                    </h5>
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
                            <tbody id="itinerary_details"></tbody>
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
        $('#btnPrint').click(function (){
            // printElement();
            window.print($('.print'));
            return false;
        });
        $(function(){
            $(".ClientsOfItinerary").click(function(e){
                e.preventDefault();
                let itinerary = +$(this).attr('data-id');
                $.ajax({
                    url: "{{ route('ClientsOfItinerary') }}",
                    type:'get',
                    data: {itinerary: itinerary, _token: '{{csrf_token()}}'},
                    success: function(data) {
                        $('#itinerary_details').html(data['data']);
                        $('#itinerary').html(data['itinerary']);
                        $('#representative').html(data['representative']);
                        $('#ClientsOfItinerary').modal('show');
                    }
                });
            });
            // Hide Success div after 5 seconds
            setTimeout(function (){ $('.alert-success').fadeOut('slow'); }, 5000);
        })

    </script>

@endsection
