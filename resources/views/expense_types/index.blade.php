@extends('layouts.manufactories')
@section('title', 'صفحة أنواع المصروفات')
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

                    <h3 class="text-center py-2 bg-black text-white">مشاهدة أنواع المصروفات</h3>

                    <h4 class="mt-0 header-title">
                        <a href="{{ route('expenseType.create') }}"  class="btn  btn-warning">إضافة نوع مصروف جديد</a>
                    </h4>
                    <table
                        class="table table-striped table-bordered dt-responsive nowrap hekal_table"
                        style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                        <thead>
                        <tr>
                            @for($x=0; $x<3; $x++)
                                <th>م</th>
                                <th>نوع المصروف</th>
                                <th>تحكم</th>
                            @endfor
                        </tr>
                        </thead>
                        <tbody>
                        @php($n=0)
                        <tr>
                            @foreach($expense_types as $type)
                                <td>{{ ++$n }}</td>
                                <td>{{ $type->name }}</td>
                                <td>
                                    <form action="{{ route('expenseType.destroy',$type->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <a class="text-warning" href="{{ route('expenseType.edit',$type->id) }}"><i class="fas fa-user-edit p-1"></i></a>
                                        <button type="submit" class="btn"><i class="fas fa-user-alt-slash text-danger p-1"></i></button>
                                    </form>
                                </td>

                                @if($n % 3 == 0) </tr><tr> @endif
                            @endforeach
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div> <!-- end col -->
    </div> <!-- end row -->
@endsection
