<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Models\EmailTemplate;
use Illuminate\Http\Request;

class EmailTemplateController extends Controller
{
    //

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($slug = '')
    {

        $breadcrumbs = [
            ['link' => url("/panel"), 'name' => 'Dashboard'],
            ['link' => url("/templates/email/".$slug), 'name' => 'template'],
            ['name' => __('template')],
        ];
         $data['value'] = $slug ? EmailTemplate::where('slug', $slug)->first() : EmailTemplate::first();
        if (!$data['value']) {
            return back()->with('error', 'Email Template not found');
        }
        $data['rows'] = EmailTemplate::get();

        return view('template.temp-editor', $data,compact('breadcrumbs'));
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
     * @param  \App\Http\Requests\StoreEmailTemplateRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        dd($request);
        $temp = EmailTemplate::where('slug', $request->slug)->first();
        if ($temp) {
            return back()->with('error', 'Slug already exists');
        }
        EmailTemplate::create($request->only('name', 'slug') + ['value' => 'NULL']);

        return back()->with('success', 'Email Template Created Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\EmailTemplate  $emailTemplate
     * @return \Illuminate\Http\Response
     */
    public function show(EmailTemplate $emailTemplate)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\EmailTemplate  $emailTemplate
     * @return \Illuminate\Http\Response
     */
    public function edit(EmailTemplate $emailTemplate)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateEmailTemplateRequest  $request
     * @param  \App\Models\EmailTemplate  $emailTemplate
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $slug)
    {


        // $slug = \Request::segment(2);
        $temp = EmailTemplate::where('slug', $slug)->first();
        $temp->value = $request->area;
        $save = $temp->save();
        if ($save) {
            return redirect()->back()->with('success', 'Updated successfully');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\EmailTemplate  $emailTemplate
     * @return \Illuminate\Http\Response
     */
    public function destroy(EmailTemplate $emailTemplate)
    {
        //
    }
}
