<?php


namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\NotificationController;
use App\Models\Instructor;
use App\Models\Payout;
use Illuminate\Http\Request;
use Gate;
use Symfony\Component\HttpFoundation\Response;
class PayoutController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        abort_if(Gate::denies('payout_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $payouts = Payout::with('instructor')->orderBy('status', 'asc')->get();
        return view('admin.instructors.payout', compact('payouts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Payout  $payout
     * @return \Illuminate\Http\Response
     */
    public function show(Payout $payout)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Payout  $payout
     * @return \Illuminate\Http\Response
     */
    public function edit(Payout $payout)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Payout  $payout
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Payout $payout)
    {
        //
        $payout->update($request->all());
        if ($request->status == 2) {
            Instructor::find($payout->instructor_id)->increment('balance', $payout->amount);
        }

        $ids['i_id'] = $payout->instructor_id;
        $ids['amount'] = $payout->amount;
        $ids['remark'] = $payout->remark;
        $ids['status'] = $payout->status == 1 ? "Paid" : "Reject";

        $res =  (new NotificationController)->sendNotification($ids, 4);




        return redirect()->route('payout.index')->withStatus(__('Payout is updated successfully.'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Payout  $payout
     * @return \Illuminate\Http\Response
     */
    public function destroy(Payout $payout)
    {
        //
    }
}
