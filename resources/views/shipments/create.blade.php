@extends('layouts.manufactories')

@section('title', 'Mahmoud Hekal')

@section('content')
    <div class="row mt-3 pt-2">
        <div class="col-lg-8 mx-auto">
            <div class="card">
                <div class="card-body">
                    <h1 class="mt-0">إثبات أمر توريد</h1>
                    <h2>برجاء مراجعة سعر بيع وشراء البون</h2>
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    @if(session()->get('process'))
                        <div class="alert alert-success">
                            <h2>
                                <span class="text-primary">{{ session()->get('process') }}</span>
                            </h2>
                        </div>
                    @endif

                    <form action="{{ route('shipment.store') }}" method="POST">
                        @csrf

                        <div class="form-row">
                            <div class="col-md-6 mb-2">
                                <label for="manufactory">اختر مصنع الأسمنت</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fab fa-studiovinari"></i></span>
                                    </div>
                                    <select class="form-control form-control-lg" id="manufactory" name="manufactory_id">
                                        <option>اختر مصنع الأسمنت</option>
                                        @foreach ($manufactories as $manufactory)
                                            <option
                                                value="{{ $manufactory->id }}" {{ old('manufactory_id') == $manufactory->id ? "selected" :""}}>
                                                {{$manufactory->name}}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-6 mb-2">
                                <label for="cement_type_id">نوع الأسمنت</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <i class="fab fa-studiovinari"></i>
                                        </span>
                                    </div>
                                    <select class="form-control form-control-lg" id="cement_type_id" name="cement_type_id">
                                        @foreach ($cement_types as $type)
                                            <option
                                                value="{{ $type->id }}" {{ old('cement_type_id') == $type->id ? "selected" :""}}>
                                                {{$type->name}}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                        </div>

                        <div class="form-row">
                            <div class="col-md-6 mb-2">
                                <label for="transportation_id">اختر شركة الشحن</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fab fa-studiovinari"></i></span>
                                    </div>
                                    <select class="form-control form-control-lg" id="transportation" name="transportation_id">
                                        <option>اختر شركة الشحن</option>transportation
                                        @foreach ($transportations as $transportation)
                                            <option
                                                value="{{ $transportation->id }}" {{ old('transportation_id') == $transportation->id ? "selected" :""}}>
                                                {{$transportation->name}}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-6 mb-2">
                                <label for="packed">تعبئة الأسمنت</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <i class="fab fa-studiovinari"></i>
                                        </span>
                                    </div>
                                    <select class="form-control form-control-lg" id="packed" name="packed">
                                        <option value="1">معبأ</option>
                                        <option value="0">سايب</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="col-md-6 mb-2">
                                <label for="trans">السائق</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-dollar-sign"></i></span>
                                    </div>
                                    <select class="form-control form-control-lg" id="driver" name="driver">
                                        <option>اختر السائق</option>
                                        @foreach ($drivers as $driver)
                                            <option
                                                value="{{ $driver->id }}" {{ old('driver_id') == $driver->id ? "selected" :""}}>
                                                {{$driver->name}}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-3 mb-2">
                                <label for="trans">تكلفة نقل الطن</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-dollar-sign"></i></span>
                                    </div>
                                    <input type="number" id="trans" name="trans" min="0"
                                           class="form-control {{ $errors->has('trans') ? 'error' : '' }}"
                                           placeholder="تكلفة نقل الطن" value="{{ old('trans') }}" />
                                </div>
                            </div>

                            <div class="col-md-3 mb-2">
                                <label for="total_trans">إجمالى تكلفة النقل</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-dollar-sign"></i></span>
                                    </div>
                                    <input type="number" readonly id="total_trans" name="total_trans"
                                           class="form-control {{ $errors->has('total_trans') ? 'error' : '' }}"
                                           placeholder="إجمالى التكلفة" value="{{ old('total_trans') }}" />
                                </div>
                            </div>

                        </div>

                        <div class="form-row">
                            <div class="col-md-6 mb-2">
                                <label for="created_at">تاريخ حركة السيارة</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-dollar-sign"></i></span>
                                    </div>
                                    <input type="datetime-local" id="created_at" name="created_at"
                                           class="form-control {{ $errors->has('created_at') ? 'error' : '' }}"
                                           placeholder="تاريخ حركة السيارة" value="{{ old('created_at') }}" />
                                </div>
                            </div>

                            <div class="col-md-3 mb-2">
                                <label for="tons">الأطنان</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-dollar-sign"></i></span>
                                    </div>
                                    <input type="number" id="tons" name="tons" min="0" max="120" class="form-control {{ $errors->has('tons') ? 'error' : '' }}" placeholder="الأطنان" value="{{ old('tons') }}" />
                                </div>
                            </div>
                            <div class="col-md-3 mb-2">
                                <label for="sacks">الشكاير</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-dollar-sign"></i></span>
                                    </div>
                                    <input type="number" id="sacks" name="sacks" min="0" max="19" class="form-control {{ $errors->has('sacks') ? 'error' : '' }}" placeholder="الشكاير" value="{{ old('sacks') }}" />
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="c_1">اختر البونات</label>
                            <span id="coupon_no" class="text-danger m-1"></span>
                            <span class="float-right btn btn-gradient-danger  mb-2 mx-1" id="del_cop">حذف</span>
                            <span class="float-right btn btn-gradient-success mb-2 mx-1" id="add_cop">اضف</span>
                        </div>

                        <div class="row bg-success py-2 mb-2">
                            <div class="input-group my-1 col-4 c_div" id="cop_1">
                                <select class="form-control cop" id="c_1" name="coupons[]"
                                        onchange="dropdown_coupon(this.value)" onfocus="prev_coupon(this.value)"></select>
                            </div>
                        </div>

                        <!--
                        <div class="form-group" id="reps">
                                                    <div class="col-md-6 mb-2">
                                <label for="representative_1">اختر المندوب</label>
                                <span class="float-right btn btn-gradient-danger  mb-2 mx-1" id="del_rep">حذف</span>
                                <span class="float-right btn btn-gradient-success mb-2 mx-1" id="add_rep" >اضف</span>

                                <div class="input-group my-1 r_div" id="rep_1">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-user-tie"></i></span>
                                    </div>
                                    <select class="form-control rep" id="r_1" name="representatives[]"
                                            onchange="dropdown_rep(this.value)" onfocus="prev_rep(this.value)">
                                        <option value="0">اختر المندوب</option>
                                        @foreach ($representatives as $representative)
                        <option value="{{$representative->id}}">{{$representative->name}}</option>
                                        @endforeach
                        </select>
                    </div>
                </div>
                </div>
