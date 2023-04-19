@extends('layouts.admin')
@section('content')
<div class="card-header bg-dark col-md-6 mx-auto">
        {{ trans('global.create') }} {{ trans('cruds.task.title') }}
    </div>
<div class="card col-md-6 mx-auto">
    <div class="card-body">
        <form action="{{ route("admin.tasks.store") }}" method="POST" enctype="multipart/form-data">
            @csrf

        
            <div class="form-group {{ $errors->has('task_title') ? 'has-error' : '' }}">
                <label for="fk_company" style="margin-top:1%;">  {{ trans('cruds.company.title_singular') }}</label>
                        <select name="fk_company" id="fk_company" class="form-control select2" required>
                            <option value=""></option>
                            @foreach($companies as $company)                           
                            <option  value="{{ $company->id }}">{{ $company -> kontrahent_kod }}</option>                        
                            @endforeach
                           
                        </select>
            </div>
            <div class="form-group {{ $errors->has('task_title') ? 'has-error' : '' }}">
                <label for="shortcode">{{ trans('cruds.task.fields.description') }}*</label>
                <input type="text" id="task_title" name="task_title" class="form-control" required >
                @if($errors->has('task_title'))
                    <em class="invalid-feedback">
                        {{ $errors->first('task_title') }}
                    </em>
                @endif
                <p class="helper-block">
                    {{ trans('cruds.company.fields.name_helper') }}
                </p>
            </div>
            <div class="form-row">
                    <div class="form-group col-md-12">
                        <label for="execution_user" style="margin-top:1%;"> {{ trans('cruds.task.fields.performed') }}</label>
                        <select id="execution_user" name="execution_user" class="form-control " required>
                            <option value="">-----{{ trans('cruds.job.fields.choose') }}-----</option>
                            @foreach($user_all as $userall)
                            
                            <option value="{{ $userall->id}}">{{ $userall->name }} {{ $userall->surname }}</option>
                            @endforeach
                        </select>
                    </div>
            </div>
            <div class="form-row" hidden>
                    <div class="form-group col-md-12">
                        <label for="fk_user" style="margin-top:1%;">Odpowiedzialny</label>
                        <select id="fk_user" name="fk_user" class="form-control ">
                            <option value="{{ $user->id}}">{{ $user->name }} {{ $user->surname }}</option>
                        </select>
                    </div>
            </div>

            <div>
                <input class="btn btn-success float-right" type="submit" value="{{ trans('global.save') }}">
            </div>
            
        </form>


    </div>
</div>
@endsection
@section('scripts')
<script type="text/javascript" src="{{ asset('vendor/jsvalidation/js/jsvalidation.js')}}"></script>

{!! JsValidator::formRequest('App\Http\Requests\StoreTaskRequest') !!}
@parent
@endsection