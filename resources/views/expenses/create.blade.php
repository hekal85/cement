@extends('layouts.manufactories')
@section('title', 'إضافة نوع مصروف جديد')
@section('content')
    <div class="row d-flex justify-content-center">
        <div class="col-lg-4">
            <div class="card">
                <div class="card-body">
                    <h3 class="text-center py-2 bg-warning">إثبات عملية صرف</h3>

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    {{ Form::open(['route' => 'expense.store', 'class' => 'card-box', 'enctype' => 'multipart/form-data']) }}
                    {{  Form::token() }}
                        <div class="form-group">
                            {{ form::label('expense_type_id', 'نوع المصروف') }}
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="far fa-user"></i></span>
                                </div>
                                {{Form::select('expense_type_id', $expense_types, null, ['required', 'class' => 'form-control py-2 '.($errors->has( 'expense_type_id') ? ' error':''), 'id' => 'expense_type_id', 'placeholder' => '--- اختر نوع المصروف ---'])}}
                            </div>
                        </div>

                        <div class="form-group">
                            {{ form::label('paid', 'المبلغ') }}
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="far fa-user"></i></span>
                                </div>
                                {{ Form::number('paid', old('paid'), [ 'required', 'id' => "paid", 'class' => 'form-control '.($errors->has( 'paid') ? ' error':''), 'placeholder' => 'المبلغ', 'min' => 10, 'max' => 99999]) }}
                            </div>
                        </div>

                    <div class="form-group">
                        <label for="city_id">طريقة التحصيل</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-home"></i></span>
                            </div>
                            {{ Form::select('city_id', [0=>'نقدى', 1 => 'بنك'], NULL, ['class' => 'form-control py-2 ', 'id' => 'city_id']) }}
                        </div>
                    </div>

                    <div class="form-group">
                        <input type="submit" class="btn btn-gradient-success form-control" value="اضف"/>
                    </div>
                {{ form::close() }}<!--end form-->
                </div><!--end card-body-->
            </div><!--end card-->
        </div><!--end col-->
    </div><!--end row-->

    <script>
        $(function () {
            $('#state_id').on('change', function () {
                let state_id = $(this).val();
                $("#city_id").html('');
                $.ajax({
                    url: '{{url('fetch_cities')}}',
                    type: "POST",
                    data: {state_id: state_id, _token: '{{csrf_token()}}'},
                    dataType: 'json',
                    success: function (result) {
                        $.each(result, function (key, value) {
                            $("#city_id").append('<option value="' + value.id + '">' + value.city + '</option>');
                        });
                    }
                });
            });
        });
    </script>
@endsection
