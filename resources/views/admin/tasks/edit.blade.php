@extends('layouts.admin')
@section('content')
<div class="card-header bg-dark col-md-6 mx-auto">
        {{ trans('global.edit') }} Zadania
    </div>
<div class="card col-md-6 mx-auto">
    <div class="card-body">
    <form action="{{ route("admin.tasks.update", [$task->id]) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="form-group {{ $errors->has('task_title') ? 'has-error' : '' }}">
                <label for="fk_company" style="margin-top:1%;">{{ trans('cruds.job.fields.company') }}</label>
                        <select name="fk_company" id="fk_company" class="form-control select2" required>
                            <option value=""></option>
                            @foreach($companies as $company)
                                <option value="{{ $company->id }}" @if($company->id == $task->fk_company)
                                    selected="selected" @endif>{{ $company -> shortcode }}</option>
                                @endforeach
                           
                        </select>
            </div>
            <div class="form-group {{ $errors->has('task_title') ? 'has-error' : '' }}">
                <label for="shortcode">Treść zadania*</label>
                <input type="text" id="task_title" name="task_title" value="{{ $task -> task_title }}" class="form-control" >
                @if($errors->has('task_title'))
                    <em class="invalid-feedback">
                        {{ $errors->first('task_title') }}
                    </em>
                @endif
                <p class="helper-block">
                    {{ trans('cruds.company.fields.name_helper') }}
                </p>
            </div>

            <div class="form-group {{ $errors->has('task_description') ? 'has-error' : '' }}">
                <label for="shortcode">Dodatkowe informacje</label>
                <textarea class="form-control" name="task_description" id="task_description"  rows="2">{{ $task -> task_description }}</textarea>
                @if($errors->has('task_description'))
                    <em class="invalid-feedback">
                        {{ $errors->first('task_description') }}
                    </em>
                @endif
                <p class="helper-block">
                    {{ trans('cruds.company.fields.name_helper') }}
                </p>
            </div>

            <div class="form-row" hidden>
                    <div class="form-group col-md-12">
                        <label for="fk_user" style="margin-top:1%;">Odpowiedzialny</label>
                        <select id="fk_user" name="fk_user" class="form-control ">
                            <option value="{{ $user->id}}">{{ $user->name }} {{ $user->surname }}</option>
                        </select>
                    </div>
            </div>

           

            <div class="form-row" >
                    <div class="form-group col-md-12">
                    <select id="completed" name="completed" class="form-control">
                                @if($task -> completed === 1 )
                                <option value="{{$task->completed}}">Wykonane</option>
                                @else
                                <option value="{{$task->completed}}">Nie Wykonane</option>
                                @endif
                                <option value="0">Nie Wykonane</option>
                                <option value="1">Wykonane</option>

                            </select>
                    </div>
            </div>

            <div>
                <input class="btn btn-danger float-right" type="submit" value="{{ trans('global.save') }}">
            </div>
            
        </form>


    </div>
</div>
@endsection
@section('scripts')

@parent
@endsection