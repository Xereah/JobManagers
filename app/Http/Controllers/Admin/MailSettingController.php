<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Mailsetting;
use Symfony\Component\HttpFoundation\Response;
use Gate;
class MailSettingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        abort_if(Gate::denies('mail_config_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $mail= Mailsetting::find(1);

        return view('admin.settings.mail',['mail'=>$mail]);
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        abort_if(Gate::denies('mail_config_update'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        // dd($mailsetting);
        // $mailsetting->create($request->all());

        $mailsetting = Mailsetting::find(1);
        $mailsetting->mail_transport = $request->mail_transport;
        $mailsetting->mail_host = $request->mail_host;
        $mailsetting->mail_port = $request->mail_port;
        $mailsetting->mail_username = $request->mail_username;
        $mailsetting->mail_password = $request->mail_password;
        $mailsetting->mail_encryption = $request->mail_encryption;
        $mailsetting->mail_from = $request->mail_from;
        $mailsetting->save();

        return redirect()->back()->withSuccess('Mail updated !!!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
