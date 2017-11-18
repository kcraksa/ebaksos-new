<?php if (! defined('BASEPATH')) exit('No direct access allowed');
/**
 * 
 */
 class M_event extends CI_Model
 {
 	
 	function __construct()
 	{
 		parent::__construct();
 	}

 	function getDataEvent() {

 		$sql  = "SELECT
 					a.*, b.iEventId
 				FROM ebaksos.event a
 				LEFT JOIN ebaksos.ikut_kegiatan b
 				ON a.id = b.iEventId
 				WHERE b.iEventId IS NULL";
 		return $this->db->query($sql);
 	}

 	function getDataEventDiikuti($user) {

 		$sql = "SELECT a.*, b.id AS idIkut, b.iBayar, c.id AS idKonfirmasiUser
				FROM ebaksos.event a LEFT JOIN ebaksos.ikut_kegiatan b ON a.id = b.iEventId
				LEFT JOIN ebaksos.konfirmasi_pembayaran c ON a.id = c.iEventId
				WHERE b.iEventId IS NOT NULL AND b.iUserId = '{$user}' GROUP BY a.id ORDER BY a.dEvent DESC";
 		return $this->db->query($sql);
 	}

 	function getAllDataEvent() {

 		$sql = "SELECT * FROM ebaksos.event ORDER BY dEvent DESC";
 		return $this->db->query($sql);
 	}

 	function getAllUser() {

 		$sql = "SELECT a.id,a.vEmail, a.iTypeUser,
				CASE a.iTypeUser
				WHEN 2 THEN b.vNama 
				WHEN 3 THEN c.vNama
				ELSE 'Administrator' 
				END AS vNama,
				a.iStatus
				FROM ebaksos.user AS a LEFT JOIN ebaksos.penyelenggara AS b ON a.id = b.iIdUser
				LEFT JOIN ebaksos.volunteer AS c ON a.id = c.iIdUser";
 		return $this->db->query($sql);
 	}
 } 
?>