<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HistoryController extends Controller
{
    public function index()
    {
        $histories = Payment::with(['bill', 'semester', 'detail'])->orderBy('created_at', 'desc')->paginate(10);
        if (Auth::user()->role == 'siswa') {
            $histories = Payment::with(['bill', 'semester'])->where('student_detail_id', Auth::user()->detail->id)->orderBy('created_at', 'desc')->paginate(10);
        }

        return view('payment.history', compact('histories'));
    }
}
