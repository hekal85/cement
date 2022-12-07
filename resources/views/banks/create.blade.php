@extends('layouts.manufactories')
@section('title', 'إضافة نوع مصروف جديد')
@section('content')
    <div class="row d-flex justify-content-center mt-3 pt-3">
        <div class="col-lg-8">
            <div class="card">
                    <div class="card-body">
                        <h4 class="mt-0">إضافة حساب جديد</h4>

                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        {{ Form::open(['route' => 'bank.store', 'class' => 'card-box', 'enctype' => 'multipart/form-data']) }}
                        {{  Form::token() }}

                        <div class="form-row">
                            <div class="col-md-6 mb-2">
                                <label for="company_id">اسم الشركة</label>
                                <div class="form-group">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="far fa-user"></i></span>
                                        </div>
                                        <select  id="company_id" name="company_id"
                                                 class="form-control form-control-lg {{ $errors->has('company_id') ? 'error' : '' }}">
                                            <option value="0">اختر الشركة</option>
                                            @foreach ($companies as $company)
                                                <option value="{{$company->id}}">
                                                    {{$company->name}}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-4 mb-2">
                                <label for="name">اختر البنك</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-user-tie"></i></span>
                                    </div>
                                    <select id="name" name="name"
                                            class="form-control form-control-lg {{ $errors->has('name') ? 'error' : '' }}">
                                        <option value="0">اختر البنك</option>
                                        @foreach ($banks as $bank)
                                            <option value="{{$bank->id}}">
                                                {{$bank->name}}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-2 mb-4">
                                <label for="bank">اضف البنك</label>
                                <div class="input-group">
                                    <button class="btn btn-gradient-warning form-control" data-bs-toggle="modal" data-bs-target="#add_bank" id="bank">
                                        بنك جديد
                                    </button>
                                </div>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="col-md-6 mb-2">
                                <label for="account">رقم الحساب</label>
                                <div class="form-group">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="far fa-user"></i></span>
                                        </div>
                                        {{ Form::text('account', old('account'), [ 'required', 'id' => "account", 'class' => 'form-control '.($errors->has( 'account') ? ' error':''), 'placeholder' => 'رقم الحساب']) }}
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-4 mb-2">
                                <label for="balance">الرصيد</label>
                                <div class="form-group">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="far fa-user"></i></span>
                                        </div>
                                        {{ Form::text('balance', old('balance'), [ 'required', 'id' => "balance", 'class' => 'form-control '.($errors->has( 'balance') ? ' error':''), 'placeholder' => 'الرصيد']) }}
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-2 mb-2">
                                <label for="balance">. </label>
                                <div class="form-group">
                                    <div class="input-group">
                                        {{ Form::submit('اضف', [ 'required', 'id' => "balance", 'class' => 'btn btn-gradient-primary form-control']) }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    {{ form::close() }}<!--end form-->
                    </div><!--end card-body-->
            </div><!--end card-->
        </div><!--end col-->
    </div><!--end row-->

    <div class="modal fade" id="add_bank" tabindex="-1" role="dialog" aria-labelledby="clients-noLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title mt-0" id="clients-noLabel">اسماء عملاء المندوب <span id="representative"></span></h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body print">
                    <div class="table-responsive">
                        {{ Form::open([ 'class' => 'card-box', 'id' => 'add_bank_form']) }}
                        {{  Form::token() }}
                        <div class="form-group">
                            {{ form::label('bank_name', 'اسم البنك') }}
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="far fa-user"></i></span>
                                </div>
                                {{ Form::text('bank_name', NULL, [ 'required', 'id' => 'bank_name', 'class' => 'form-control ', 'placeholder' => 'اسم البنك']) }}
                            </div>
                        </div>
                        <div class="form-group">
                            <input type="button" class="btn btn-gradient-success form-control" id="add" value="اضف" />
                        </div>
                    {{ form::close() }}<!--end form-->
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(function (){
            $("#add").click(function( event ) {
                let bank_name = $('#bank_name').val();
                $('#name').append('<option value="'+bank_name+'">'+bank_name+'</option>');
                event.preventDefault();
                $('#add_bank').modal('toggle');
            });
        })
    </script>

@endsection
