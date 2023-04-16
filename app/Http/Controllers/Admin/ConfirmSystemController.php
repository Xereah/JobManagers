<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Contracts;
use App\Models\Company;
use App\Models\User;
use App\Models\Car;
use App\Models\TypeTask;
use App\Models\TaskType;
use App\Models\Job;
use App\Models\Task;
use App\Models\RepEquipment;
use App\Models\Notification;
use DB;
use Auth;
use Gate;
use PDF;
use Carbon\Carbon;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Mail;
use Illuminate\Mail\Message;
use Illuminate\Queue\SerializesModels;
use App\Http\Requests\StoreConfirmSystem;

class ConfirmSystemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $companies = Company::orderby("shortcode","asc")
         ->select('id','shortcode')
         ->get();
         $user = Auth::user();
         $user_all = User::all()->unique();
         $TypeTask = TypeTask::all();
         $car = Car::all();
         $repEquipment=RepEquipment::all()->where('is_loan','!=',1);
         $TaskType = TaskType::orderby("id","asc")
         ->select('id','name')->get();
        return view('admin.confirmsystem.index', compact('companies','user','user_all','TypeTask','TaskType','car','repEquipment'));
    }

    public function getEmployees($company=0){        
        $empData['data'] = DB::table('companies')
           ->select('id','name','distance', DB::raw("CONCAT(companies.location,' ',companies.street) AS adress"))        
           ->where('id',$company)
           ->get();   
        return response()->json($empData);   
      }

      public function getTask($TypeTask=0)
      {       
          $empData['data'] = DB::select( DB::raw("SELECT type_task.id, type_task.name FROM task_type_type_task INNER JOIN type_task 
          ON task_type_type_task.type_task_id = type_task.id WHERE task_type_id = '$TypeTask'") );
          return response()->json($empData);
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
    public function store(StoreConfirmSystem $request)
    {   

        $request->validate([  
            'description.*' => 'required',
            'start.*' => 'required',
            'end.*' => 'required',
              ], 
            [  
            'description.*.required' => 'Pole Opis jest wymagane',
            'start.*.required' => 'Pole Początek jest wymagane',
            'end.*.required' => 'Pole Koniec jest wymagane',
             ]);

    

            $year = Carbon::now()->year;
            $now = Carbon::now();
            $last = DB::table('jobs')->distinct('order')->count('order');
            if($last == 0){$last=0;}
            else{$last;}
            $number_order=$last+1;
     
            $start = $request->input('start',[]);
            $end = $request->input('end',[]);
            $fk_typetask = $request->input('fk_typetask',[]);
            $description = $request->input('description',[]);  
            $użytkownik = $request->input('fk_user',[]);   
            $description_goods = $request->input('description_goods',[]);  
            $fk_rep_eq = $request->input('fk_rep_eq',[]);
            $description_eq = $request->input('description_eq',[]);               
            $company =$request->input('fk_company');
            $contract = DB::table('companies')->where('id',  $company)->pluck('fk_contract')->first();
            $usługi = DB::table('task_type')->where('name', 'Usługi(U)')->pluck('id')->first();
            $towary = DB::table('task_type')->where('name', 'Towary(T)')->pluck('id')->first();
            $slugi_typ = DB::table('type_task')->where('name', 'Serwis sprzętu komputerowego')->pluck('id')->first();
            $location = DB::table('companies')->where('id',  $company)->pluck('id')->first();
            $sprzęt_zast= DB::table('task_type')->where('name',  'Sprzęt zastępczy(SZ)')->pluck('id')->first();
            $user_auth = Auth::user();
            $comments1 = $request->comments[0];

            $time1= strtotime(implode($start));          
            $time2= strtotime(implode($end));          
            $diff = $time2-$time1;
            $diff2 = date("H:i",  $diff);   
                       
            foreach ($description as $key => $value) {
                $start =$request->start[$key];
                $end =$request->end[$key];
                $time1= strtotime($start);          
                $time2= strtotime($end);          
                $diff = $time2-$time1;
                $diff2 = date("H:i",  $diff);
        
                $data = array(    
                    'fk_company' => $request->fk_company,
                    'fk_car' => $request->fk_car,
                    'start_car' =>$request->start_car,
                    'end_car' => $request->start_car,
                    'paid' => $request->paid,
                    'start_date' => $request->start_date,
                    'end_date' => $request->start_date,
                    'start' =>$request->start[$key],
                    'fk_tasktype' =>  $usługi,
                    'end' => $request->end[$key],
                    'fk_typetask' =>  $request->fk_typetask[$key],
                    'fk_user' =>  $request->fk_user[$key],
                    'fk_contract' =>  $contract,
                    'location' =>$location,
                    'time' => $diff2,
                    'order' =>'SRW/'. $number_order. '/'. $year,
                    'description' =>$request->description[$key],
                    'comments' => $comments1,                
                );  
               

                if (!empty($description_goods[$key])){
                    foreach ($description_goods as $key => $value) {
                    $data1 = array(    
                        'fk_company' => $request->fk_company,
                        'fk_car' => $request->fk_car,
                        'start_car' =>$request->start_car,
                        'end_car' => $request->start_car,
                        'paid' => $request->paid,
                        'start_date' => $request->start_date,
                        'end_date' => $request->start_date,
                        'fk_tasktype' =>  $towary,
                        'fk_typetask' =>  $slugi_typ,
                        'fk_contract' =>  $contract,
                        'fk_user' =>  $request->fk_user[$key],
                        'order' =>'SRW/'. $number_order. '/'. $year,
                        'description_goods' =>$description_goods[$key],
                    ); 
                   
                    $created = Job::insert($data1); 
                }
            }
                
                if (!empty($fk_rep_eq[$key])){
                    foreach ($fk_rep_eq as $key => $value) {
                $data2 = array(    
                    'fk_company' => $request->fk_company,
                    'fk_car' => $request->fk_car,
                    'start_car' =>$request->start_car,
                    'end_car' => $request->start_car,
                    'paid' => $request->paid,
                    'start_date' => $request->start_date,
                    'end_date' => $request->start_date,
                    'fk_tasktype' =>  $sprzęt_zast,
                    'fk_contract' =>  $contract,
                    'fk_typetask' =>  $slugi_typ,
                    'fk_user' =>  $request->fk_user[$key],
                    'order' =>'SRW/'. $number_order. '/'. $year,
                    'fk_rep_eq' =>$fk_rep_eq[$key],
                    'description_eq'=>$description_eq[$key],
                ); 
              
                 $created = Job::insert($data2); 

                 $data3 =array(
                    'entry_date' => $now,
                    'comments' => $description_eq[$key],
                    'company_place' =>$request->fk_company,
                    'is_loan' =>1,
                 );
                 $created = RepEquipment::where('id',$fk_rep_eq[$key])->update($data3);                 
            }      
        }    
        if (!empty($request->comments[$key])) {
            $comments = explode("\n", $request->comments[$key]);
            foreach ($comments as $comment) {
                $data4 = array(
                    'fk_user' =>  $user_auth->id,
                    'fk_company' => $request->fk_company,
                    'task_title' => trim($comment),
                    'execution_user' => $user_auth->id,
                    'fk_contract' => $contract,
                    'completed' => 0,
                    'created_at' => $now,
                );
               
                $created = Task::insert($data4);
            }
        }     
                $created = Job::insert($data);                      
            };
             
            $last_id = DB::table('jobs')->whereNull('deleted_at')->pluck('id')->last();

             return redirect(url('admin/ConfirmSystem/'. $last_id.'/edit'))->with('success', 'Pomyślnie dodano nowe potwierdzenie.'); 
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        abort_if(Gate::denies('job_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $job = Job::findOrFail($id);
        $jobi=$job->order;      
       
        $time = Job::where('order', $jobi)->sum(DB::raw("TIME_TO_SEC(time)/60"));
        $minsandsecs = date('i:s',$time);

        $jobs = Job::all()
        ->where('order', '==', $jobi)
        ->wherenotNull('description');

        $jobs_towary = Job::all()
        ->where('order', '==', $jobi)
        ->wherenotNull('description_goods');

        $jobs_sprzetzast = Job::all()
        ->where('order', '==', $jobi)
        ->wherenotNull('fk_rep_eq');
        $company = $job->fk_company;
        $company_km = DB::table('companies')->where('id',  $company)->pluck('distance')->first();
        
        return view('admin.confirmsystem.print', compact('job','jobs','minsandsecs','jobs_towary','jobs_sprzetzast','company_km'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $job = Job::findOrFail($id);
        $companies = Company::all();
        $car = Car::all();
        $user = Auth::user();
        $user_all = User::all();
        $repEquipment=RepEquipment::all();
        $TaskType = TaskType::all();
        $TypeTask = TypeTask::all();
        $jobi=$job->order;
        $jobi_loan=$job->fk_company;
        $Notification = Notification::all()
        ->where('order', '==', $jobi);
       
       // $type_task_id=$job->fk_tasktype;        
        $jobs = Job::all()
        ->where('order', '==', $jobi)
        ->wherenotNull('description');

        $jobs_towary = Job::all()
        ->where('order', '==', $jobi)
        ->wherenotNull('description_goods');

        $jobs_sprzetzast = Job::all()
        ->where('order', '==', $jobi)
        ->wherenotNull('fk_rep_eq');
        
        $repEquipment_loan=RepEquipment::all()->where('company_place', '==', $jobi_loan);
        $repEquipment_loan_add=RepEquipment::all()->where('is_loan','!=',1);
        return view('admin.confirmsystem.edit', compact('companies','job','TaskType','TypeTask','user_all','jobs','Notification','car','user','repEquipment',
        'jobs_towary','jobs_sprzetzast','repEquipment_loan','repEquipment_loan_add'));
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

        $validatedData = $request->validate([
            'description' => 'required',
        ]);

        $last = DB::table('jobs')->distinct('order')->count('order');
        if($last == 0){$last=0;}
        else{$last;}
        $number_order=$last+1;
        $now = Carbon::now();
        $start = $request->input('start',[]);
        $end = $request->input('end',[]);
        $fk_typetask = $request->input('fk_typetask',[]);
        $description = $request->input('description',[]);  
        $użytkownik = $request->input('fk_user');  
        $description_goods = $request->input('description_goods',[]);  
        $fk_rep_eq = $request->input('fk_rep_eq',[]);   
        $description_equipment = $request->input('description_eq',[]);             
        $company =$request->input('fk_company');
        $contract = DB::table('companies')->where('id',  $company)->pluck('fk_contract')->first();
        $usługi = DB::table('task_type')->where('name', 'Usługi(U)')->pluck('id')->first();
        $towary = DB::table('task_type')->where('name', 'Towary(T)')->pluck('id')->first();
        $slugi_typ = DB::table('type_task')->where('name', 'Serwis sprzętu komputerowego')->pluck('id')->first();
        $location = DB::table('companies')->where('id',  $company)->pluck('id')->first();
        $sprzęt_zast= DB::table('task_type')->where('name',  'Sprzęt zastępczy(SZ)')->pluck('id')->first();
        $order = $request->input('order');
        $user_order = $request->input('user_order');
        $user_auth = Auth::user();

        $time1= strtotime(implode($start));          
        $time2= strtotime(implode($end));          
        $diff = $time2-$time1;
        $diff2 = date("H:i",  $diff); 
        $comments1 = $request->comments[0];
        $job = Job::findOrFail($id);

        foreach ($description as $key => $value) 
        {
            $id_opis = $request->input('id_opis',[]);
            $id_sprzet = $request->input('id_sprzet',[]);
            $id_towar = $request->input('id_towar',[]);
            $start =$request->start[$key];
            $end =$request->end[$key];
            $time1= strtotime($start);          
            $time2= strtotime($end);          
            $diff = $time2-$time1;
            $diff2 = date("H:i",  $diff);    
            $data = array
            (    
                'fk_company' => $request->fk_company,
                'fk_car' => $request->fk_car,
                'start_car' =>$request->start_car,
                'end_car' => $request->start_car,
                'paid' => $request->paid,
                'start_date' => $request->start_date,
                'end_date' => $request->start_date,
                'start' =>$request->start[$key],
                'fk_tasktype' =>  $usługi,
                'end' => $request->end[$key],
                'fk_typetask' =>  $request->fk_typetask[$key],
                'fk_contract' =>  $contract,
                'location' =>$location,
                'time' => $diff2,
                'order' => $order,
                'fk_user' =>  $request->fk_user[$key],
                'description' =>$request->description[$key],
                'comments' =>  $comments1, 
                                
            ); 
            
           
            
            // możliwość aktualizacji
            if(!empty($id_opis[$key]))
            {
                $created = Job::where('id',$id_opis[$key])->update($data);
            }
            else
            {
            // możliwość dodania nowych rekordów
                $created = Job::create($data);
            }
        };   
        
        if (!empty($comments1)) {
            $comments = explode("\n", $comments1);
            foreach ($comments as $comment) {
                $existingTask = Task::where('fk_user', $user_auth->id)
                                     ->where('fk_company', $request->fk_company)
                                     ->where('task_title', trim($comment))
                                     ->first();
                if ($existingTask) {
                    $existingTask->update([
                        'execution_user' => $user_auth->id,
                        'fk_contract' => $contract,
                        'completed' => 0,
                        'created_at' => $now,
                    ]);
                } else {
                    $data = array(
                        'fk_user' => $user_auth->id,
                        'fk_company' => $request->fk_company,
                        'task_title' => trim($comment),
                        'execution_user' => $user_auth->id,
                        'fk_contract' => $contract,
                        'completed' => 0,
                        'created_at' => $now,
                    );
                    $created = Task::create($data); // Tworzenie nowego rekordu
                }
            }
        };
           
    
        foreach($description_goods as $key => $value) 
        {
            $data1 = array
            (    
                'fk_company' => $request->fk_company,
                'fk_car' => $request->fk_car,
                'start_car' =>$request->start_car,
                'end_car' => $request->start_car,
                'paid' => $request->paid,
                'start_date' => $request->start_date,
                'end_date' => $request->start_date,
                'fk_tasktype' =>  $towary,
                'fk_typetask' =>  $slugi_typ,
                'fk_contract' =>  $contract,
                'order' => $order,
                'fk_user' => $user_order,
                'description_goods' =>$description_goods[$key],
            );  

           
            // możliwość aktualizacji
            if(!empty($id_towar[$key]))
            {
              $created = Job::where('id',$id_towar[$key])->update($data1); 
            }
            else
            {
                // możliwość dodania nowych rekordów
              $created = Job::create($data1);
             
            }
        };  
        
        foreach ($fk_rep_eq as $key => $value) 
        {   
            $data2 = array
            (    
                'fk_company' => $request->fk_company,
                'fk_car' => $request->fk_car,
                'start_car' =>$request->start_car,
                'end_car' => $request->start_car,
                'paid' => $request->paid,
                'start_date' => $request->start_date,
                'end_date' => $request->start_date,
                'fk_tasktype' =>  $sprzęt_zast,
                'fk_contract' =>  $contract,
                'fk_typetask' =>  $slugi_typ,
                'order' => $order,
                'fk_user' => $user_order,
                'fk_rep_eq' =>$fk_rep_eq[$key],
                'description_eq'=>$description_equipment[$key],
            );
            // możliwość dodania nowych rekordów
                $created = Job::create($data2); 
                     
            $data3 =array(
                'entry_date' => $now,
                'comments' => $description_equipment[$key],
                'company_place' =>$request->fk_company,
                'is_loan' =>1,);
            $created = RepEquipment::where('id',$fk_rep_eq[$key])->update($data3);
        };    

     $last_id = DB::table('jobs')->count('id');

     return back()->with('success', 'Pomyślnie edytowano potwierdzenie.');  
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
    public function SendMail($id) 
    {
        $job = Job::findOrFail($id);
        $jobi = $job->order;      
        $company = $job->fk_company;
        $company_mail = DB::table('companies')->where('id',  $company)->pluck('email')->first();
        $company_km = DB::table('companies')->where('id',  $company)->pluck('distance')->first();
        $time = Job::where('order', $jobi)->sum(DB::raw("TIME_TO_SEC(time)/60"));
        $minsandsecs = date('i:s', $time);
        $jobs = Job::where('order', $jobi)->whereNotNull('description')->get();
        $jobs_towary = Job::where('order', $jobi)->whereNotNull('description_goods')->get();
        $jobs_sprzetzast = Job::where('order', $jobi)->whereNotNull('fk_rep_eq')->get();
        $data["title"] = "Potwierdzenie wykonania usługi";
        $pdf = PDF::loadView('admin.confirmsystem.sendMail', compact('job', 'jobs', 'minsandsecs', 'jobs_towary', 'jobs_sprzetzast','company_km'));
        $fileName = 'potwierdzenie-wykonania-uslug.pdf';
        $output = $pdf->setOptions(['isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true])->output();
    
        // Walidacja adresu e-mail
        if (filter_var($company_mail, FILTER_VALIDATE_EMAIL)) {
            // Adres e-mail jest poprawny, próba wysłania wiadomości
            try {
                Mail::send('admin.confirmsystem.sendMailHi', compact('job', 'jobs', 'minsandsecs', 'jobs_towary', 'jobs_sprzetzast','company_km'), function ($message) use ($company_mail, $fileName, $output)  {
                    $message->to($company_mail);
                    $message->subject('Kasper Komputer, potwierdzenie wykonania usług');
                    $message->attachData($output, $fileName, [
                        'mime' => 'application/pdf',
                    ]);
                });
                return redirect()->back()->with('success', 'Wiadomość e-mail została wysłana.');
            } catch (\Exception $e) {
                // Błąd podczas wysyłania wiadomości e-mail
                return redirect()->back()->with('error', 'Nie udało się wysłać wiadomości e-mail. ' . $e->getMessage());
            }
        } else {
            // Adres e-mail jest niepoprawny
            return redirect()->back()->with('error', 'Niepoprawny adres e-mail.');
        }
    }
}
