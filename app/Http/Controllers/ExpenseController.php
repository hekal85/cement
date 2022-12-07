<?php

namespace App\Http\Controllers;

use App\Models\ExpenseType;
use App\Models\InvoiceType;
use App\Models\Expense;
use App\Models\Invoice;
use App\Models\InvoiceDetails;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ExpenseController extends Controller
{
    public function index()
    {
        $expenses = Expense::take(100)->orderBy('id', 'DESC')->get();
        return view('expenses.index', compact('expenses'));
    }

    public function create()
    {
        $expense_types = ExpenseType::orderBy('name')->pluck('name', 'id');
        return view('expenses.create', compact('expense_types'));
    }

    public function store(Request $request)
    {
        $expense = $request->validate([
            'expense_type_id' => 'required | integer | min:1',
            'paid' => 'required | integer | min:1 | max: 999999',
            'person_id' => 'nullable',
        ]);
        Expense::create($expense);
        return redirect()->route('expense.index')->with(['process' => 'تم إثبات المصروف بمبلغ', 'name' => $request->paid]);
    }

    public function show(Expense $expense)
    {
        dd($expense);
    }

    public function edit(Expense $expense)
    {
        $expense_types = ExpenseType::orderBy('name')->pluck('name', 'id');
        return view('expenses.edit', compact('expense', 'expense_types'));
    }

    public function update(Request $request, Expense $expense)
    {
        $request->validate([
            'expense_type_id' => 'required | integer | min:1',
            'paid' => 'required | integer | min:1 | max: 999999',
            'person_id' => 'nullable',
        ]);
        $expense->update($request->all());
        return redirect()->route('expense.index')->with(['process' => 'تم تعديل بيانات نوع المصروف', 'name' => $request->name]);
    }

    public function destroy(Expense $expense)
    {
        $expense->delete();
        return redirect()->route('expense.index')->with(['process' => 'تم حذف المصروف']);
    }

    public function expense_by_period(Expense $expense)
    {
        $expenses = Expense::all()->sortByDesc('id')->take(50);
        $expense_types = ExpenseType::orderBy('name')->pluck('name', 'id');
        return view('expenses.expense_by_period', compact('expenses', 'expense_types'));
    }

    public function expense_between_dates(Expense $expense)
    {
        $expense = date($_GET['expense']);

        if ($_GET['to'] >= $_GET['from']) {
            $from = date($_GET['from']);
            $to = date($_GET['to']);
        } else {
            $from = date($_GET['to']);
            $to = date($_GET['from']);
        }

        // $from = Carbon::parse($from)->startOfDay();
        // $to= Carbon::parse($to)->endOfDay();

        $expenses = Expense::whereBetween('created_at', [$from.' 00:00:00', $to.' 23:59:59'])
                    ->where('expense_type_id', $expense)->orderByDesc('id')->get();

        $processes = $expenses->count();;
        $data = '';
        $n = 0;
        $data .= "<tr>";
        $total = 0;
        foreach ($expenses as $expense):
            $total += $expense->paid;
            $data .= "
                <td>".++$n."</td>
                <td>".$expense->expenseType->name."</td>
                <td>$expense->paid</td>
                <td>$expense->created_at</td>";
            $data .= ($n % 2 == 0) ? '</tr><tr>': '';
        endforeach;
        $result = ['data' => $data, 'total' => $total, 'processes' => $processes];
        return $result;
    }
    /*
        public function follow_up_expenses()
        {
            $expense_types = InvoiceDetails::orderBy('name')->pluck('name', 'id');
            return view('expenses.follow_up_expenses', compact('expense_types'));
        }

        public function fetch_follow_up_expenses()
        {
            $expense = date($_GET['expense']);
            $expenses = Invoice::where('invoice_type_id', $expense)->orderByDesc('id')->get();
            $data = '';
            $n = 0;
            $data .= "<tr>";
            foreach ($expenses as $expense):
                $data .= "
                    <td>".++$n."</td>
                    <td>$expense->paid</td>
                    <td>$expense->created_at</td>";
                $data .= ($n % 4 == 0) ? '</tr><tr>': '';
            endforeach;
            $result = ['data' => $data, 'total' => $n];
            return $result;
        }
    */
}
