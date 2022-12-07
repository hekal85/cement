@extends('layouts.manufactories')
@section('title', 'تعديل: '.$expenseType->name)
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

                    {{ Form::open(['route' => ['expenseType.update', $expenseType->id], 'method' => 'PUT', 'class' => 'card-box', 'enctype' => 'multipart/form-data']) }}
                    {{ Form::token() }}
                        <div class="form-group">
                            {{ form::label('name', 'نوع المصروف') }}
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="far fa-user"></i></span>
                                </div>
                                {{ Form::text('name', @$expenseType->name? $expenseType->name:old('name'), [ 'required', 'id' => "name", 'class' => 'form-control '.($errors->has( 'name') ? ' error':''), 'placeholder' => 'نوع المصروف']) }}
                            </div>
                        </div>
                        <div class="form-group">
                            <input type="submit" class="btn btn-gradient-warning form-control" value="عدل" />
                        </div>
                    {{ form::close() }}<!--end form-->
                </div><!--end card-body-->
            </div><!--end card-->
        </div><!--end col-->

    </div><!--end row-->
@endsection
