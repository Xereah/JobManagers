@extends('layouts.admin')
@section('content')
<div class="card-header bg-dark col-md-6 mx-auto">
        {{ trans('global.create') }} Auto
    </div>
<div class="card col-md-6 mx-auto" >
    <div class="card-body">
        <form action="{{ route("admin.car.store") }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="form-group {{ $errors->has('car_mark') ? 'has-error' : '' }}">
                <label for="shortcode">Marka*</label>
                <input type="text" id="car_mark" name="car_mark" class="form-control" >
                @if($errors->has('car_mark'))
                    <em class="invalid-feedback">
                        {{ $errors->first('car_mark') }}
                    </em>
                @endif
                <p class="helper-block">
                    {{ trans('cruds.company.fields.name_helper') }}
                </p>
            </div>

            <div class="form-group {{ $errors->has('car_model') ? 'has-error' : '' }}">
                <label for="shortcode">Model*</label>
                <input type="text" id="car_model" name="car_model" class="form-control" >
                @if($errors->has('car_model'))
                    <em class="invalid-feedback">
                        {{ $errors->first('car_model') }}
                    </em>
                @endif
                <p class="helper-block">
                    {{ trans('cruds.company.fields.name_helper') }}
                </p>
            </div>

            <div class="form-group {{ $errors->has('car_plates') ? 'has-error' : '' }}">
                <label for="shortcode">Rejestracja*</label>
                <input type="text" id="car_plates" name="car_plates" class="form-control" >
                @if($errors->has('car_plates'))
                    <em class="invalid-feedback">
                        {{ $errors->first('car_plates') }}
                    </em>
                @endif
                <p class="helper-block">
                    {{ trans('cruds.company.fields.name_helper') }}
                </p>
            </div>

         
            <div>
                <input class="btn btn-success float-right" type="submit" value="{{ trans('global.save') }}">
            </div>
        </form>


    </div>
</div>
@endsection
@section('scripts')

@parent


@endsection