@extends('layouts.admin')
@section('content')
<div class="card-header bg-dark col-md-6 mx-auto">
        {{ trans('global.create') }} pozostałość
    </div>
<div class="card col-md-6 mx-auto">
    <div class="card-body">
        <form action="" method="POST" enctype="multipart/form-data">
            @csrf

        

            
        </form>


    </div>
</div>
@endsection
@section('scripts')

@parent
@endsection