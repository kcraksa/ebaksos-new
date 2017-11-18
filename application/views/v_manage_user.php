<?php 
	// print_r($this->session->userdata());
	// exit();
?>
<div class="container">
	<div class="row">
		<div class="col-md-12">
			<h3>List User</h3>
			<hr>
		</div>
	</div>
	<div class="row">
		<div class="col-md-12">
			<table id="table_event_diikuti" class="table table-striped table-bordered">
				<thead>
					<tr>
						<th align="center">No.</th>
						<th align="center">Nama User</th>
						<th align="center">Email</th>
						<th align="center">Role</th>
						<th align="center">Action</th>
					</tr>
				</thead>
			</table>
		</div>
	</div>
</div>

<script>
	$(document).ready(function () {
		$('#table_event_diikuti').DataTable({
			ajax: {
				url: '<?= site_url('c_event/getDataAllUser') ?>',
				type: 'GET'
			},
			columnDefs: [
				{ width: 100, targets: 4 },
				{ width: 10, targets: 0 }
			]
		});
	})	
</script>