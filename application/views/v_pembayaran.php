<div class="container" style="text-align: center;">
	<div class="row">
		<div class="col-md-12">
			<div class="panel panel-default">
				<div class="panel-body">
					Selamat, Anda Telah Mendaftarkan Diri Sebagai Peserta Kegiatan <b><?php echo $data[0]['vNamaEvent'] ?></b>. <br>
					Selanjutnya, silahkan Anda melakukan pembayaran untuk tiket kegiatan ke rekening <b><?php echo $data[0]['vNoRek'] ?> a/n <?php echo $data[0]['vPemilikRek'] ?></b>. <br>
					Jika sudah, dimohon untuk segera melakukan konfirmasi pembayaran di menu Event -> Event Diikuti -> Klik Tombol Confirm. <br>
					Terima Kasih
				</div>
			</div>
			<div style="text-align: center;">
				<a href="<?php echo site_url() ?>/c_event/" class="btn btn-primary">Kembali Ke Menu Utama</a>
			</div>
		</div>
	</div>
</div>