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
                <div class="row" id="date-filter">
                    <div class="col-md-4 col-md-offset-4 form-group">
                        <label for="date-range" class="form-label">Filter dengan tanggal:</label>
                        <input type="text" name="date-range" id="date-range" class="form-control">
                    </div>
                    <div class="col-md-1 form-group">
                        <label <a href="{{ route('api.absenceDate') }}" for="date-submit" class="form-label">&nbsp;</label>
                        <input type="submit" onclick="addData()" name="date-submit" id="date-submit" value="Filter" class="btn btn-info">
                    </div>
                </div>
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
@endsection

@section('js')>
<script type="text/javascript">
    
  //   $(function() {

  //   var start = moment().subtract(29, 'days');
  //   var end = moment();

  //   function cb(start, end) {
  //     $('#range-libur span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
  //   }

  //   $('#range-libur').daterangepicker({
  //     startDate: start,
  //     endDate: end,
  //     ranges: {
  //      'Hari ini': [moment(), moment()],
  //      'Kemarin': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
  //      'Last 7 Days': [moment().subtract(6, 'days'), moment()],
  //      'Last 30 Days': [moment().subtract(29, 'days'), moment()],
  //      'This Month': [moment().startOf('month'), moment().endOf('month')],
  //      'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
  //    }
  //  }, cb);

  //   cb(start, end);

  // });
    $( function() {
        $("#date-range").daterangepicker({
            locale: {
                format: "DD MMM YYYY",
                cancelLabel: 'Clear'
            }
        });
    });

    var table = $('#absences-table').DataTable({
      processing: true,
      serverSide: true,
      ajax: "{{ route('api.absence') }}",
      columns: [

                        {data: 'Name', name: 'Name'},
                        {data: 'Date', name: 'Date'},
                        // {data: 'Timetable', name: 'Timetable'},
                        // {data: 'On Duty', name: 'On Duty'},
                        // {data: 'Off Duty', name: 'Off Duty'},
                        {data: 'Clock In', name: 'Clock In'},
                        {data: 'Clock Out', name: 'Clock Out'},
                        {data: 'Late', name: 'Late'},
                        {data: 'Early', name: 'Early'},
                        {data: 'absent', name: 'absent'},
                        {data: 'OT Time', name: 'OT Time'},
                        {data: 'Work Time', name: 'Work Time'},
                        {data: 'Department', name: 'Department'}, 
                        {data: 'ATT_Time', name: 'ATT_Time'}, 
                 //       {data: 'action', name: 'action', orderable: false, searchable: false}
                      
                        ]
                    });

    function addForm() {
        save_method = "add";
        $('input[name=_method]').val('POST');
        $('#modal-form').modal('show');
        $('#modal-form form')[0].reset();
        $('.modal-title').text('Add Absence');
    }

    function editForm(id) {
        save_method = 'edit';
        $('input[name=_method]').val('PATCH');
        $('#modal-form form')[0].reset();
        $.ajax({
          url: "{{ url('absence') }}" + '/' + id + "/edit",
          type: "GET",
          dataType: "JSON",
          success: function(data) {
            $('#modal-form').modal('show');
            $('.modal-title').text('Edit Absence');

            $('#id').val(data.id);
            $('#name').val(data.name);
            $('#email').val(data.email);
        },
        error : function() {
          alert("Nothing Data");
      }
  });
    }

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

  $(function(){
    $('#modal-form form').validator().on('submit', function (e) {
        if (!e.isDefaultPrevented()){
            var id = $('#id').val();
            if (save_method == 'add') url = "{{ url('absence') }}";
            else url = "{{ url('absence') . '/' }}" + id;

            $.ajax({
                url : url,
                type : "POST",
//                        data : $('#modal-form form').serialize(),
data: new FormData($("#modal-form form")[0]),
contentType: false,
processData: false,
success : function(data) {
    $('#modal-form').modal('hide');
    table.ajax.reload();
    swal({
        title: 'Success!',
        text: data.message,
        type: 'success',
        timer: '1500'
    })
},
error : function(data){
    swal({
        title: 'Oops...',
        text: data.message,
        type: 'error',
        timer: '1500'
    })
}
});
            return false;
        }
    });
});


  function eximForm() {
    $('#modal-exim').modal('show');
    $('#modal-exim form')[0].reset();

}
</script>
@endsection
