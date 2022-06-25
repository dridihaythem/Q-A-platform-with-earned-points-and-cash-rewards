<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Withdraw\UpdateWithdrawRequest;
use App\Models\WithdrawRequest;
use App\Services\PointService;
use Illuminate\Http\Request;

class WithdrawRequestController extends Controller
{
    public function __construct(private PointService $pointService)
    {
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $requests = WithdrawRequest::with('user', 'paymentMethod')->get();

        return view('admin.withdraws.index', ['requests' => $requests]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\WithdrawRequest  $withdrawRequest
     * @return \Illuminate\Http\Response
     */
    public function edit(WithdrawRequest $withdraw)
    {
        return view('admin.withdraws.edit', ['request' => $withdraw]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\WithdrawRequest  $withdrawRequest
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateWithdrawRequest $request, WithdrawRequest $withdraw)
    {
        $withdraw->update($request->validated());

        return redirect()->back()->with('success', 'تم التحديث بنجاح');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\WithdrawRequest  $withdrawRequest
     * @return \Illuminate\Http\Response
     */
    public function destroy(WithdrawRequest $withdraw)
    {
        $withdraw->update(['status' => 'rejected']);

        $withdraw->user()->increment('points', $this->pointService->convertToPoint($withdraw->amount));

        return redirect()->back()->with('success', 'تم رفض عملية السحب');
    }
}
