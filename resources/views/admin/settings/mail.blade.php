@extends('layouts.admin')
@section('content')
<div class="card-header col-md-6 mx-auto bg-dark">
    Edycja Maila
</div>
<div class="card col-md-6 mx-auto">
        <div class="container py-4">
        <form action="{{ url('/configuration/mail/update') }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('POST')
            <div class="row">
                <div class="form-group col-md-6">
                    <label for="comments">Mail Transport</label>
                    <input type="text" class="form-control" type="text" name="mail_transport"
                        value="{{ old('mail_transport',$mail->mail_transport) }}"></input>
                </div>
                <div class="form-group col-md-6">
                    <label for="comments"> Mail Host</label>
                    <input id="mail_host" class="form-control" type="text" name="mail_host"
                        value="{{ old('mail_host',$mail->mail_host) }}"></input>
                </div>
            </div>

            <div class="row">
                <div class="form-group col-md-6">
                    <label for="comments">Mail Port</label>
                    <input type="text" class="form-control" type="text" name="mail_port"
                        value="{{ old('mail_port',$mail->mail_port) }}"></input>
                </div>
                <div class="form-group col-md-6">
                    <label for="comments"> Mail Encryption</label>
                    <input id="mail_encryption" class="form-control" type="text" name="mail_encryption"
                        value="{{ old('mail_encryption',$mail->mail_encryption) }}"></input>
                </div>
            </div>

            <div class="row">
            <div class="form-group col-md-6">
                    <label for="comments"> Mail Użytkownik</label>
                    <input id="mail_username" class="form-control" type="text" name="mail_username"
                        value="{{ old('mail_username',$mail->mail_username) }}"></input>
                </div>
                <div class="form-group col-md-6">
                    <label for="comments"> Mail Password</label>
                    <input type="password" class="form-control" type="text" name="mail_password"
                    value="{{ old('mail_password',$mail->mail_password) }}">
                    </input>
                </div>
             
            </div>

            <div class="row">
                <div class="form-group col-md-6">
                    <label for="comments"> Mail From</label>
                    <input type="text" class="form-control" type="text" name="mail_from"
                        value="{{ old('mail_from',$mail->mail_from) }}"></input>
                </div>
            </div>
            <div class="text-right mt-16">
                <button type="submit" class="btn btn-success float-right">Update</button>
            </div>
            </form>
        </div>
</div>
@endsection
@section('scripts')

@parent

@endsection