<?php  

/**
* 
*/
class C_event extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->model('m_crud');
		$this->load->model('m_event');
	}

	function index() {
		$this->load->view('headerLogin');
		$this->load->view('v_event_penyelenggara');
	}

	function formAddEvent() {

		$data['provinsi'] = $this->m_crud->get('provinces');
		$data['bank']     = $this->m_crud->get('bank');

		$this->load->view('headerLogin');
		$this->load->view('v_add_event', $data);
	}

	function formEditEvent($id) {

		$query = $this->db->get_where('event', array('id' => $id));
		foreach ($query->result_array() as $k => $v) {
			$row_data = $v;
		}

		$data['data'] = $row_data;
		$data['bank'] = $this->m_crud->get('bank');

		$this->load->view('headerLogin');
		$this->load->view('v_edit_event', $data);
	}

	function showEventDiikuti() {
		$this->load->view('headerLogin');
		$this->load->view('v_event_diikuti');
	}

	function showManageEvent() {

		$this->load->view('headerLogin');
		$this->load->view('v_manage_event');
	}

	function showAllUser() {

		$this->load->view('headerLogin');
		$this->load->view('v_manage_user');
	}

	function formKonfirmasiPembayaran($id) {

		$data = array();

		$query = $this->m_crud->selectWhere('event', array('id', 'vNamaEvent'), array('id' => $id));
		foreach ($query->result_array() as $row) {
			$data = $row;
		}

		$datanya['data'] = $data;

		$this->load->view('headerLogin');
		$this->load->view('v_konfirmasi_pembayaran', $datanya);
	}

	function prosesKonfirmasiPembayaranByUser() {

		$insert = array(
					'id'             => '',
					'iEventId'       => $this->input->post('id_event'),
					'iUserId'        => $this->session->userdata('id'),
					'vRekeningBayar' => $this->input->post('rekening_pengirim'),
					'vAtasNama'      => $this->input->post('nama_pemilik'),
					'iNominal'       => $this->input->post('nominal_transfer')
				);
		$query = $this->m_crud->insert('konfirmasi_pembayaran', $insert);
		if ($query) redirect('/c_event/showEventDiikuti');
	}

	function save() {

		$data = array(
					'iId_penyelenggara' => $this->session->userdata('id'),
					'vNamaEvent'        => $this->input->post('event_name'),
					'vDeskripsi'        => $this->input->post('ket_event'),
					'dEvent'            => date('Y-m-d', strtotime($this->input->post('tanggal_event'))),
					'tEventFrom'        => $this->input->post('jam_event1'),
					'tEventTo'          => $this->input->post('jam_event2'),
					'vLat'              => $this->input->post('lat'),
					'vLon'              => $this->input->post('lng'),
					'vAddress'			=> $this->input->post('formatted_address'),
					'iTiket'            => $this->input->post('htm_event'),
					'vHargaTiket'       => $this->input->post('harga_tiket'),
					'iKuota'            => str_replace(',', '', $this->input->post('kuota_peserta')),
					'vKeterangan'       => $this->input->post('keterangan_event'),
					'vNoRek'			=> $this->input->post('no_rekening'),
					'vPemilikRek'		=> $this->input->post('pemilik_rekening'),
					'iBankId'			=> $this->input->post('nama_bank')
				);
		$query = $this->m_crud->insert('event', $data);
		if ($query) redirect('/c_event/index'); else echo "<script>alert('Input Gagal, Terjadi Kesalahan')</script>";
	}

	function update() {

		$data = array(
					'iId_penyelenggara' => $this->session->userdata('id'),
					'vNamaEvent'        => $this->input->post('event_name'),
					'vDeskripsi'        => $this->input->post('ket_event'),
					'dEvent'            => date('Y-m-d', strtotime($this->input->post('tanggal_event'))),
					'tEventFrom'        => $this->input->post('jam_event1'),
					'tEventTo'          => $this->input->post('jam_event2'),
					'vLat'              => $this->input->post('lat'),
					'vLon'              => $this->input->post('lng'),
					'vAddress'			=> $this->input->post('formatted_address'),
					'iTiket'            => $this->input->post('htm_event'),
					'vHargaTiket'       => $this->input->post('harga_tiket'),
					'iKuota'            => str_replace(',', '', $this->input->post('kuota_peserta')),
					'vKeterangan'       => $this->input->post('keterangan_event'),
					'vNoRek'			=> $this->input->post('no_rekening'),
					'vPemilikRek'		=> $this->input->post('pemilik_rekening'),
					'iBankId'			=> $this->input->post('nama_bank')
				);
		$query = $this->m_crud->update('event', $data, array('id' => $this->input->post('EventId')));
		if ($query) redirect('/c_event/index'); else echo "<script>alert('Update Gagal, Terjadi Kesalahan')</script>";
	}

	function delete($id) {

		$query = $this->m_crud->delete('event', array('id' => $id));
		if ($query) redirect('/c_event/index'); else echo "<script>alert('Failed to delete data')</script>";
	}

	function getDataEvent() {

		$draw   = intval($this->input->get("draw"));
		$start  = intval($this->input->get("start"));
		$length = intval($this->input->get("length"));
		
		
		if ($this->session->userdata('iTypeUser') == 'Penyelenggara') {
			$query = $this->m_crud->get('event');
		}

		if ($this->session->userdata('iTypeUser') == 'Volunteer') {
			$query = $this->m_event->getDataEvent();
		}
		
		$data = array();
		
		// print_r($this->db->last_query()); exit();

		$no = 1;
		foreach($query->result() as $r) {

			// '

		$btnView = "<a href='#' class='btn btn-primary btn-xs btn_view_event' data-toggle='modal' data-target='#myModal' onclick='showDetailEvent({$r->id})'><span class='glyphicon glyphicon-align-left' title='Detail'></span></a>";

		$btnEdit = "<a href='".site_url()."/c_event/formEditEvent/".$r->id."' class='btn btn-success btn-xs btn_edit_event'><span class='glyphicon glyphicon-pencil' title='Edit'></span></a>";

		$btnDelete = "<a href='".site_url()."/c_event/delete/".$r->id."' class='btn btn-danger btn-xs btn_delete_event' onclick='return confirm(\"Yakin akan menghapus data ini ?\")'><span class='glyphicon glyphicon-trash' title='Delete'></span></a>";

		$btnFollow = "<a href='".site_url()."/c_event/ikutiKegiatan/".$r->id."' class='btn btn-success btn-xs btn_follow_event' onclick='confirm(\"Anda Yakin Ingin Ikut Kegiatan Ini ?\")'><span class='glyphicon glyphicon-plus' title='Ikuti Kegiatan'></span></a>";

		$btnBatal = "<a href='#' class='btn btn-danger btn-xs btn_batal_event' onclick='btn_batal_event(".$r->id.")'><span class='glyphicon glyphicon-remove-circle' title='Batal Ikuti Kegiatan'></span></a>";
		
		if ($this->session->userdata('iTypeUser') == 'Penyelenggara') {
			$button = $btnView." ".$btnEdit." ".$btnDelete;
		} else {
			$button = $btnView." ".$btnFollow;
		}
		
		$data[] = array(
					$no,
					$r->vNamaEvent,
					date('d-m-Y', strtotime($r->dEvent)),
					date('H:i', strtotime($r->tEventFrom))." s/d  ".date('H:i', strtotime($r->tEventTo)),
					$r->vAddress,
					$r->vHargaTiket,
					$r->iKuota,
					$button
				);
			$no++;
		}
		
		$output = array(
					"draw"            => $draw,
					"recordsTotal"    => $query->num_rows(),
					"recordsFiltered" => $query->num_rows(),
					"data"            => $data
				);

		echo json_encode($output);
		exit();
	}

	function ikut_event() {

		$draw   = intval($this->input->get("draw"));
		$start  = intval($this->input->get("start"));
		$length = intval($this->input->get("length"));
		
		
		$query = $this->m_event->getDataEventDiikuti($this->session->userdata('id'));
		
		$data = array();
		
		// print_r($this->db->last_query()); exit();

		$no = 1;
		foreach($query->result() as $r) {

			$btnView = "<a href='#' class='btn btn-primary btn-xs btn_view_event' data-toggle='modal' data-target='#myModal' onclick='showDetailEvent({$r->id})'><span class='glyphicon glyphicon-align-left' title='Detail'></span></a>";

			$btnConfirm = "<a href='".site_url()."/c_event/formKonfirmasiPembayaran/".$r->id."' class='btn btn-success btn-xs btn_batal_event'><span class='glyphicon glyphicon-ok' title='Konfirmasi Pembayaran' ></span></a>";

			$btnBatal = "<a href='#' class='btn btn-danger btn-xs btn_batal_event' onclick='btn_batal_event(".$r->id.")'><span class='glyphicon glyphicon-remove-circle' title='Batal Ikuti Kegiatan'></span></a>";

			if ($r->iTiket == 1) {
				if ($r->idKonfirmasiUser == NULL) {
					$button = $btnView." ".$btnConfirm." ".$btnBatal;
				} else {
					$button = $btnView." ".$btnBatal;
				}
			} else {
				$button = $btnView." ".$btnBatal;
			}
			
			$data[] = array(
						$no,
						$r->vNamaEvent,
						date('d-m-Y', strtotime($r->dEvent)),
						date('H:i', strtotime($r->tEventFrom))." s/d  ".date('H:i', strtotime($r->tEventTo)),
						$r->vAddress,
						$r->vHargaTiket,
						$r->iKuota,
						$button
					);
				$no++;
		}
		
		$output = array(
					"draw"            => $draw,
					"recordsTotal"    => $query->num_rows(),
					"recordsFiltered" => $query->num_rows(),
					"data"            => $data
				);

		echo json_encode($output);
		exit();
	}

	function getDetailEvent() {

		$this->load->library('BarcodeQR');

		$id = $this->input->post('id');
		$qr = new BarcodeQR();
		$qrpath = "./qrcode/";
		$qrname = "qr_".$id.".png";

		// print_r($qrpath); exit();

		$o  = "<table class='table table-striped'>";

		$query = $this->db->get_where('event', array('id' => $id))->result_array();
		foreach ($query as $q) {

			$qr->geo($q['vLat'], $q['vLon'], 250); 
			$qr->draw(250, $qrpath.$qrname);

			$tiket = $q['iTiket'] == 1 ? "Rp. ".$q['vHargaTiket'] : "Gratis";
			
			$o  .= "<tr>
				        <th width='20%'>Nama Event</th>
				        <td>:</td>
				        <td width='80%'>{$q['vNamaEvent']}</td>
				      </tr>
				      <tr>
				        <th width='20%'>Tanggal</th>
				        <td>:</td>
				        <td width='80%'>".date('d-m-Y', strtotime($q['dEvent']))."</td>
				      </tr>
				      <tr>
				        <th width='20%'>Jam</th>
				        <td>:</td>
				        <td width='80%'>{$q['tEventFrom']} s/d {$q['tEventTo']}</td>
				      </tr>
				      <tr>
				        <th width='20%'>Lokasi Event</th>
				        <td>:</td>
				        <td width='80%'>
				        	{$q['vAddress']}
				        	<br>
				        	<img src='".base_url()."qrcode/{$qrname}'></img><br>
				        	<i><b style='color: red'>Scan QR Code to See Location on Your Google Maps</b></i>
				        </td>
				      </tr>
				      <tr>
				        <th width='20%'>Deskripsi Event</th>
				        <td>:</td>
				        <td width='80%'>{$q['vDeskripsi']}</td>
				      </tr>
				      <tr>
				        <th width='20%'>Kuota Peserta</th>
				        <td>:</td>
				        <td width='80%'>{$q['iKuota']}</td>
				      </tr>
				      <tr>
				        <th width='20%'>Harga Tiket</th>
				        <td>:</td>
				        <td width='80%'>{$tiket}</td>
				      </tr>";

			if ($q['iTiket'] == 1) {

				$bank = $this->db->get_where('bank', array('id' => $q['iBankId']))->row();

				$o .= "<tr>
				        <th width='20%'>Nomor Rekening</th>
				        <td>:</td>
				        <td width='80%'>{$q['vNoRek']}</td>
				      </tr>
				      <tr>
				        <th width='20%'>Nama Pemilik Rekening</th>
				        <td>:</td>
				        <td width='80%'>{$q['vPemilikRek']}</td>
				      </tr>
				      <tr>
				        <th width='20%'>Nama Bank</th>
				        <td>:</td>
				        <td width='80%'>{$bank->vBankName}</td>
				      </tr>";

			}

		}

		$o .= "</table>";
		echo $o;
	}

	function ikutiKegiatan($id) {

		$insert = array(
					'iEventId' => $id,
					'iUserId'  => $this->session->userdata('id'),
				);

		$query = $this->m_crud->insert('ikut_kegiatan', $insert);
		if ($query) redirect('/c_event/showInfoPembayaran/'.$id);
	}

	function showInfoPembayaran($id) {

		$datanya = array();

		$dataEvent = $this->db->get_where('event', array('id' => $id));
		foreach ($dataEvent->result() as $row) {
			$row_data['vNamaEvent']  = $row->vNamaEvent;
			$row_data['vNoRek']      = $row->vNoRek;
			$row_data['vPemilikRek'] = $row->vPemilikRek;

			array_push($datanya, $row_data);
		}

		$data['data'] = $datanya;

		$this->load->view('headerLogin');
		$this->load->view('v_pembayaran', $data);
	}

	function cek_sudah_ikut_event() {

		$iEventId = $this->input->post('iEventId');
		$iUserId  = $this->input->post('iUserId');

		$query = $this->db->get_where('ikut_kegiatan', array('iEventId' => $iEventId, 'iUserId' => $iUserId, 'iCancel' => ''));
		if ($query->num_rows() > 0) {
			echo "1";
		}
	}

	function konfirmasiPembayaran() {
	}

	function getDataEventAll() {

		$draw   = intval($this->input->get("draw"));
		$start  = intval($this->input->get("start"));
		$length = intval($this->input->get("length"));

		$query = $this->m_event->getAllDataEvent();
		
		$data = array();
		
		// print_r($this->db->last_query()); exit();

		$no = 1;
		foreach($query->result() as $r) {

			// '

		$btnView = "<a href='#' class='btn btn-primary btn-xs btn_view_event' data-toggle='modal' data-target='#myModal' onclick='showDetailEvent({$r->id})'><span class='glyphicon glyphicon-align-left' title='Detail'></span></a>";

		$btnVerified = "<a href='".site_url()."/c_event/verifikasiEvent/".$r->id."' class='btn btn-success btn-xs btn_edit_event' onclick='return confirm(\"Anda Yakin ?\")'><span class='glyphicon glyphicon-ok' title='Verifikasi'></span></a>";

		$btnNotVerified = "<a href='".site_url()."/c_event/tolakEvent/".$r->id."' class='btn btn-danger btn-xs btn_delete_event' onclick='return confirm(\"Anda Yakin ?\")'><span class='glyphicon glyphicon-remove' title='Tolak'></span></a>";

		if ($r->iVerified == 0) {
			$button = $btnView." ".$btnVerified." ".$btnNotVerified;
		} else {
			$button = $btnView;
		}

		
		$data[] = array(
					$no,
					$r->vNamaEvent,
					date('d-m-Y', strtotime($r->dEvent)),
					date('H:i', strtotime($r->tEventFrom))." s/d  ".date('H:i', strtotime($r->tEventTo)),
					$r->vAddress,
					$r->vHargaTiket,
					$r->iKuota,
					$button,
					$this->getStatusVerified($r->iVerified)
				);
			$no++;
		}
		
		$output = array(
					"draw"            => $draw,
					"recordsTotal"    => $query->num_rows(),
					"recordsFiltered" => $query->num_rows(),
					"data"            => $data
				);

		echo json_encode($output);
		exit();
	}

	function getStatusVerified($status) {
		if ($status == 0) {
			$label = "<span class='label label-warning'>Belum Terverifikasi</span>";
		}

		if ($status == 1) {
			$label = "<span class='label label-success'>Terverifikasi</span>";
		}

		if ($status == 2) {
			$label = "<span class='label label-danger'>Ditolak</span>";
		}

		return $label;
	}

	function verifikasiEvent($id) {

		$set = array(
				'iVerified' => 1
			);
		$query = $this->m_crud->update('event', $set, array('id' => $id));
		if ($query) {
			redirect('/c_event/showManageEvent');
		} else {
			echo "<script>alert('Oops, Terjadi Kesalahan'); return false;</script>";
		}
	}

	function tolakEvent($id) {

		$set   = array('iVerified' => 2);
		$where = array('id' => $id);

		$query = $this->m_crud->update('event', $set, $where);
		if ($query) {
			redirect('/c_event/showManageEvent');
		} else {
			echo "<script>alert('Oops, Terjadi Kesalahan'); return false;</script>";
		}
	}

	function getDataAllUser() {

		$draw   = intval($this->input->get("draw"));
		$start  = intval($this->input->get("start"));
		$length = intval($this->input->get("length"));
		
		
		$query = $this->m_event->getAllUser();
		
		$data = array();
		
		// print_r($this->db->last_query()); exit();

		$no = 1;
		foreach($query->result() as $r) {

			$btnSuspend = "<a href='".site_url('c_event/suspendUser/'.$r->id)."' class='btn btn-warning btn-xs' onclick='confirm(\"Anda Yakin ?\")'>Suspend</a>";
			$btnBanned  = "<a href='".site_url('c_event/bannedUser/'.$r->id)."' class='btn btn-danger btn-xs' onclick='confirm(\"Anda Yakin ?\")'>Banned</a>";
			$btnActive  = "<a href='".site_url('c_event/activatingUser/'.$r->id)."' class='btn btn-success btn-xs' onclick='confirm(\"Anda Yakin ?\")'>Active</a>";

			if ($r->iStatus == 0) {
				$button = $btnSuspend." ".$btnBanned;
			} else {
				$button = $btnActive;
			}
			
			$data[] = array(
						$no,
						$r->vNama,
						$r->vEmail,
						$this->getRoleUser($r->iTypeUser),
						$button
					);
				$no++;
		}
		
		$output = array(
					"draw"            => $draw,
					"recordsTotal"    => $query->num_rows(),
					"recordsFiltered" => $query->num_rows(),
					"data"            => $data
				);

		echo json_encode($output);
		exit();
	}

	function getRoleUser($iTypeUser) {

		if ($iTypeUser == 1) {
			$role = "Administrator";
		}

		if ($iTypeUser == 2) {
			$role = "Penyelenggara";
		}

		if ($iTypeUser == 3) {
			$role = "Volunteer";
		}

		return $role;
	}

	function suspendUser($idUser) {

		$set  = array('iStatus' => 2);
		$where = array('id' => $idUser);

		$query = $this->m_crud->update('user', $set, $where);
		if ($query) {
			redirect('/c_event/showAllUser');
		} else {
			echo "<script>alert('Oops, Terjadi Kesalahan'); return false;</script>";
		}
	}

	function bannedUser($idUser) {

		$set  = array('iStatus' => 3);
		$where = array('id' => $idUser);

		$query = $this->m_crud->update('user', $set, $where);
		if ($query) {
			redirect('/c_event/showAllUser');
		} else {
			echo "<script>alert('Oops, Terjadi Kesalahan'); return false;</script>";
		}
	}

	function activatingUser($idUser) {

		$set  = array('iStatus' => 0);
		$where = array('id' => $idUser);

		$query = $this->m_crud->update('user', $set, $where);
		if ($query) {
			redirect('/c_event/showAllUser');
		} else {
			echo "<script>alert('Oops, Terjadi Kesalahan'); return false;</script>";
		}
	}
}

?>