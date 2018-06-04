<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Mockery\Exception;
use Yajra\DataTables\DataTables;
use Excel;
use App\Absence;
use Carbon\Carbon;
use App\Summary;

class SummaryController extends Controller
{
    public function index()
    {
        //
        $summary = new Summary();

        DB::table('summaries')->truncate();


        $absences = DB::table('absences')->select('Name')->distinct()->pluck('Name')->toJson();

        $data = json_decode($absences, TRUE);

  

        foreach($data as $datas)
        {
            
            $summary = new Summary();
    

      
            $harikerja = DB::table('absences')->where([
                ['Name', '=', $datas],
                ['absent', '=', 0],
                
            ])->count();                
           
            $absen = DB::table('absences')->where('name', $datas)->sum('absent');                
    
            $att_time = DB::table('absences')->where('name', $datas)->sum('ATT_Time'); 
    
            DB::table('summaries')->insert(
                ['nama' => $datas, 'total_hari_kerja' =>$harikerja, 'total_absen' => $absen,'att_time' => $att_time/10000]
            );


        }

        return view('summary');
    }


    public function store(Request $request)
    {
        $input = $request->all();

        Summary::create($input);

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
        $summary = Summary::findOrFail($id);
        return $summary;
    }


    public function apiSummary()
    {
        $summary = Summary::all();

        return Datatables::of($summary)

            ->addColumn('action', function($summary){
                return '<a href="#" class="btn btn-info btn-xs"><i class="glyphicon glyphicon-eye-open"></i> Show</a> ' .
                       '<a onclick="editForm('. $summary->id .')" class="btn btn-primary btn-xs"><i class="glyphicon glyphicon-edit"></i> Edit</a> ' .
                       '<a onclick="deleteData('. $summary->id .')" class="btn btn-danger btn-xs"><i class="glyphicon glyphicon-trash"></i> Delete</a>';
            })
            ->rawColumns(['action'])->make(true);
    }

    public function summaryExport(){
        $summary = Summary::select('nama','total_hari_kerja','total_absen','att_time')->get();
        return Excel::create('data_summary',function($excel) use ($summary){
            $excel->sheet('mysheet', function($sheet) use ($summary){
                $sheet->fromArray($summary);
            });
        })->download('xls');
    }


}
