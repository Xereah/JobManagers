@extends('layouts.admin')
@section('content')
<div class="card-header bg-dark col-md-6 mx-auto">
{{ trans('global.edit') }} {{ trans('cruds.rep_eq.title_plural') }}
    </div>
<div class="card col-md-6 mx-auto">

    <div class="card-body">
        <form action="{{ route("admin.repequipment.update", [$RepEquipment->id]) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="form-group {{ $errors->has('eq_number') ? 'has-error' : '' }}">
                <label for="shortcode">Numer Sprzętu*</label>
                <input type="text" id="eq_number" name="eq_number" value="{{ $RepEquipment->eq_number }}" class="form-control" >
            </div>

            <div class="form-group {{ $errors->has('eq_name') ? 'has-error' : '' }}">
                <label for="shortcode">Nazwa*</label>
                <input type="text" id="eq_name" name="eq_name" value="{{ $RepEquipment->eq_name }}" class="form-control" >
            </div>

            <div class="form-group {{ $errors->has('eq_name') ? 'has-error' : '' }}">
                <label for="shortcode">Numer Seryjny*</label>
                <input type="text" id="serial_number" name="serial_number" value="{{ $RepEquipment->serial_number }}" class="form-control" >
            </div>
            <div class="form-group {{ $errors->has('eq_name') ? 'has-error' : '' }}">
                        <label for="eq_category">Kategoria</label>
                        <select name="eq_category" id="eq_category" class="form-control select2" >
                            @foreach($EquipmentCategory as $EquipmentCategories)                           
                            <option  value="{{ $EquipmentCategories->id }}" @if($EquipmentCategories->id == $RepEquipment->eq_category)
                                    selected="selected" @endif>{{ $EquipmentCategories -> category_name }}</option>                        
                            @endforeach
                           
                        </select>
            </div>

            <div class="form-group {{ $errors->has('eq_name') ? 'has-error' : '' }}">
                        <label for="company_place">Miejsce Pobytu</label>
                        <select name="company_place" id="company_place" class="form-control select2" >
                            <option value=""></option>
                            @foreach($Company as $Companies)                           
                            <option  value="{{ $Companies->id }}" @if($Companies->id == $RepEquipment->company_place)
                                    selected="selected" @endif>{{ $Companies -> shortcode }}</option>                        
                            @endforeach
                           
                        </select>
            </div>

            <div class="form-group {{ $errors->has('comments') ? 'has-error' : '' }}">
                <label for="shortcode">Uwagi*</label>
                <textarea class="form-control" name="comments" id="comments" value="{{ $RepEquipment->comments }}" rows="3"></textarea>
            </div>

            <div class="form-group {{ $errors->has('entry_date') ? 'has-error' : '' }}">
                <input type='date' id="entry_date" hidden name="entry_date"
                                class="form-control input-group-addon"  value="{{ date("Y-m-d") }}"/>
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

{!! JsValidator::formRequest('App\Http\Requests\StoreRepEqRequest') !!}

@endsection