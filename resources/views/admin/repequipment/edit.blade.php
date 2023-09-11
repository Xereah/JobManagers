@extends('layouts.admin')
@section('content')
<div class="card-header bg-dark col-md-6 mx-auto">
    {{ trans('global.edit') }} {{ trans('cruds.rep_eq.title_plural') }}
</div>
<div class="card col-md-6 mx-auto">

    <div class="card-body">
        <form action="{{ route("admin.repequipment.update", [$RepEquipment->id]) }}" method="POST"
            enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="container">
                <div class="row">
                    <div class="col">
                        <div class="form-group {{ $errors->has('eq_number') ? 'has-error' : '' }}">
                            <label for="shortcode">Numer Sprzętu*</label>
                            <input type="text" id="eq_number" name="eq_number" value="{{ $RepEquipment->eq_number }}"
                                class="form-control">
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group {{ $errors->has('eq_name') ? 'has-error' : '' }}">
                            <label for="shortcode">Nazwa*</label>
                            <input type="text" id="eq_name" name="eq_name" value="{{ $RepEquipment->eq_name }}"
                                class="form-control">
                        </div>
                    </div>
                    <div class="w-100"></div>
                    <div class="col">
                        <div class="form-group {{ $errors->has('eq_name') ? 'has-error' : '' }}">
                            <label for="shortcode">Numer Seryjny*</label>
                            <input type="text" id="serial_number" name="serial_number"
                                value="{{ $RepEquipment->serial_number }}" class="form-control">
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group {{ $errors->has('eq_name') ? 'has-error' : '' }}">
                            <label for="eq_category">Kategoria</label>
                            <select name="eq_category" id="eq_category" class="form-control select2">
                                @foreach($EquipmentCategory as $EquipmentCategories)
                                <option value="{{ $EquipmentCategories->id }}" @if($EquipmentCategories->id ==
                                    $RepEquipment->eq_category)
                                    selected="selected" @endif>{{ $EquipmentCategories -> category_name }}</option>
                                @endforeach

                            </select>
                        </div>
                    </div>
                    <div class="w-100"></div>
                    <div class="col">
                        <div class="form-group {{ $errors->has('eq_name') ? 'has-error' : '' }}">
                            <label for="company_place">Miejsce Pobytu</label>
                            <select name="company_place" id="company_place" class="form-control select2">
                                <option value=""></option>
                                @foreach($Company as $Companies)
                                <option value="{{ $Companies->kontrahent_id }}" @if($Companies->kontrahent_id ==
                                    $RepEquipment->company_place)
                                    selected="selected" @endif>{{ $Companies -> kontrahent_kod }}</option>
                                @endforeach

                            </select>
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group {{ $errors->has('eq_active') ? 'has-error' : '' }}">
                            <label for="eq_active">Aktywny</label>
                            <select name="eq_active" id="eq_active" class="form-control select2">
                                <option value="0" {{ $RepEquipment->eq_active == 0 ? 'selected' : '' }}>Tak</option>
                                <option value="1" {{ $RepEquipment->eq_active == 1 ? 'selected' : '' }}>Nie</option>
                            </select>
                        </div>
                    </div>
                    <div class="w-100"></div>
                    <div class="col">
                        <div class="form-group {{ $errors->has('eq_specification') ? 'has-error' : '' }}">
                            <label for="shortcode">Parametry</label>
                            <textarea class="form-control" name="eq_specification" id="eq_specification"
                                rows="3">{{ $RepEquipment->eq_specification }}</textarea>
                        </div>
                    </div>

                    <div class="w-100"></div>
                    <div class="col">
                        <div class="form-group {{ $errors->has('comments') ? 'has-error' : '' }}">
                            <label for="shortcode">Uwagi*</label>
                            <textarea class="form-control" name="comments" id="comments"
                                rows="3">{{ $RepEquipment->comments }}</textarea>
                        </div>

                        <div class="form-group {{ $errors->has('entry_date') ? 'has-error' : '' }}">
                            <input type='date' id="entry_date" hidden name="entry_date"
                                class="form-control input-group-addon" value="{{ date("Y-m-d") }}" />
                        </div>

                        <div>
                            <input class="btn btn-success float-right" type="submit" value="{{ trans('global.save') }}">
                        </div>
                    </div>

                </div>
            </div>



































        </form>


    </div>
</div>
@endsection
@section('scripts')

@parent
<script type="text/javascript" src="{{ asset('vendor/jsvalidation/js/jsvalidation.js')}}"></script>

{!! JsValidator::formRequest('App\Http\Requests\StoreRepEqRequest') !!}

@endsection