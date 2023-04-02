@extends('layouts.admin')
@section('content')
<div class="card-header bg-dark col-md-6 mx-auto">
    {{ trans('global.edit') }} {{ $inventory -> EqCategory ->category_name }}
</div>
<div class="card col-md-6 mx-auto">
    <div class="card-body">
        <form action="{{ route("admin.inventory.update", [$inventory->id]) }}" method="POST" enctype="multipart/form-data">

            @csrf
            @method('PUT')
            <div class="form-row">
                <div class="form-group col-md-12">
                    <label for="shortcode">Kod</label>
                    <input type="text" name="code" value="{{$inventory->code}}" class="form-control">
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="shortcode">Marka*</label>
                    <input type="text" name="mark" value="{{$inventory->mark}}" class="form-control">
                </div>
                <div class="form-group col-md-6">
                    <label for="model">Model*</label>
                    <input type="text" name="model" value="{{$inventory->model}}" class="form-control">
                </div>
            </div>


            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="processor">Procesor*</label>
                    <input type="text" name="processor" value="{{$inventory->processor}}" class="form-control">
                </div>
                <div class="form-group col-md-6">
                    <label for="ram">Ram*</label>
                    <input type="text" name="ram"  value="{{$inventory->ram}}" class="form-control">
                </div>
            </div>


            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="hard_drive">Dysk Twardy*</label><br>
                    <label>
                        <input type="radio" name="hard_drive" value="SSD" @if($hard_drive_value == 'SSD') checked @endif> SSD
                    </label>
                    <label>
                        <input type="radio" name="hard_drive" value="HDD" @if($hard_drive_value == 'HDD') checked @endif > HDD
                    </label>
                </div>
                <div class="form-group col-md-6">
                    <label for="hard_drive_capacity">Pojemność*</label><br>
                    <label>
                        <input type="radio" name="hard_drive_capacity" value="128" @if($hard_drive_capacity == '128') checked @endif > 128GB
                    </label>
                    <label>
                        <input type="radio" name="hard_drive_capacity" value="256" @if($hard_drive_capacity == '256') checked @endif> 256GB
                    </label>
                    <label>
                        <input type="radio" name="hard_drive_capacity" value="512" @if($hard_drive_capacity == '512') checked @endif> 512GB
                    </label>
                    <label>
                        <input type="radio" name="hard_drive_capacity" value="1" @if($hard_drive_capacity == '1') checked @endif> 1TB
                    </label>
                    <label>
                        <input type="radio" name="hard_drive_capacity" value="2" @if($hard_drive_capacity == '2') checked @endif> 2TB
                    </label>
                </div>

            </div>

            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="serial_number">Numer seryjny</label>
                    <input type="text" name="serial_number" value="{{$inventory->serial_number}}" class="form-control">
                </div>
                <div class="form-group col-md-6">
                    <label for="fk_company">Kontrahent*</label>
                    <select name="fk_company" id="fk_company" class="form-control select2" disabled required>
                                @foreach($companies as $company)
                                <option value="{{ $company->id }}" @if($company->id == $inventory->fk_company)
                                    selected="selected" @endif>{{ $company -> shortcode }}</option>
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