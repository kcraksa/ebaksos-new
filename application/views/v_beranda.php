<?php  

$nama = $this->session->userdata('vNama');

?>
<style>
	#beranda-greeting {
		font-size: 20pt;
	}

	#beranda-greeting2 {
		font-size: 10pt;
	}
</style>
<div class="container">
	<div class="row">
		<div class="col-md-12">
			<p id="beranda-greeting">Hello, <?= $nama ?></p>
			<p id="beranda-greeting2">Selamat Datang Kembali.</p>
		</div>
	</div>
</div>