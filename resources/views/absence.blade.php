@extends('mainlayout')

@section('content')
<div class="container">
      <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4>Data mentah dari mesin absensi
                        <a href="{{ route('absence.export') }}" class="btn btn-success pull-right" style="margin-top: -8px;">Ekspor data</a>
                        <a onclick="eximForm()" class="btn btn-primary pull-right" style="margin-top: -8px; margin-right: 8px;">Tambah data</a>    
                    </h4>
                </div>
                <div class="panel-body table-responsive">
                    <table id="absences-table" class="table table-striped table-bordered">
                        <thead>
                            <tr >
                                <th>Name</th>
                                <th>Date</th>
                                <!-- <th>Timetable</th>
                                <th>On Duty</th>
                                <th>Off Duty</th> -->
                                <th>Clock In</th>
                                <th>Clock Out</th>
                                <th>Late</th>
                                <th>Early</th>
                                <th>Absence</th>
                                <th>OT Time</th>
                                <th>Work Time</th>
                                <th>Department</th>
                                <th>ATT_Time</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
        </div>
      </div>

      @include('forms')

    </div> <!-- /container -->
@stop
