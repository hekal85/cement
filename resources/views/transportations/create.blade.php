@extends('layouts.manufactories')

@section('title', 'Mahmoud Hekal')

@section('content')
    <div class="row">
        <div class="col-lg-6 mx-auto">
            <div class="card">
                <div class="card-body">
                    <h2 class="mb-2 py-2 text-center bg-primary rounded">نموذج إضافة شركة شحن</h4>
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <form action="{{ route('transportation.store') }}" method="POST">
                        @csrf
                        <div class="form-row">
                            <div class="col-md-6 mb-6">
                                <label for="name">اسم شركة الشحن</label>
                                <div class="form-group">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="far fa-user"></i></span>
                                        </div>
                                        <input type="text" id="name" name="name"
                                               class="form-control {{ $errors->has('name') ? 'error' : '' }}"
                                               value="{{ old('name') }}" placeholder="اسم شركة الشحن"/>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 mb-6">
                                <label for="director">اسم المدير المسئول</label>
                                <div class="form-group">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="far fa-user"></i></span>
                                        </div>
                                        <input type="text" id="director" name="director"
                                               class="form-control {{ $errors->has('director') ? 'error' : '' }}"
                                               value="{{ old('director') }}" placeholder="اسم المدير المسئول"/>
                                    </div>
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
                                    <input type="tel" id="mobile" name="mobile"
                                           class="form-control {{ $errors->has('mobile') ? 'error' : '' }}"
                                           value="{{ old('mobile') }}" placeholder="رقم الموبايل"/>
                                </div>
                            </div>

                            <div class="col-md-6 mb-6">
                                <label for="exampleInputPassword1">رقم الهاتف</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-phone-volume"></i></span>
                                    </div>
                                    <input type="tel" id="phone" name="phone"
                                           class="form-control {{ $errors->has('phone') ? 'error' : '' }}"
                                           value="{{ old('phone') }}" placeholder="رقم الهاتف"/>
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
                                    <select class="form-control form-control-lg" id="city_id" name="city_id"></select>
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
                                    <input type="email" id="email" name="email"
                                           class="form-control {{ $errors->has('email') ? 'error' : '' }}"
                                           value="{{ old('email') }}" placeholder="البريد الإليكترونى"/>
                                </div>
                            </div><!--end col-->

                            <div class="col-md-3 mb-3">
                                <label for="cash">الرصيد</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-dollar-sign"></i></span>
                                    </div>
                                    <input type="number" id="cash" name="cash"
                                           class="form-control {{ $errors->has('cash') ? 'error' : '' }}"
                                           value="{{ old('cash') }}" placeholder="الرصيد"/>
                                    <div class="invalid-feedback">
                                        Please choose a username.
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="address">العنوان</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-street-view"></i></span>
                                </div>
                                <input type="text" id="address" name="address"
                                       class="form-control {{ $errors->has('address') ? 'error' : '' }}"
                                       value="{{ old('address') }}" placeholder="العنوان"/>
                            </div>
                        </div>

                        <div class="form-group">
                            <label>ملاحظات</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">ملاحظات</span>
                                </div>
                                <textarea class="form-control {{ $errors->has('name') ? 'notes' : '' }}" id="notes"
                                          rows="8" name="notes" aria-label="notes">{{ old('notes') }}</textarea>
                            </div>
                        </div>
                        <input type="submit" class="btn btn-gradient-primary form-control" value="سجل" />
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
                            $("#city_id").append('<option value="' + value.city + '">' + value.city + '</option>');
                        });
                    }
                });
            });
        });
    </script>

@endsection
