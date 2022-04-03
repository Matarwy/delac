<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;


use App\Models\NotiTemplate;
use Illuminate\Http\Request;
use Gate;
use Symfony\Component\HttpFoundation\Response;
class NotiTemplateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        abort_if(Gate::denies('notification_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        
        $notis =  NotiTemplate::all();
        return view('admin.notitemp.index', compact('notis'));
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
     * @param  \App\Models\NotiTemplate  $notiTemplate
     * @return \Illuminate\Http\Response
     */
    public function show(NotiTemplate $notiTemplate)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\NotiTemplate  $notiTemplate
     * @return \Illuminate\Http\Response
     */
    public function edit(NotiTemplate $notiTemplate)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\NotiTemplate  $notiTemplate
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, NotiTemplate $notiTemplate)
    {
        abort_if(Gate::denies('notification_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        //
        $notiTemplate->update($request->all());
        return back()->withStatus(__('template is updated successfully.'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\NotiTemplate  $notiTemplate
     * @return \Illuminate\Http\Response
     */
    public function destroy(NotiTemplate $notiTemplate)
    {
        //
    }
}
