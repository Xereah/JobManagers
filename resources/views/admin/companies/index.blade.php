@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header bg-dark">
    {{ trans('global.list') }} {{ trans('cruds.company.title_plural') }}
        <!-- @can('company_create')
        <a class="btn btn-dark float-right" href="{{ route("admin.companies.create") }}">
        <i class="fa fa-plus"></i> {{ trans('global.add') }} {{ trans('cruds.company.title_add') }}
            </a>
        @endcan -->
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-Company" id="example">
                <thead>
                <tr>               
               <th> <button class="btn btn-danger" id="btnSearch" name="btnSearch"><i class="fa fa-trash"></i></button></th>
               <th><input id="filtr_akronim" class="form-control" /></th>
               <th><input id="filtr_nazwa" class="form-control" /></th>
               <th><input id="filtr_miasto" class="form-control" /></th>
               <th><input id="filtr_ulica" class="form-control" /></th>
               <th><select class="form-control" id="filtr_umowa">
                        <option> </option>
                                @foreach($contracts as $key => $contract)
                                <option value="{{$contract->contract_name}}">{{ $contract->contract_name }} </option>
                                @endforeach
                            </select></th>
               <th><input id="filtr_email" class="form-control" /></th>   
               <th></th>       
           </tr>
                    <tr>
                        <th width="10">
                        {{ trans('global.lp') }}
                        </th>
                       
                        <th >
                            {{ trans('cruds.company.fields.shortcode') }}
                        </th>
                        <th>
                            {{ trans('cruds.company.fields.name') }}
                        </th>
                        <th>
                            {{ trans('cruds.company.fields.location') }}
                        </th>
                        <th>
                            {{ trans('cruds.company.fields.street') }}
                        </th>
                        <th>
                            {{ trans('cruds.company.fields.contract') }}
                        </th>
                        <th>
                            {{ trans('cruds.company.fields.email') }}
                        </th>                       
                         <th>
                        {{ trans('cruds.company.fields.action') }}
                        </th> 
                    </tr>
                </thead>
                <tbody>
                    @foreach($companies as $key => $company)
                        <tr data-entry-id="{{ $company->id }}">
                            <td>

                            </td>                            
                            <td>
                                {{ $company->kontrahent_kod ?? '' }}
                            </td>
                            <td>
                                {{ $company->kontrahent_nazwa1 ?? '' }}  {{ $company->kontrahent_nazwa2 ?? '' }}  {{ $company->kontrahent_nazwa3 ?? '' }}
                            </td>
                            <td>
                                {{ $company->kontrahent_miasto ?? '' }}
                            </td>  
                            <td>
                                {{ $company->kontrahent_ulica ?? '' }}  {{ $company->kontrahent_nrdomu ?? '' }}
                            </td>    
                            <td>
                                {{ $company->kontrahent_grupa ?? '' }}
                            </td>                
                            <td>
                                {{ $company->kontrahent_email ?? '' }}
                            </td>  
                        
                            <td width="10" align="center">
                                <div class="btn-group" role="group">
                                @can('company_edit')
                                    <a class="btn  btn-info" href="{{ route('admin.companies.edit', $company->kontrahent_id) }}" title="{{ trans('global.edit') }}">
                                    <i class="fas fa-edit"></i>
                                    </a>
                                @endcan
                                <!-- @can('company_delete')
                                <form action="{{ route('admin.companies.destroy', $company->kontrahent_id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
                                    <input type="hidden" name="_method" value="DELETE">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    <button type="submit" class="btn  btn-danger" title="{{ trans('global.delete') }}">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                                @endcan  -->
                                </div>

                            </td> 

                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>


    </div>
</div>
@endsection
@section('scripts')
@parent

<script>

$(document).ready(function() {
$('#example').DataTable();
var table = $('#example').DataTable();
    $('#filtr_akronim').on( 'change', function () {      
    table.columns( $(this).parent().index()+':visible' ).search( this.value ).draw();
    } );
    $('#filtr_nazwa').on( 'change', function () {      
    table.columns( $(this).parent().index()+':visible' ).search( this.value ).draw();
    } );
    $('#filtr_ulica').on('change', function () {
    table.columns( $(this).parent().index()+':visible' ).search( this.value ).draw();
    } );
    $('#filtr_umowa').on('change', function () {
    table.columns($(this).parent().index() + ':visible').search('^' + this.value + '$', true, false).draw();
    } );
    $('#filtr_kod').on('change', function () {
    table.columns( $(this).parent().index()+':visible' ).search( this.value ).draw();
    } );
    $('#filtr_miasto').on('change', function () {
    table.columns( $(this).parent().index()+':visible' ).search( this.value ).draw();
    } );
    $('#filtr_telefon').on( 'change', function () {
    table.columns( $(this).parent().index()+':visible' ).search( this.value ).draw();
    } );
    $('#filtr_email').on( 'change', function () {
    table.columns( $(this).parent().index()+':visible' ).search( this.value ).draw();
    } );
    $('#filtr_odleglosc').on( 'change', function () {
    table.columns( $(this).parent().index()+':visible' ).search( this.value ).draw();
    } );
    $('#btnSearch').click(function (){
        table.columns([1,2,3,4,5,7,9,10]).search('').draw();
       });

 
});
</script>

@endsection
