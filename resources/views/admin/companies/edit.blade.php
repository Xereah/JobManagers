@extends('layouts.admin')
@section('content')

<div class="card-header bg-dark col-md-6 mx-auto">
    {{ trans('global.view') }} {{ trans('cruds.company.title_add') }}
</div>

<div class="card col-md-6 mx-auto">
    <div class="card-body">
    <form action="{{ route("admin.companies.update", [$company->kontrahent_id]) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="form-row">
                <div class="form-group col-md-6 {{ $errors->has('kontrahent_kod') ? 'has-error' : '' }}">
                    <label for="kontrahent_kod">{{ trans('cruds.company.fields.shortcode') }}*</label>
                    <input type="text" id="kontrahent_kod" disabled name="kontrahent_kod" class="form-control" value="{{ old('kontrahent_kod', isset($company) ? $company->kontrahent_kod : '') }}">
                    @if($errors->has('kontrahent_kod'))
                    <em class="invalid-feedback">
                        {{ $errors->first('kontrahent_kod') }}
                    </em>
                    @endif
                    <p class="helper-block">
                        {{ trans('cruds.company.fields.name_helper') }}
                    </p>
                </div>
                <div class="form-group col-md-6 {{ $errors->has('kontrahent_grupa') ? 'has-error' : '' }}">
                    <label for="kontrahent_grupa">{{ trans('cruds.company.fields.contract') }}*</label>
                    <select name="kontrahent_grupa" disabled id="kontrahent_grupa" class="form-control" required>
                            <option value="{{$company->kontrahent_grupa}}" selected="selected">{{$company->kontrahent_grupa}}
                            </option>
                            @foreach($contract as $contracts)
                            <option value="{{ $contracts->contract_name }}">{{ $contracts -> contract_name }}</option>
                            @endforeach
                        </select>
                    <p class="helper-block">
                        {{ trans('cruds.company.fields.name_helper') }}
                    </p>
                </div>

            </div>
            <div class="form-row">
                <div class="form-group col-md-6 {{ $errors->has('kontrahent_nazwa1') ? 'has-error' : '' }}">
                    <label for="kontrahent_nazwa1">{{ trans('cruds.company.fields.name') }}1*</label>
                    <input type="text" id="kontrahent_nazwa1" disabled name="kontrahent_nazwa1" value="{{ old('kontrahent_nazwa1', isset($company) ? $company->kontrahent_nazwa1 : '') }}" class="form-control">
                    @if($errors->has('kontrahent_nazwa1'))
                    <em class="invalid-feedback">
                        {{ $errors->first('kontrahent_nazwa1') }}
                    </em>
                    @endif
                    <p class="helper-block">
                        {{ trans('cruds.company.fields.name_helper') }}
                    </p>
                </div>
                <div class="form-group col-md-6 {{ $errors->has('kontrahent_nazwa2') ? 'has-error' : '' }}">
                    <label for="name">{{ trans('cruds.company.fields.name') }}2*</label>
                    <input type="text" id="kontrahent_nazwa2" disabled name="kontrahent_nazwa2" value="{{ old('kontrahent_nazwa2', isset($company) ? $company->kontrahent_nazwa2 : '') }}" class="form-control">
                    @if($errors->has('name'))
                    <em class="invalid-feedback">
                        {{ $errors->first('name') }}
                    </em>
                    @endif
                    <p class="helper-block">
                        {{ trans('cruds.company.fields.name_helper') }}
                    </p>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6 {{ $errors->has('kontrahent_nazwa3') ? 'has-error' : '' }}">
                    <label for="kontrahent_nazwa3">{{ trans('cruds.company.fields.name') }}3*</label>
                    <input type="text" id="kontrahent_nazwa3" disabled name="kontrahent_nazwa3" value="{{ old('kontrahent_nazwa3', isset($company) ? $company->kontrahent_nazwa3 : '') }}" class="form-control">
                    @if($errors->has('kontrahent_nazwa3'))
                    <em class="invalid-feedback">
                        {{ $errors->first('kontrahent_nazwa3') }}
                    </em>
                    @endif
                    <p class="helper-block">
                        {{ trans('cruds.company.fields.name_helper') }}
                    </p>
                </div>
                <div class="form-group col-md-6 {{ $errors->has('kontrahent_nip') ? 'has-error' : '' }}">
                    <label for="kontrahent_nip">NIP*</label>
                    <input type="text" id="kontrahent_nip" disabled name="kontrahent_nip" value="{{ old('kontrahent_nip', isset($company) ? $company->kontrahent_nip : '') }}" class="form-control">
                    @if($errors->has('kontrahent_nip'))
                    <em class="invalid-feedback">
                        {{ $errors->first('kontrahent_nip') }}
                    </em>
                    @endif
                    <p class="helper-block">
                        {{ trans('cruds.company.fields.name_helper') }}
                    </p>
                </div>
            </div>
            <div class="form-row">
            <div class="form-group col-md-4 {{ $errors->has('kontrahent_miasto') ? 'has-error' : '' }}">
                    <label for="kontrahent_miasto">{{ trans('cruds.company.fields.location') }}*</label>
                    <input type="text" id="kontrahent_miasto" disabled name="kontrahent_miasto" value="{{ old('kontrahent_miasto', isset($company) ? $company->kontrahent_miasto : '') }}" class="form-control">
                    @if($errors->has('kontrahent_miasto'))
                    <em class="invalid-feedback">
                        {{ $errors->first('kontrahent_miasto') }}
                    </em>
                    @endif
                    <p class="helper-block">
                        {{ trans('cruds.company.fields.name_helper') }}
                    </p>
                </div>
                <div class="form-group col-md-4  {{ $errors->has('kontrahent_ulica') ? 'has-error' : '' }}">
                    <label for="kontrahent_ulica">{{ trans('cruds.company.fields.street') }}*</label>
                    <input type="text" id="kontrahent_ulica" disabled name="kontrahent_ulica" value="{{ old('kontrahent_ulica', isset($company) ? $company->kontrahent_ulica : '') }}" class="form-control">
                    @if($errors->has('kontrahent_ulica'))
                    <em class="invalid-feedback">
                        {{ $errors->first('kontrahent_ulica') }}
                    </em>
                    @endif
                    <p class="helper-block">
                        {{ trans('cruds.company.fields.name_helper') }}
                    </p>
                </div>
                <div class="form-group col-md-2 {{ $errors->has('kontrahent_nrdomu') ? 'has-error' : '' }}">
                    <label for="kontrahent_nrdomu">Nr. domu</label>
                    <input type="text" id="kontrahent_nrdomu" disabled name="kontrahent_nrdomu" value="{{ old('kontrahent_nrdomu', isset($company) ? $company->kontrahent_nrdomu : '') }}" class="form-control">
                    @if($errors->has('kontrahent_nrdomu'))
                    <em class="invalid-feedback">
                        {{ $errors->first('kontrahent_nrdomu') }}
                    </em>
                    @endif
                    <p class="helper-block">
                        {{ trans('cruds.company.fields.name_helper') }}
                    </p>
                </div>
                <div class="form-group col-md-2 {{ $errors->has('kontrahent_nrlokalu') ? 'has-error' : '' }}">
                    <label for="kontrahent_nrlokalu">Nr. lokalu</label>
                    <input type="text" id="kontrahent_nrlokalu" disabled name="kontrahent_nrlokalu" value="{{ old('kontrahent_nrlokalu', isset($company) ? $company->kontrahent_nrlokalu : '') }}" class="form-control">
                    @if($errors->has('kontrahent_nrlokalu'))
                    <em class="invalid-feedback">
                        {{ $errors->first('kontrahent_nrlokalu') }}
                    </em>
                    @endif
                    <p class="helper-block">
                        {{ trans('cruds.company.fields.name_helper') }}
                    </p>
                </div>
            </div>

            <div class="form-row">
             
                <div class="form-group col-md-6 {{ $errors->has('kontrahent_kodpocztowy') ? 'has-error' : '' }}">
                    <label for="kontrahent_kodpocztowy">{{ trans('cruds.company.fields.zipcode') }}*</label>
                    <input type="text" id="kontrahent_kodpocztowy" disabled name="kontrahent_kodpocztowy" value="{{ old('kontrahent_kodpocztowy', isset($company) ? $company->kontrahent_kodpocztowy : '') }}" class="form-control">
                    @if($errors->has('kontrahent_kodpocztowy'))
                    <em class="invalid-feedback">
                        {{ $errors->first('kontrahent_kodpocztowy') }}
                    </em>
                    @endif
                    <p class="helper-block">
                        {{ trans('cruds.company.fields.name_helper') }}
                    </p>
                </div>

                <div class="form-group col-md-6 {{ $errors->has('location') ? 'has-error' : '' }}">
                    <label for="kontrahent_poczta">{{ trans('cruds.company.fields.location') }}*</label>
                    <input type="text" id="kontrahent_poczta" disabled name="kontrahent_poczta" value="{{ old('kontrahent_poczta', isset($company) ? $company->kontrahent_poczta : '') }}" class="form-control">
                    @if($errors->has('kontrahent_poczta'))
                    <em class="invalid-feedback">
                        {{ $errors->first('kontrahent_poczta') }}
                    </em>
                    @endif
                    <p class="helper-block">
                        {{ trans('cruds.company.fields.name_helper') }}
                    </p>
                </div>
            </div>


            <div class="form-row">
                <div class="form-group col-md-6 {{ $errors->has('kontrahent_telefon1') ? 'has-error' : '' }}">
                    <label for="kontrahent_telefon1">{{ trans('cruds.company.fields.phonenumber') }}*</label>
                    <input type="text" id="kontrahent_telefon1" disabled name="kontrahent_telefon1" value="{{ old('kontrahent_telefon1', isset($company) ? $company->kontrahent_telefon1 : '') }}" class="form-control">
                    @if($errors->has('kontrahent_telefon1'))
                    <em class="invalid-feedback">
                        {{ $errors->first('kontrahent_telefon1') }}
                    </em>
                    @endif
                    <p class="helper-block">
                        {{ trans('cruds.company.fields.name_helper') }}
                    </p>
                </div>
                <div class="form-group col-md-6 {{ $errors->has('kontrahent_telefon2') ? 'has-error' : '' }}">
                    <label for="kontrahent_telefon2">{{ trans('cruds.company.fields.phonenumber') }}2</label>
                    <input type="text" id="kontrahent_telefon2" disabled name="kontrahent_telefon2" value="{{ old('kontrahent_telefon2', isset($company) ? $company->kontrahent_telefon2 : '') }}" class="form-control">
                    @if($errors->has('kontrahent_telefon2'))
                    <em class="invalid-feedback">
                        {{ $errors->first('kontrahent_telefon2') }}
                    </em>
                    @endif
                    <p class="helper-block">
                        {{ trans('cruds.company.fields.name_helper') }}
                    </p>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-12 {{ $errors->has('kontrahent_email') ? 'has-error' : '' }}">
                    <label for="kontrahent_email">{{ trans('cruds.company.fields.email') }}*</label>
                    <input type="text" id="kontrahent_email" disabled name="kontrahent_email" value="{{ old('kontrahent_email', isset($company) ? $company->kontrahent_email : '') }}" class="form-control">
                    @if($errors->has('kontrahent_email'))
                    <em class="invalid-feedback">
                        {{ $errors->first('kontrahent_email') }}
                    </em>
                    @endif
                    <p class="helper-block">
                        {{ trans('cruds.company.fields.name_helper') }}
                    </p>
                </div>
            </div>
            <!-- <div>
                <input class="btn btn-success float-right" type="submit" value="{{ trans('global.save') }}">
            </div> -->
        </form>


    </div>
</div>
@endsection
@section('scripts')

@parent
<script type="text/javascript" src="{{ asset('vendor/jsvalidation/js/jsvalidation.js')}}"></script>

{!! JsValidator::formRequest('App\Http\Requests\StoreCompanyRequest') !!}

@endsection