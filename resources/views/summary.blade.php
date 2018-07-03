@extends('base')

@section('content')
<div class="container">

  <div class="row">
    <div class="col-md-12">
      <div class="panel panel-default">
        <div class="panel-heading">
          <h4>Ringkasan kehadiran karyawan
            <a href="{{ route('summary.export') }}" class="btn btn-success pull-right" style="margin-top: -8px;"  title="Ambil data yang ditampilkan berikut sebagai dokumen Excel"><i class="fa fa-download"></i> Ekspor data</a>
          </h4>
        </div>
        <div class="panel-body">
          <div class="col-md-4 col-md-offset-4 form-group" id="date-filter">
            <label for="date-range" class="form-label">Filter dengan tanggal:</label>
            <input type="text" name="date-range" id="date-range" class="form-control">
          </div>
          <table  id="summary-table" class="table table-striped table-bordered">
            <thead>
              <tr >

                <th>Nama</th>
                <th>Total Hari Kerja</th>
                <th>Total Absen</th>
                <th>Total Jam Kerja</th>

              </tr>
            </thead>
            <tbody></tbody>
          </table>
        </div>
      </div>
    </div>
  </div>

  @include('forms')

</div>
@endsection

@section('js')
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

  var table = $('#summary-table').DataTable({
    processing: true,
    serverSide: true,
    ajax: "{{ route('api.summary') }}",
    columns: [

    {data: 'nama', name: 'nama'},
    {data: 'total_hari_kerja', name: 'total_hari_kerja'},
    {data: 'total_absen', name: 'total_absen'},
    {data: 'att_time', name: 'att_time'},

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
    $('#modal-exims').modal('show');
    $('#modal-exims form')[0].reset();

  }
</script>
@endsection
