<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Inventory;
use App\Models\Company;
use App\Models\EquipmentCategory;
use DB;
use Symfony\Component\HttpFoundation\Response;

class InventoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $companies = Company::all();
        $computers = Inventory::all();
        
        return view('admin.inventory.index',compact('companies','computers'));
    }
// -------------------------------------------------------------------------
    public function drukarki()
    {
        $companies = Company::all();
        return view('admin.inventory.create.drukarki',compact('companies'));
    }

    public function store_drukarki(Request $request)
    {
        $company =$request->input('fk_company');
        $shortocde = DB::table('companies')->where('id',  $company)->pluck('shortcode')->first();
        
        $Rodzaj = 2;
        $count = DB::table('inventory')
        ->where('fk_company', '=', $company )
        ->where('eq_type', '=', $Rodzaj )
        ->count('id');

        if($count == 0){ $count=0;} else{$count;}
        $numberid=$count+1;
        
        $data = array(    
            'code'=>$shortocde.'_'.'DRUKARKI'.'_'.$numberid, 
            'mark' => $request->mark,
            'model' =>  $request->model,
            'fk_company' => $request->fk_company,
            'eq_type' =>  $Rodzaj,
            'serial_number' => $request->serial_number,    
        );
        $created = Inventory::insert($data); 
        return redirect()->route('admin.inventory.index')->with('success', 'Pomyślnie dodano nową drukarkę.');
    }
// -------------------------------------------------------------------------
    public function fiskalne()
    {
        $companies = Company::all();
        return view('admin.inventory.create.fiskalne',compact('companies'));
    }

    public function store_fiskalne(Request $request)
    {
        $company =$request->input('fk_company');
        $shortocde = DB::table('companies')->where('id',  $company)->pluck('shortcode')->first();
        $Rodzaj = 4;
        $count = DB::table('inventory')
        ->where('fk_company', '=', $company )
        ->where('eq_type', '=', $Rodzaj )
        ->count('id');

        if($count == 0){ $count=0;} else{$count;}
        $numberid=$count+1;
        
        $data = array(    
            'code'=>$shortocde.'_'.'FISKALNE'.'_'.$numberid, 
            'mark' => $request->mark,
            'model' =>  $request->model,
            'fk_company' => $request->fk_company,
            'eq_type' =>   $Rodzaj,
            'serial_number' => $request->serial_number,    
        );
        $created = Inventory::insert($data); 
        return redirect()->route('admin.inventory.index')->with('success', 'Pomyślnie dodano nową fiskalną.');
    }
// -------------------------------------------------------------------------
    public function komputery()
    {
        $companies = Company::all();
        $computers = Inventory::all();
        return view('admin.inventory.create.komputery',compact('companies','computers'));
    }
    public function store_komputery(Request $request)
    {

        $company =$request->input('fk_company');
        $shortocde = DB::table('companies')->where('id',  $company)->pluck('shortcode')->first();
        $Rodzaj = 1;
        $count = DB::table('inventory')
        ->where('fk_company', '=', $company )
        ->where('eq_type', '=', $Rodzaj )
        ->count('id');

        if($count == 0){ $count=0;} else{$count;}
        $numberid=$count+1;

        $data = array(    
             'code'=>$shortocde.'_'.'KOMPUTERY'.'_'.$numberid, 
            'mark' => $request->mark,
            'model' =>  $request->model,
            'processor' => $request->processor,
            'hard_drive' => $request->hard_drive,
            'hard_drive_capacity' => $request->hard_drive_capacity,
            'fk_company' => $request->fk_company,
            'eq_type' =>  $Rodzaj,
            'ram' => $request->ram,
            'serial_number' => $request->serial_number,
    
        );
        $created = Inventory::insert($data); 

        return redirect()->route('admin.inventory.index')
            ->with('success', 'Pomyślnie dodano nowy komputer.');
    }
    public function edit_pc($id)
    {
        $companies = Company::all();
        $inventory = Inventory::findOrFail($id);
        $hard_drive_value = $inventory->hard_drive;
        $hard_drive_capacity = $inventory->hard_drive_capacity;
        return view('admin.inventory.edit_pc', compact('companies','inventory','hard_drive_value','hard_drive_capacity'));
    }
// -------------------------------------------------------------------------
    public function monitory()
    {
        $companies = Company::all();
        return view('admin.inventory.create.monitory',compact('companies'));
    }
    public function store_monitory(Request $request)
    {
        $company =$request->input('fk_company');
        $shortocde = DB::table('companies')->where('id',  $company)->pluck('shortcode')->first();
        $Rodzaj = 5;
        $count = DB::table('inventory')
        ->where('fk_company', '=', $company )
        ->where('eq_type', '=', $Rodzaj )
        ->count('id');

        if($count == 0){ $count=0;} else{$count;}
        $numberid=$count+1;
        
        $data = array(    
            'code'=>$shortocde.'_'.'MONITORY'.'_'.$numberid, 
            'mark' => $request->mark,
            'model' =>  $request->model,
            'fk_company' => $request->fk_company,
            'eq_type' =>  $Rodzaj,
            'serial_number' => $request->serial_number,    
        );
        $created = Inventory::insert($data); 
        return redirect()->route('admin.inventory.index')->with('success', 'Pomyślnie dodano nowy monitor.');
    }
