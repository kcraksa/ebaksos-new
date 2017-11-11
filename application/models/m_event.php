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
 					*
 				FROM ebaksos.event a
 				LEFT JOIN ebaksos.ikut_kegiatan b
 				ON a.id = b.iEventId
 				WHERE b.iEventId IS NULL";
 		return $this->db->query($sql);
 	}
 } 
?>