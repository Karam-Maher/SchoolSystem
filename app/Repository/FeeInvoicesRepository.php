<?php


namespace App\Repository;


use App\Models\Fee;
use App\Models\FeeInvoice;
use App\Models\Grade;
use App\Models\Student;
use App\Models\StudentAccount;
use Illuminate\Support\Facades\DB;

class FeeInvoicesRepository implements FeeInvoicesRepositoryInterface
{

    public function index()
    {
        $fee_invoices = FeeInvoice::all();
        $grades = Grade::all();
        return view('dashboard.fees_invoices.index', compact('fee_invoices', 'grades'));
    }

    public function show($id)
    {
        $student = Student::findOrFail($id);
        $fees = Fee::where('classroom_id', $student->classroom_id)->get();
        return view('dashboard.fees_invoices.create', compact('student', 'fees'));
    }

    public function store($request)
    {
        $list_fees = $request->list_fees;

        DB::beginTransaction();

        try {
            foreach ($list_fees as $list_fee) {
                // حفظ البيانات في جدول فواتير الرسوم الدراسية
                $Fees = new FeeInvoice();
                $Fees->invoice_date = date('Y-m-d');
                $Fees->student_id = $list_fee['student_id'];
                $Fees->grade_id = $request->grade_id;
                $Fees->classroom_id = $request->classroom_id;;
                $Fees->fee_id = $list_fee['fee_id'];
                $Fees->amount = $list_fee['amount'];
                $Fees->description = $list_fee['description'];
                $Fees->save();
                // حفظ البيانات في جدول حسابات الطلاب
                $StudentAccount = new StudentAccount();
                $StudentAccount->date = date('Y-m-d');
                $StudentAccount->type = 'invoice';
                $StudentAccount->fee_invoice_id = $Fees->id;
                $StudentAccount->student_id = $list_fee['student_id'];
                $StudentAccount->grade_id = $request->grade_id;
                $StudentAccount->classroom_id = $request->classroom_id;
                $StudentAccount->debit = $list_fee['amount']; //مدين
                $StudentAccount->credit = 0.00; //داين
                $StudentAccount->description = $list_fee['description'];
                $StudentAccount->save();
            }

            DB::commit();
            toastr()->success(trans('messages.success'));
            return redirect()->route('feesinvoice.index');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function edit($id)
    {
        $fee_invoices = FeeInvoice::findOrFail($id);
        $fees = Fee::where('classroom_id', $fee_invoices->classroom_id)->get();
        return view('dashboard.fees_invoices.edit', compact('fee_invoices', 'fees'));
    }

    public function update($request)
    {
        DB::beginTransaction();
        try {
            // تعديل البيانات في جدول فواتير الرسوم الدراسية
            $Fees = FeeInvoice::findOrFail($request->id);
            $Fees->fee_id = $request->fee_id;
            $Fees->amount = $request->amount;
            $Fees->description = $request->description;
            $Fees->save();

            // تعديل البيانات في جدول حسابات الطلاب
            $StudentAccount = StudentAccount::where('fee_invoice_id', $request->id)->first();
            $StudentAccount->debit = $request->amount;
            $StudentAccount->description = $request->description;
            $StudentAccount->save();
            DB::commit();

            toastr()->success(trans('messages.update'));
            return redirect()->route('feesinvoice.index');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function destroy($request)
    {
        try {
            FeeInvoice::destroy($request->id);
            toastr()->error(trans('messages.delete'));
            return redirect()->back();
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
}
