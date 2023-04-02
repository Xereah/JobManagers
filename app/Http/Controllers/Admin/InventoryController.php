<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Computer;
use App\Models\Company;
use App\Models\EquipmentCategory;
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
        return view('admin.inventory.index');
    }
    
    public function drukarki()
    {
        return view('admin.inventory.create.drukarki');
    }

    public function fiskalne()
    {
        return view('admin.inventory.create.fiskalne');
    }
// -------------------------------------------------------------------------
    public function komputery()
    {
        $companies = Company::all();
        $computers = Computer::all();
        return view('admin.inventory.create.komputery',compact('companies','computers'));
    }
    public function store_komputery(Request $request)
    {
        $data = array(    
            'code'=>'Komputer_01', 
            'mark' => $request->mark,
            'model' =>  $request->model,
            'processor' => $request->processor,
            'hard_drive' => $request->hard_drive,
            'hard_drive_capacity' => $request->hard_drive_capacity,
            'fk_company' => $request->fk_company,
            'eq_type' =>  1,
            'ram' => $request->ram,
            'serial_number' => $request->serial_number,
    
        );
        $created = Computer::insert($data); 

        return redirect()->route('admin.inventory.index')
            ->with('success', 'Pomyślnie dodano nowy komputer.');



    }
// -------------------------------------------------------------------------
    public function monitory()
    {
        return view('admin.inventory.create.monitory');
    }

    public function notebooki()
    {
        return view('admin.inventory.create.notebooki');
    }

    public function ups()
    {
        return view('admin.inventory.create.ups');
    }

    public function pozostale()
    {
        return view('admin.inventory.create.pozostale');
    }


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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
