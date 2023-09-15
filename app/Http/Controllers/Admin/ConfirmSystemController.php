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
use DateTime;
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

        $companies = Company::all();
        $user = Auth::user();
        $user_all = User::all()->unique();
        $TypeTask = TypeTask::all();
        $car = Car::all();
        $repEquipment=RepEquipment::all()->where('is_loan','!=',1)->where('eq_active','!=',1);
        $TaskType = TaskType::orderby("id","asc")->select('id','name')->get();
        return view('admin.confirmsystem.index', compact('companies','user','user_all','TypeTask','TaskType','car','repEquipment'));
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

     private function generateOrderNumber()
        {
            $year = Carbon::now()->year;
            $lastOrder = DB::table('jobs')->orderBy('id', 'desc')->first();
            if (!$lastOrder || substr($lastOrder->order, -4) < $year) {
                $orderNumber = 1;
            } else {
                $orderNumber = intval(substr($lastOrder->order, 4, -5)) + 1;
            }
        
            return 'SRW/' . $orderNumber . '/' . $year;
        }
        
    private function getContractId($companyId)
        {
            $contractGroup = DB::table('kontrahenci')->where('kontrahent_id', $companyId)->pluck('kontrahent_grupa')->first();
        
            return DB::table('contracts')->where('contract_name', $contractGroup)->pluck('id')->first();
        }

    private function getCompanyDistance($companyId)
        {
            $CompanyZipcode = DB::table('kontrahenci')->where('kontrahent_id', $companyId)->pluck('kontrahent_kodpocztowy')->first();    
            return DB::table('kontrahenci_miasta')->where('kontrahent_kodpocztowy', $CompanyZipcode)->pluck('kontrahent_odleglosc')->first();
        }
    

    public function store(StoreConfirmSystem $request)
        {   
            $order = $this->generateOrderNumber();
            $contract = $this->getContractId($request->fk_company);
            $now = Carbon::now()->addMinutes(120);

      
           
            $fk_typetask = $request->input('fk_typetask',[]);
            $description = $request->input('description',[]);  
            $description_goods = $request->input('description_goods',[]);  
            $fk_rep_eq = $request->input('fk_rep_eq',[]);
            $description_eq = $request->input('description_eq',[]);               
            $company =$request->input('fk_company');
            $usługi = DB::table('task_type')->where('name', 'Usługi(U)')->pluck('id')->first();
            $towary = DB::table('task_type')->where('name', 'Towary(T)')->pluck('id')->first();
            $slugi_typ = DB::table('type_task')->where('name', 'Serwis sprzętu komputerowego')->pluck('id')->first();
            $location = DB::table('kontrahenci')->where('kontrahent_id',  $company)->pluck('kontrahent_id')->first();
            $sprzęt_zast= DB::table('task_type')->where('name',  'Sprzęt zastępczy(SZ)')->pluck('id')->first();
            $user_auth = Auth::user();
            $comments1 = $request->comments[0];
                       
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
                    'end_car' => $request->end_car,
                    'paid' => $request->paid,
                    'start_date' => $request->start_date,
                    'end_date' => $request->start_date,
                    'start' =>$request->start[$key],
                    'fk_tasktype' => $request->fk_typetask[$key],
                    'end' => $request->end[$key],
                    'fk_typetask' =>  $request->fk_typetask[$key],
                    'fk_user' =>  $request->fk_user[$key],
                    'fk_contract' =>  $contract,
                    'location' =>$location,
                    'time' => $diff2,
                    'order' =>$order,
                    'description' =>$request->description[$key],
                    'paid_job'=>$request->paid_job[$key],
                    'comments' => $comments1, 
                    'rns' => $request->rns[$key],               
                );  
                if(!empty($description[$key]) && isset($request->start[$key]) && isset($request->end[$key])) { 
                    $created = Job::insert($data); 
                }
                if (!empty($request->comments[$key])) {
                    $end = $now->copy()->addMinutes(30); // Dodanie 30 minut do godziny startu
                    $comments = explode("\n", $request->comments[$key]);
                    foreach ($comments as $comment)
                    {
                    $data4 = array(
                        'fk_user' =>  $user_auth->id,
                        'fk_company' => $request->fk_company,
                        'title' => trim($comment),
                        'start' => $now,
                        'end' => $end,
                        'execution_user' => $request->fk_user[$key],
                        'fk_contract' => $contract,
                        'completed' => 0,
                        'created_at' => $now,
                    );                   
                    $created = Task::insert($data4);
                         }
                    };                     
                };
                        
                foreach ($description_goods as $key => $value) {
                    $data1 = array(
                        'fk_company' => $request->fk_company,
                        'fk_car' => $request->fk_car,
                        'start_car' => $request->start_car,
                        'end_car' => $request->end_car,
                        'paid' => $request->paid,
                        'start_date' => $request->start_date,
                        'end_date' => $request->start_date,
                        'fk_tasktype' => $towary,
                        'fk_typetask' => $slugi_typ,
                        'fk_contract' => $contract,
                        'fk_user' => $user_auth->id,
                        'order' => $order,
                        'description_goods' => $description_goods[$key],
                        'paid_goods' => $request->paid_goods[$key],
                        'value_goods' => $request->value_goods[$key],
                    );  
                    if(!empty($description_goods[$key]) && isset($request->paid_goods[$key]) && isset($request->value_goods[$key])) { 
                        $created = Job::insert($data1); 
                    }
                    };

                   foreach ($fk_rep_eq as $key => $value){
                        $data2 = array(
                            'fk_company' => $request->fk_company,
                            'fk_car' => $request->fk_car,
                            'start_car' => $request->start_car,
                            'end_car' => $request->end_car,
                            'paid' => $request->paid,
                            'start_date' => $request->start_date,
                            'end_date' => $request->start_date,
                            'fk_tasktype' => $sprzęt_zast,
                            'fk_contract' => $contract,
                            'fk_typetask' => $slugi_typ,
                            'fk_user' => $user_auth->id,
                            'order' => $order,
                            'fk_rep_eq' => $fk_rep_eq[$key],
                            'description_eq' => $description_eq[$key],
                            'paid_eq' => $request->paid_eq[$key],
                        );  
                        if(!empty($fk_rep_eq[$key]) && isset($request->description_eq[$key]) && isset($request->paid_eq[$key])) {               
                        $created = Job::insert($data2);     
                    }           
                        $data3 = array(
                            'entry_date' => $now,
                            'comments' => $description_eq[$key],
                            'company_place' => $request->fk_company,
                            'is_loan' => 1,
                        );                
                        $created = RepEquipment::where('id', $fk_rep_eq[$key])->update($data3);
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
        
        $start1 = new DateTime($job->start_car);       
        $end1 = new DateTime($job->end_car);
        $travel = $start1->diff($end1);
        $travel_string = $travel->format('%H:%I');
       
        $time = Job::where('order', $jobi)->sum(DB::raw("TIME_TO_SEC(time)/60"));
        $minsandsecs = date('i:s',$time);

        $jobs = Job::all()->where('order', '==', $jobi)->wherenotNull('description');

        $jobs_towary = Job::all()->where('order', '==', $jobi)->wherenotNull('description_goods');

        $jobs_sprzetzast = Job::all()->where('order', '==', $jobi)->wherenotNull('fk_rep_eq');

        $company = $job->fk_company;
        $company_km = $this->getCompanyDistance($company);
        
        return view('admin.confirmsystem.print', compact('job','travel_string','jobs','minsandsecs','jobs_towary','jobs_sprzetzast','company_km'));
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
        $Notification = Notification::all()->where('order', '==', $jobi);
       
       // $type_task_id=$job->fk_tasktype;        
        $jobs = Job::all()->where('order', '==', $jobi)->wherenotNull('description');

        $jobs_towary = Job::all()->where('order', '==', $jobi)->wherenotNull('description_goods');

        $jobs_sprzetzast = Job::all()->where('order', '==', $jobi)->wherenotNull('fk_rep_eq');
        $company = $job->fk_company;
        $company_mails = DB::table('kontrahenci')->where('kontrahent_id',  $company)->pluck('kontrahent_email')->first();
        $company_mails = explode(';', $company_mails);
        
        $repEquipment_loan=RepEquipment::all()->where('company_place', '==', $jobi_loan);
        $repEquipment_loan_add=RepEquipment::all()->where('is_loan','!=',1)->where('eq_active','!=',1);

        return view('admin.confirmsystem.edit', compact('companies','company_mails','job','TaskType','TypeTask','user_all','jobs','Notification','car','user','repEquipment',
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

        $now = Carbon::now()->addMinutes(120);
        $contract = $this->getContractId($request->fk_company);

        $fk_typetask = $request->input('fk_typetask',[]);
        $description = $request->input('description',[]);  
        $description_goods = $request->input('description_goods',[]);  
        $fk_rep_eq = $request->input('fk_rep_eq',[]);   
        $description_equipment = $request->input('description_eq',[]);             
        $company =$request->input('fk_company');
      
        $usługi = DB::table('task_type')->where('name', 'Usługi(U)')->pluck('id')->first();
        $towary = DB::table('task_type')->where('name', 'Towary(T)')->pluck('id')->first();
        $slugi_typ = DB::table('type_task')->where('name', 'Serwis sprzętu komputerowego')->pluck('id')->first();
        $location = DB::table('kontrahenci')->where('kontrahent_id',  $company)->pluck('kontrahent_id')->first();
        $sprzęt_zast= DB::table('task_type')->where('name',  'Sprzęt zastępczy(SZ)')->pluck('id')->first();
        $order = $request->input('order');
        $user_auth = Auth::user() -> id;

     
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
                'end_car' => $request->end_car,
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
                'paid_job'=>$request->paid_job[$key],
                'comments' =>  $comments1,   
                'rns' => $request->rns[$key],                              
            ); 
            
             
            if(!empty($description[$key]) && isset($request->start[$key]) && isset($request->end[$key])) { 
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
        }
        };   
        
        if (!empty($comments1)) {
            $comments = explode("\n", $comments1);
            $end = $now->copy()->addMinutes(30); // Dodanie 15 minut do godziny startu
            foreach ($comments as $comment) {
                $existingTask = Task::
                                     where('fk_company', $request->fk_company)
                                     ->where('title', trim($comment))
                                     ->first();

               
                if ($existingTask) {
                    $existingTask->update([
                        'execution_user' =>  $user_auth,
                        'fk_contract' => $contract,
                        'completed' => 0,
                        'created_at' => $now,
                    ]);
                } else {
                    $data = array(
                        'fk_user' =>  $user_auth,
                        'fk_company' => $request->fk_company,
                        'title' => trim($comment),
                        'execution_user' =>  $user_auth,
                        'fk_contract' => $contract,
                        'completed' => 0,
                        'created_at' => $now,
                        'start' => $now,
                        'end' => $end, 
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
                'end_car' => $request->end_car,
                'paid' => $request->paid,
                'start_date' => $request->start_date,
                'end_date' => $request->start_date,
                'fk_tasktype' =>  $towary,
                'fk_typetask' =>  $slugi_typ,
                'fk_contract' =>  $contract,
                'order' => $order,
                'fk_user' => $user_auth,
                'description_goods' =>$description_goods[$key],
                'paid_goods' =>$request->paid_goods[$key],
                'value_goods' =>$request->value_goods[$key],
            );  

            if(!empty($description_goods[$key]) && isset($request->paid_goods[$key]) && isset($request->value_goods[$key])) { 
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
            }
        };  
        
        foreach ($fk_rep_eq as $key => $value) 
        {   
            $data2 = array
            (    
                'fk_company' => $request->fk_company,
                'fk_car' => $request->fk_car,
                'start_car' =>$request->start_car,
                'end_car' => $request->end_car,
                'paid' => $request->paid,
                'start_date' => $request->start_date,
                'end_date' => $request->start_date,
                'fk_tasktype' =>  $sprzęt_zast,
                'fk_contract' =>  $contract,
                'fk_typetask' =>  $slugi_typ,
                'order' => $order,
                'fk_user' =>  $user_auth,
                'fk_rep_eq' =>$fk_rep_eq[$key],
                'description_eq'=>$description_equipment[$key],
                'paid_eq'=>$request->paid_eq[$key],
            );
            if(!empty($fk_rep_eq[$key]) && isset($request->description_eq[$key]) && isset($request->paid_eq[$key])) {    
            // możliwość dodania nowych rekordów
                $created = Job::create($data2); 
            }   
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
    public function SendMail(Request $request,$id) 
    {
        $job = Job::findOrFail($id);
        $jobi = $job->order;      
        $company = $job->fk_company;
        $company_mails = DB::table('kontrahenci')->where('kontrahent_id',  $company)->pluck('kontrahent_email')->first();
        $company_mails = explode(';', $company_mails);
        $company_km = $this->getCompanyDistance($company);
        $time = Job::where('order', $jobi)->sum(DB::raw("TIME_TO_SEC(time)/60"));
        $minsandsecs = date('i:s', $time);
        $start1 = new DateTime($job->start_car);       
        $end1 = new DateTime($job->end_car);
        $travel = $start1->diff($end1);
        $travel_string = $travel->format('%H:%I'); // np. 02:30
        $jobs = Job::where('order', $jobi)->whereNotNull('description')->get();
        $jobs_towary = Job::where('order', $jobi)->whereNotNull('description_goods')->get();
        $jobs_sprzetzast = Job::where('order', $jobi)->whereNotNull('fk_rep_eq')->get();
        $data["title"] = "Potwierdzenie wykonania usługi";
        $pdf = PDF::loadView('admin.confirmsystem.sendMail', compact('job', 'jobs', 'minsandsecs', 'jobs_towary', 'jobs_sprzetzast','company_km','travel_string'  ));
        $fileName = 'potwierdzenie-wykonania-uslug.pdf';
        $output = $pdf->setOptions(['isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true])->output();
        $recipients = $request->input('recipients',[]);
    
        // Walidacja adresów e-mail
        if (empty($recipients)) {
            return redirect()->back()->with('error', 'Nie wybrano żadnych adresów e-mail.');
        }
    
        // Adresy e-mail są poprawne, próba wysłania wiadomości
        try {
            Mail::send('admin.confirmsystem.sendMailHi', compact('job', 'jobs', 'minsandsecs', 'jobs_towary', 'jobs_sprzetzast','company_km','travel_string'), function ($message) use ($recipients, $fileName, $output)  {
                $message->to($recipients);
                $message->subject('Kasper Komputer, potwierdzenie wykonania usług');
                $message->attachData($output, $fileName, [
                    'mime' => 'application/pdf',
                ]);
            });
            return redirect()->back()->with('success', 'Wiadomość e-mail została wysłana');
            } catch (\Exception $e) {
                // Błąd podczas wysyłania wiadomości e-mail
                return redirect()->back()->with('error', 'Nie udało się wysłać wiadomości e-mail. ' . $e->getMessage());
            }
       
    }
}
