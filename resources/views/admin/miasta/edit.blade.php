@extends('layouts.admin')
@section('content')

<div class="card-header bg-dark col-md-6 mx-auto">
    {{ trans('global.edit') }} {{ trans('cruds.miasta.title_two') }}
</div>

<div class="card col-md-6 mx-auto">
    <div class="card-body">
        <form action="{{ route("admin.miasta.update", [$miasta->id]) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="form-group {{ $errors->has('kontrahent_miasto') ? 'has-error' : '' }}">
                <label for="kontrahent_miasto"> {{ trans('cruds.miasta.fields.location') }}*</label>
                <input type="text" id="kontrahent_miasto" name="kontrahent_miasto" class="form-control"
                    value="{{ old('kontrahent_miasto', isset($miasta) ? $miasta->kontrahent_miasto : '') }}" required>
                @if($errors->has('name'))
                <em class="invalid-feedback">
                    {{ $errors->first('name') }}
                </em>
                @endif
                <p class="helper-block">
                    {{ trans('cruds.category.fields.name_helper') }}
                </p>
            </div>

            <div class="form-group {{ $errors->has('kontrahent_kodpocztowy') ? 'has-error' : '' }}">
                <label for="kontrahent_kodpocztowy"> {{ trans('cruds.miasta.fields.zipcode') }}*</label>
                <input type="text" id="kontrahent_kodpocztowy" name="kontrahent_kodpocztowy" class="form-control"
                    value="{{ old('kontrahent_kodpocztowy', isset($miasta) ? $miasta->kontrahent_kodpocztowy : '') }}"
                    required>
                @if($errors->has('name'))
                <em class="invalid-feedback">
                    {{ $errors->first('name') }}
                </em>
                @endif
                <p class="helper-block">
                    {{ trans('cruds.category.fields.name_helper') }}
                </p>
            </div>

            <div class="form-group {{ $errors->has('kontrahent_odleglosc') ? 'has-error' : '' }}">
                <label for="kontrahent_odleglosc"> {{ trans('cruds.miasta.fields.distance') }}*</label>
                <input type="text" id="kontrahent_odleglosc" name="kontrahent_odleglosc" class="form-control"
                    value="{{ old('kontrahent_odleglosc', isset($miasta) ? $miasta->kontrahent_odleglosc : '') }}"
                    required>
                @if($errors->has('name'))
                <em class="invalid-feedback">
                    {{ $errors->first('name') }}
                </em>
                @endif
                <p class="helper-block">
                    {{ trans('cruds.category.fields.name_helper') }}
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
<script type="text/javascript" src="{{ asset('vendor/jsvalidation/js/jsvalidation.js')}}"></script>

{!! JsValidator::formRequest('App\Http\Requests\StoreMiastaRequest') !!}

@endsection