<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Mockery\Exception;
use Yajra\DataTables\DataTables;
use Excel;
use App\Absence;
use App\Summary;
use Carbon\Carbon;

class AbsenController extends Controller
{
    public function index()
    {
        //
        return view('rawdata');
    }


    public function store(Request $request)
    {
        $input = $request->all();

        Absence::create($input);

        return response()->json([
            'success' => true,
            'message' => 'Absence Created'
        ]);
    }

    public function show($id)
    {
        //
    }

    public function edit($id)    {
        $absence = Absence::findOrFail($id);
        return $absence;
    }


    public function apiAbsence(Request $request)
    {
        $absence =Absence::select('Name','Date','Clock In','Clock Out','Late','Early','absent','OT Time',
        'Work Time','Department','ATT_Time')->whereBetween('Date',['2017-13-16', '2017-13-16']);
        
        return Datatables::of($absence)
            
            ->addColumn('action', function($absence){
                return '<a href="#" class="btn btn-info btn-xs"><i class="glyphicon glyphicon-eye-open"></i> Show</a> ' .
                       '<a onclick="editForm('. $absence['emp no'] .')" class="btn btn-primary btn-xs"><i class="glyphicon glyphicon-edit"></i> Edit</a> ' .
                       '<a onclick="deleteData('. $absence['emp no'] .')" class="btn btn-danger btn-xs"><i class="glyphicon glyphicon-trash"></i> Delete</a>';
            })
            ->rawColumns(['action'])->make(true);
    }


    public function apiAbsenceDate($startdate, $enddate)
    {
  
        $absence =Absence::select('Name','Date','Clock In','Clock Out','Late','Early','absent','OT Time',
        'Work Time','Department','ATT_Time')->whereBetween('Date',[$start_date, $end_date]);
        

        return Datatables::of($absence)
            
            ->addColumn('action', function($absence){
                return '<a href="#" class="btn btn-info btn-xs"><i class="glyphicon glyphicon-eye-open"></i> Show</a> ' .
                       '<a onclick="editForm('. $absence['emp no'] .')" class="btn btn-primary btn-xs"><i class="glyphicon glyphicon-edit"></i> Edit</a> ' .
                       '<a onclick="deleteData('. $absence['emp no'] .')" class="btn btn-danger btn-xs"><i class="glyphicon glyphicon-trash"></i> Delete</a>';
            })
            ->rawColumns(['action'])->make(true);
    }




    public function absenceExport(){
        $absence = Absence::select('emp no','name','TimeTable','On Duty','Off Duty','Clock In','Clock Out','Late','Early','Absent', 'work time','date','ATT_Time')->get();
        return Excel::create('data_absence',function($excel) use ($absence){
            $excel->sheet('mysheet', function($sheet) use ($absence){
                $sheet->fromArray($absence);
            });
        })->download('xls');
    }


    public function absenceImport(Request $request){
     if($request->hasFile('file')){
         $path = $request->file('file')->getRealPath();
         $data = Excel::load($path, function ($reader){})->get();
         $totalabsen=0;
            // data tersebut tidak empty dan bisa dihitung
         if(!empty($data)&& $data->count())  {
            foreach ($data as $key => $value){
                $absence = new Absence();
                    $absence['emp no']=$value->emp_no;  //id


                    $absence['name']=$value->name;  //name 
                    $absence['date']=$value->date; //date

                    



                    $var=$value->date;
                    $date = str_replace('/', '-', $var);



                    $absence['date']=date('Y-m-d', strtotime($date));
                    



                    $absence['TimeTable']=$value->timetable; //date


                    $absence['On Duty']=$value->on_duty; //On Duty            
                    $var=$value->on_duty;
                    $time = str_replace('.', ':', $var);
                    $absence['On Duty']=date('H:i', strtotime($time));
                    




                    $absence['Off Duty']=$value->off_duty; //On Duty
                    $var=$value->off_duty;
                    $time = str_replace('.', ':', $var);
                    $absence['Off Duty']=date('H:i', strtotime($time));
                    


                    $absence['Clock In']=$value->clock_in; //On Duty
                    $var=$value->clock_in;
                    $time = str_replace('.', ':', $var);
                    $absence['Clock In']=date('H:i', strtotime($time));


                    $absence['Clock Out']=$value->clock_out; //On Duty
                    $var=$value->clock_out;
                    $time = str_replace('.', ':', $var);
                    $absence['Clock Out']=date('H:i', strtotime($time));


                    $absence['Late']=$value->late; //On Duty
                    $var=$value->late;
                    $time = str_replace('.', ':', $var);
                    $absence['Late']=date('H:i', strtotime($time));

                    $absence['Early']=$value->early; //On Duty
                    $var=$value->early;
                    $time = str_replace('.', ':', $var);
                    $absence['Early']=date('H:i', strtotime($time));


                    $absence->absent=filter_var($value->absent, FILTER_VALIDATE_BOOLEAN); //absent  
                    $absence['OT Time']=$value->ot_time; //On Duty
                    $var=$value->ot_time;
                    $time = str_replace('.', ':', $var);
                    $absence['OT Time']=date('H:i', strtotime($time));
                    

                    
                    $absence['Work Time']=$value->work_time; //work_time
                    $var=$value->work_time;
                    $time = str_replace('.', ':', $var);
                    $absence['Work Time']=date('H:i', strtotime($time));



                    $absence['Department']=$value->department; //On Duty
                    
                    
                    $absence['ATT_Time']=$value->att_time; //On Duty
                    $var=$value->att_time;
                    $time = str_replace('.', ':', $var);
                    $absence['ATT_Time']=date('H:i', strtotime($time));
                    
                    //$users = DB::table('absences')->whereBetween('Date', ['2017-11-13', '2017-11-15'])->SUM('ATT_Time');

                    

                    $absence->save();
                }

            }

            



        }
        return back();
    }


  
    public function getDataLibur(Request $request)
    {
        $nama_libur= $request->all();
        $awal_libur= $request['awal-libur'];
        $akhir_libur= $request['akhir-libur'];
        $berlaku_libur= $request['berlaku-libur'];

        
       
        
      $absences = Absence::findOrfail(2);

        
     

    }
    
    public function getDataCuti(Request $request)
    {
        $nama_cuti= $request['nama-cuti'];
        $awal_cuti= $request['awal-cuti'];
        $akhir_cuti= $request['akhir-cuti'];
        $berlaku_cuti= $request['berlaku-cuti'];

    }

    public function getDataMesinRusak(Request $request)
    {
        
        $awal_rusak= $request['awal-rusak'];
        $akhir_rusak= $request['akhir-rusak'];
        $berlaku_rusak= $request['berlaku-rusak'];
       

    }

    public function getDataPerdin(Request $request)
    {
        $nama_perdin= $request['nama-perdin'];
        $akhir_perdin= $request['akhir-perdin'];
        $berakhir_perdin= $request['berakhir-perdin'];  
        $berlaku_perdin= $request['berlaku-perdin'];
        

    }


    public function stores()
    {
    $input = Input::only('name','email','password');            
    $user = new User;
    $user->name = $input['name'];
    $user->email = $input['email'];
    $user->password = Hash::make($input['password']);
    $user->save();
    }

}
