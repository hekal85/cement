@extends('layouts.manufactories')
@section('title', 'إضافة نوع مصروف جديد')
@section('content')
    <div class="row d-flex justify-content-center">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-body">
                    <h4 class="mt-0 header-title">نموذج إضافة نوع مصروف جديد</h4>

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    {{ Form::open(['route' => 'expenseType.store', 'class' => 'card-box', 'enctype' => 'multipart/form-data']) }}
                    {{  Form::token() }}

                    <div class="form-group">
                        {{ form::label('name', 'نوع المصروف') }}
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="far fa-user"></i></span>
                            </div>
                            {{ Form::text('name', old('name'), [ 'required', 'id' => "name", 'class' => 'form-control '.($errors->has( 'name') ? ' error':''), 'placeholder' => 'نوع المصروف']) }}
                        </div>
                    </div>
                    <div class="form-group">
                        <input type="submit" class="btn btn-gradient-success form-control" value="اضف" />
                    </div>
                {{ form::close() }}<!--end form-->
                </div><!--end card-body-->
            </div><!--end card-->
        </div><!--end col-->
    </div><!--end row-->
@endsection
