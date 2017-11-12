<div class="container">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-default">
				<div class="panel-heading">
					Form Konfirmasi Pembayaran Event
				</div>
				<div class="panel-body">
					<form action="<?= site_url() ?>/c_event/prosesKonfirmasiPembayaranByUser" method="post" class="form-horizontal">
						<div class="form-group">
							<label for="rekening_pengirim" class="control-label col-md-4">No.Rekening Pengirim :</label>
							<div class="col-md-8">
								<input type="text" class="form-control" id="rekening_pengirim" name="rekening_pengirim" required>
							</div>
						</div>
						<div class="form-group">
							<label for="nama_pemilik" class="control-label col-md-4">Nama Pemilik :</label>
							<div class="col-md-8">
								<input type="text" class="form-control" id="nama_pemilik" name="nama_pemilik" required>
							</div>
						</div>
						<div class="form-group">
							<label for="nominal_transfer" class="control-label col-md-4">Nominal Transfer :</label>
							<div class="col-md-8">
								<input type="text" class="form-control" id="nominal_transfer" name="nominal_transfer" required>
							</div>
						</div>
						<div class="form-group">
							<label for="perihal_transfer" class="control-label col-md-4">Perihal Transfer :</label>
							<div class="col-md-8">
								<input type="hidden" id="id_event" name="id_event" value="<?php echo $data['id'] ?>">
								<input type="text" class="form-control" id="perihal_transfer" name="perihal_transfer" value="<?php echo $data['vNamaEvent'] ?>" readonly>
							</div>
						</div>
						<div style="text-align: right;">
							<button class="btn btn-primary" type="submit">Submit</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>