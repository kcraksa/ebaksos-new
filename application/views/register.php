<?php  

$pekerjaan = array('' => '', 1 => 'Karyawan', 2 => 'Pegawai Negeri Sipil', 3 => 'TNI/POLRI', 4 => 'Wiraswasta', 5 => 'Lain - Lain');

?>
<div class="container">
	<div class="row">
		<form action="<?= base_url() ?>index.php/welcome/registerProcess" method="POST" class="form-horizontal">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h3>Form Pendaftaran Penyelenggara Bakti Sosial</h3>
				</div>
				<div class="panel-body">
					<div class="form-group">
						<label for="nama_register_eo" class="control-label col-sm-3">Nama Penyelenggara :</label>
						<div class="col-sm-9">
							<input type="text" class="form-control" id="nama_register_eo" name="nama_register_eo" required>
						</div>
					</div>
					<div class="form-group">
						<label for="alamat_register_eo" class="control-label col-sm-3">Alamat Penyelenggara :</label>
						<div class="col-sm-9">
							<textarea name="alamat_register_eo" id="alamat_register_eo" class="form-control" required></textarea>
						</div>
					</div>
					<div class="form-group">
						<label for="nama_pj_eo" class="control-label col-sm-3">Nama Penanggung Jawab :</label>
						<div class="col-sm-9">
							<input type="text" class="form-control" id="nama_pj_eo" name="nama_pj_eo" required>
						</div>
					</div>
					<div class="form-group">
						<label for="gender_pj_eo" class="control-label col-sm-3">Jenis Kelamin :</label>
						<div class="col-sm-9">
							<label class="radio-inline"><input type="radio" name="gender_pj_eo" id="gender_pj_eo" value="L" required>Laki - Laki</label>
							<label class="radio-inline"><input type="radio" name="gender_pj_eo" id="gender_pj_eo" value="P" required>Perempuan</label>
						</div>
					</div>
					<div class="form-group">
						<label for="idno_pj_eo" class="control-label col-sm-3">Nomor KTP/SIM/PASSPOR :</label>
						<div class="col-sm-9">
							<input type="text" class="form-control" id="idno_pj_eo" name="idno_pj_eo" required>
						</div>
					</div>
					<div class="form-group">
						<label for="kerja_pj_eo" class="control-label col-sm-3">Pekerjaan :</label>
						<div class="col-sm-9">
							<select name="kerja_pj_eo" id="kerja_pj_eo" class="form-control" required>
								<?php  

								foreach ($pekerjaan as $k => $v) {
									echo "<option value='{$k}'>{$v}</option>";
								}

								?>
							</select>
						</div>
					</div>
					<div class="form-group">
						<label for="alamat_pj_eo" class="control-label col-sm-3">Alamat Penanggung Jawab :</label>
						<div class="col-sm-9">
							<textarea name="alamat_pj_eo" id="alamat_pj_eo" class="form-control" required></textarea>
						</div>
					</div>
					<div class="form-group">
						<label for="jabatan_pj_eo" class="control-label col-sm-3">Jabatan Dalam Organisasi :</label>
						<div class="col-sm-9">
							<input type="text" class="form-control" id="jabatan_pj_eo" name="jabatan_pj_eo" required>
						</div>
					</div>
					<div class="form-group">
						<label for="email_register_eo" class="control-label col-sm-3">Email :</label>
						<div class="col-sm-9">
							<input type="email" class="form-control" id="email_register_eo" name="email_register_eo" required>
						</div>
					</div>
					<div class="form-group">
						<label for="password_register_eo" class="control-label col-sm-3">Password :</label>
						<div class="col-sm-9">
							<input type="password" class="form-control" id="password_register_eo" name="password_register_eo" required>
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