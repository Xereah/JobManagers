@extends('layouts.admin')
@section('content')
<div class="card-header bg-dark col-md-6 mx-auto">
        {{ trans('global.create') }} UPS
    </div>
<div class="card col-md-6 mx-auto">
    <div class="card-body">
    <form action="{{ url('/inventory/ups/add') }}" method="POST" enctype="multipart/form-data">

@csrf

<div class="form-row">
    <div class="form-group col-md-6">
        <label for="shortcode">Marka*</label>
        <input type="text" name="mark" class="form-control">
    </div>
    <div class="form-group col-md-6">
        <label for="model">Model*</label>
        <input type="text" name="model" class="form-control">
    </div>
</div>

<div class="form-row">
    <div class="form-group col-md-6">
        <label for="serial_number">Numer seryjny</label>
        <input type="text" name="serial_number" class="form-control">
    </div>
    <div class="form-group col-md-6">
        <label for="fk_company">Kontrahent*</label>
        <select name="fk_company" id="fk_company" class="form-control select2" required>
            <option value=""></option>
            @foreach($companies as $company)
            <option value="{{ $company->id }}">{{ $company -> shortcode }}</option>
            @endforeach

        </select>
    </div>
</div>

<input class="btn btn-success float-right" type="submit" value="{{ trans('global.save') }}">

</form>


    </div>
</div>
@endsection
@section('scripts')

@parent
@endsection