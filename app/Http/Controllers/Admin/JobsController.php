<?php

namespace App\Http\Controllers\Admin;

use App\Models\Company;
use App\Models\TypeTask;
use App\Models\TaskType;
use App\Models\User;
use App\Models\Task;
use App\Models\Notification;
use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyJobRequest;
use App\Http\Requests\StoreJobRequest;
use App\Http\Requests\UpdateJobRequest;
use App\Models\Job;
use App\Models\Location;
use App\Models\Contracts;
use App\Models\TaskType_Pivot;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Auth;
use DB;
use Carbon\Carbon;
use Yajra\Datatables\Datatables;
class JobsController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('job_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $last = Job::count(); 
        $order = $request->order_filter;
        $rns = $request->rns_filter;
        $company = $request->company;
        $descriptions = $request->descriptions_filter;
        $start_date = $request->start_date_filter;
        $end_date = $request->end_date_filter;
        $task_name = $request->task_name;
        $task = $request->task;
        $users = $request->users;
        $paid = $request->paid_filter; 
        $contract = $request->contract_filter;   
        $comments = $request->comments_filter;   

        $filter_company = Company::all()->unique();
        $filter_task_name = TypeTask::all()->unique();
        $filter_contracts = Contracts::all()->unique();
        $filter_task = TaskType::all()->unique();
        $filter_user = user::all()->unique();
        $filter_tasktype = TaskType::all()->pluck('name')->unique();
        $user = Auth::user();
        
        $TypeTaskValue = TypeTask::where('id',$task_name)->first(); 
        $TaskTypeValue = TaskType::where('id',$task)->first(); 
        $CompanyValue = Company::where('id',$company)->first(); 
        $UserValue = User::where('id',$users)->first(); 
        $ContractValue = Contracts::where('id',$contract)->first(); 

        $jobs = Job::query();  
        $jobs = $jobs->where(function($query) use($descriptions, $order, $start_date,  $end_date, $paid, $rns, $company, $task_name, $task, $users, $contract, $comments){
            if (!empty($descriptions)) {
                $query->where('description', 'like', '%'.$descriptions.'%');
            }
            if (!empty($order)) {
                $query->where('order', 'like', '%'.$order.'%');
            }
            if (!empty($paid)) {
                $query->where('paid', 'like', '%'.$paid.'%');
            }
            if (!empty($rns)) {
                $query->where('rns', 'like', '%'.$rns.'%');
            }
            if (!empty($company)) {
                $query->where('fk_company', 'like', '%'.$company.'%');
            }
            if (!empty($task_name)) {
                $query->where('fk_typetask', 'like', '%'.$task_name.'%');
            }
            if (!empty($task)) {
                $query->where('fk_tasktype', 'like', '%'.$task.'%');
            }
            if (!empty($users)) {
                $query->where('fk_user', 'like', '%'.$users.'%');
            }
            if (!empty($contract)) {
                $query->where('fk_contract', 'like', '%'.$contract.'%');
            }
            if (!empty($comments)) {
                $query->where('comments', 'like', '%'.$comments.'%');
            }
            if (empty($start_date) && empty($end_date)) {
                $query->where('start_date', '>', Carbon::now()->subWeek());
            }
            elseif (!empty($start_date) && !empty($end_date)) {
                $query->whereBetween('start_date', [$start_date, $end_date]);
            }
            })->orderBy('id', 'DESC')->paginate(500);  
            
        return view('admin.jobs.index', compact('jobs','filter_tasktype','filter_company','filter_task_name','filter_task',
        'filter_user','order','rns','descriptions','start_date','end_date','users','task_name','TypeTaskValue','task','TaskTypeValue','company','CompanyValue','UserValue','paid','filter_contracts','contract','ContractValue'));
        
    }

    public function create()
    {
        abort_if(Gate::denies('job_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $job = Job::all();

        $job->load('company');

        $companies = Company::all();
        
        $user = Auth::user();
        $user_all = User::all();
        $TypeTask = TypeTask::all();
        $todayDate =  Carbon::now();
        $TaskType = TaskType::orderby("id","asc")
        ->select('id','name')->get();
        $list=TaskType_Pivot::all()->where('task_type_id','==',1);
        return view('admin.jobs.create', compact('companies','job','TaskType','TypeTask','user','user_all','todayDate','list'));
      

    }
    public function getTask($TypeTask)
    {       
        $empData['data'] = DB::select( DB::raw("SELECT type_task.id, type_task.name FROM task_type_type_task INNER JOIN type_task 
        ON task_type_type_task.type_task_id = type_task.id WHERE task_type_id = '$TypeTask'") );
        return response()->json($empData);
    }

    public function store(Request $request)
    {             
        $year = Carbon::now()->year;
        $last = DB::table('jobs')->distinct('order')->count('order');
        if($last == 0){
           $last=0;
        }
        else{
            $last;
        }

           $number_order=$last+1;

            $start_date = $request->input('start_date',[]);
            $end_date = $request->input('end_date',[]);
            $start = $request->input('start',[]);
            $end = $request->input('end',[]);
            $fk_typetask = $request->input('fk_typetask',[]);
            $description = $request->input('description',[]);
            $comments = $request->input('comments',[]);
            $value = $request->input('value',[]);
            $company =$request->input('fk_company');
            $contract = DB::table('companies')->where('id',  $company)->pluck('fk_contract')->first();

            $time1= strtotime(implode($start));          
            $time2= strtotime(implode($end));          
            $diff = $time2-$time1;
            $diff2 = date("H:i",  $diff);     
            
           
            foreach ($fk_typetask as $key => $value) {
                $start =$request->start[$key];
                $end =$request->end[$key];
                $time1= strtotime($start);          
                $time2= strtotime($end);          
                $diff = $time2-$time1;
                $diff2 = date("H:i",  $diff);
        
                $data = array(     
                    'fk_company' => $request->fk_company,
                    'fk_user' => $request->fk_user,
                    'rns' => $request->rns,
                    'fk_tasktype' => $request->fk_tasktype,
                    'paid' => $request->paid,
                    'location' => $request->location,
                    'fk_contract' =>  $contract,
                    'time' => $diff2,
                    'order' =>'CZK/'. $number_order. '/'. $year,
        
                    'fk_typetask' => $request->fk_typetask[$key],
                    'start_date' => $request->start_date[$key],
                    'end_date' => $request->end_date[$key],
                    'start' =>$request->start[$key],
                    'end' => $request->end[$key],
                    'description' =>$request->description[$key],
                    'comments' =>  $request->comments[$key],
                    'value'=> $request->value[$key],      
                );
                $created = Job::insert($data); 
             }  
         return redirect()->route('admin.jobs.index');
    }


    public function edit($id)
    {
        $job = Job::findOrFail($id);
        $companies = Company::all();
     
        $user_all = User::all();
        $TaskType = TaskType::all();
        $TypeTask = TypeTask::all();
        $jobi=$job->order;
        $Notification = Notification::all()
        ->where('order', '==', $jobi);
       
        $type_task_id=$job->fk_tasktype;        
        $jobs = Job::all()
        ->whereNull('description');
        $list=TaskType_Pivot::all()->where('task_type_id','==',$type_task_id);   

        return view('admin.jobs.edit', compact('companies','job','TaskType','TypeTask','user_all','jobs','list','type_task_id','Notification'));
    }
    public function editone($id)
    {
        $job = Job::findOrFail($id);
        $companies = Company::all();
   
        $user_all = User::all();
        $TaskType = TaskType::all();
        $TypeTask = TypeTask::all();    

        $jobi=$job->order;  
        $type_task_id=$job->fk_tasktype;       
        $jobs = Job::all()->where('order', '==', $jobi);
        $list=TaskType_Pivot::all()->where('task_type_id','==',$type_task_id);  
        return view('admin.jobs.editone', compact('companies','job','TaskType','TypeTask','user_all','jobs','list'));
    }


    public function update(Request $request, $id)
    {
    $company = $request->fk_company;
    $contract = DB::table('companies')->where('id',  $company)->pluck('fk_contract')->first();
    foreach ($request->id as $key => $value) {
        $start =$request->start[$key];
        $end =$request->end[$key];
        $time1= strtotime($start);          
        $time2= strtotime($end);          
        $diff = $time2-$time1;
        $diff2 = date("H:i",  $diff);
        $data = array(                
            'fk_company' => $request->fk_company,
            'fk_user' => $request->fk_user,
            'rns' => $request->rns,
            'fk_tasktype' => $request->fk_tasktype,
            'paid' => $request->paid,
            'location' => $request->location,
            'fk_contract' =>  $contract,
            'time' => $diff2,

            'fk_typetask' => $request->fk_typetask[$key],
            'start_date' => $request->start_date[$key],
            'end_date' => $request->end_date[$key],
            'start' =>$request->start[$key],
            'end' => $request->end[$key],
            'description' =>$request->description[$key],
            'comments' =>  $request->comments[$key],
            'value'=> $request->value[$key],                             
        );        
        Job::where('id',$request->id[$key])
        ->update($data);         
     }

     $description = $request->input('description_new',[]);
     $job = Job::findOrFail($id);
     $order=$job -> order;

    foreach ($description as $key => $value) {
        $start1 =$request->start_new[$key];
        $end1 =$request->end_new[$key];
        $time3= strtotime($start1);          
        $time4= strtotime($end1);          
        $diff1 = $time4-$time3;
        $diff3 = date("H:i",  $diff1);

        $data = array(     
            'fk_company' => $request->fk_company,
            'fk_user' => $request->fk_user,
            'rns' => $request->rns,
            'fk_tasktype' => $request->fk_tasktype,
            'paid' => $request->paid,
            'location' => $request->location,
            'fk_contract' =>  $contract,
            'time' => $diff3,
            'order' => $order,  

            'fk_typetask' => $request->fk_typetask_new[$key],
            'start_date' => $request->start_date_new[$key],
            'end_date' => $request->end_date_new[$key],
            'start' =>$request->start_new[$key],
            'end' => $request->end_new[$key],
            'description' => $request->description_new[$key],
            'comments' =>  $request->comments_new[$key],
            'value'=> $request->value_new[$key],      
        );
        
        if (!empty($description)) {
        $created = Job::insert($data);
        
    }   
     }  
     $user = Auth::user();
     $DateNow = Carbon::now();
     $Notification = new Notification([
        'user' => $user->id,
        'order' => $order,
        'date' => $DateNow,
    ]);
      $Notification->save();


       return redirect()->route('admin.jobs.index');
    }

    public function show(Job $job)
    {
        abort_if(Gate::denies('job_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $jobi=$job->order;
       
        $jobs = Job::all()
        ->where('order', '==', $jobi);
       
        $time = Job::where('order', $jobi)->sum(DB::raw("TIME_TO_SEC(time)/60"));
        $minsandsecs = date('i:s',$time);
        
        return view('admin.jobs.print', compact('job','jobs','minsandsecs'));
    }

    public function print(Job $job)
    {
        abort_if(Gate::denies('job_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $jobi=$job->order;
        $job->load('company');
        $time = DB::select("SELECT SEC_TO_TIME( SUM( TIME_TO_SEC( `time` ) ) ) AS total_time FROM job WHERE order == $jobi");
       
        return view('admin.jobs.print', compact('job','time'));
    }
    

    public function destroy($id)
    {
        abort_if(Gate::denies('job_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $job = Job::find($id);
      
        $job->delete();
        return back();
    }

    public function massDestroy(MassDestroyJobRequest $request)
    {
        Job::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function test(Request $request)

    {
        $startDate = Carbon::now()->subMonth(2);
        $endDate = date('Y-m-d');
        if ($request->ajax()) {
            $data = DB::table('jobs')
            ->join('companies', 'companies.id', '=', 'jobs.fk_company')
            ->join('task_type', 'task_type.id', '=', 'jobs.fk_tasktype')
            ->join('users', 'users.id', '=', 'jobs.fk_user')
            ->select('jobs.*', 'companies.shortcode','users.name','users.surname','task_type.name')
            ->whereBetween('jobs.start_date', [$startDate, $endDate]);
            return Datatables::of(Job::query())
            ->editColumn('fk_typetask', function ($job) {
                return '<a class="text-success" data-toggle="modal" id="mediumButton" data-target="#mediumModal"
                data-attr="'.url('/job/editone', $job->id).'">'.$job->fk_typetask.'</a>';
            })
            ->editColumn('order', function ($job) {
                return '<a class="text-success" data-toggle="modal" id="mediumButton" data-target="#mediumModal"
                data-attr="'.route('admin.jobs.edit', $job->id).'">'.$job->order.'</a>';
            })
            ->editColumn('fk_user', function ($job) {
                return  $job->user->surname.' '. $job->user->name;
            })
            ->editColumn('start_date', function ($job) {
                return  $job->start_date;
            })
            ->editColumn('end_date', function ($job) {
                return  $job->end_date;
            })
            ->editColumn('fk_tasktype', function ($job) {
                return  $job->task_type->name;
            })
            ->editColumn('fk_company', function ($job) {
                return  $job->company->shortcode;
            })
            
                ->addIndexColumn()
                ->rawColumns(['fk_typetask','order','fk_user','start_date','end_date','fk_tasktype'])
                ->order(function ($query) {
                    if (request()->has('order')) {
                        $query->orderBy('order', 'desc');
                    }
                })
                ->make(true);
        }            
        
        $filter_typetask = TypeTask::all()->pluck('name')->unique();
        $filter_tasktype = TaskType::all()->pluck('name')->unique();
        $filter_company = Company::all()->pluck('shortcode')->unique();
        $filter_user = User::all();     
        $user_all = User::all();
        return view('admin.jobs.test', compact('filter_user','filter_typetask','filter_tasktype','filter_company','user_all'));
        
    }

}


