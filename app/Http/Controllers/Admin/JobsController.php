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
use Validator;
use Carbon\Carbon;
use Yajra\Datatables\Datatables;
class JobsController extends Controller
{
    public function index(Request $request)
    {
        $startDate = Carbon::now()->subMonth(12);
        $endDate = date('Y-m-d');
        if ($request->ajax()) {     
            return Datatables::of(Job::query()->orderBy('id', 'desc')
            ->whereBetween('jobs.start_date', [$startDate, $endDate]))
            ->editColumn('fk_typetask', function ($job) {
                $order_querry="SRW/";
                $pos = strpos($job->order, $order_querry);

                if($pos === false)
                return '<a class="text-dark font-weight-bold" data-toggle="tooltip" title="' . $job->description .'" href="'.route('admin.jobs.edit', $job->id).'">'.$job->type_task->name .'</a>';
                else
                return '<a class="text-dark font-weight-bold" data-toggle="tooltip" title="' . $job->description . '" href="'.route('admin.ConfirmSystem.edit', $job->id) . '">' . $job->type_task->name . '</a>';
            })
            ->editColumn('order', function ($job) {
                $order_querry="SRW/";
                $pos = strpos($job->order, $order_querry);

                if($pos === false)
                return '<a class="text-dark font-weight-bold" data-toggle="tooltip" title="' . $job->description .'" href="'.route('admin.jobs.edit', $job->id).'">'.$job->order .'</a>';
                else
                return '<a class="text-dark font-weight-bold" href="'.route('admin.ConfirmSystem.edit', $job->id) . '">' . $job->order . '</a>';
            })
            ->editColumn('fk_user', function ($job) {
                $zmienna1=$job->user->name;
                $zmienna2=$job->user->surname;
                $firstLetter1 = substr($zmienna1, 0, 1);
                $firstLetter2 = substr($zmienna2, 0, 1);
                return  $firstLetter1.''. $firstLetter2;  
            })
            ->editColumn('start_date', function ($job) {
                $poczatek = $job->start_date.' ' .$job->start;
                if(!(is_null($job->time)))
             //   return   date('Y-m-d G:i', strtotime($poczatek)) ;
             return  $job->start_date.' ' .date('G:i', strtotime($job->start));
                else
                return $job->start_date;              
            })
            ->editColumn('end_date', function ($job) {
                $koniec = $job->end_date.' ' .$job->end;
                if(!(is_null($job->time)))
               // return  date('Y-m-d G:i', strtotime($koniec)) ;
                return  $job->end_date.' ' .date('G:i', strtotime($job->end));
                else
                return  $job->end_date;
            })
            ->editColumn('fk_tasktype', function ($job) {
                return  $job->task_type->name;
            })
            ->editColumn('time', function ($job) {
               
               if(!(is_null($job->time)))
               return    date('G:i', strtotime($job->time));                     
            })
            ->editColumn('id', function ($job) {
                return  '';
            })
            ->editColumn('fk_company', function ($job) {
                return  $job->fk_company;
            })
            ->editColumn('comments', function ($job) {
                return  $job->comments;
            })
            ->editColumn('fk_contract', function ($job) {
                return  $job->contract->contract_name;
            })        
            ->editColumn('paid', function ($job) {
                if($job->paid==1)
                return  "Bezpłatne";
                else
                return "Płatne";
            })
            ->editColumn('description', function ($job) {
                if(!(is_null($job->description)))
                    return  '<div style="text-align:left; max-height: 75px; overflow: auto;">' . $job->description . '</div>';
                elseif(!(is_null($job->description_goods)))
                    return '<div style="text-align:left; max-height: 75px; overflow: auto;">' . $job->description_goods . '</div>';
                elseif(!(is_null($job->fk_rep_eq)))
                    return '<div style="text-align:left; max-height: 75px; overflow: auto;">' . $job->repeq->eq_number . ' ' . $job->repeq->eq_name . '</div>';
            })        
                ->addIndexColumn()
                ->rawColumns(['fk_typetask','order','fk_user','start_date','end_date','fk_tasktype','id','description'])
                ->make(true);
        }            
        
        $filter_typetask = TypeTask::all()->pluck('name')->unique();
        $filter_tasktype = TaskType::all()->pluck('name')->unique();
        $filter_company = Company::all()->pluck('kontrahent_kod')->unique();
        $filter_contract = Contracts::all()->pluck('contract_name')->unique();
        $filter_user = User::all();     
        $user_all = User::all();


        $filter_company = Company::all()->unique();
        $filter_task_name = TypeTask::all()->unique();
        $filter_contracts = Contracts::all()->unique();
        $filter_task = TaskType::all()->unique();
        $filter_user = user::all()->unique();
        $filter_tasktype = TaskType::all()->pluck('name')->unique();


        return view('admin.jobs.index', compact('filter_user','filter_typetask','filter_tasktype','filter_company','user_all','filter_contract',
        'filter_task_name','filter_task','filter_contracts'));
        
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
        $TaskType = TaskType::orderby("id","asc")->select('id','name')->get();
        $list=TaskType_Pivot::all()->where('task_type_id','==',1);
        return view('admin.jobs.create', compact('companies','job','TaskType','TypeTask','user','user_all','todayDate','list'));
      

    }
    public function getTask($TypeTask)
    {       
        $empData['data'] = DB::select( DB::raw("SELECT type_task.id, type_task.name FROM task_type_type_task INNER JOIN type_task 
        ON task_type_type_task.type_task_id = type_task.id WHERE task_type_id = '$TypeTask'") );
        return response()->json($empData);
    }

    private function generateOrderNumber()
    {
        $year = Carbon::now()->year;
        $lastOrder = DB::table('jobs')->orderBy('id', 'desc')->first();
        if (!$lastOrder || substr($lastOrder->order, -4) < $year) {
            $orderNumber = 1;
        } else {
            $orderNumber = intval(substr($lastOrder->order, 4, -5)) + 1;
        }
    
        return 'CZK/' . $orderNumber . '/' . $year;
    }

    private function saveNotification($user_id, $order_id) {
        $DateNow = Carbon::now();
        $Notification = new Notification([
            'user' => $user_id,
            'order' => $order_id,
            'date' => $DateNow,
        ]);
        $Notification->save();
    }
    
    private function getContractId($companyId)
    {
        $contractGroup = DB::table('kontrahenci')->where('kontrahent_id', $companyId)->pluck('kontrahent_grupa')->first();
    
        return DB::table('contracts')->where('contract_name', $contractGroup)->pluck('id')->first();
    }

    public function store(Request $request)
    {    
        try {
            $order = $this->generateOrderNumber();
            $contract = $this->getContractId($request->fk_company);

        
            $fk_typetask = $request->input('fk_typetask',[]);
            $description = $request->input('description',[]);
            $company =$request->input('fk_company');
            $company_place=DB::table('kontrahenci')->where('kontrahent_kod', 'KASPERKOMPUTERSPZOO')->pluck('kontrahent_id')->first();
       
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
                    'rns' => $request->rns[$key],
                    'fk_tasktype' => $request->fk_tasktype[$key],
                    'paid' => $request->paid[$key],
                    'location' => $company_place,
                    'fk_contract' =>  $contract,
                    'time' => $diff2,
                    'order' =>$order,
        
                    'fk_typetask' => $request->fk_typetask[$key],
                    'start_date' => $request->start_date[$key],
                    'end_date' => $request->end_date[$key],
                    'start' =>$request->start[$key],
                    'end' => $request->end[$key],
                    'description' =>$request->description[$key],    
                );
                if(!empty($description[$key]) && isset($request->start[$key]) && isset($request->end[$key])) { 
                $created = Job::insert($data); 
                }
             }  
         return redirect()->back()->with('success', 'Pomyślnie dodano nowe zadanie.'); 
        } catch (\Exception $e) {
            // Błąd podczas tworzenia nowego zadania
            return redirect()->back()->with('error', 'Nie udało się dodać nowego zadania. ' . $e->getMessage());
        }
    }


