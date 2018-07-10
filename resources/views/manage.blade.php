<!-- Senpai,
In case enggak paham cara pakenya, coba cek dokumentasi DateRangePicker ya
http://www.daterangepicker.com -->

@extends('base')

@section('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.4/css/bootstrap-select.min.css">
@endsection

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-8 col-md-offset-2 panel-group" id="accordion">

      <div class="alert alert-info">
        <strong>Catatan:</strong> Klik dua kali pada tanggal untuk memilih tanggal yang sama
      </div>
      <div class="panel panel-primary" id="libur-panel">
        <div class="panel-heading">
          <h2 class="panel-title"><a data-toggle="collapse" data-parent="accordion" href="#collapse1">Liburan</a></h2>
        </div>
        <div class="panel-collapse collapse in" id="collapse1">
          <form class="panel-body" id="libur-form" action="{{ route('submit.libur') }}" method="post">
            <div class="form-row">
              <div class="form-group col-md-6" style="padding-left: 0">	
                <label for="nama-libur" class="control-label">Nama Libur:</label>
                {{ csrf_field()}}
                <input type="text" name="nama-libur" class="form-control" placeholder="contoh: Idul Fitri">
              </div>
              <div class="form-group col-md-6" style="padding-right: 0">
                <label for="range-libur" class="control-label">Periode:</label>
                {{ csrf_field()}}
                <input type="text" name="range-libur" id="range-libur" class="form-control">
              </div>
            </div>
            <div class="form-group">
              <label for="berlaku-libur" class="control-label">Berlaku bagi:</label>
              {{ csrf_field()}}
              <select multiple class="selectpicker form-control" data-live-search="true" id="berlaku-libur" data-actions-box="true">
                @foreach ($entries as $entry)
                  <option value="{{ $entry->Name }}">{{ $entry->Name }} ({{ $entry->Department }})</option>
                @endforeach
              </select>
            </div>
            <button type="submit" class="btn btn-primary pull-right">Submit</button>
          </form>
        </div>
      </div>
      <div class="panel panel-success" id="cuti-panel">
        <div class="panel-heading">
          <h2 class="panel-title"><a data-toggle="collapse" data-parent="accordion" href="#collapse2">Cuti/Izin</a></h2>
        </div>
        <div class="panel-collapse collapse" id="collapse2">
          <form class="panel-body" id="cuti-form" action="{{ route('submit.cuti') }}" method="post">
            <div class="form-row">
              <div class="form-group col-md-6" style="padding-left: 0">
                <label for="nama-cuti" class="control-label">Alasan:</label>
                {{ csrf_field()}}
                <input type="text" name="nama-cuti" class="form-control" placeholder="contoh: Sakit">
              </div>
              <div class="form-group col-md-6" style="padding-right: 0">
                <label for="range-cuti" class="control-label">Periode:</label>
                {{ csrf_field()}}
                <input type="text" name="range-cuti" id="range-cuti" class="form-control">
              </div>
              <div class="form-group col-md-6" style="padding-right: 0">
                <label for="range-cuti" class="control-label">Periode:</label>
                {{ csrf_field()}}
                <input type="text" name="range-cuti" id="range-cuti" class="form-control">
              </div>
            </div>
            
            <div class="form-group">
              <label for="berlaku-cuti" class="control-label">Berlaku bagi:</label>
              {{ csrf_field()}}
              <select multiple class="selectpicker form-control" data-live-search="true" id="berlaku-cuti" data-actions-box="true">
                @foreach ($entries as $entry)
                  <option value="{{ $entry->Name }}">{{ $entry->Name }} ({{ $entry->Department }})</option>
                @endforeach
              </select>
            </div>
            
            <button type="submit" class="btn btn-success pull-right">Submit</button>
          </form>
        </div>
      </div>
      <div class="panel panel-warning" id="perdin-panel">
        <div class="panel-heading">
          <h2 class="panel-title"><a data-toggle="collapse" data-parent="accordion" href="#collapse3">Perjalanan Dinas</a></h2>
        </div>
        <div class="panel-collapse collapse" id="collapse3">
          <form class="panel-body" id="cuti-form" action="{{ route('submit.cuti') }}" method="post">
            <div class="form-row">
              <div class="form-group col-md-6" style="padding-left: 0">
                <label for="nama-perdin" class="control-label">Alasan:</label>
                {{ csrf_field()}}
                <input type="text" name="nama-perdin" class="form-control" placeholder="contoh: Rapat di Kemkominfo">
              </div>
              <div class="form-group col-md-6" style="padding-right: 0">
                <label for="range-perdin" class="control-label">Periode:</label>
                {{ csrf_field()}}
                <input type="text" name="range-perdin" id="range-perdin" class="form-control">
              </div>
            </div>
            <div class="form-group">
              <label for="berlaku-perdin" class="control-label">Berlaku bagi:</label>
              {{ csrf_field()}}
              <select multiple class="selectpicker form-control" data-live-search="true" id="berlaku-perdin" data-actions-box="true">
                @foreach ($entries as $entry)
                  <option value="{{ $entry->Name }}">{{ $entry->Name }} ({{ $entry->Department }})</option>
                @endforeach
              </select>
            </div>
            <button type="submit" class="btn btn-warning pull-right">Submit</button>
          </form>
        </div>
      </div>
      <div class="panel panel-danger" id="mesin-rusak-panel">
        <div class="panel-heading">
          <h2 class="panel-title"><a data-toggle="collapse" data-parent="accordion" href="#collapse4">Mesin Rusak</a></h2>
        </div>
        <div class="panel-collapse collapse" id="collapse4">
          <form class="panel-body" id="rusak-form" action="{{ route('test.store') }}" method="post">
            <div class="form-row">
              <div class="form-group" style="padding-left: 0">
                <label for="range-rusak" class="control-label">Periode:</label>
                {{ csrf_field()}}
                <input type="text" name="range-rusak" id="range-rusak" class="form-control" >
              </div>
            </div>
            <div class="form-row">
              <div class="form-group" style="padding-right: 0">
                <label for="berlaku-rusak" class="control-label">Berlaku Bagi:</label>
                {{ csrf_field()}}
                <select multiple class="selectpicker form-control" data-live-search="true" id="berlaku-rusak" data-actions-box="true">
                  @foreach ($entries as $entry)
                    <option value="{{ $entry->Name }}">{{ $entry->Name }} ({{ $entry->Department }})</option>
                  @endforeach
                </select>
              </div>
            </div>
            <button type="submit" class="btn btn-danger pull-right">Submit</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection

@section('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.4/js/bootstrap-select.min.js"></script>

@endsection
