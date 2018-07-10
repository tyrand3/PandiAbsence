<!-- Senpai,
In case enggak paham cara pakenya, coba cek dokumentasi DateRangePicker ya
http://www.daterangepicker.com -->

@extends('base')

@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-12">
      <div class="panel panel-default">
        <div class="panel-heading">
          <h4>Data dari mesin absensi
            <a href="{{ route('absence.export') }}" class="btn btn-success pull-right" style="margin-top: -8px;"  title="Ambil data yang ditampilkan berikut sebagai dokumen Excel"><i class="fa fa-download"></i> Ekspor data</a>
            <a onclick="eximForm()" class="btn btn-primary pull-right" style="margin-top: -8px; margin-right: 8px;" title="Import dokumen Excel dari mesin absensi untuk memperbarui database"><i class="fa fa-upload"></i> Tambah data</a>   
          </h4>
        </div>
        <div class="panel-body table-responsive">
          <div class="col-md-4 col-md-offset-4 form-group" id="date-filter">
            <label for="date-range" class="form-label">Filter dengan tanggal:</label>
            <input type="text" name="date-range" id="date-range" class="form-control">
          </div>
          <table id="absences-table" class="table table-striped table-bordered">
            <thead>
              <tr >
                <th>Name</th>
                <th>Date</th>
                <th>Clock In</th>
                <th>Clock Out</th>
                <th>Late</th>
                <th>Early</th>
                <th>Absence</th>
                <th>OT Time</th>
                <th>Work Time</th>
                <th>Department</th>
                <th>ATT_Time</th>
                <th></th>
              </tr>
            </thead>
            <tbody></tbody>
          </table>
        </div>
      </div>
    </div>
  </div>

  @include('forms')
  @include('form')
</div> <!-- /container -->
@endsection

@section('js')>
<script type="text/javascript">
  $( function() {
    $("#date-range").daterangepicker({
      maxDate: moment(),
      autoUpdateInput: false,
      ranges: {
        'Hari ini': [moment(), moment()],
        'Kemarin': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
        'Minggu ini': [moment().startOf('isoWeek'), moment()],
        'Minggu lalu': [moment().subtract(1, 'weeks').startOf('isoWeek'), moment().subtract(1, 'weeks').endOf('isoWeek')],
        'Bulan ini': [moment().startOf('month'), moment()],
        'Bulan lalu': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
      },
      locale: {
        format: "DD MMM YYYY",
        cancelLabel: 'Batal',
        applyLabel: 'Pilih',
        customRangeLabel: "Pilih sendiri",
      }
    });
  });
  $('#date-range').on('apply.daterangepicker', function(ev, picker) {
    $(this).val(picker.startDate.format('DD MMM YYYY') + ' - ' + picker.endDate.format('DD MMM YYYY'));
    console.log(picker.startDate.format('YYYY-MM-DD'));
    console.log(picker.endDate.format('YYYY-MM-DD'));
  });
  $('#date-range').on('cancel.daterangepicker', function(ev, picker) {
    $(this).val('');
  });

  var table = $('#absences-table').DataTable({
    processing: true,
    serverSide: true,
    ajax: "{{ route('api.absence') }}",
    columns: [
    {data: 'Name', name: 'Name'},
    {data: 'Date', name: 'Date'},
    {data: 'Clock In', name: 'Clock In'},
    {data: 'Clock Out', name: 'Clock Out'},
    {data: 'Late', name: 'Late'},
    {data: 'Early', name: 'Early'},
    {data: 'absent', name: 'absent'},
    {data: 'OT Time', name: 'OT Time'},
    {data: 'Work Time', name: 'Work Time'},
    {data: 'Department', name: 'Department'}, 
    {data: 'ATT_Time', name: 'ATT_Time'}, 
    {data: 'action', name: 'action', orderable: false, searchable: false}
    ]
  });

  function editForm(id) {
        save_method = 'edit';
        $('input[name=_method]').val('PATCH');
        $('#modal-form form')[0].reset();
        $.ajax({
         
          url: "{{ url('absence') }}" + '/' + id + "/edit", type: "GET",
          dataType: "JSON",
          success: function(data) {
            $('#modal-form').modal('show');
            $('.modal-title').text('Edit Absence');
            $('#id').val(data.id);
            $('#Name').val(data.Name);
            $('#Date').val(data.Date);
            $('#ATT_Time').val(data.ATT_Time);
            $('#absent').val(data.absent);
          },
          error : function() {
              alert("Nothing Data");
          }
        });
      }
 
       
     $(function(){
            $('#modal-form form').validator().on('submit', function (e) {
                if (!e.isDefaultPrevented()){
                    var id = $('#id').val();
                    if (save_method == 'add') url = "{{ url('absence') }}";
                    else url = "{{ url('absence') . '/' }}" + id;

                    
                    $.ajax({
                        url : url,
                        type : "POST",
                        data : $('#modal-form form').serialize(),
                        success : function($data) {
                            $('#modal-form').modal('hide');
                            table.ajax.reload();
                        },
                        error : function(){
                            alert('Oops! Something Error!');
                        }
                    });
                    return false;
                }
            });
        });
      function deleteData(id){
    var csrf_token = $('meta[name="csrf-token"]').attr('content');
    swal({
      title: 'Are you sure?',
      text: "You won't be able to revert this!",
      type: 'warning',
      showCancelButton: true,
      cancelButtonColor: '#d33',
      confirmButtonColor: '#3085d6',
      confirmButtonText: 'Yes, delete it!'
    }).then(function () {
      $.ajax({
        url : "{{ url('absence') }}" + '/' + id,
        type : "POST",
        data : {'_method' : 'DELETE', '_token' : csrf_token},
        success : function(data) {
          table.ajax.reload();
          swal({
            title: 'Success!',
            text: data.message,
            type: 'success',
            timer: '1500'
          })
        },
        error : function () {
          swal({
            title: 'Oops...',
            text: data.message,
            type: 'error',
            timer: '1500'
          })
        }
      });
    });
  }


  function eximForm() {
    $('#modal-exim').modal('show');
    $('#modal-exim form')[0].reset();

  }
</script>


@endsection
