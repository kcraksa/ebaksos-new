<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>e-Baksos - Selalu Ada Cara Untuk Menolong Sesama</title>
	<!-- CSS -->
	<link rel="stylesheet" href="<?php echo base_url() ?>assets/css/bootstrap.min.css">
	<!-- <link rel="stylesheet" href="<?php echo base_url() ?>assets/css/style.css"> -->
	<link rel="stylesheet" href="<?= base_url() ?>assets/css/font-awesome.min.css">
	<link rel="stylesheet" href="<?= base_url() ?>assets/css/bootstrap-datepicker.min.css">
	<link rel="stylesheet" href="<?= base_url() ?>assets/css/datatables.min.css">

	<!-- Javascript -->
	<script type="text/Javascript" src="<?=base_url().'assets/js/jquery.min.js'?>"></script>
	<script type="text/Javascript" src="<?=base_url().'assets/js/bootstrap.min.js'?>"></script>
	<script type="text/Javascript" src="<?=base_url().'assets/js/bootstrap-datepicker.min.js'?>"></script>
	<script type="text/Javascript" src="<?=base_url().'assets/js/datatables.min.js'?>"></script>
	<script type="text/Javascript" src="<?=base_url().'assets/js/jquery.geocomplete.min.js'?>"></script>
	<script type="text/Javascript" src="<?=base_url().'assets/js/autoNumeric.min.js'?>"></script>
	<script src="http://maps.googleapis.com/maps/api/js?libraries=places&key=AIzaSyBnMYVgkf8p6QZr5xOl3hvSr_xVi56Djss"></script>
</head>
<body>

	<!-- Header -->

	<div id="header">
		<nav class="navbar navbar-inverse">
			<div class="container-fluid">
				<div class="navbar-header">
					<a href="<?= base_url() ?>index.php" class="navbar-brand">e-Baksos</a>
				</div>

				<?php if ($this->session->has_userdata('iTypeUser')) { ?>
		
				<ul class="nav navbar-nav">
					<li><a href="<?= site_url() ?>/c_event/">Event</a></li>
				</ul>			

				<ul class="nav navbar-nav navbar-right">
					<li><a href="<?= base_url() ?>index.php/welcome/logOutProcess"><i class="fa fa-sign-in"></i> Logout</a></li>
				</ul>

				<?php } else { ?>

				<ul class="nav navbar-nav navbar-right">
					<li><a href="<?= base_url() ?>index.php/welcome/showRegisterForm"><i class="fa fa-id-card-o"></i> Daftar Sebagai Penyelenggara</a></li>
					<li><a href="<?= base_url() ?>index.php/welcome/showFormRegisterVolunteer"><i class="fa fa-users"></i> Daftar Sebagai Peserta</a></li>
					<li><a href="<?= base_url() ?>index.php/welcome/loginForm"><i class="fa fa-sign-in"></i> Login</a></li>
				</ul>

				<?php } ?>
			</div>
		</nav>	
	</div>

	<!-- End Header -->