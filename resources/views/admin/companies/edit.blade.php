@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.company.title_singular') }}
    </div>

    <div class="card-body">
        <form action="{{ route("admin.companies.update", [$company->id]) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="form-group {{ $errors->has('shortcode') ? 'has-error' : '' }}">
                <label for="shortcode">{{ trans('cruds.company.fields.shortcode') }}*</label>
                <input type="text" id="shortcode" name="shortcode" class="form-control" value="{{ old('shortcode', isset($company) ? $company->shortcode : '') }}" required>
                @if($errors->has('shortcode'))
                    <em class="invalid-feedback">
                        {{ $errors->first('shortcode') }}
                    </em>
                @endif
                <p class="helper-block">
                    {{ trans('cruds.company.fields.name_helper') }}
                </p>
            </div>

            <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                <label for="name">{{ trans('cruds.company.fields.name') }}*</label>
                <input type="text" id="name" name="name" class="form-control" value="{{ old('name', isset($company) ? $company->name : '') }}" required>
                @if($errors->has('shortcode'))
                    <em class="invalid-feedback">
                        {{ $errors->first('name') }}
                    </em>
                @endif
                <p class="helper-block">
                    {{ trans('cruds.company.fields.name_helper') }}
                </p>
            </div>
            
            <div class="form-group {{ $errors->has('contract_name') ? 'has-error' : '' }}">
                <label for="fk_contract">{{ trans('cruds.company.fields.contract') }}*</label>
                <select name="fk_contract" id="fk_contract" class="form-control" required>
                            <option value="{{$company->fk_contract}}" selected="selected">{{$company->contract->contract_name}}
                            </option>
                            @foreach($contract as $contracts)
                            <option value="{{ $contracts->id }}">{{ $contracts -> contract_name }}</option>
                            @endforeach
                        </select>
                <p class="helper-block">
                    {{ trans('cruds.company.fields.name_helper') }}
                </p>
            </div>

            <div class="form-group {{ $errors->has('street') ? 'has-error' : '' }}">
                <label for="street">{{ trans('cruds.company.fields.street') }}*</label>
                <input type="text" id="street" name="street" class="form-control" value="{{ old('street', isset($company) ? $company->street : '') }}" required>
                @if($errors->has('street'))
                    <em class="invalid-feedback">
                        {{ $errors->first('street') }}
                    </em>
                @endif
                <p class="helper-block">
                    {{ trans('cruds.company.fields.name_helper') }}
                </p>
            </div>
          

            <div class="form-group {{ $errors->has('zipcode') ? 'has-error' : '' }}">
                <label for="zipcode">{{ trans('cruds.company.fields.zipcode') }}*</label>
                <input type="text" id="zipcode" name="zipcode" class="form-control" value="{{ old('zipcode', isset($company) ? $company->zipcode : '') }}" required>
                @if($errors->has('zipcode'))
                    <em class="invalid-feedback">
                        {{ $errors->first('zipcode') }}
                    </em>
                @endif
                <p class="helper-block">
                    {{ trans('cruds.company.fields.name_helper') }}
                </p>
            </div>

            <div class="form-group {{ $errors->has('location') ? 'has-error' : '' }}">
                <label for="location">{{ trans('cruds.company.fields.location') }}*</label>
                <input type="text" id="location" name="location" class="form-control" value="{{ old('location', isset($company) ? $company->location : '') }}" required>
                @if($errors->has('location'))
                    <em class="invalid-feedback">
                        {{ $errors->first('location') }}
                    </em>
                @endif
                <p class="helper-block">
                    {{ trans('cruds.company.fields.name_helper') }}
                </p>
            </div>

            <div class="form-group {{ $errors->has('phonenumber') ? 'has-error' : '' }}">
                <label for="phonenumber">{{ trans('cruds.company.fields.phonenumber') }}*</label>
                <input type="text" id="phonenumber" name="phonenumber" class="form-control" value="{{ old('phonenumber', isset($company) ? $company->phonenumber : '') }}" required>
                @if($errors->has('phonenumber'))
                    <em class="invalid-feedback">
                        {{ $errors->first('phonenumber') }}
                    </em>
                @endif
                <p class="helper-block">
                    {{ trans('cruds.company.fields.name_helper') }}
                </p>
            </div>

            <div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
                <label for="email">{{ trans('cruds.company.fields.email') }}*</label>
                <input type="text" id="email" name="email" class="form-control" value="{{ old('email', isset($company) ? $company->email : '') }}" required>
                @if($errors->has('email'))
                    <em class="invalid-feedback">
                        {{ $errors->first('email') }}
                    </em>
                @endif
                <p class="helper-block">
                    {{ trans('cruds.company.fields.name_helper') }}
                    
                </p>
            </div>
            <div class="form-group {{ $errors->has('distance') ? 'has-error' : '' }}">
                <label for="distance">{{ trans('cruds.company.fields.distance') }}*</label>
                <input type="text" id="distance" name="distance" class="form-control" value="{{ old('distance', isset($company) ? $company->distance : '') }}" required>
                @if($errors->has('distance'))
                    <em class="invalid-feedback">
                        {{ $errors->first('distance') }}
                    </em>
                @endif
                <p class="helper-block">
                    {{ trans('cruds.company.fields.name_helper') }}
                </p>
            </div>
           
                <input class="btn btn-danger" type="submit" value="{{ trans('global.save') }}">
            </div>
        </form>


    </div>
</div>
@endsection

@section('scripts')

@parent
<script type="text/javascript" src="{{ asset('vendor/jsvalidation/js/jsvalidation.js')}}"></script>

{!! JsValidator::formRequest('App\Http\Requests\UpdateCompanyRequest') !!}

@endsection