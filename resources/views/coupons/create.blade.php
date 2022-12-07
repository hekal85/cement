@extends('layouts.manufactories')

@section('title', 'Mahmoud Hekal')

@section('content')
    <div class="row mt-3 pt-2">
        <div class="col-lg-6 mx-auto">
            <div class="card">
                <div class="card-body">
                    <h4 class="mt-0">نموذج إضافة بونات</h4>
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
                            <h3>
                                <span class="text-primary">{{ session()->get('process') }}</span>
                            </h3>
                            <ol>
                                @foreach(session()->get('duplicated') as $d)
                                    <li class="text-danger">{{ $d }}</li>
                                @endforeach
                            </ol>
                        </div>
                    @endif

                    <form action="{{ route('coupon.store') }}" method="POST">
                        @csrf
                        <div class="form-row">
                            <div class="col-md-9 mb-2">
                                <div class="form-group">
                                    <label for="manufactory">اختر مصنع الأسمنت</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fab fa-studiovinari"></i></span>
                                        </div>
                                        <select class="form-control form-control-lg" id="manufactory"
                                                name="manufactory" {{ $errors->has('manufactory') ? 'error' : '' }} >
                                            <option>اختر مصنع الأسمنت</option>
                                            @foreach ($manufactories as $manufactory)
                                                <option
                                                    value="{{ $manufactory->id }}" {{ old('manufactory') == $manufactory->id ? "selected" :""}}>
                                                    {{$manufactory->name}}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="col-md-7 mb-7">
                                        <label for="transportation">ختر شركة الشحن</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fab fa-studiovinari"></i></span>
                                            </div>
                                            <select class="form-control form-control-lg" id="transportation"
                                                    name="transportation" {{ $errors->has('transportation') ? 'error' : '' }}>
                                                <option>اختر شركة الشحن</option>
                                                @foreach ($transportations as $transportation)
                                                    <option
                                                        value="{{ $transportation->id }}" {{ old('transportation') == $transportation->id ? "selected" :""}}>
                                                        {{$transportation->name}}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-5 mb-5">
                                        <label for="packed">تعبئة الأسمنت</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i
                                                        class="fab fa-studiovinari"></i></span>
                                            </div>
                                            <select class="form-control form-control-lg" id="packed" name="packed"
                                                {{ $errors->has('packed') ? 'error' : '' }}>
                                                <option value="1">معبأ</option>
                                                <option value="0">سايب</option>
                                            </select>
                                        </div>
                                    </div><!--end col-->
                                </div>

                                <div class="form-row">
                                    <div class="col-md-7 mb-7">
                                        <label for="cement_type_id">اختر نوع الأسمنت</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i
                                                        class="fab fa-studiovinari"></i></span>
                                            </div>
                                            <select class="form-control form-control-lg" id="cement_type_id"
                                                    name="cement_type_id" {{ $errors->has('cement_type_id') ? 'error' : '' }}>
                                                <option>نوع الأسمنت</option>
                                                @foreach ($cement_types as $types)
                                                    <option
                                                        value="{{ $types->id }}" {{ old('cement_type_id') == $types->id ? "selected" :""}}>
                                                        {{$types->name}}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-5 mb-5">
                                        <label for="value">الفئة</label>
                                        <div class="input-group">
                                            <div class="input-group-append">
                                                <span class="input-group-text"><i class="far fa-envelope"></i></span>
                                            </div>
                                            <select class="form-control form-control-lg" id="value" name="value"
                                                    {{ $errors->has('value') ? 'error' : '' }} required>
                                                @for($n=10; $n<=100; $n+=10)
                                                    <option value="{{$n}}">{{$n}} طن</option>
                                                @endfor
                                            </select>
                                        </div>
                                    </div><!--end col-->

                                </div>

                                <div class="form-row">
                                    <div class="col-md-7 mb-7">
                                        <label for="created_at">تاريخ إصدار الكوبون</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fas fa-dollar-sign"></i></span>
                                            </div>
                                            <input type="datetime-local" id="created_at" name="created_at"
                                                   class="form-control {{ $errors->has('created_at') ? 'error' : '' }}"
                                                   placeholder="تاريخ الإصدار" value="{{ old('created_at') }}"/>
                                        </div>
                                    </div>


                                    <div class="col-md-5 mb-5">
                                        <label for="cost">تكلفة الطن</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i
                                                        class="fab fa-studiovinari"></i></span>
                                            </div>
                                            <input type="number" id="cost" name="cost" class="form-control {{ $errors->has('cost') ? 'error' : '' }}" min="100" max="3000" value="{{ old('cost') }}" />
                                        </div>
                                    </div><!--end col-->
                                </div>
                            </div>
                            <div class="col-md-3 mb-0">
                                <div class="form-group">
                                    <label for="coupon">أرقام الكوبون</label>
                                    <textarea class="form-control {{ $errors->has('coupon') ? 'error' : '' }}"
                                              id="coupon" rows="12" name="coupon"
                                              required>{{ old('username') }}</textarea>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <input type="number" id="total_cost" name="total_cost"
                                               class="form-control" readonly />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label>ملاحظات</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">ملاحظات</span>
                                        </div>
                                        <textarea class="form-control {{ $errors->has('notes') ? 'error' : '' }}"
                                                  id="notes" rows="5" name="notes" aria-label="notes"
                                                  style="resize: none;">{{ old('username') }}</textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-gradient-primary form-control">
                            <span class="spinner-border-sm" id="spinner" role="status" aria-hidden="true"></span> اضف
                        </button>
                    </form><!--end form-->
                </div><!--end card-body-->
            </div><!--end card-->
        </div><!--end col-->
    </div><!--end row-->

    <script>
        $(function () {
            $('#cost, #coupon, #value').on('change', function () {
                var coupons = $('#coupon').val().split("\n").length;
                var value = $('#value').val();
                var cost = $('#cost').val();
                var total = coupons * value * cost;
                $('#total_cost').val(total);
            });
        });
    </script>
@endsection