    public function edit($id)
    {
        $job = Job::findOrFail($id);
        $companies = Company::all();     
        $user_all = User::all();
        $TaskType = TaskType::all();
        $TypeTask = TypeTask::all();
        $jobi=$job->order;
        $Notification = Notification::all()->where('order', '==', $jobi);       
        $type_task_id=$job->fk_tasktype;        
        $jobs = Job::all()->where('order', '==', $jobi);
        $list=TaskType_Pivot::all();   

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
        $Notification = Notification::all()
        ->where('order', '==', $jobi);
        $jobs = Job::all()->where('order', '==', $jobi);
        $list=TaskType_Pivot::all()->where('task_type_id','==',$type_task_id);  
        return view('admin.jobs.editone', compact('companies','job','TaskType','TypeTask','user_all','jobs','list','Notification'));
    }


    public function update(Request $request, $id)
    {
 
    try {
    $description = $request->input('description',[]);  

    $company = $request->fk_company;
    $id_opis = $request->input('id_opis',[]);
    $contract = $this->getContractId($request->fk_company);

    $user = Auth::user();
    $DateNow = Carbon::now();
    
        if(!empty($request)){
            foreach ($description as $key => $value) {
                $start =$request->start[$key];
                $end =$request->end[$key];
                $time1= strtotime($start);          
                $time2= strtotime($end);          
                $diff = $time2-$time1;
                $diff2 = date("H:i",  $diff);
                $data = array(                
                    'fk_company' => $request->fk_company,
                    'fk_user' => $request->fk_user,
                    'rns' => $request->rns[$key],
                    'fk_tasktype' => $request->fk_tasktype[$key],
                    'paid' => $request->paid[$key],
                    'location' => 1,
                    'fk_contract' =>  $contract,
                    'time' => $diff2,
                    'fk_typetask' => $request->fk_typetask[$key],
                    'start_date' => $request->start_date[$key],
                    'end_date' => $request->end_date[$key],
                    'start' =>$request->start[$key],
                    'end' => $request->end[$key],
                    'description' =>$request->description[$key],                          
                );     
                
                    if(!empty($description[$key]) && isset($request->start[$key]) && isset($request->end[$key])) { 
                    Job::where('id',$id_opis[$key])->update($data);   
                    }    
             }
        
             $description_new = $request->input('description_new',[]);
             $job = Job::findOrFail($id);
             $order=$job -> order;
        
            foreach ($description_new as $key => $value) {
                $start1 =$request->start_new[$key];
                $end1 =$request->end_new[$key];
                $time3= strtotime($start1);          
                $time4= strtotime($end1);          
                $diff1 = $time4-$time3;
                $diff3 = date("H:i",  $diff1);
        
                $data = array(     
                
                    'order' => $order,  
                    'fk_company' => $request->fk_company,
                    'fk_user' => $request->fk_user,
                    'rns' => $request->rns_new[$key],
                    'fk_tasktype' => $request->fk_tasktype_new[$key],
                    'paid' => $request->paid_new[$key],
                    'location' => 1,
                    'fk_contract' =>  $contract,
                    'time' => $diff3,
                    'fk_typetask' => $request->fk_typetask_new[$key],
                    'start_date' => $request->start_date_new[$key],
                    'end_date' => $request->end_date_new[$key],
                    'start' =>$request->start_new[$key],
                    'end' => $request->end_new[$key],
                    'description' =>$request->description_new[$key],
                );       
                if(!empty($description_new[$key]) && isset($request->start_new[$key]) && isset($request->end_new[$key])) {           
                $created = Job::insert($data);        
                 }   
             }   

             $this->saveNotification($user->id, $order);
     }

    //    return redirect()->route('admin.jobs.index') ->with('success', 'Pomyślnie edytowano potwierdzenie.'); 
          return back()->with('success', 'Pomyślnie edytowano zadanie.'); 
        } catch (\Exception $e) {
            // Błąd podczas tworzenia nowego zadania
            return redirect()->back()->with('error', 'Nie udało się edytować zadania. ' . $e->getMessage());
        }
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
        $job_rder=$job->order; 
        
        $job->delete();
        return redirect()->route('admin.jobs.index')->with('success', 'Zlecenia zostały pomyślnie usunięte.');
    }

