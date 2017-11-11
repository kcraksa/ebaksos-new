<?php  

$pekerjaan = array('' => '', 1 => 'Karyawan', 2 => 'Pegawai Negeri Sipil', 3 => 'TNI/POLRI', 4 => 'Wiraswasta', 5 => 'Lain - Lain');

?>
<div class="container">
	<div class="row">
		<form action="<?= base_url() ?>index.php/welcome/volunteerRegisterProcess" method="POST" class="form-horizontal">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h3>Form Pendaftaran Volunteer Bakti Sosial</h3>
				</div>
				<div class="panel-body">
					<div class="form-group">
						<label for="nama_volunteer_reg" class="control-label col-sm-3">Nama :</label>
						<div class="col-sm-9">
							<input type="text" class="form-control" id="nama_volunteer_reg" name="nama_volunteer_reg" required>
						</div>
					</div>
					<div class="form-group">
						<label for="alamat_volunteer_reg" class="control-label col-sm-3">Alamat :</label>
						<div class="col-sm-9">
							<textarea name="alamat_volunteer_reg" id="alamat_volunteer_reg" class="form-control" required></textarea>
						</div>
					</div>
					<div class="form-group">
						<label for="gender_pj_eo" class="control-label col-sm-3">Jenis Kelamin :</label>
						<div class="col-sm-9">
							<label class="radio-inline"><input type="radio" name="gender_volunteer_reg" id="gender_volunteer_reg" value="L" required>Laki - Laki</label>
							<label class="radio-inline"><input type="radio" name="gender_volunteer_reg" id="gender_volunteer_reg" value="P" required>Perempuan</label>
						</div>
					</div>
					<div class="form-group">
						<label for="birthplace_volunteer_reg" class="control-label col-sm-3">Tempat Lahir :</label>
						<div class="col-sm-9">
							<input type="text" name="birthplace_volunteer_reg" id="birthplace_volunteer_reg" class="form-control" required></textarea>
						</div>
					</div>
					<div class="form-group">
						<label for="birthday_volunteer_reg" class="control-label col-sm-3">Tanggal Lahir :</label>
						<div class="col-sm-9">
							<input type="text" name="birthday_volunteer_reg" id="birthday_volunteer_reg" class="form-control" required readonly>
						</div>
					</div>
					<div class="form-group">
						<label for="idno_volunteer_reg" class="control-label col-sm-3">Nomor KTP/SIM/PASSPOR :</label>
						<div class="col-sm-9">
							<input type="text" class="form-control" id="idno_volunteer_reg" name="idno_volunteer_reg" required>
						</div>
					</div>
					<div class="form-group">
						<label for="kerja_volunteer_reg" class="control-label col-sm-3">Pekerjaan :</label>
						<div class="col-sm-9">
							<select name="kerja_volunteer_reg" id="kerja_volunteer_reg" class="form-control" required>
								<?php  

								foreach ($pekerjaan as $k => $v) {
									echo "<option value='{$k}'>{$v}</option>";
								}

								?>
							</select>
						</div>
					</div>
					<div class="form-group">
						<label for="email_volunteer_reg" class="control-label col-sm-3">Email :</label>
						<div class="col-sm-9">
							<input type="email" class="form-control" id="email_volunteer_reg" name="email_volunteer_reg" required>
						</div>
					</div>
					<div class="form-group">
						<label for="password_volunteer_reg" class="control-label col-sm-3">Password :</label>
						<div class="col-sm-9">
							<input type="password" class="form-control" id="password_volunteer_reg" name="password_volunteer_reg" required>
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
		$('#birthday_volunteer_reg').datepicker({
			format: 'dd-mm-yyyy'
		});
	})
</script>