@extends('layouts.admin')
@section('content')
<style>
.account-settings .user-profile {
    margin: 0 0 1rem 0;
    padding-bottom: 1rem;
    text-align: center;
}

.account-settings .user-profile .user-avatar {
    margin: 0 0 1rem 0;
}

.account-settings .user-profile .user-avatar img {
    width: 90px;
    height: 90px;
    -webkit-border-radius: 100px;
    -moz-border-radius: 100px;
    border-radius: 100px;
}

.account-settings .user-profile h5.user-name {
    margin: 0 0 0.5rem 0;
}

.account-settings .user-profile h6.user-email {
    margin: 0;
    font-size: 0.8rem;
    font-weight: 400;
}

.account-settings .about {
    margin: 1rem 0 0 0;
    font-size: 0.8rem;
    text-align: center;
}
</style>



<div class="container">
    <form action="{{ url('/user/settings/update') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('POST')
        <div class="row gutters">
            <div class="col-xl-3 col-lg-3 col-md-12 col-sm-12 col-12">
                <div class="card h-100">
                    <div class="card-body">
                        <div class="account-settings">
                            <div class="user-profile">
                                <div class="user-avatar">
                                    <img src="https://bootdey.com/img/Content/avatar/avatar1.png" alt="Maxwell Admin">
                                </div>
                                <h5 class="user-name">{{$user->name}} {{$user->surname}}</h5>
                                <h6 class="user-email">{{$user->email}}</h6>
                            </div>
                            <div class="about">
                                <h5 class="mb-2 text-primary">O mnie</h5>
                                <p>Cześć jestem {{$user->name}}, ale Patryk wykonał kawał świetnej roboty. Jestem mu
                                    ogromnie wdzieczny :D</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-9 col-lg-9 col-md-12 col-sm-12 col-12">
                <div class="card h-100">
                    <div class="card-body">
                        <div class="row gutters">
                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                <h6 class="mb-3 text-primary">Szczegóły</h6>
                            </div>

                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                                    <label for="name">{{ trans('cruds.user.fields.name') }}</label>
                                    <input type="text" id="name" name="name" class="form-control"
                                        value="{{ old('name', isset($user) ? $user->name : '') }}" required>
                                    @if($errors->has('name'))
                                    <em class="invalid-feedback">
                                        {{ $errors->first('name') }}
                                    </em>
                                    @endif
                                    <p class="helper-block">
                                        {{ trans('cruds.user.fields.name_helper') }}
                                    </p>
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                <div class="form-group {{ $errors->has('surname') ? 'has-error' : '' }}">
                                    <label for="surname">{{ trans('cruds.user.fields.surname') }}*</label>
                                    <input type="text" id="surname" name="surname" class="form-control"
                                        value="{{ old('surname', isset($user) ? $user->surname : '') }}" required>
                                    @if($errors->has('surname'))
                                    <em class="invalid-feedback">
                                        {{ $errors->first('surname') }}
                                    </em>
                                    @endif
                                    <p class="helper-block">
                                        {{ trans('cruds.user.fields.name_helper') }}
                                    </p>
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                <div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
                                    <label for="email">{{ trans('cruds.user.fields.email') }}*</label>
                                    <input type="email" id="email" name="email" class="form-control"
                                        value="{{ old('email', isset($user) ? $user->email : '') }}" required>
                                    @if($errors->has('email'))
                                    <em class="invalid-feedback">
                                        {{ $errors->first('email') }}
                                    </em>
                                    @endif
                                    <p class="helper-block">
                                        {{ trans('cruds.user.fields.email_helper') }}
                                    </p>
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                <div class="form-group {{ $errors->has('password') ? 'has-error' : '' }}">
                                    <label for="password">{{ trans('cruds.user.fields.password') }}</label>
                                    <input type="password" id="password" name="password" class="form-control">
                                    @if($errors->has('password'))
                                    <em class="invalid-feedback">
                                        {{ $errors->first('password') }}
                                    </em>
                                    @endif
                                    <p class="helper-block">
                                        {{ trans('cruds.user.fields.password_helper') }}
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="row gutters">
                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                <div class="text-right">
                                <a href="{{ url()->previous() }}" class="btn btn-secondary">Anuluj</a>
                                    <input class="btn btn-primary" type="submit" value="{{ trans('global.save') }}">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection