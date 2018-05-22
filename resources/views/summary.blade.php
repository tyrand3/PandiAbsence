@extends('base')

@section('css')
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/css/bootstrap-datepicker.css" rel="stylesheet">
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/js/bootstrap-datepicker.js"></script>
@endsection

@section('content')
<div class="container">
      <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4>Ringkasan absensi karyawan
                        <a href="" class="btn btn-success pull-right" style="margin-top: -8px;"  title="Ambil data yang ditampilkan berikut sebagai dokumen Excel">Ekspor data</a>
                    </h4>
                </div>
                <div class="panel-body table-responsive">
                    <table id="absences-table" class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Date</th>
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
@endsection

@section('js')
<script type="text/javascript">
    $('.date').datepicker({  
       format: 'mm-dd-yyyy'
     });  
</script>  

@endsection
