<?php

namespace App\Http\Controllers\Admin;

use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Controllers\Controller;
use App\Models\RepEquipment;
use App\Models\EquipmentCategory;
use App\Models\Company;
use App\Models\Job;
use DB;
use Carbon\Carbon;
class RepEquipmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        abort_if(Gate::denies('equipment_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $RepEquipment = RepEquipment::all();

        return view('admin.repequipment.index',compact('RepEquipment'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        abort_if(Gate::denies('equipment_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $RepEquipment = RepEquipment::all();
        $EquipmentCategory= EquipmentCategory::all();
        $Company= Company::all();
        return view('admin.repequipment.create',compact('RepEquipment','EquipmentCategory','Company'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $RepEquipment = RepEquipment::create($request->all());
        return redirect()->route('admin.repequipment.index') ->with('success', 'Pomyślnie dodano nowe urządzenie.'); 
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        abort_if(Gate::denies('equipment_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.repequipment.show');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        abort_if(Gate::denies('equipment_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $RepEquipment = RepEquipment::findOrFail($id);
        $EquipmentCategory= EquipmentCategory::all();
        $Company= Company::all();
        return view('admin.repequipment.edit', compact('RepEquipment','EquipmentCategory','Company'));
    }

    public function is_loan($id)
    {
        abort_if(Gate::denies('equipment_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $company_place=DB::table('kontrahenci')->where('kontrahent_kod', 'KASPERKOMPUTER')->pluck('id')->first();
        $now = Carbon::now();
        $data =array(
            'entry_date' => $now,
            'comments' => 'Przebywa na serwisie KK',
            'company_place' => $company_place,
            'is_loan' =>0,
         );
         $created = RepEquipment::where('id',$id)->update($data);
        return back()->with('success', 'Pomyślnie dokonano zwrotu sprzętu na serwis.'); 
    }


    public function is_loan_delete($id)
    {
        abort_if(Gate::denies('equipment_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $company_place=DB::table('kontrahenci')->where('kontrahent_kod', 'KASPERKOMPUTER')->pluck('id')->first();
        $id_delete=DB::table('jobs')->where('id',$id)->pluck('fk_rep_eq')->last();

        $now = Carbon::now();
        $data =array(
            'entry_date' => $now,
            'comments' => 'Przebywa na serwisie KK',
            'company_place' => $company_place,
            'is_loan' =>0,
         );
         $created = RepEquipment::where('id',$id_delete)->update($data); 
         $job = Job::find($id);      
         $job->delete();
         return redirect()->route('admin.jobs.index')->with('success', 'Pomyślnie dokonano zwrotu sprzętu na serwis.');
    }

    public function delete($id)
    {
        abort_if(Gate::denies('equipment_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

         $job = Job::find($id);      
         $job->delete();
         return redirect()->route('admin.jobs.index')->with('success', 'Zlecenia zostało pomyślnie usunięte.');
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
        $RepEquipment = RepEquipment::findOrFail($id);
        $RepEquipment->update($request->all());
       
        return redirect()->route('admin.repequipment.index')->with('success', 'Pomyślnie edytowano urządzenie.'); 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        abort_if(Gate::denies('equipment_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $RepEquipment = RepEquipment::findOrFail($id);
        $RepEquipment->delete();
        return back();
    }
}
