<?php

namespace App\Http\Controllers\Admin;
use Auth;
use App\Models\Task;
use App\Models\Company;
use App\Models\Event;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Carbon\Carbon;
class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $tasks = Task::all();
        $user = Auth::user();

        return view('admin.tasks.index', compact('tasks','user'));
    }

    public function calendar(Request $request)
    {
        $tasks = Task::all();
        $user = Auth::user();
        $companies = Company::all(); 
        if($request->ajax()) {   
            $data = Event::whereDate('start', '>=', $request->start)
                      ->whereDate('end',   '<=', $request->end)
                      ->get(['id', 'title', 'start', 'end']);
            return response()->json($data);
       }

        return view('admin.tasks.calendar', compact('tasks','user','companies'));
    }

    public function ajax(Request $request)

    {
        $company =$request->input('fk_company');
        $contract = DB::table('kontrahenci')->where('kontrahent_id',  $company)->pluck('kontrahent_grupa')->first();
        $now = Carbon::now();
        $user = Auth::user();

        switch ($request->type) {
           case 'add':
              $event = Event::create([
                  'title' => $request->title,
                  'start' => $request->start,
                  'end' => $request->end,
                  'fk_company' =>  $company,
                  'fk_contract' => $contract,
                  'fk_user' => $user->id,
                  'completed' =>  0,
              ]);
              return response()->json($event);
             break;

           case 'update':
              $event = Event::find($request->id)->update([
                  'title' => $request->title,
                  'start' => $request->start,
                  'end' => $request->end,
              ]);
              return response()->json($event);
             break;
           case 'delete':
              $event = Event::find($request->id)->delete();
              return response()->json($event);
             break;   
           default:
             # code...
             break;
        }

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   
        $companies = Company::all();
        $user = Auth::user();
        $user_all = User::all();
        return view('admin.tasks.create', compact('companies','user','user_all'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $company =$request->input('fk_company');
        $contract = DB::table('kontrahenci')->where('kontrahent_id',  $company)->pluck('kontrahent_grupa')->first();
        $now = Carbon::now();
        $data = array(     
            'task_title' => $request->task_title,
            'fk_company' =>  $company,
            'fk_contract' => $contract,
            'fk_user' => $request->fk_user,
            'created_at' =>$now,
            'execution_user' => $request->execution_user,
            'completed' =>  0,
    
        );
        $created = Task::insert($data); 

        return redirect()->route('admin.tasks.index')
            ->with('success', 'Pomyślnie dodano zadanie.');
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
        $task = Task::findOrFail($id);
        $user = Auth::user();
        $companies = Company::all();
        $user_all = User::all();
        return view('admin.tasks.edit', compact('task','user','companies','user_all'));
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
        $task = Task::findOrFail($id);
        // $task->update($request->all());
        $company =$request->input('fk_company');
        $contract = DB::table('kontrahenci')->where('kontrahent_id',  $company)->pluck('kontrahent_grupa')->first();
        $now = Carbon::now();

        $data = array(     
            'task_title' => $request->task_title,
            'fk_company' =>  $request->fk_company,
            'fk_contract' => $contract,
            'execution_date' =>$request->execution_date,
            'execution_user' => $request->execution_user,
            'completed' =>  $request->completed,
    
        );
        $created =Task::where('id',$id)->update($data); 

      

        return redirect()->route('admin.tasks.index')
        ->with('success', 'Pomyślnie zaktualizowano zadanie.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $task = Task::findOrFail($id);
        $task->delete();
        return back()->with('success', 'Pomyślnie usunięto zadanie.');
    }

    public function is_done($id)
    {      
        $user = Auth::user();
        $DateNow = Carbon::now();
        $data =array(
          
            'execution_user' => $user->id,
            'execution_date' => $DateNow,
            'completed' =>1,
         );
         $created = Task::where('id',$id)->update($data);
        return back();
    }
}
