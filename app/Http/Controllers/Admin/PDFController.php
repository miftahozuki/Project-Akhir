<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use PDF;
use Illuminate\Http\Request;

class PDFController extends Controller
{
    public function index()
    {
        $data = [
            'date' => date('Y'),
        ];

        $pdf = PDF::loadView('admin.pdf.report', $data);
        return $pdf->download('Report-' . $data['date'] . '.pdf');
    }
}
