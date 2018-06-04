<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Mockery\Exception;
use Yajra\DataTables\DataTables;
use Excel;
use App\Absence;

use App\Summary;

class SummaryController extends Controller
{
    public function index()
    {
        //
        $summary = new Summary();
    
        $absen = DB::table('absences')->where('emp no', 4)->whereBetween('Date', ['2017-11-13', '2017-12-15'])->sum('absent');                
    
        $harikerja = DB::table('absences')->where([
            ['emp no', '=', 4],
            ['absent', '=', 0],
            
        ])->whereBetween('Date', ['2017-11-13', '2017-12-15'])->count();                
       
        $nama = DB::table('absences')->where([
            ['emp no', '=', 4],
            ['absent', '=', 0],
            
        ])->first();
        DB::table('summaries')->insert(
            ['nama' => $nama->Name, 'total_hari_kerja' =>$harikerja ,'total_absen' => $absen]
        );



              
        $absen = DB::table('absences')->where('emp no', 2)->whereBetween('Date', ['2017-11-13', '2017-12-15'])->sum('absent');                
    
        $harikerja = DB::table('absences')->where([
            ['emp no', '=', 2],
            ['absent', '=', 0],
            
        ])->whereBetween('Date', ['2017-11-13', '2017-12-15'])->count();                
       
        $nama = DB::table('absences')->where([
            ['emp no', '=', 2],
            ['absent', '=', 0],
            
        ])->first();

        DB::table('summaries')->insert(
            ['nama' => $nama->Name, 'total_hari_kerja' =>$harikerja ,'total_absen' => $absen]
        );

                      
        $absen = DB::table('absences')->where('emp no', 5)->whereBetween('Date', ['2017-11-13', '2017-12-15'])->sum('absent');                
    
        $harikerja = DB::table('absences')->where([
            ['emp no', '=', 5],
            ['absent', '=', 0],
            
        ])->whereBetween('Date', ['2017-11-13', '2017-12-15'])->count();                
       
        $nama = DB::table('absences')->where([
            ['emp no', '=', 5],
            ['absent', '=', 0],
            
        ])->first();

        DB::table('summaries')->insert(
            ['nama' => $nama->Name, 'total_hari_kerja' =>$harikerja ,'total_absen' => $absen]
        );
                      
        $absen = DB::table('absences')->where('emp no', 6)->whereBetween('Date', ['2017-11-13', '2017-12-15'])->sum('absent');                
    
        $harikerja = DB::table('absences')->where([
            ['emp no', '=', 6],
            ['absent', '=', 0],
            
        ])->whereBetween('Date', ['2017-11-13', '2017-12-15'])->count();                
       
        $nama = DB::table('absences')->where([
            ['emp no', '=', 6],
            ['absent', '=', 0],
            
        ])->first();

        DB::table('summaries')->insert(
            ['nama' => $nama->Name, 'total_hari_kerja' =>$harikerja ,'total_absen' => $absen]
        );

        $absen = DB::table('absences')->where('emp no', 7)->whereBetween('Date', ['2017-11-13', '2017-12-15'])->sum('absent');                
    
        $harikerja = DB::table('absences')->where([
            ['emp no', '=', 7],
            ['absent', '=', 0],
            
        ])->whereBetween('Date', ['2017-11-13', '2017-12-15'])->count();                
       
        $nama = DB::table('absences')->where([
            ['emp no', '=', 7],
            ['absent', '=', 0],
            
        ])->first();

        DB::table('summaries')->insert(
            ['nama' => $nama->Name, 'total_hari_kerja' =>$harikerja ,'total_absen' => $absen]
        );

        $absen = DB::table('absences')->where('emp no', 8)->whereBetween('Date', ['2017-11-13', '2017-12-15'])->sum('absent');                
    
        $harikerja = DB::table('absences')->where([
            ['emp no', '=', 8],
            ['absent', '=', 0],
            
        ])->whereBetween('Date', ['2017-11-13', '2017-12-15'])->count();                
       
        $nama = DB::table('absences')->where([
            ['emp no', '=', 8],
            ['absent', '=', 0],
            
        ])->first();

        DB::table('summaries')->insert(
            ['nama' => $nama->Name, 'total_hari_kerja' =>$harikerja ,'total_absen' => $absen]
        );

        $absen = DB::table('absences')->where('emp no', 9)->whereBetween('Date', ['2017-11-13', '2017-12-15'])->sum('absent');                
    
        $harikerja = DB::table('absences')->where([
            ['emp no', '=', 9],
            ['absent', '=', 0],
            
        ])->whereBetween('Date', ['2017-11-13', '2017-12-15'])->count();                
       
        $nama = DB::table('absences')->where([
            ['emp no', '=', 9],
            ['absent', '=', 0],
            
        ])->first();

        DB::table('summaries')->insert(
            ['nama' => $nama->Name, 'total_hari_kerja' =>$harikerja ,'total_absen' => $absen]
        );




        return view('welcomes');
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


    
}
