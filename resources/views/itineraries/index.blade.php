@extends('layouts.manufactories')

@section('title', 'Mahmoud Hekal')

@section('content')
    <div class="row mt-3">
        <div class="col-12">
            <div class="card">
                <div class="card-body print" id="datatable-buttons">
                    <a href="{{ route('itinerary.create') }}" class="btn btn-primary no_print my-2">
                        إضافة خط سير جديد
                    </a>
                    <button onclick="print_itineraries()" class="btn btn-warning no_print">طباعة</button>

                    @if(session()->get('process'))
                        <div class="alert alert-success">
                            <span class="text-primary">{{ session()->get('process') }}</span>
                            <span class="text-danger">{{ session()->get('name') }}</span>
                        </div>
                    @endif
                    <table class="table table-striped table-bordered dt-responsive nowrap caption-top "
                           style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                        <caption>مشاهدة خطوط السير</caption>
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>المندوب</th>
                            <th>خط السير</th>
                            <th>اليوم الأول</th>
                            <th>اليوم الثانى</th>
                            <th>عدد المدن</th>
                            <th>تحصيل</th>
                        </tr>
                        </thead>
                        <tbody>
                        @php($no=1)
                        @foreach ($itineraries as $itinerary)
                            <tr>
                                <td>{{ $no++ }}</td>
                                <td>{{ $itinerary->Representative->person->name }}</td>
                                <td>{{ $itinerary->name }}</td>
                                <td>{{ $itinerary->day1 }}</td>
                                <td>{{ $itinerary->day2 }}</td>
                                <td>
                                    <button class="btn btn-info ClientsOfItinerary" data-toggle="modal"
                                            data-id="{{ $itinerary->id }}">
                                        {{ sizeof($itinerary->ItineraryDetails) }}
                                    </button>
                                </td>
                                <td>
                                    <a href="{{route('itinerary_collecting', $itinerary->id )}}"
                                       class="btn btn-warning">
                                        <i class="fa-solid fa-hand-holding-dollar"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div> <!-- end col -->
    </div> <!-- end row -->

    <div class="modal fade print" id="ClientsOfItinerary" tabindex="-1" role="dialog" aria-labelledby="clientsLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content" id="">
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
                            <tbody id="itinerary_details"></tbody>
                        </table>
                    </div>
                </div>
                <div class="modal-footer no_print">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <input type="button" class="btn btn-warning" value="Print" onclick="print_ClientsOfItinerary()"/>
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript">
        // Print Itineraries
        function print_itineraries() {
            $('#ClientsOfItinerary').removeClass('print');
            $('#datatable-buttons').addClass('print').show();
            window.print();
            return false;
        }

        // Print ClientsOfItinerary
        function print_ClientsOfItinerary() {
            $('#datatable-buttons').removeClass('print');
            $('#ClientsOfItinerary').addClass('print').show();
            window.print();
            return false;
        }

        $(function () {
            $(".ClientsOfItinerary").click(function (e) {
                e.preventDefault();
                let itinerary = +$(this).attr('data-id');
                $.ajax({
                    url: "{{ route('ClientsOfItinerary') }}",
                    type: 'get',
                    data: {itinerary: itinerary, _token: '{{csrf_token()}}'},
                    success: function (data) {
                        $('#itinerary_details').html(data['data']);
                        $('#itinerary').html(data['itinerary']);
                        $('#representative').html(data['representative']);
                        $('#ClientsOfItinerary').modal('show');
                    }
                });
            });
// Hide Success div after 5 seconds
            setTimeout(function () {
                $('.alert-success').fadeOut('slow');
            }, 5000);
        })

    </script>

@endsection
