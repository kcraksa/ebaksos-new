<?php  

$nama = $this->session->userdata('vNama');

?>
<div class="container">
	<div class="row">
		<div class="col-md-12">
			<p>Hello, <?= $nama ?></p>
			<p>Selamat Datang Kembali.</p>
		</div>
	</div>
</div>