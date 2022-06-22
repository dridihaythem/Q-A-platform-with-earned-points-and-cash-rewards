<?php

namespace App\Http\Controllers;

use App\Http\Requests\Withdraw\CreateWithdrawRequest;
use App\Models\PaymentMethod;
use App\Models\WithdrawRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WithdrawRequestController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $requests = Auth::user()->withdrawRequests()
            ->with('paymentMethod')
            ->orderBy('id', 'desc')
            ->get();
        return view('withdraw.index', ['requests' => $requests]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $methods = PaymentMethod::all();
        return view('withdraw.create', ['methods' => $methods]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateWithdrawRequest $request)
    {
        $data =  $request->validated();

        Auth::user()->withdrawRequests()->create($data);

        Auth::user()->decrement('balance', $request->amount);

        return redirect()->route('withdraw.index')
            ->with('success', 'تم إظافة طلب السحب بنجاح ، ستتم معالجته في أقرب وقت ممكن');
    }
}
