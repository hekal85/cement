@extends('layouts.manufactories')
@section('title', 'البنوك')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        @if(session()->get('process'))
                            <div class="alert alert-success col-12" id="notice">
                                <span class="text-primary">{{ session()->get('process') }}</span>
                                <span class="text-danger">{{ session()->get('name') }}</span>
                            </div>
                        @endif
                    </div>

                    <h3 class="text-center py-2 bg-black text-white">مشاهدة الحسابات والبنوك</h3>

                    <h4 class="mt-0 header-title">
                        <a href="{{ route('bank.create') }}"  class="btn  btn-warning">إضافة حساب جديد</a>
                    </h4>
                    <table
                        class="table table-striped table-bordered dt-responsive nowrap hekal_table"
                        style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                        <thead>
                        <tr>
                            <th>م</th>
                            <th>الشركة</th>
                            <th>اسم البنك</th>
                            <th>رقم الحساب</th>
                            <th>الرصيد</th>
                            <th>تحكم</th>
                        </tr>
                        </thead>
                        <tbody>
                        @php($n=0)
                            @foreach($banks as $bank)
                            <tr>
                                <td>{{ ++$n }}</td>
                                <td>{{ $bank->Company->name }}</td>
                                <td>{{ $bank->name }}</td>
                                <td>{{ $bank->account }}</td>
                                <td>{{ $bank->balance }}</td>
                                <td>
                                    <form action="{{ route('bank.destroy',$bank->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <a class="text-success" href="{{ route('bank.show',$bank->id) }}">
                                            <i class="fas fa-user-eye p-1"></i>
                                        </a>
                                        <a class="text-warning" href="{{ route('bank.edit',$bank->id) }}">
                                            <i class="fas fa-user-edit p-1"></i>
                                        </a>
                                        <button type="submit" class="btn">
                                            <i class="fas fa-user-alt-slash text-danger p-1"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div> <!-- end col -->
    </div> <!-- end row -->
@endsection
