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
		<form action="<?= base_url() ?>index.php/c_event/update" method="POST" class="form-horizontal">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h3>Edit Event</h3>
				</div>
				<div class="panel-body">
					<div class="form-group">
						<label for="event_name" class="control-label col-sm-3">Nama Event :</label>
						<div class="col-sm-9">
							<input type="hidden" name="EventId" value="<?= $data['id'] ?>">
							<input type="text" class="form-control" id="event_name" name="event_name" required value='<?= $data['vNamaEvent'] ?>'>
						</div>
					</div>
					<div class="form-group">
						<label for="ket_event" class="control-label col-sm-3">Deskripsi :</label>
						<div class="col-sm-9">
							<textarea name="ket_event" id="ket_event" class="form-control" required rows="10"><?= $data['vDeskripsi'] ?></textarea>
						</div>
					</div>
					<div class="form-group">
						<label for="tanggal_event" class="control-label col-sm-3">Tanggal Event :</label>
						<div class="col-sm-3">
							<?php $date = date('d-m-Y', strtotime($data['dEvent'])) ?>
							<input type="text" class="form-control" id="tanggal_event" name="tanggal_event" readonly required value='<?=$date?>'>
						</div>
					</div>
					<div class="form-group">
						<label for="jam_event" class="control-label col-sm-3">Jam :</label>
						<div class="col-sm-9 form-inline">
							<?php $to = date('H:i', strtotime($data['tEventTo'])); $from = date('H:i', strtotime($data['tEventFrom'])); ?>
							<input type="text" class="form-control" id="jam_event1" name="jam_event1" style="width: 100px;" required value="<?=$from?>">
							<label for="jam_event" class="control-label">s/d</label>
							<input type="text" class="form-control" id="jam_event2" name="jam_event2" style="width: 100px;" required value="<?=$to?>">
							<i style="font-size: 8pt">*format 00:00</i>
						</div>
					</div>
					<div class="form-group">
						<label for="alamat_event" class="control-label col-sm-3">Cari Alamat :</label>
						<div class="col-sm-9">
							<input type="text" id="geocomplete" class="form-control" value="<?= $data['vAddress'] ?>">
							<div class="map_canvas" style="width: 500px; height: 500px; margin-top: 10px"></div>
							<input name="lat" type="hidden" value="<?= $data['vLat'] ?>">
							<input name="lng" type="hidden" value="<?= $data['vLon'] ?>">
							<input name="formatted_address" type="hidden" value="<?= $data['vAddress'] ?>">
						</div>
					</div>
					<div class="form-group">
						<label for="htm_event" class="control-label col-sm-3">Tiket :</label>
						<div class="col-sm-9">
							<?php  

								if ($data['iTiket'] == 1) {
									$c1 = 'checked';
									$c0 = '';
								} else {
									$c1 = '';
									$c0 = 'checked';
								}

							?>
							<label class="radio-inline"><input type="radio" name="htm_event" id="htm_event" value="1" required <?=$c1?>>Ada</label>
							<label class="radio-inline"><input type="radio" name="htm_event" id="htm_event" value="0" required <?=$c0?>>Tidak Ada</label>
						</div>
					</div>
					<div id="pembayaran-field">
					<div class="form-group">
						<label for="harga_tiket" class="control-label col-sm-3">Harga Tiket :</label>
						<div class="col-sm-9">
							<input type="text" name="harga_tiket" id="harga_tiket" class="form-control" required value="<?= $data['vHargaTiket'] ?>">
						</div>
					</div>
					<div class="form-group">
						<label for="no_rekening" class="control-label col-sm-3">No. Rekening Pembayaran :</label>
						<div class="col-sm-9">
							<input type="text" name="no_rekening" id="no_rekening" class="form-control" required value="<?= $data['vNoRek'] ?>">
						</div>
					</div>
					<div class="form-group">
						<label for="pemilik_rekening" class="control-label col-sm-3">Pemilik Rekening :</label>
						<div class="col-sm-9">
							<input type="text" name="pemilik_rekening" id="pemilik_rekening" class="form-control" required value="<?= $data['vPemilikRek'] ?>">
						</div>
					</div>
					<div class="form-group">
						<label for="nama_bank" class="control-label col-sm-3">Bank :</label>
						<div class="col-sm-9">
							<select name="nama_bank" id="nama_bank" class="form-control">
								<option value=""></option>

							<?php 

								foreach ($bank->result_array() as $v) {

									if ($v['id'] == $data['iBankId']) {
										$select = "selected";
									} else {
										$select = "";
									}

									echo "<option value='{$v['id']}' {$select}>{$v['vBankName']}</option>";
								}

							?>

							</select>
						</div>
					</div>
					</div>
					<div class="form-group">
						<label for="harga_tiket" class="control-label col-sm-3">Harga Tiket :</label>
						<div class="col-sm-9">
							<input type="text" name="harga_tiket" id="harga_tiket" class="form-control" required value="<?= $data['vHargaTiket'] ?>">
						</div>
					</div>
					<div class="form-group">
						<label for="kuota_peserta" class="control-label col-sm-3">Kuota Peserta :</label>
						<div class="col-sm-9 form-inline">
							<input type="text" name="kuota_peserta" id="kuota_peserta" class="form-control" required style="width: 50px" value="<?= $data['iKuota'] ?>"> Orang
						</div>
					</div>
					<div class="form-group">
						<label for="keterangan_event" class="control-label col-sm-3">Keterangan :</label>
						<div class="col-sm-9">
							<textarea name="keterangan_event" id="keterangan_event" class="form-control" required><?= $data['vKeterangan'] ?></textarea>
						</div>
					</div>
					<div class="form-group">
						<div class="col-sm-12" style="text-align: right;">
							<button class="btn btn-primary">Update</button>
						</div>
					</div>
				</div>
			</div>
		</form>
	</div>
</div>
<script>
	$(document).ready(function () {

		// $('#geocomplete').trigger('geocode');

		$('#tanggal_event').datepicker({
			format: 'dd-mm-yyyy'
		});

		$('#geocomplete').geocomplete({
			map: '.map_canvas',
			details: "form",
          	types: ["geocode", "establishment"]
		});

		$("#geocomplete").geocomplete("find", "<?= $data['vAddress'] ?>");

		new AutoNumeric('#harga_tiket', { allowDecimalPadding: false });
		new AutoNumeric('#kuota_peserta', { allowDecimalPadding: false });

		var iTiket = '<?= $data['iTiket'] ?>';
		if (iTiket == 1) {
			$('#pembayaran-field').show('fast', 'swing');
		} else {
			$('#pembayaran-field').hide('fast', 'swing');
		}

		$('[name="htm_event"]').change(function(){
			if ($('[name="htm_event"]:checked').val() == 1) {
				$('#pembayaran-field').show('fast', 'swing');
			} else {
				$('#pembayaran-field').hide('fast', 'swing');
			}
		})
	})
</script>