<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Mockery\Exception;
use Yajra\DataTables\DataTables;
use Excel;
use App\Absence;

class AbsenController extends Controller
{
    public function index()
    {
        //
        return view('welcomes');
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


    public function apiAbsence()
    {
        $absence = Absence::all();
 
        return Datatables::of($absence)
            
            ->addColumn('action', function($absence){
                return '<a href="#" class="btn btn-info btn-xs"><i class="glyphicon glyphicon-eye-open"></i> Show</a> ' .
                       '<a onclick="editForm('. $absence->id .')" class="btn btn-primary btn-xs"><i class="glyphicon glyphicon-edit"></i> Edit</a> ' .
                       '<a onclick="deleteData('. $absence->id .')" class="btn btn-danger btn-xs"><i class="glyphicon glyphicon-trash"></i> Delete</a>';
            })
            ->rawColumns(['action'])->make(true);
    }





    public function absenceExport(){
        $absence = Absence::select('name', 'work_time','absent')->get();
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
            
            // data tersebut tidak empty dan bisa dihitung
            if(!empty($data)&& $data->count())  {
                foreach ($data as $key => $value){
                    $absence = new Absence();
                    $absence->id=$value->id;
                    $absence->name=$value->name;
                    
                    $string =$value->work_time;
                    $float = (double)$string;
                    $absence ->work_time=$float;

                    $absence->absent=filter_var($value->absent, FILTER_VALIDATE_BOOLEAN);
                    

                    
                    $absence->save();
                }
            }

        }
        return back();
    }


}
