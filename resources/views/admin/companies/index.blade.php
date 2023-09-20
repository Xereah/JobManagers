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
               <th><input id="filtr_kod_pocztowy" class="form-control" /></th>
               <th><input id="filtr_nip" class="form-control" /></th>
               <th><input id="filtr_umowa" class="form-control" /></th>
               <th><input id="filtr_email" class="form-control" /></th>   
                
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
                            {{ trans('cruds.company.fields.zipcode') }}
                        </th>
                        <th>
                            {{ trans('cruds.company.fields.nip') }}
                        </th>
                        <th>
                            {{ trans('cruds.company.fields.contract') }}
                        </th>
                        <th>
                            {{ trans('cruds.company.fields.email') }}
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
                                {{ $company->kontrahent_kodpocztowy?? '' }}
                            </td>  
                            <td>
                                {{ $company->kontrahent_nip?? '' }}
                            </td>   
                            <td>
                                {{ $company->kontrahent_grupa ?? '' }}
                            </td>                
                            <td>
                                {{ $company->kontrahent_email ?? '' }}
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
$('#btnSearch').click(function (){
        $('#filtr_akronim, #filtr_nazwa, #filtr_ulica, #filtr_umowa, #filtr_kod, #filtr_miasto, #filtr_telefon, #filtr_email, #filtr_kod_pocztowy','filtr_nip').val('');
        table.columns([1,2,3,4,5,6,7,8]).search('').draw();
    });
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
        table.columns( $(this).parent().index()+':visible' ).search( this.value ).draw();
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
    $('#filtr_kod_pocztowy').on( 'change', function () {
    table.columns( $(this).parent().index()+':visible' ).search( this.value ).draw();
    } );
    $('#filtr_nip').on( 'change', function () {
    table.columns( $(this).parent().index()+':visible' ).search( this.value ).draw();
    } );
 
});
</script>

@endsection
