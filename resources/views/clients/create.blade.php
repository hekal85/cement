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

                        <form action="{{ route('client.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="form-row">
                            <div class="col-md-4 mb-4">
                                <label for="name">اسم العميل</label>
                                <div class="form-group">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="far fa-user"></i></span>
                                        </div>
                                        <input type="text" id="name" name="name" class="form-control {{ $errors->has('name') ? 'error' : '' }}" placeholder="اسم العميل" value="{{ old('name') }}" />
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-4 mb-4">
                                <label for="representative">اختر المندوب</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-user-tie"></i></span>
                                    </div>
                                    <select class="form-control form-control-lg {{ $errors->has('representative') ? 'error' : '' }}" id="representative" name="representative">
                                        <option value="0">اختر المندوب</option>
                                        @foreach ($representatives as $representative)
                                            <option value="{{$representative->id}}">
                                                {{$representative->name}}
                                            </option>
                                        @endforeach
                                    </select>
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
                            <div class="col-md-9 mb-9">
                                <label for="email">البريد الإليكترونى</label>
                                <div class="input-group">
                                    <div class="input-group-append">
                                        <span class="input-group-text"><i class="far fa-envelope"></i></span>
                                    </div>
                                    <input type="email" id="email" name="email" class="form-control {{ $errors->has('email') ? 'error' : '' }}" placeholder="البريد الإليكترونى" value="{{ old('email') }}" />
                                </div>
                            </div>

                            <div class="col-md-3 mb-3">
                                <label for="cash">الرصيد</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-dollar-sign"></i></span>
                                    </div>
                                    <input type="number" id="cash" name="cash" class="form-control {{ $errors->has('cash') ? 'error' : '' }}" placeholder="الرصيد" value="{{ old('cash') }}" />
                                </div>
                            </div>
                        </div>

                        <div class="form-row my-2">
                            <div class="col-md-6 mb-6">
                                <label for="mobile">أرقام التواصل</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-mobile-alt"></i></span>
                                    </div>
                                    <input type="tel" id="mobile" name="mobile" class="form-control {{ $errors->has('mobile') ? 'error' : '' }}" placeholder="رقم الموبايل" value="{{ old('mobile') }}" />
                                </div>
                            </div>

                            <div class="col-md-6 mb-6">
                                <label for="exampleInputPassword1">رقم الهاتف</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-phone-volume"></i></span>
                                    </div>
                                    <input type="tel" id="phone" name="phone" class="form-control {{ $errors->has('phone') ? 'error' : '' }}" placeholder="رقم الهاتف" value="{{ old('phone') }}" />
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
                                <label for="city_id">اختر المركز</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-home"></i></span>
                                    </div>
                                    <select class="form-control form-control-lg {{ $errors->has('city_id') ? 'error' : '' }}" id="city_id" name="city_id"></select>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="address">العنوان</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-street-view"></i></span>
                                </div>
                                <input type="text" id="address" name="address" class="form-control {{ $errors->has('address') ? 'error' : '' }}" placeholder="العنوان" value="{{ old('address') }}" />
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
