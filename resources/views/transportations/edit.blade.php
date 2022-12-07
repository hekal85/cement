@extends('layouts.manufactories')
@section('title', 'مصانع الأسمنت')

@section('content')
    <div class="row">
        <div class="col-lg-8 mx-auto">
            <div class="card">
                <div class="card-body">
                    <h2 class="m-0 py-2 text-center bg-warning">نموذج تعديل شركة شحن</h2>
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    {{ Form::open(['route' => ['transportation.update', $transportation->id], 'method' => 'PUT', 'class' => 'card-box', 'enctype' => 'multipart/form-data']) }}
                    {{ Form::token() }}

                    <div class="form-row my-2">
                        <div class="col-md-6 mb-6">
                            {{ Form::label('name', 'اسم الشركة') }}
                            <div class="form-group">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="far fa-user"></i></span>
                                    </div>
                                    {{ Form::text('name', $transportation->company->name, [ 'required', 'id' => "name", 'class' => 'form-control '.($errors->has( 'name') ? ' error':''), 'placeholder' => 'اسم الشركة']) }}
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 mb-6">
                            {{ Form::label('director', 'المدير') }}
                            <div class="form-group">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="far fa-user"></i></span>
                                    </div>
                                    {{ Form::text('director', $transportation->company->director, [ 'required', 'id' => "director", 'class' => 'form-control '.($errors->has( 'director') ? ' error':''), 'placeholder' => 'المدير المسئول']) }}
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-row my-2">
                        <div class="col-md-6 mb-6">
                            {{ Form::label('mobile', 'الموبايل') }}
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-mobile-alt"></i></span>
                                </div>
                                {{ Form::text('mobile', $transportation->company->mobile, [ 'required', 'id' => "mobile", 'class' => 'form-control '.($errors->has( 'mobile') ? ' error':''), 'placeholder' => 'الموبايل']) }}
                            </div>
                        </div>

                        <div class="col-md-6 mb-6">
                            {{ Form::label('phone', 'الهاتف') }}
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-phone-volume"></i></span>
                                </div>
                                {{ Form::text('phone', $transportation->company->phone, [ 'required', 'id' => "phone", 'class' => 'form-control '.($errors->has( 'phone') ? ' error':''), 'placeholder' => 'الهاتف']) }}
                            </div>
                        </div>
                    </div>

                    <div class="form-row my-2">
                        <div class="col-md-6 mb-6">
                            <label for="state_id">اختر المحافظة</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fab fa-studiovinari"></i></span>
                                </div>
                                <select class="form-control form-control-lg" id="state_id" name="state_id">
                                    <option>اختر المحافظة</option>
                                    @foreach ($states as $state)
                                        <option value="{{$state->state_id}}">
                                            {{$state->state}}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-md-6 mb-6">
                            {{ Form::label('city_id', 'المركز') }}
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-home"></i></span>
                                </div>
                                {{ Form::select('city_id', [], NULL, ['class' => 'form-control form-control-lg', 'id' => 'city_id']) }}
                            </div>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="col-md-9 mb-9">
                            {{ Form::label('email', 'البريد الإليكترونى') }}
                            <div class="input-group">
                                <div class="input-group-append">
                                    <span class="input-group-text"><i class="far fa-envelope"></i></span>
                                </div>
                                {{ Form::email('email', $transportation->company->email, [ 'required', 'id' => "email", 'class' => 'form-control '.($errors->has( 'email') ? ' error':''), 'placeholder' => 'البريد الإليكترونى']) }}
                            </div>
                        </div><!--end col-->

                        <div class="col-md-3 mb-3">
                            {{ Form::label('cash', 'الرصيد') }}
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-dollar-sign"></i></span>
                                </div>
                                {{ Form::number('cash', $transportation->company->cash, [ 'required', 'id' => "cash",
                                'class' => 'form-control '.($errors->has( 'cash') ? ' error':''), 'placeholder' =>
                                'الرصيد']) }}
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        {{ Form::label('address', 'العنوان') }}
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-street-view"></i></span>
                            </div>
                            {{ Form::text('address', $transportation->company->address, [ 'required', 'id' => "address", 'class' => 'form-control '.($errors->has( 'address') ? ' error':''), 'placeholder' => 'العنوان']) }}
                        </div>
                    </div>

                    <div class="form-group">
                        {{ Form::label('notes', 'ملاحظات') }}
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">ملاحظات</span>
                            </div>
                            {{ Form::textarea('notes', $transportation->company->notes, ['id' => "notes", 'class' => 'form-control '.($errors->has( 'notes') ? ' error':''), 'rows' => 5, 'placeholder' => 'ملاحظات']) }}
                        </div>
                    </div>
                {{ Form::submit('عدل', ['class' => 'form-control btn btn-gradient-warning']) }}
                {{ Form::close() }}<!--end form-->
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
