<?php

namespace App\Http\Controllers\Instructor;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\SpecialDiscount;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SpecialDiscountController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        $reqData = $request->all();
        $reqData['instructor_id'] = Auth::id();
        SpecialDiscount::create($reqData);
        return redirect()->route('courses.index')->withStatus(__('Discount is added successfully.'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SpecialDiscount  $specialDiscount
     * @return \Illuminate\Http\Response
     */
    public function show(SpecialDiscount $specialDiscount)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SpecialDiscount  $specialDiscount
     * @return \Illuminate\Http\Response
     */
    public function edit(SpecialDiscount $specialDiscount)
    {
        //
        $active = Course::withCount('content')->with('category:id,name')->where([['instructor_id', Auth::id()], ['status', 1]])->get();

        return view('frontend.instructor.discount.edit', compact('specialDiscount', 'active'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\SpecialDiscount  $specialDiscount
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SpecialDiscount $specialDiscount)
    {
        //
        $specialDiscount->update($request->all());
        return redirect()->route('courses.index')->withStatus(__('Discount is updated successfully.'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SpecialDiscount  $specialDiscount
     * @return \Illuminate\Http\Response
     */
    public function destroy(SpecialDiscount $specialDiscount)
    {
        //
        $specialDiscount->delete();
        return redirect()->route('courses.index')->withStatus(__('Discount is deleted successfully.'));
    }
}