-->

                        <div class="form-group">
                            <label>ملاحظات</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">ملاحظات</span>
                                </div>
                                <textarea class="form-control {{ $errors->has('notes') ? 'error' : '' }}" id="notes"
                                          rows="5" name="notes" aria-label="notes">{{ old('username') }}</textarea>
                            </div>
                        </div>
                        <input type="submit" class="btn btn-gradient-primary form-control" value="سجل" />
                    </form><!--end form-->
                </div><!--end card-body-->
            </div><!--end card-->
        </div><!--end col-->
    </div><!--end row-->

    <script>
        var max_coupons = 1;
        $(function () {
            $('#trans, #tons').on('change', function () {
                var trans = $('#trans').val();
                var tons = $('#tons').val();
                $('#total_trans').val(trans * tons);
            });
            $('#transportation, #packed, #cement_type_id').on('change', function () {
                $("div.c_div:not(:eq(0))").remove();
                $("#c_1").empty();
                let transportation = $('#transportation').val();
                let packed = $('#packed').val();
                let cement = $('#cement_type_id').val();
                $(".cop").html('');
                let x =1;
                $.ajax({
                    url: '{{url('couponsOfTransportation')}}',
                    type: "POST",
                    data: {transportation: transportation,packed: packed, cement: cement, _token: '{{csrf_token()}}'},
                    dataType: 'json',
                    success: function (result) {
                        $.each(result, function (key, value) {
                            $(".cop").append('<option value="' + value.id + '">' + x++ + ' : ' + value.coupon + ' بقيمة ' + value.value + ' طن </option>');
                        });
                        $('#coupon_no').html(result.length + ' كوبون متاح');
                        max_coupons = result.length;
                    }
                });
            });
        });

        $("#add_cop").click({options: ".cop", div: "#cop_1"}, add);
        $("#del_cop").click({options: ".cop", last:'.c_div'}, del);

        function add(e){
            let div = e.data.div;
          //  let string1 = "cop_1";
            let x = div.split('_')[1];
            x++;
            console.log(x);
            let max = max_coupons;
            let options = e.data.options;
            let total = $(options).length;
            if (total >= max)
                return false;
            $(div).clone().insertAfter(div);
        }

        function del(e){
            let options = e.data.options;
            let last = e.data.last;
            let total = $(options).length;
            if (total < 2)
                return false;
            let x = $(last).last().data.value;
            $(last).last().remove();
        }

        let p_coupon = 0;
        function prev_coupon(x){
            p_coupon = x;
        }

        function dropdown_coupon(n_coupon){
            $('select[id^="c_"]').not(this).find('option[value="'+p_coupon+'"]').show();
            $('select[id^="c_"]').find('option[value="' + n_coupon + '"]').hide();
            $('select[id^="c_"]').not(this).find('option[value="' + n_coupon + '"]').hide();
        }

        /*
        $("#add_rep").click({options: ".rep", div: "#rep_1", max: 3}, add);
        $("#del_rep").click({options: ".rep", last:'.r_div'}, del);


          function add(e){
            let div = e.data.div;
            let max = e.data.max;
            let options = e.data.options;
            let total = $(options).length;
            if (total >= max)
               return false;
            $(div).clone().insertAfter(div);
        }

        function del(e){
            let options = e.data.options;
            let last = e.data.last;
            let total = $(options).length;
            if (total < 2)
                return false;
            let x = $(last).last().data.value;
            $(last).last().remove();
            console.log('Deleted: ' +x);
        }

        let p_rep = 0;
        function prev_rep(x){
            p_rep = x;
        }
        function dropdown_rep(n_rep){
            $('select[id^="r_"]').not(this).find('option[value="'+p_rep+'"]').show();
            $('select[id^="r_"]').find('option[value="' + n_rep + '"]').hide();
            $('select[id^="r_"]').not(this).find('option[value="' + n_rep + '"]').hide();
        }
        */

    </script>
@endsection
