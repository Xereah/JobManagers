@extends('layouts.admin')
@section('content')

<div class="card-header col-md-6 mx-auto">
        {{ trans('global.create') }} {{ trans('cruds.tasktype.title_singular') }}
    </div>
<div class="card col-md-6 mx-auto">

    <div class="card-body">
        <form action="{{ route("admin.tasktype.update", [$tasktype->id]) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                <label for="name">{{ trans('cruds.tasktype.fields.name') }}*</label>
                <input type="text" id="name" name="name" class="form-control" value="{{ old('name', isset($tasktype) ? $tasktype->name : '') }}" required>
                @if($errors->has('name'))
                    <em class="invalid-feedback">
                        {{ $errors->first('name') }}
                    </em>
                @endif
                <p class="helper-block">
                    {{ trans('cruds.category.fields.name_helper') }}
                </p>
            </div>
            <div class="row">
                          
                          @foreach($TypeTask as $id => $TypeTasks)
                          <div class="col-md-6 py-2 ">  
                          <input type="checkbox" name="TypeTask[]" value="{{ $TypeTasks->id }}" 
                           {{ $tasktype->TypeTask->contains($TypeTasks->id) ? 'checked' : '' }}> {{ $TypeTasks->name }} <br>
                           
                          </div>
                          @endforeach
                   
                      </div>
            <div>
                <input class="btn btn-danger" type="submit" value="{{ trans('global.save') }}">
            </div>
        </form>


    </div>
</div>
@endsection
@section('scripts')

@parent
<script type="text/javascript" src="{{ asset('vendor/jsvalidation/js/jsvalidation.js')}}"></script>

{!! JsValidator::formRequest('App\Http\Requests\UpdateTaskTypeRequest') !!}

@endsection