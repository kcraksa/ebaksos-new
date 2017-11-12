<?php 
	// print_r($this->session->userdata());
	// exit();
?>
<div class="container">
	<div class="row">
		<div class="col-md-12">
			<h3>List Event Diikuti</h3>
			<hr>
		</div>
	</div>
	<div class="row">
		<div class="col-md-12">
			<table id="table_event_diikuti" class="table table-striped table-bordered">
				<thead>
					<tr>
						<th align="center">No.</th>
						<th align="center">Nama Kegiatan</th>
						<!-- <th align="center">Lokasi</th> -->
						<th align="center">Tanggal</th>
						<th align="center">Waktu</th>
						<th align="center">Lokasi</th>
						<th align="center">Harga Tiket</th>
						<th align="center">Kuota Peserta</th>
						<th align="center">Action</th>
					</tr>
				</thead>
			</table>
		</div>
	</div>
</div>

<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Detail</h4>
      </div>
      <div class="modal-body">
        <div id="detail_event">
        	
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>

<script>
	$(document).ready(function () {
		$('#table_event_diikuti').DataTable({
			ajax: {
				url: '<?= site_url('c_event/ikut_event') ?>',
				type: 'GET'
			},
			columnDefs: [
				{ width: 60, targets: 7 }
			]
		});
	})	

	function showDetailEvent(id) {
		$.ajax({
			url: '<?= site_url("c_event/getDetailEvent") ?>',
			type: 'POST',
			data: {
				'id': id
			},
			success: function(data) {
				$('#detail_event').html(data);
				console.log(data);
			}
		})
	}
</script>