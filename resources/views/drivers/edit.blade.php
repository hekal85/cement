@extends('layouts.manufactories')
@section('title', 'مصانع الأسمنت')

@section('content')
    <div class="row">
        <div class="col-lg-8 mx-auto">
            <div class="card">
                <div class="card-body">
                    <h2 class="mb-2 py-2 text-center bg-warning rounded">نموذج تعديل بيانات سائق</h2>
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    {{ Form::open(['route' => ['driver.update', $driver->id], 'method' => 'PUT', 'class' => 'card-box', 'enctype' => 'multipart/form-data']) }}
                    {{ Form::token() }}


                    <div class="form-row">
                        <div class="col-md-6 mb-6">
                            {{ Form::label('name', 'الاسم') }}
                            <div class="input-group">
                                <div class="input-group-append">
                                    <span class="input-group-text"><i class="far fa-user"></i></span>
                                </div>
                                {{ Form::text('name', $driver->person->name ?? old('name'), [ 'required', 'id' => "name", 'class' => 'form-control '.($errors->has( 'name') ? ' error':''), 'placeholder' => 'الاسم']) }}
                            </div>
                        </div><!--end col-->

                            <div class="col-md-6 mb-6">
                                {{ Form::label('transportation_id', 'اختر شركة الشحن') }}
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fab fa-studiovinari"></i></span>
                                    </div>
                                    <select class="form-control form-control-lg" id="transportation_id" name="transportation_id">
                                        <option>اختر شركة الشحن</option>
                                        @foreach ($transportations as $transportation)
                                            <option value="{{ $transportation->id }}" {{ old('transportation_id') == $transportation->id ? "selected" :""}}>
                                                {{$transportation->name}}
                                            </option>
                                        @endforeach
                                    </select>
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
                                {{ Form::email('email', $driver->person->email ?? old('email'), [ 'required', 'id' => "email", 'class' => 'form-control '.($errors->has( 'email') ? ' error':''), 'placeholder' => 'البريد الإليكترونى']) }}
                            </div>
                        </div><!--end col-->

                        <div class="col-md-3 mb-3">
                            {{ Form::label('cash', 'الرصيد') }}
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-dollar-sign"></i></span>
                                </div>
                                {{ Form::number('cash', $driver->person->cash ?? old('cash'), [ 'required', 'id' => "cash", 'class' => 'form-control '.($errors->has( 'cash') ? ' error':''), 'min' => 0, 'max' => 999999, 'placeholder' => 'الرصيد']) }}
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
                                {{ Form::text('mobile', $driver->person->mobile ?? old('mobile'), [ 'required', 'id' => "mobile", 'class' => 'form-control '.($errors->has( 'mobile') ? ' error':''), 'placeholder' => 'الموبايل']) }}
                            </div>
                        </div>

                        <div class="col-md-6 mb-6">
                            {{ Form::label('phone', 'الهاتف') }}
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-phone-volume"></i></span>
                                </div>
                                {{ Form::text('phone', $driver->person->phone ?? old('phone'), [ 'required', 'id' => "phone", 'class' => 'form-control '.($errors->has( 'phone') ? ' error':''), 'placeholder' => 'الهاتف']) }}
                            </div>
                        </div>
                    </div>

                    <div class="form-row my-2">
                        <div class="col-md-6 mb-6">
                            {{ Form::label('state_id', 'اختر المحافظة') }}
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fab fa-studiovinari"></i></span>
                                </div>
                                <select class="form-control form-control-lg" id="state_id" name="state_id">
                                    <option>اختر المحافظة</option>
                                    @foreach ($states as $state)
                                        <option value="{{ $state->state_id }}" {{ old('state') == $state->state_id ? "selected" :""}}>
                                            {{$state->state}}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-md-6 mb-6">
                            {{ Form::label('city_id', 'اختر المركز') }}
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-home"></i></span>
                                </div>
                                {{ Form::select('city_id', [], NULL, ['class' => 'form-control form-control-lg', 'id' => 'city_id']) }}
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        {{ Form::label('address', 'العنوان') }}
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-street-view"></i></span>
                            </div>
                            {{ Form::text('address', $driver->person->address ?? old('address'), [ 'required', 'id' => "address", 'class' => 'form-control '.($errors->has( 'address') ? ' error':''), 'placeholder' => 'العنوان']) }}
                        </div>
                    </div>

                    <div class="form-group">
                        {{ Form::label('notes', 'ملاحظات') }}
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"></span>
                            </div>
                            {{ Form::textarea('notes', $driver->person->notes ?? old('notes'), ['id' => "notes", 'class' => 'form-control '.($errors->has( 'notes') ? ' error':''), 'rows' => 5, 'placeholder' => 'ملاحظات']) }}
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