// -------------------------------------------------------------------------
public function siec()
{
    $companies = Company::all();
    return view('admin.inventory.create.siec',compact('companies'));
}
public function store_siec(Request $request)
{
    $company =$request->input('fk_company');
    $shortocde = DB::table('companies')->where('id',  $company)->pluck('shortcode')->first();
    $Rodzaj = 7;
    $count = DB::table('inventory')
    ->where('fk_company', '=', $company )
    ->where('eq_type', '=', $Rodzaj )
    ->count('id');

    if($count == 0){ $count=0;} else{$count;}
    $numberid=$count+1;
    
    $data = array(    
        'code'=>$shortocde.'_'.'SIEĆ'.'_'.$numberid, 
        'mark' => $request->mark,
        'model' =>  $request->model,
        'fk_company' => $request->fk_company,
        'eq_type' =>  $Rodzaj,
        'serial_number' => $request->serial_number,    
    );
    $created = Inventory::insert($data); 
    return redirect()->route('admin.inventory.index')->with('success', 'Pomyślnie dodano nowy monitor.');
}
// -------------------------------------------------------------------------
    public function notebooki()
    {
        $companies = Company::all();
        return view('admin.inventory.create.notebooki',compact('companies'));
    }
    public function store_notebooki(Request $request)
    {
        $company =$request->input('fk_company');
        $shortocde = DB::table('companies')->where('id',  $company)->pluck('shortcode')->first();
        $Rodzaj = 6;
        $count = DB::table('inventory')
        ->where('fk_company', '=', $company )
        ->where('eq_type', '=', $Rodzaj )
        ->count('id');

        if($count == 0){ $count=0;} else{$count;}
        $numberid=$count+1;
        
        $data = array(    
            'code'=>$shortocde.'_'.'NOTEBOOK'.'_'.$numberid, 
           'mark' => $request->mark,
           'model' =>  $request->model,
           'processor' => $request->processor,
           'hard_drive' => $request->hard_drive,
           'hard_drive_capacity' => $request->hard_drive_capacity,
           'fk_company' => $request->fk_company,
           'eq_type' =>  6,
           'ram' => $request->ram,
           'serial_number' => $request->serial_number,
   
       );
        $created = Inventory::insert($data); 
        return redirect()->route('admin.inventory.index')->with('success', 'Pomyślnie dodano nowy notebook.');
    }
// -------------------------------------------------------------------------
    public function ups()
    {
        $companies = Company::all();
        return view('admin.inventory.create.ups',compact('companies'));
    }
    public function store_ups(Request $request)
    {
        $company =$request->input('fk_company');
        $shortocde = DB::table('companies')->where('id',  $company)->pluck('shortcode')->first();
        $Rodzaj = 3;
        $count = DB::table('inventory')
        ->where('fk_company', '=', $company )
        ->where('eq_type', '=', $Rodzaj )
        ->count('id');

        if($count == 0){ $count=0;} else{$count;}
        $numberid=$count+1;
        
        $data = array(    
            'code'=>$shortocde.'_'.'UPS'.'_'.$numberid, 
            'mark' => $request->mark,
            'model' =>  $request->model,
            'fk_company' => $request->fk_company,
            'eq_type' =>  3,
            'serial_number' => $request->serial_number,    
        );
        $created = Inventory::insert($data); 
        return redirect()->route('admin.inventory.index')->with('success', 'Pomyślnie dodano nowy UPS.');
    }
// -------------------------------------------------------------------------
    public function pozostale()
    {
        $companies = Company::all();
        return view('admin.inventory.create.pozostale',compact('companies'));
    }
    public function store_pozostale(Request $request)
    {
        $company =$request->input('fk_company');
        $shortocde = DB::table('companies')->where('id',  $company)->pluck('shortcode')->first();
        $Rodzaj = 8;
        $count = DB::table('inventory')
        ->where('fk_company', '=', $company )
        ->where('eq_type', '=', $Rodzaj )
        ->count('id');

        if($count == 0){ $count=0;} else{$count;}
        $numberid=$count+1;

        $data = array(    
            'code'=>$shortocde.'_'.'POZOSTALE'.'_'.$numberid, 
            'mark' => $request->mark,
            'model' =>  $request->model,
            'fk_company' => $request->fk_company,
            'eq_type' =>  8,
            'serial_number' => $request->serial_number,    
        );
        $created = Inventory::insert($data); 
        return redirect()->route('admin.inventory.index')->with('success', 'Pomyślnie dodano pozostałe urządzenie.');
    }
// -------------------------------------------------------------------------
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $companies = Company::all();
        $inventory = Inventory::findOrFail($id);

        return view('admin.inventory.edit', compact('companies','inventory'));
    }



    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $inventory = Inventory::findOrFail($id);
        $inventory->update($request->all());
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $inventory = Inventory::find($id);      
        $inventory->delete();
        return back();
    }
}
