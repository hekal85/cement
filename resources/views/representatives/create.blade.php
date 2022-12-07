@extends('layouts.manufactories')
@section('title', 'Mahmoud Hekal')

@section('content')
    <div class="row">
        <div class="col-lg-6 mx-auto">
            <div class="card">
                <div class="card-body">
                    <h2 class="mb-2 py-2 text-center bg-success rounded">نموذج إضافة مندوب</h2>
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    {{ Form::open(['route' => ['representative.store'], 'method' => 'POST', 'class' => 'card-box', 'enctype' => 'multipart/form-data']) }}
                    {{ Form::token() }}

                    <div class="form-row">
                        <div class="col-md-8 mb-8">
                            <label for="name">الاسم</label>
                            <div class="input-group">
                                <div class="input-group-append">
                                    <span class="input-group-text"><i class="far fa-user"></i></span>
                                </div>
                                {{ Form::text('name', old('name'), [ 'required', 'id' => "name", 'class' => 'form-control '.($errors->has( 'name') ? ' error':''), 'placeholder' => 'الاسم']) }}
                            </div>
                        </div>

                        <div class="col-md-4 mb-4">
                            <label for="image">الصورة</label>
                            <div class="input-group">
                                {{ Form::file('image', old('image'), [ 'required', 'id' => "image", 'class' => 'form-control']) }}
                            </div>
                        </div>
                    </div>

                        <div class="form-row">
                            <div class="col-md-8 mb-8">
                                <label for="email">البريد الإليكترونى</label>
                                <div class="input-group">
                                    <div class="input-group-append">
                                        <span class="input-group-text"><i class="far fa-envelope"></i></span>
                                    </div>
                                    {{ Form::email('email', old('email'), [ 'required', 'id' => "email", 'class' => 'form-control '.($errors->has( 'email') ? ' error':''), 'placeholder' => 'البريد الإليكترونى']) }}
                                </div>
                            </div><!--end col-->

                            <div class="col-md-4 mb-4">
                                <label for="cash">الرصيد</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-dollar-sign"></i></span>
                                    </div>
                                    {{ Form::number('cash', old('cash'), [ 'required', 'id' => "cash", 'class' => 'form-control '.($errors->has( 'cash') ? ' error':''), 'min' => 0, 'max' => 999999, 'placeholder' => 'الرصيد']) }}
                                </div>
                            </div>
                        </div>

                        <div class="form-row my-2">
                            <div class="col-md-6 mb-6">
                                <label for="mobile">رقم الموبايل</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-mobile-alt"></i></span>
                                    </div>
                                    {{ Form::text('mobile', old('mobile'), [ 'required', 'id' => "mobile", 'class' => 'form-control '.($errors->has( 'mobile') ? ' error':''), 'placeholder' => 'الموبايل']) }}
                                </div>
                            </div>

                            <div class="col-md-6 mb-6">
                                <label for="phone">رقم الهاتف</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-phone-volume"></i></span>
                                    </div>
                                    {{ Form::text('phone', old('phone'), [ 'required', 'id' => "phone", 'class' => 'form-control '.($errors->has( 'phone') ? ' error':''), 'placeholder' => 'الهاتف']) }}
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
                                            <option value="{{ $state->state_id }}" {{ old('state') == $state->state_id ? "selected" :""}}>
                                                {{$state->state}}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-6 mb-6">
                                <label for="city_id">اختر المركز</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-home"></i></span>
                                    </div>
                                    {{ Form::select('city_id', [], NULL, ['class' => 'form-control form-control-lg', 'id' => 'city_id']) }}
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="address">العنوان</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-street-view"></i></span>
                                </div>
                                {{ Form::text('address', old('address'), [ 'required', 'id' => "address", 'class' => 'form-control '.($errors->has( 'address') ? ' error':''), 'placeholder' => 'العنوان']) }}
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="notes">ملاحظات</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"></span>
                                </div>
                                {{ Form::textarea('notes', old('notes'), ['id' => "notes", 'class' => 'form-control '.($errors->has( 'notes') ? ' error':''), 'rows' => 5, 'placeholder' => 'ملاحظات']) }}
                            </div>
                        </div>
                    {{ Form::submit('اضف', ['class' => 'btn btn-gradient-primary form-control ', 'id' => 'spinner', 'role' => 'status']) }}
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
