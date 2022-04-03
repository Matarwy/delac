<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Rules\JSONValidate;
use App\Models\WebLanguage;
use Illuminate\Http\Request;

use Gate;
use Symfony\Component\HttpFoundation\Response;

class WebLanguageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        abort_if(Gate::denies('lang_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $lang = WebLanguage::all();
        return view('admin.lang.index', compact('lang'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        abort_if(Gate::denies('lang_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.lang.create');
    }
    public function downloadBaseFile($lang)
    {
        try {
            $lang = $lang . '.json';
            $file = base_path('resources/lang/' . $lang);
            $headers = array(
                'Content-Type: application/json',
            );

            return  response()->download($file, $lang, $headers);
        } catch (\Throwable $th) {
            //throw $th;
            return back();
        }
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'language_file' => ['bail', 'required', 'file', new JSONValidate],
            'name' => 'bail|required|unique:web_language',
            'short_name' => 'bail|required|unique:web_language|min:2|max:2'
        ]);

        if ($request->hasFile('language_file')) {
            $file = $request->file('language_file');
            $name = $request->short_name . '.' . $file->getClientOriginalExtension();
            $destinationPath = resource_path('/lang');
            $file->move($destinationPath, $name);
        }
        $reqData = $request->all();
        $reqData['is_rtl'] = $request->has('is_rtl') ? 1 : 0;

        WebLanguage::create($reqData);
        return redirect()->route('web-language.index')->withStatus(__('Language is added successfully.'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Language  $language
     * @return \Illuminate\Http\Response
     */
    public function show(WebLanguage $language)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Language  $language
     * @return \Illuminate\Http\Response
     */
    public function edit(WebLanguage $WebLanguage)
    {
        //
        abort_if(Gate::denies('lang_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $path = base_path('resources/lang/' . $WebLanguage->short_name . '.json');
        $data = file_get_contents($path);
        $results = array();
        $lang = (array) json_decode($data);
        $language =   $WebLanguage;
        return view('admin.lang.edit', compact('language', 'lang'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Language  $language
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, WebLanguage $WebLanguage)
    {
        //
        if ($request->has('short_name')) {
            $request->validate([
                'language_file' => ['bail', 'required', 'file', new JSONValidate],
            ]);
            $reqData = $request->all();

            $reqData['is_rtl'] = $request->has('is_rtl') ? 1 : 0;

            if ($request->hasFile('language_file')) {
                $file = $request->file('language_file');
                $name = $request->short_name . '.' . $file->getClientOriginalExtension();
                $destinationPath = resource_path('/lang');
                $file->move($destinationPath, $name);
            }
            $WebLanguage->update($reqData);
            return redirect()->route('web-language.index')->withStatus(__('Language is added successfully.'));
        }
        $d =  $request->all();
        $result = array();
        foreach ($d as $obj => $key) {
            $obj = str_replace('_', ' ', $obj);
            if ($obj !== ' token' &&  $obj !== ' method') {
                $result[$obj] = $key;
            }
        }
        $path = base_path('resources/lang/' . $WebLanguage->short_name . '.json');
        $d =  (object) $result;
        $newJsonString = json_encode($d, JSON_UNESCAPED_UNICODE);
        $fp = fopen($path, 'w');
        fwrite($fp, stripslashes($newJsonString));
        fclose($fp);
        $data = file_get_contents($path);
        return redirect()->route('web-language.index')->withStatus(__('language is updated successfully.'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Language  $language
     * @return \Illuminate\Http\Response
     */
    public function destroy(WebLanguage $WebLanguage)
    {
        //
        abort_if(Gate::denies('lang_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $WebLanguage->delete();

        return back()->withStatus(__('Language is deleted successfully.'));
    }
}