    public function massDestroy(MassDestroyJobRequest $request)
    {
        Job::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function search_index(Request $request)

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
        $CompanyValue = Company::where('kontrahent_id',$company)->first(); 
        $UserValue = User::where('id',$users)->first(); 
        $ContractValue = Contracts::where('id',$contract)->first(); 

        $jobs = Job::query();  
        $jobs = $jobs->where(function($query) use($descriptions, $order, $start_date,  $end_date, $paid, $rns, $company, $task_name, $task, $users, $contract, $comments){
            if (!empty($descriptions)) {
                $query->where('description', 'like', '%'.$descriptions.'%');
            }
            if (!empty($order)) {
                $query->where('order', '=',$order);
            }
            if (!empty($paid)) {
                $query->where('paid', '=',$paid);
            }
            if (!empty($rns)) {
                $query->where('rns',  '=',$rns);
            }
            if (!empty($company)) {
                $query->where('fk_company', '=', $company);
            }
            if (!empty($task_name)) {
                $query->where('fk_typetask', '=', $task_name);
            }
            if (!empty($task)) {
                $query->where('fk_tasktype', '=', $task);
            }
            if (!empty($users)) {
                $query->where('fk_user', '=', $users);
            }
            if (!empty($contract)) {
                $query->where('fk_contract',  '=', $contract);
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
            
            
        return view('admin.jobs.search', compact('jobs','filter_tasktype','filter_company','filter_task_name','filter_task',
        'filter_user','order','rns','descriptions','start_date','end_date','users','task_name','TypeTaskValue','task','TaskTypeValue','company','CompanyValue','UserValue','paid','filter_contracts','contract','ContractValue'));
        
    }

}


