<?php

namespace App\Http\Controllers\Admin;

use App\Models\TaskType;
use App\Models\TypeTask;
use App\Http\Requests\StoreTaskTypeRequest;
use App\Http\Requests\UpdateTaskTypeRequest;
use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyTaskTypeRequest;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TaskTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        abort_if(Gate::denies('TaskType_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $TaskType = TaskType::all();
        $TypeTask = TypeTask::all();

        return view('admin.tasktype.index', compact('TaskType','TypeTask'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        abort_if(Gate::denies('TaskType_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $TypeTask =  TypeTask::all();
        return view('admin.tasktype.create',compact('TypeTask'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreTaskTypeRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTaskTypeRequest $request)
    {
        $TaskType = TaskType::create($request->all());
        $TaskType->TypeTask()->sync($request->input('TypeTask', []));
      //  toastr()->success( trans('global.store_success') );
        return redirect()->route('admin.tasktype.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\TaskType  $taskType
     * @return \Illuminate\Http\Response
     */
    public function show(TaskType $tasktype)
    {
        abort_if(Gate::denies('TaskType_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.tasktype.show', compact('tasktype'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\TaskType  $taskType
     * @return \Illuminate\Http\Response
     */
    public function edit(TaskType $tasktype)
    {
        abort_if(Gate::denies('TaskType_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');
       $TypeTask =  TypeTask::all();

        return view('admin.tasktype.edit', compact('TypeTask','tasktype'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateTaskTypeRequest  $request
     * @param  \App\Models\TaskType  $taskType
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTaskTypeRequest $request, TaskType $tasktype)
    {
        $tasktype->update($request->all());
        $tasktype->TypeTask()->sync($request->input('TypeTask', []));
        toastr()->success( trans('global.store_edit') );
        return redirect()->route('admin.tasktype.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TaskType  $taskType
     * @return \Illuminate\Http\Response
     */
    public function destroy(TaskType $tasktype)
    {
        abort_if(Gate::denies('TaskType_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $tasktype->delete();

        return back();
    }

    public function massDestroy(MassDestroyTaskTypeRequest $request)
    {
        TaskType::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
