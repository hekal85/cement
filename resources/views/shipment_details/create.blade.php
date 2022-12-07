@extends('layouts.manufactories')

@section('title', 'Mahmoud Hekal')

@section('content')
    <div class="row">
        <div class="col-lg-6 mx-auto">
            <div class="card">
                <div class="card-body">
                    <h1 class="mt-0">إثبات أمر توريد</h1>
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

                    <form action="{{ route('shipmentDetails.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="shipment_id" value="{{ $shipment[0]->id }}">
                        <input type="hidden" name="remaining" value="{{ $shipment[0]->remaining }}">
                        <div class="row">
                            <div class="col-6">

                                <div class="form-row">
                                    <label for="representative">اختر المندوب</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fab fa-studiovinari"></i></span>
                                        </div>
                                        <select class="form-control form-control-lg
                                                {{ $errors->has('representative') ? 'error' : '' }}"
                                                id="representative" name="representative_id" required>
                                            <option>اختر المندوب</option>
                                            @foreach ($representatives as $representative)
                                                <option
                                                    value="{{ $representative->id }}" {{ old('representative') == $representative->id ? "selected" :""}}>
                                                    {{$representative->name}}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="form-row">
                                    <label for="client">اختر العميل</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fab fa-studiovinari"></i></span>
                                        </div>
                                        <select class="form-control form-control-lg
                                                {{ $errors->has('client') ? 'error' : '' }}"
                                                id="client" name="client_id" required></select>
                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="col-md-6 mb-6">
                                        <label for="tons">الكمية بالأطنان</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fas fa-dollar-sign"></i></span>
                                            </div>
                                            <input type="number" id="tons" name="tons"
                                                   class="form-control {{ $errors->has('tons') ? 'error' : '' }}"
                                                   min="0" max="{{ floor($shipment[0]->remaining / 20) }}" required
                                                   placeholder="الأطنان" value="{{ old('tons') }}"/>
                                        </div>
                                    </div>

                                    <div class="col-md-6 mb-6">
                                        <label for="sacks">الكمية بالشكاير</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fas fa-dollar-sign"></i></span>
                                            </div>
                                            <input type="number" id="sacks" name="sacks"
                                                   class="form-control {{ $errors->has('sacks') ? 'error' : '' }}"
                                                   min="0" max="19" required
                                                   placeholder="الشكاير" value="{{ old('sacks') }}"/>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="col-md-6 mb-6">
                                        <label for="cost">سعر الطن</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fas fa-dollar-sign"></i></span>
                                            </div>
                                            <input type="number" id="cost" name="cost" required
                                                   class="form-control {{ $errors->has('cost') ? 'error' : '' }}"
                                                   placeholder="سعر الطن" value="{{ old('cost') }}"/>
                                        </div>
                                    </div>

                                    <div class="col-md-6 mb-6">
                                        <label for="total">إجمالى التكلفة</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fas fa-dollar-sign"></i></span>
                                            </div>
                                            <input type="number" id="total" name="total" readonly="readonly" required
                                                   class="form-control {{ $errors->has('total') ? 'error' : '' }}"
                                                   placeholder="التكلفة" value="{{ old('total') }}"/>
                                        </div>
                                    </div>

                                </div>

                                <div class="form-row">
                                    <div class="col-md-6 mb-6">
                                        <label for="discount">قيمة الخصم</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fas fa-dollar-sign"></i></span>
                                            </div>
                                            <input type="number" id="discount" name="discount" required
                                                   class="form-control {{ $errors->has('discount') ? 'error' : '' }}"
                                                   placeholder="قيمة الخصم" value="{{ old('discount') }}"/>
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-6">
                                        <label for="paid">المبلغ المدفوع</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fas fa-dollar-sign"></i></span>
                                            </div>
                                            <input type="number" id="paid" name="paid" required
                                                   class="form-control {{ $errors->has('paid') ? 'error' : '' }}"
                                                   placeholder="المدفوع" value="{{ old('paid') }}"/>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-row">
                                    <label for="transportation">عهدة النقل</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-dollar-sign"></i></span>
                                        </div>
                                        <input type="number" id="transportation" name="transportation" required
                                               class="form-control {{ $errors->has('transportation') ? 'error' : '' }}"
                                               placeholder="تكلفة النقل" value="{{ old('transportation') }}"/>
                                    </div>
                                </div>

                                <div class="form-row">
                                    <label for="owed">المبلغ المتبقى</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-dollar-sign"></i></span>
                                        </div>
                                        <input type="number" id="owed" name="owed" readonly required
                                               class="form-control {{ $errors->has('owed') ? 'error' : '' }}"
                                               placeholder="المتبقى" value="{{ old('owed') }}"/>
                                    </div>
                                </div>

                                <div class="form-row">
                                    <label for="created_at">تاريخ تسليم الأسمنت للعميل</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-dollar-sign"></i></span>
                                        </div>
                                        <input type="datetime-local" id="created_at" name="created_at"
                                               class="form-control {{ $errors->has('created_at') ? 'error' : '' }}"
                                               placeholder="تاريخ الإصدار" value="{{ old('created_at') }}"/>
                                    </div>
                                </div>
                            </div>

                            <div class="col-6 rounded py-2 bg-gray">
                                <ul class="list-group">
                                    <li class="list-group-item list-group-item-action">
                                        كود الحركة:
                                        {{ $shipment[0]->id }}
                                    </li>
                                    <li class="list-group-item list-group-item-action">
                                        المصنع:
                                        {{ $shipment[0]->manufactory->company->name }}
                                    </li>
                                    <li class="list-group-item list-group-item-action">
                                        الشحن:
                                        {{ $shipment[0]->transportation->company->name }}
                                    </li>
                                    <li class="list-group-item list-group-item-action">
                                        تاريخ الحركة:
                                        {{ $shipment[0]->created_at }}
                                    </li>
                                    <li class="list-group-item list-group-item-action">
                                        سر قطع الطن:
                                        {{ floor($shipment[0]->cost) }}
                                    </li>
                                    <li class="list-group-item list-group-item-action">
                                        إجمالى الشحنة بالأطنان:
                                        {{ floor($shipment[0]->payload / 20) }}
                                    </li>
                                    <li class="list-group-item list-group-item-action">
                                        إجمالى الشحنة بالشكاير:
                                        {{ $shipment[0]->payload % 20 }}
                                    </li>
                                    <li class="list-group-item list-group-item-action">
                                        السائق :
                                        {{ $shipment[0]->Driver->name }}
                                    </li>
                                    <li class="list-group-item list-group-item-action">
                                        المتبقى بالأطنان:
                                        {{ floor($shipment[0]->remaining / 20) }}
                                    </li>
                                    <li class="list-group-item list-group-item-action">
                                        المتبقى بالشكاير:
                                        {{ $shipment[0]->remaining % 20 }}
                                    </li>
                                    <li class="list-group-item list-group-item-action">
                                        <p>{!! nl2br($shipment[0]->notes) !!}</p>
                                    </li>
                                </ul>
                            </div>
                        </div>
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
                        <input type="submit" class="btn btn-gradient-primary form-control" value="سجل"/>
                    </form><!--end form-->
                </div><!--end card-body-->
            </div><!--end card-->
        </div><!--end col-->
    </div><!--end row-->

    <script>
        $(function () {
            // Calculate total cost and remaining money
            $("#tons, #sacks, #cost, #paid, #discount, #transportation").on('change', function () {
                let tons = $("#tons").val();
                let sacks = $("#sacks").val();
                let cost = $("#cost").val();
                let paid = $("#paid").val();
                let disc = $("#discount").val();
                let trans = $("#transportation").val();
                let total = parseFloat(tons * cost + sacks * cost / 20);
                let owed = parseFloat(total - paid - disc - trans);
                $("#total").val(total);
                $("#owed").val(owed);
            });

            // Get all Clients of Representative
            $('#representative').on('change', function () {
                let id = $(this).val();
                $("#client").empty();
                $.ajax({
                    url: '{{url('ClientsOfRepresentative')}}',
                    type: "POST",
                    data: {id: id, _token: '{{csrf_token()}}'},
                    dataType: 'json',
                    success: function (data) {
                        $('#client').html(data['clients']);
                    }
                });
            });
        });

    </script>
@endsection
