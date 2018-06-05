@extends('base')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-8 col-md-offset-2 panel-group" id="accordion">
			<div class="panel panel-primary" id="libur-panel">
				<div class="panel-heading">
					<h2 class="panel-title"><a data-toggle="collapse" data-parent="accordion" href="#collapse1">Liburan</a></h2>
				</div>
				<div class="panel-collapse collapse in" id="collapse1">
					<form class="panel-body" id="libur-form">
						<div class="form-group">
							<label for="nama-libur" class="control-label">Nama Libur:</label>
							<input type="text" name="nama-libur" class="form-control" placeholder="contoh: Idul Fitri">
						</div>
						<div class="form-row">
							<div class="form-group col-md-6" style="padding-left: 0">
								<label for="awal-libur" class="control-label">Dari tanggal:</label>
								<input type="text" name="awal-libur" class="form-control" placeholder="05 Jun 2018">
							</div>
							<div class="form-group col-md-6" style="padding-right: 0">
								<label for="akhir-libur" class="control-label">sampai:</label>
								<input type="text" name="akhir-libur" class="form-control" placeholder="13 Jun 2018">
							</div>
						</div>
						<div class="form-group">
							<label for="berlaku-libur" class="control-label">Berlaku bagi:</label>
							<input type="text" name="berlaku-libur" class="form-control" placeholder="Meita">
						</div>
						<button type="submit" class="btn btn-primary pull-right">Submit</button>
					</form>
				</div>
			</div>
			<div class="panel panel-info" id="cuti-panel">
				<div class="panel-heading">
					<h2 class="panel-title"><a data-toggle="collapse" data-parent="accordion" href="#collapse2">Cuti/Izin</a></h2>
				</div>
				<div class="panel-collapse collapse" id="collapse2">
					<form class="panel-body" id="cuti-form">
						<div class="form-group">
							<label for="nama-cuti" class="control-label">Alasan:</label>
							<input type="text" name="nama-cuti" class="form-control" placeholder="contoh: Sakit">
						</div>
						<div class="form-row">
							<div class="form-group col-md-6" style="padding-left: 0">
								<label for="awal-cuti" class="control-label">Dari tanggal:</label>
								<input type="text" name="awal-cuti" class="form-control" placeholder="05 Jun 2018">
							</div>
							<div class="form-group col-md-6" style="padding-right: 0">
								<label for="akhir-cuti" class="control-label">sampai:</label>
								<input type="text" name="akhir-cuti" class="form-control" placeholder="13 Jun 2018">
							</div>
						</div>
						<div class="form-group">
							<label for="berlaku-cuti" class="control-label">Berlaku bagi:</label>
							<input type="text" name="berlaku-cuti" class="form-control" placeholder="Meita">
						</div>
						<button type="submit" class="btn btn-primary pull-right">Submit</button>
					</form>
				</div>
			</div>
			<div class="panel panel-warning" id="perdin-panel">
				<div class="panel-heading">
					<h2 class="panel-title"><a data-toggle="collapse" data-parent="accordion" href="#collapse3">Perjalanan Dinas</a></h2>
				</div>
				<div class="panel-collapse collapse" id="collapse3">
					<form class="panel-body" id="cuti-form">
						<div class="form-group">
							<label for="nama-perdin" class="control-label">Alasan:</label>
							<input type="text" name="nama-perdin" class="form-control" placeholder="contoh: Rapat di Kemkominfo">
						</div>
						<div class="form-row">
							<div class="form-group col-md-6" style="padding-left: 0">
								<label for="begin-perdin" class="control-label">Dari pukul:</label>
								<input type="text" name="begin-perdin" class="form-control" placeholder="05 Jun 2018 09:00">
							</div>
							<div class="form-group col-md-6" style="padding-right: 0">
								<label for="end-perdin" class="control-label">sampai:</label>
								<input type="text" name="end-perdin" class="form-control" placeholder="6 Jun 2018 13:00">
							</div>
						</div>
						<div class="form-group">
							<label for="berlaku-perdin" class="control-label">Berlaku bagi:</label>
							<input type="text" name="berlaku-perdin" class="form-control" placeholder="Meita">
						</div>
						<button type="submit" class="btn btn-primary pull-right">Submit</button>
					</form>
				</div>
			</div>
			<div class="panel panel-danger" id="mesin-rusak-panel">
				<div class="panel-heading">
					<h2 class="panel-title"><a data-toggle="collapse" data-parent="accordion" href="#collapse4">Mesin Rusak</a></h2>
				</div>
				<div class="panel-collapse collapse" id="collapse4">
					<form class="panel-body" id="cuti-form">
						<div class="form-row">
							<div class="form-group col-md-6" style="padding-left: 0">
								<label for="awal-rusak" class="control-label">Dari tanggal:</label>
								<input type="text" name="awal-rusak" class="form-control" placeholder="05 Jun 2018">
							</div>
							<div class="form-group col-md-6" style="padding-right: 0">
								<label for="akhir-rusak" class="control-label">sampai:</label>
								<input type="text" name="akhir-rusak" class="form-control" placeholder="6 Jun 2018">
							</div>
						</div>
						<div class="form-group">
							<label for="berlaku-rusak" class="control-label">Berlaku bagi:</label>
							<input type="text" name="berlaku-rusak" class="form-control" placeholder="Meita">
						</div>
						<button type="submit" class="btn btn-primary pull-right">Submit</button>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection

@section('js')
<script type="text/javascript">
	$( function() {
        $("input[name*=awal], input[name*=akhir]").datepicker({
            dateFormat: "dd M yy",
            changeMonth: true,
            changeYear: true
        });
    });
</script>
@endsection
