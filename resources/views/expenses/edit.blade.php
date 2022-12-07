@extends('layouts.manufactories')
@section('title', 'تعديل مصروف ')
@section('content')
    <div class="row d-flex justify-content-center">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-body">
                    <h4 class="mt-0 header-title">نموذج تعديل نوع المصروف</h4>

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    {{ Form::open(['route' => ['expense.update', $expense->id], 'method' => 'PUT', 'class' => 'card-box', 'enctype' => 'multipart/form-data']) }}
                    {{ Form::token() }}

                    <div class="form-row my-2">
                        <div class="col-md-6 mb-6">
                            {{ form::label('expense_type_id', 'نوع المصروف') }}
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="far fa-user"></i></span>
                                </div>
                                {{Form::select('expense_type_id', $expense_types, @$expense->expense_type_id ? $expense->expense_type_id : old('expense_type_id'), ['required', 'class' => 'form-control '.($errors->has( 'expense_type_id') ? ' error':''), 'id' => 'expense_type_id', 'placeholder' => '--- اختر الوظيفة ---'])}}
                            </div>
                        </div>

                        <div class="col-md-6 mb-6">
                            {{ form::label('paid', 'المبلغ') }}
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="far fa-user"></i></span>
                                </div>
                                {{ Form::hidden('id', $expense->id) }}
                                {{ Form::text('paid', @$expense->paid ? $expense->paid : old('paid'), [ 'required', 'id' => "paid", 'class' => 'form-control '.($errors->has( 'paid') ? ' error':''), 'placeholder' => 'المبلغ', 'min' => 10, 'max' => 99999]) }}
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <input type="submit" class="btn btn-gradient-warning form-control" value="عدل"/>
                    </div>
                {{ form::close() }}<!--end form-->
                </div><!--end card-body-->
            </div><!--end card-->
        </div><!--end col-->

    </div><!--end row-->
@endsection
