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

            <input class="btn btn-success float-right" type="submit" value="{{ trans('global.update') }}">

        </form>


    </div>
</div>
@endsection
@section('scripts')

@parent


@endsection