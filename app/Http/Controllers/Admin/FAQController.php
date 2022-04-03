<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AdminSetting;
use App\Models\FAQ;
use Illuminate\Http\Request;
use Gate;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;
use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Facades\JsonLdMulti;
use Artesaos\SEOTools\Facades\SEOTools;

class FAQController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        abort_if(Gate::denies('faq_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $faqs = FAQ::get();
        return view('admin.faqs.index', compact('faqs'));
    }

    public function faqHelp(Request $request)
    {
        $seo = AdminSetting::whereIn('id', [28, 29, 30, 31, 32])->get();

        JsonLdMulti::setTitle('Help - ' . env('APP_NAME') ?? env('APP_NAME'));
        SEOTools::twitter()->setTitle('Help - ' . env('APP_NAME') ?? env('APP_NAME'));
        SEOMeta::setTitle('Help - ' . env('APP_NAME') ?? env('APP_NAME'));
        SEOTools::setTitle('Help - ' . env('APP_NAME') ?? env('APP_NAME'));

        JsonLdMulti::setDescription($seo[1]['value'] ?? null);
        SEOMeta::setDescription($seo[1]['value'] ?? null);
        SEOTools::setDescription($seo[1]['value'] ?? null);

        SEOMeta::addKeyword($seo[2]['value'] ?? null);
        SEOTools::opengraph()->addProperty('keywords', $seo[2]['value'] ?? null);

        JsonLdMulti::addImage(asset('frontend/images/seoimage.png'));
        SEOTools::opengraph()->addProperty('image', asset('frontend/images/logo.svg'));
        SEOTools::jsonLd()->addImage(asset('frontend/images/seoimage.png'));

        $q = $request->q ?? "";

        $master['ins'] = FAQ::where([['faq_for', 1], ['question', 'LIKE', '%' . $q . '%']])->latest()->get();
        $master['stu'] = FAQ::where([['faq_for', 1], ['question', 'LIKE', '%' . $q . '%']])->latest()->get();
        return view('frontend.student.help.faq', compact('master', 'q'));
    }
    public function notification()
    {
        $noti = Auth::user()->notifications;
        return view('frontend.student.help.notification', compact('noti'));
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
        abort_if(Gate::denies('faq_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $request->validate([
            'question' => 'bail|required|max:255|min:2',
            'ans' => 'bail|required|max:500|min:2',

        ]);
        $d = FAQ::create($request->all());

        return redirect()->route('faqs.index')->withStatus(__('FAQ is added successfully.'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\FAQ  $fAQ
     * @return \Illuminate\Http\Response
     */
    public function show(FAQ $fAQ)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\FAQ  $fAQ
     * @return \Illuminate\Http\Response
     */
    public function edit(FAQ $faq)
    {
        //
        abort_if(Gate::denies('faq_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $faqs = FAQ::get();

        return view('admin.faqs.index', compact('faqs', 'faq',));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\FAQ  $fAQ
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, FAQ $faq)
    {
        //
        abort_if(Gate::denies('faq_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $request->validate([
            'question' => 'bail|required|max:255|min:2',
            'ans' => 'bail|required|max:500|min:2',

        ]);
        $faq->update($request->all());
        return redirect()->route('faqs.index')->withStatus(__('FAQ is updated successfully.'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\FAQ  $fAQ
     * @return \Illuminate\Http\Response
     */
    public function destroy(FAQ $faq)
    {
        //
        abort_if(Gate::denies('faq_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $faq->delete();

        return back()->withStatus(__('FAQ is deleted successfully.'));
    }
}
