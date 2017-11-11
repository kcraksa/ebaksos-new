<?php  

$pekerjaan = array('' => '', 1 => 'Karyawan', 2 => 'Pegawai Negeri Sipil', 3 => 'TNI/POLRI', 4 => 'Wiraswasta', 5 => 'Lain - Lain');

?>
<style>
	.partisi {
		background-color: #000;
		color: #fff;
		width: 103.5%;
		padding: 8px;
		margin: 19px 0px 19px -23px;
	}
</style>
<div class="container">
	<div class="row">
		<form action="<?= base_url() ?>index.php/c_event/save" method="POST" class="form-horizontal">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h3>Tambah Event</h3>
				</div>
				<div class="panel-body">
					<div class="form-group">
						<label for="event_name" class="control-label col-sm-3">Nama Event :</label>
						<div class="col-sm-9">
							<input type="text" class="form-control" id="event_name" name="event_name" required>
						</div>
					</div>
					<div class="form-group">
						<label for="ket_event" class="control-label col-sm-3">Deskripsi :</label>
						<div class="col-sm-9">
							<textarea name="ket_event" id="ket_event" class="form-control" required rows="10"></textarea>
						</div>
					</div>
					<div class="form-group">
						<label for="tanggal_event" class="control-label col-sm-3">Tanggal Event :</label>
						<div class="col-sm-3">
							<input type="text" class="form-control" id="tanggal_event" name="tanggal_event" readonly required>
						</div>
					</div>
					<div class="form-group">
						<label for="jam_event" class="control-label col-sm-3">Jam :</label>
						<div class="col-sm-9 form-inline">
							<input type="text" class="form-control" id="jam_event1" name="jam_event1" style="width: 100px;" required>
							<label for="jam_event" class="control-label">s/d</label>
							<input type="text" class="form-control" id="jam_event2" name="jam_event2" style="width: 100px;" required>
							<i style="font-size: 8pt">*format 00:00</i>
						</div>
					</div>
					<div class="form-group">
						<label for="alamat_event" class="control-label col-sm-3">Cari Alamat :</label>
						<div class="col-sm-9">
							<input type="text" id="geocomplete" class="form-control">
							<div class="map_canvas" style="width: 500px; height: 500px; margin-top: 10px"></div>
							<input name="lat" type="hidden" value="">
							<input name="lng" type="hidden" value="">
							<input name="formatted_address" type="hidden" value="">
						</div>
					</div>
					<div class="form-group">
						<label for="htm_event" class="control-label col-sm-3">Tiket :</label>
						<div class="col-sm-9">
							<label class="radio-inline"><input type="radio" name="htm_event" id="htm_event" value="1" required>Ada</label>
							<label class="radio-inline"><input type="radio" name="htm_event" id="htm_event" value="0" required>Tidak Ada</label>
						</div>
					</div>
					<div id="pembayaran-field">
					<div class="form-group">
						<label for="harga_tiket" class="control-label col-sm-3">Harga Tiket :</label>
						<div class="col-sm-9">
							<input type="text" name="harga_tiket" id="harga_tiket" class="form-control" required>
						</div>
					</div>
					<div class="form-group">
						<label for="no_rekening" class="control-label col-sm-3">No. Rekening Pembayaran :</label>
						<div class="col-sm-9">
							<input type="text" name="no_rekening" id="no_rekening" class="form-control" required>
						</div>
					</div>
					<div class="form-group">
						<label for="pemilik_rekening" class="control-label col-sm-3">Pemilik Rekening :</label>
						<div class="col-sm-9">
							<input type="text" name="pemilik_rekening" id="pemilik_rekening" class="form-control" required>
						</div>
					</div>
					<div class="form-group">
						<label for="nama_bank" class="control-label col-sm-3">Bank :</label>
						<div class="col-sm-9">
							<select name="nama_bank" id="nama_bank" class="form-control">
								<option value=""></option>

							<?php 

								foreach ($bank->result_array() as $v) {
									echo "<option value='{$v['id']}'>{$v['vNamaBank']}</option>";
								}

							?>

							</select>
						</div>
					</div>
					</div>
					<div class="form-group">
						<label for="kuota_peserta" class="control-label col-sm-3">Kuota Peserta :</label>
						<div class="col-sm-9 form-inline">
							<input type="text" name="kuota_peserta" id="kuota_peserta" class="form-control" required style="width: 50px"> Orang
						</div>
					</div>
					<div class="form-group">
						<label for="keterangan_event" class="control-label col-sm-3">Keterangan :</label>
						<div class="col-sm-9">
							<textarea name="keterangan_event" id="keterangan_event" class="form-control" required></textarea>
						</div>
					</div>
					<div class="form-group">
						<div class="col-sm-12" style="text-align: right;">
							<button class="btn btn-primary">Submit</button>
						</div>
					</div>
				</div>
			</div>
		</form>
	</div>
</div>
<script>
	$(document).ready(function () {
		$('#tanggal_event').datepicker({
			format: 'dd-mm-yyyy'
		});

		$('#geocomplete').geocomplete({
			map: '.map_canvas',
			details: "form",
          	types: ["geocode", "establishment"],
		});

		new AutoNumeric('#harga_tiket', { allowDecimalPadding: false });
		new AutoNumeric('#kuota_peserta', { allowDecimalPadding: false });

		$('#pembayaran-field').hide('fast');

		$('[name="htm_event"]').change(function(){
			if ($('[name="htm_event"]:checked').val() == 1) {
				$('#pembayaran-field').show('fast', 'swing');
			} else {
				$('#pembayaran-field').hide('fast', 'swing');
			}
		})
	})
</script>