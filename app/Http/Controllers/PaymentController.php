<?php

namespace App\Http\Controllers;

use App\Models\Bill;
use App\Models\Semester;
use App\Models\Payment;
use App\Models\StudentDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PaymentController extends Controller
{
    public function index()
    {
        $bills = Bill::get();
        $semesters = Semester::get();

        return view('payment.index', compact('bills', 'semesters'));
    }

    public function search(Request $request)
    {
        $student = StudentDetail::with(['user', 'grade' => function ($query) use ($request) {
            $query->with('major');
        }])->where('nim', $request->nim)->first();
        $payment = Payment::where('student_detail_id', $student->id)->get();

        return response()->json([
            'student' => $student,
            'payment' => $payment,
        ], 200);
    }

    public function store(Request $request)
    {
        $semester = Semester::findOrFail($request->semester);
        $bill = Bill::findOrFail($request->bill);
        $detail = StudentDetail::with('user')->where('nim', $request->nim)->first();
        $payment = Payment::where('student_detail_id', $detail->id)->where('bill_id', $request->bill)->where('semester_id', $request->semester)->first();

        if ($payment) {
            return redirect(route('payment.index'))->with('danger', "Mahasiswa telah membayar UKT pada bulan $semester->name $bill->years");
        } elseif ($request->haspay < $bill->price) {
            return redirect(route('payment.index'))->with('danger', 'Mahasiswa harus membayar minimal seperti yang ditagihkan');
        }

        DB::beginTransaction();
        try {
            Payment::create([
                'user_id' => Auth::id(),
                'student_detail_id' => $detail->id,
                'bill_id' => $bill->id,
                'semester_id' => $semester->id,
            ]);

            DB::commit();
            return redirect(route('payment.index'))->with('success', "Berhasil melakukan pembayaran!");
        } catch (\Exception $e) {
            DB::rollback();
            return redirect(route('payment.index'))->with('danger', "Gagal melakukan pembayaran!");
        }
    }
}
