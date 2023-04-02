@extends('layouts.admin')
@section('content')
<div class="card-header bg-dark col-md-6 mx-auto">
    {{ trans('global.create') }} komputer
</div>
<div class="card col-md-6 mx-auto">
    <div class="card-body">
        <form action="{{ url('/inventory/komputery/add') }}" method="POST" enctype="multipart/form-data">

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
                    <label for="processor">Procesor*</label>
                    <input type="text" name="processor" class="form-control">
                </div>
                <div class="form-group col-md-6">
                    <label for="ram">Ram*</label>
                    <input type="text" name="ram" class="form-control">
                </div>
            </div>


            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="hard_drive">Dysk Twardy*</label><br>
                    <label>
                        <input type="radio" name="hard_drive" value="SSD"> SSD
                    </label>
                    <label>
                        <input type="radio" name="hard_drive" value="HDD"> HDD
                    </label>
                </div>
                <div class="form-group col-md-6">
                    <label for="hard_drive_capacity">Pojemność*</label><br>
                    <label>
                        <input type="radio" name="hard_drive_capacity" value="128"> 128GB
                    </label>
                    <label>
                        <input type="radio" name="hard_drive_capacity" value="256"> 256GB
                    </label>
                    <label>
                        <input type="radio" name="hard_drive_capacity" value="512"> 512GB
                    </label>
                    <label>
                        <input type="radio" name="hard_drive_capacity" value="1"> 1TB
                    </label>
                    <label>
                        <input type="radio" name="hard_drive_capacity" value="2"> 2TB
                    </label>
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
                            <option  value="{{ $company->id }}">{{ $company -> shortcode }}</option>                        
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