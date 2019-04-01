<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function manage()
    {
        return view('transaction.manage', ['title' => 'Tất cả giao dịch']);
    }


}
