<?php

namespace App\Http\Controllers\Admin;

use App\Models\TypeTask;
use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyTypeTaskRequest;
use App\Http\Requests\StoreTypeTaskRequest;
use App\Http\Requests\UpdateTypeTaskRequest;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TypeTaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        abort_if(Gate::denies('TypeTask_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $typetask = TypeTask::all();

        return view('admin.typetask.index', compact('typetask'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        abort_if(Gate::denies('TypeTask_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.typetask.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreTypeTaskRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTypeTaskRequest $request)
    {
        $typetask = TypeTask::create($request->all());
       
        return redirect()->route('admin.typetask.index')->with('success', 'Pomyślnie dodano typ zadania.');
    }

    public function storeTask(StoreTypeTaskRequest $request)
    {
        $typetask = TypeTask::create($request->all());
       
        return back()->with('success', 'Pomyślnie dodano typ zadania.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\TypeTask  $typeTask
     * @return \Illuminate\Http\Response
     */
    public function show(TypeTask $typetask)
    {
        abort_if(Gate::denies('TypeTask_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.typetask.show', compact('typetask'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\TypeTask  $typeTask
     * @return \Illuminate\Http\Response
     */
    public function edit(TypeTask $typetask)
    {
        abort_if(Gate::denies('TypeTask_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        
        return view('admin.typetask.edit', compact('typetask'))->with('success', 'Pomyślnie edytowano typ zadania.');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateTypeTaskRequest  $request
     * @param  \App\Models\TypeTask  $typeTask
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTypeTaskRequest $request, TypeTask $typetask)
    {
        $typetask->update($request->all());
        toastr()->success( trans('global.store_edit') );
        return redirect()->route('admin.typetask.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TypeTask  $typeTask
     * @return \Illuminate\Http\Response
     */
    public function destroy(TypeTask $typetask)
    {
        abort_if(Gate::denies('TypeTask_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $typetask->delete();

        return back()->with('success', 'Pomyślnie usunięto typ zadania.');
    }

    public function massDestroy(MassDestroyTypeTaskRequest $request)
    {
        TypeTask::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

}
