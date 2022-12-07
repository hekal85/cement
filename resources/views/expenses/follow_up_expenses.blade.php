@extends('layouts.manufactories')
@section('title', 'صفحة المصروفات')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h3 class="text-center py-2 bg-black text-white">
                        مشاهدة عمليات صرف
                        <span id="title" style="color:#ff0000"></span>
                        <span id="total" style="color:#ffff00"></span>
                    </h3>

                    <div class="form-row my-3">
                        <div class="col-md-2">
                            <div class="input-group">
                                <h4 class="mt-0 header-title">
                                    <a href="{{ route('expense.create') }}" class="btn  btn-warning">
                                        إضافة مصروف جديد
                                    </a>
                                </h4>
                            </div>
                        </div>

                        <div class="col-md-7">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fab fa-studiovinari"></i></span>
                                </div>
                                {{Form::select('expense', $expense_types, null, ['required', 'class' => 'form-control py-2 '.($errors->has( 'expense') ? ' error':''), 'id' => 'expense', 'placeholder' => '--- اختر نوع المصروف ---'])}}
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="input-group">
                                {{ Form::button('ابحث', ['id' => 'find', 'class' => 'btn btn-gradient-primary form-control', 'type' => 'search']) }}
                            </div>
                        </div>
                    </div>

                    <table id="data"
                           class="table table-striped table-bordered dt-responsive nowrap hekal_table"
                           style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                        <thead>
                        <tr>
                            @for($x=0; $x<4; $x++)
                                <th>م</th>
                                <th>المبلغ</th>
                                <th>تاريخ السداد</th>
                            @endfor
                        </tr>
                        </thead>
                        <tbody id="hekal"></tbody>
                    </table>
                    </table>
                </div>
            </div>
        </div> <!-- end col -->
    </div> <!-- end row -->

    <script>
        $(function () {
            $('#find').on('click', function (e) {
                let expense = $('#expense').val();
                let title = $('#expense option:selected').text();
                let info = $.get("{{url('fetch_follow_up_expenses')}}", {expense: expense});
                info.done(function (result) {
                    $('#title').html(title);
                    $('#total').html(' عدد ' + result.total + ' عملية');
                    $('#hekal').html(result.data);
                });
            });
        })
    </script>
@endsection
