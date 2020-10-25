<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use Illuminate\Http\Request;

class PaySuccessController extends Controller
{
    public function getPaySuccess()
    {

        return view('frontend.pages.shopping.paysuccess');
    }
}
