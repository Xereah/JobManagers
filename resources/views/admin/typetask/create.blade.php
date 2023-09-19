@extends('layouts.admin')
@section('content')

<div class="card-header bg-dark col-md-6 mx-auto">
{{ trans('global.create') }} {{ trans('cruds.typetask.title_singular') }}
    </div>

<div class="card col-md-6 mx-auto">
    <div class="card-body">
        <form action="{{ route("admin.typetask.store") }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                <label for="name">{{ trans('cruds.typetask.fields.name') }}*</label>
                <input type="text" id="name" name="name" class="form-control" value="{{ old('name', isset($typetask) ? $typetask->name : '') }}" required>
                @if($errors->has('name'))
                    <em class="invalid-feedback">
                        {{ $errors->first('name') }}
                    </em>
                @endif
                <p class="helper-block">
                    {{ trans('cruds.category.fields.name_helper') }}
                </p>
            </div>

            <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                <label for="name">Skrót*</label>
                <input type="text" id="short" name="short" class="form-control" value="{{ old('short', isset($typetask) ? $typetask->short : '') }}" required>
                @if($errors->has('short'))
                    <em class="invalid-feedback">
                        {{ $errors->first('short') }}
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

{!! JsValidator::formRequest('App\Http\Requests\StoreTypeTaskRequest') !!}

@endsection