@extends('layouts.manufactories')
@section('title', 'صفحة المصروفات')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="text-center py-2 bg-black text-white">
                        مشاهدة عمليات الصرف
                        <span id="title" style="color:#00ff00"></span>
                        <span id="period" style="color:#ffff00"></span>
                        <span id="processes" style="color:#ffffff"></span>
                        <span id="total" style="color:#ff0000"></span>
                    </h4>
                    <div class="form-row my-2">
                        <div class="col-md-3">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fab fa-studiovinari"></i></span>
                                </div>
                                {{Form::select('expense', $expense_types, null, ['required', 'class' => 'form-control py-2 ', 'id' => 'expense', 'placeholder' => '--- اختر نوع المصروف ---'])}}
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fab fa-studiovinari"></i></span>
                                </div>
                                {{ Form::date('from', \Carbon\Carbon::now()->startOfMonth()->subMonth(), [ 'required', 'id' => "from", 'class' => 'form-control ', 'placeholder' => 'بداية التاريخ'])  }}
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-home"></i></span>
                                </div>
                                {{ Form::date('to', \Carbon\Carbon::now(), [ 'required', 'id' => "to", 'class' => 'form-control ', 'placeholder' => 'نهابية التاريخ']) }}
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="input-group">
                                {{ Form::button('ابحث', ['disabled','class' => 'form-control btn btn-gradient-primary', 'id' => 'getPeriod'])  }}
                            </div>
                        </div>
                    </div>
                    <div  id="expense_table">
                    <table
                        class="table table-striped table-bordered dt-responsive nowrap hekal_table"
                        style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                        <thead>
                        <tr>
                            @for($x=0; $x<2; $x++)
                                <th>م</th>
                                <th>نوع المصروف</th>
                                <th>المبلغ</th>
                                <th>تاريخ السداد</th>
                            @endfor
                        </tr>
                        </thead>
                        <tbody id="hekal"></tbody>
                        <tfoot>
                        <tr class="text-white bg-black">
                            <td colspan="4" >إجمالى المصروفات</td>
                            <td colspan="4" id="paids"></td>
                        </tr>
                        </tfoot>
                    </table>
                </div>
                </div>
            </div>
        </div> <!-- end col -->
    </div> <!-- end row -->

    <script>
        $(function () {
            $('#expense_table').hide();
            $('#expense').change(function (){
                let expense = $(this).val();
                if(expense > 0){
                    $('#getPeriod').prop('disabled', false);
                }else{
                    $('#getPeriod').prop('disabled', true);
                    $('#title').html('');
                    $('#period').html('');
                    $('#total').html('');
                    $('#hekal').html('');
                }
            })

            $('#getPeriod').on('click', function (e) {
                $('#expense_table').show();
                let from = $('#from').val();
                let to = $('#to').val();
                let expense = $('#expense').val();
                let title = $('#expense option:selected').text();
                let info = $.get("{{url('expense_between_dates')}}", {from: from, to: to, expense: expense});
                info.done(function (result) {
                    $('#title').html(title);
                    $('#period').html(' خلال الفترة من ' + from + ' وحتى:  ' + to);
                    $('#processes').html(' بعدد ' + result.processes + ' عملية ');
                    $('#total').html(' وإجمالى مبلغ ' + result.total + ' جنيه ');
                    $('#hekal').html(result.data);
                    $('#paids').html(result.total);
                });
            });
        })
    </script>

@endsection
