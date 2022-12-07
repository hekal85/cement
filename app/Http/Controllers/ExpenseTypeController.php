<?php

namespace App\Http\Controllers;

use App\Models\ExpenseType;
use Illuminate\Http\Request;
use App\Models\InvoiceType;
//use phpDocumentor\Reflection\Exception\PcreException;
//use Illuminate\Support\Facades\DB;

class ExpenseTypeController extends Controller
{
    public function index()
    {
        $expense_types = ExpenseType::orderBy('name')->get();
        return view('expense_types.index', compact('expense_types'));
      }

    public function create()
    {
        return view('expense_types.create');
    }

    public function store(Request $request)
    {
        ExpenseType::create($request->validate(['name' => 'required | min:2']));
        return redirect()->route('expenseType.index')->with(['process' => 'تم تعديل بيانات نوع المصروف', 'name' => $request->name]);
    }

    public function show(ExpenseType $expenseType)
    {
        //
    }

    public function edit(ExpenseType $expenseType)
    {
        return view('expense_types.edit', compact('expenseType'));
    }

    public function update(Request $request, ExpenseType $expenseType)
    {
        $expenseType->update($request->validate(['name' => 'required | min:2']));
        return redirect()->route('expenseType.index')->with(['process' => 'تم تعديل بيانات نوع المصروف', 'name' => $request->name]);
    }

    public function destroy(ExpenseType $expenseType)
    {
        $name = $expenseType->name;
        $expenseType->delete();
        return redirect()->route('expenseType.index')->with(['process' => 'تم حذف نوع المصروف', 'name' => $name]);
    }
}
