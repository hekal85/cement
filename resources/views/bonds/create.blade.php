@extends('layouts.manufactories')

@section('title', 'Mahmoud Hekal')

@section('content')
    <div class="row">
        <div class="col-lg-6 mx-auto">
            <div class="card">
                <div class="card-body">
                        <h4 class="mt-0">نموذج إثبات عملية إيداع مساهم</h4>
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form action="{{ route('bond.store') }}" method="POST">
                        @csrf
                        <div class="form-row">
                            <div class="col-md-6 mb-6">
                                <label for="person_id">اختر المساهم</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-user-tie"></i></span>
                                    </div>
                                    <select class="form-control form-control-lg {{ $errors->has('person_id') ? 'error' : '' }}" id="person_id" name="person_id">
                                        <option value="0">اختر المساهم</option>
                                        @foreach ($shareholders as $shareholder)
                                            <option value="{{$shareholder->id}}">
                                                {{$shareholder->name}}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-6 mb-6">
                                <label for="name">مساهم جديد</label>
                                <div class="form-group">
                                    <button type="button" class="btn btn-success form-control text-danger bg-success" data-bs-toggle="modal" data-bs-target="#new_shareholder">
                                        مساهم جديد
                                    </button>
                                </div>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="col-md-6 mb-6">
                                <label for="amount">المبلغ</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-dollar-sign"></i></span>
                                    </div>
                                    <input type="number" id="amount" name="amount" class="form-control {{ $errors->has('amount') ? 'error' : '' }}" placeholder="المبلغ" value="{{ old('amount') }}" />
                                </div>
                            </div>

                            <div class="col-md-6 mb-6">
                                <label for="created_at">تاريخ العملية</label>
                                <div class="input-group">
                                    <div class="input-group-append">
                                        <span class="input-group-text"><i class="far fa-envelope"></i></span>
                                    </div>
                                    <input type="datetime-local" id="created_at" name="created_at" class="form-control {{ $errors->has('created_at') ? 'error' : '' }}" placeholder="تاريخ العملية" value="{{ old('created_at') }}" />
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label>ملاحظات</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">ملاحظات</span>
                                </div>
                                <textarea class="form-control {{ $errors->has('notes') ? 'error' : '' }}" id="notes" rows="5" name="notes" aria-label="notes">{{ old('username') }}</textarea>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-gradient-primary form-control form_spinner">
                            <span class="spinner-border-sm" id="spinner" role="status" aria-hidden="true"></span>   اضف
                        </button>
                    </form><!--end form-->
                </div><!--end card-body-->
            </div><!--end card-->
        </div><!--end col-->
 </div><!--end row-->

    <!-- Create a new Shareholder Modal -->
    <div class="modal fade" id="new_shareholder" tabindex="-1" aria-labelledby="new_shareholder_Label" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="new_shareholder_Label">نموذج إضافة مساهم جديد</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('shareholder.store') }}" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="name">ادخل اسم المساهم الجديد</label>
                            <input type="name" class="form-control" id="name" name="name" aria-describedby="name">
                        </div>
                        <button type="submit" class="btn btn-primary">حفظ</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(function () {
            $('#state').on('change', function () {
               let state_id = $(this).val();
               $("#city").html('');
               $.ajax({
                   url: '{{url('fetch_cities')}}',
                    type: "POST",
                    data: {state_id: state_id, _token: '{{csrf_token()}}'},
                    dataType: 'json',
                    success: function (result) {
                       $.each(result, function (key, value) {
                            $("#city").append('<option value="' + value.city + '">' + value.city + '</option>');
                        });
                    }
                });
            });
        });
    </script>
@endsection
