<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('m_crud');
	}

	public function index()
	{
		$this->load->view('headerLogin');
		$this->load->view('home');
	}

	function showRegisterForm() 
	{
		$this->load->view('headerLogin');		
		$this->load->view('register');		
	}

	function showFormRegisterVolunteer() {

		$this->load->view('headerLogin');
		$this->load->view('v_register_visitor');
	}

	function loginForm() {

		$this->load->view('headerLogin');
		$this->load->view('v_login');
	}

	function showBeranda() {

		$this->load->view('headerLogin');
		$this->load->view('v_beranda');
	}

	function registerProcess() {

		$user = array(
			'vEmail'    => $this->input->post('email_register_eo'),
			'vPassword' => sha1($this->input->post('password_register_eo')),
			'iTypeUser' => 2
		);

		$this->m_crud->insert('ebaksos.user', $user);
		$idUser = $this->db->insert_id();
		
		$penyelenggara = array(
			'vNama'        => $this->input->post('nama_register_eo'),
			'vAlamat'      => $this->input->post('alamat_register_eo'),
			'vNamaPJ'      => $this->input->post('nama_pj_eo'),
			'vAlamatPJ'    => $this->input->post('alamat_pj_eo'),
			'eGender'      => $this->input->post('gender_pj_eo'),
			'vIDNumber'    => $this->input->post('idno_pj_eo'),
			'vPekerjaanPJ' => $this->input->post('kerja_pj_eo'),
			'vJabatanPJ'   => $this->input->post('jabatan_pj_eo'),
			'iIdUser'      => $idUser
		);

		$this->m_crud->insert('ebaksos.penyelenggara', $penyelenggara);
	}

	function volunteerRegisterProcess() {

		$user = array(
			'vEmail'    => $this->input->post('email_volunteer_reg'),
			'vPassword' => sha1($this->input->post('password_volunteer_reg')),
			'iTypeUser' => 3
		);

		$this->m_crud->insert('ebaksos.user', $user);
		$idUser = $this->db->insert_id();

		$volunteer = array(
			'vNama'       => $this->input->post('nama_volunteer_reg'),
			'vAlamat'     => $this->input->post('alamat_volunteer_reg'),
			'iGender'     => $this->input->post('gender_volunteer_reg'),
			'vIdNumber'   => $this->input->post('idno_volunteer_reg'),
			'iKerja'      => $this->input->post('kerja_volunteer_reg'),
			'vBirthplace' => $this->input->post('birthplace_volunteer_reg'),
			'dBirthday'   => date('Y-m-d', strtotime($this->input->post('birthday_volunteer_reg'))),
			'iIdUser'     => $idUser
		);

		$query = $this->m_crud->insert('ebaksos.volunteer', $volunteer);
		if ($query) {
			$this->load->view('headerLogin');
			$this->load->view('v_registerSuccess');
			$this->load->view('footer');
		}
	}

	function loginProcess() {

		$typeUser = array(1 => 'Administrator', 2 => 'Penyelenggara', 3 => 'Volunteer');

		$username = $this->input->post('email_user');
		$password = $this->input->post('pass_user');

		$select = 'id, vEmail, vPassword, tLastLogin, iTypeUser';
		$where  = array(
						'vEmail'    => $username,
						'vPassword' => sha1($password)
					);

		$checkUser = $this->m_crud->selectWhere('user', $select, $where);
		
		if ($checkUser->num_rows() > 0) {

			$row = $checkUser->row();
			$id  = $row->id;

			$this->updateLastLogin($id);

			// Get Detail Data User

			if ($row->iTypeUser == 2) {

				$db = 'penyelenggara';
			}

			if ($row->iTypeUser == 3) {

				$db = 'volunteer';
			}

			if ($row->iTypeUser == 1) {
				$dataUser = array(
								'vEmail'     => $username,
								'iTypeUser'  => 1,
								'tLastLogin' => date('d-m-Y H:i:s', strtotime($row->tLastLogin)),
								'vNama'      => 'Administrator'
							);
				$this->session->set_userdata($dataUser);

				redirect('/welcome/showBeranda/');
				break;
			}

			$select      = 'vNama';
			$where       = array('iIdUser' => $id);
			$getDataUser = $this->m_crud->selectWhere($db, $select, $where);

			$r = $getDataUser->row();

			$dataUser = array(
							'id'		 => $id,
							'vEmail'     => $row->vEmail,
							'iTypeUser'  => $typeUser[$row->iTypeUser],
							'tLastLogin' => date('d-m-Y H:i:s', strtotime($row->tLastLogin)),
							'vNama'      => $r->vNama
						);
			$this->session->set_userdata($dataUser);

			redirect('/welcome/showBeranda/');

		} else {

			echo "<script>alert('Email atau Password Salah')</script>";
			$this->loginForm();
		}
	}

	function updateLastLogin($id) {
		$set   = array('tLastLogin' => date('Y-m-d H:i:s'));
		$where = array('id' => $id);
		$db    = 'user';

		$this->m_crud->update($db, $set, $where);
	}

	function logOutProcess() {

		$dataUser = array('vEmail','iTypeUser','tLastLogin','vNama');
		$this->session->unset_userdata($dataUser);
		redirect('/welcome/index/');
	}

	function getMd5Keys($str) {

		echo sha1($str);
	}
}
