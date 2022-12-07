@extends('layouts.manufactories')

@section('title', 'Mahmoud Hekal')

@section('content')
    <div class="row">
        <div class="col-lg-6 mx-auto">
            <div class="card">
                <div class="card-body">
                    <h4 class="mt-0 header-title">نموذج إضافة عميل</h4>
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('itinerary.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="form-row my-2">
                            <div class="col-md-7">

                                <div class="form-group">
                                    <label for="name">اسم خط السير</label>
                                    <div class="input-group">
                                        <div class="input-group-append">
                                            <span class="input-group-text"><i class="far fa-user"></i></span>
                                        </div>
                                        {{ Form::text('name', old('name'), [ 'required', 'id' => "name", 'class' => 'form-control '.($errors->has( 'name') ? ' error':''), 'placeholder' => 'اسم خط السير']) }}
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="representative">اختر المندوب</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-user-tie"></i></span>
                                        </div>
                                        <select
                                            class="form-control form-control-lg {{ $errors->has('representative') ? 'error' : '' }}"
                                            id="representative" name="representative_id">
                                            <option value="0">اختر المندوب</option>
                                            @foreach ($representatives as $representative)
                                                <option value="{{$representative->id}}">
                                                    {{$representative->name}}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="state_id">اختر المحافظة</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <i class="fab fa-studiovinari"></i>
                                        </span>
                                        </div>
                                        <select class="form-control form-control-lg" id="state_id" name="state_id" required>
                                            <option>اختر المحافظة</option>
                                            @foreach ($states as $state)
                                                <option value="{{$state->state_id}}">
                                                    {{$state->state}}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="representative">اليوم الأول</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i
                                                            class="fas fa-user-tie"></i></span>
                                                </div>
                                                <select
                                                    class="form-control form-control-lg {{ $errors->has('day1') ? 'error' : '' }}"
                                                    id="day1" name="day1" required>
                                                    @foreach ($days as $key=>$value)
                                                        <option value="{{$key}}">{{$value}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="representative">اليوم الثانى</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i
                                                            class="fas fa-user-tie"></i></span>
                                                </div>
                                                <select
                                                    class="form-control form-control-lg {{ $errors->has('day2') ? 'error' : '' }}"
                                                    id="day2" name="day2" required>
                                                    @foreach ($days as $key=>$value)
                                                        <option value="{{$key}}">{{$value}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-5">
                                <label for="city_id">اختر المركز</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-home"></i></span>
                                    </div>
                                    <select multiple id="city_id" name="city_id[]" required
                                            style="min-height: 310px; width: 100%;"
                                            class="form-control form-control-lg {{ $errors->has('city_id') ? 'error' : '' }}"></select>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label>ملاحظات</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">ملاحظات</span>
                                </div>
                                <textarea class="form-control {{ $errors->has('notes') ? 'error' : '' }}"
                                          id="notes" rows="5" name="notes"
                                          aria-label="notes">{{ old('username') }}</textarea>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-gradient-primary form-control form_spinner">
                            <span class="spinner-border-sm" id="spinner" role="status" aria-hidden="true"></span>
                            اضف
                        </button>
                    </form><!--end form-->
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

            $('#city').on('change', function () {
                let city = $(this).val();
                $("#client").html('');
                $.ajax({
                    url: '{{url('clients_by_city')}}',
                    type: "GET",
                    data: {city: city},
                    dataType: 'json',
                    success: function (result) {
                        $.each(result, function (key, value) {
                            $("#client").append('<option value="' + value.id + '">' + value.name + '</option>');
                        });
                    }
                });
            });

        });
    </script>
@endsection
