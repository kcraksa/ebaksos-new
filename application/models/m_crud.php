<?php  

/**
* 
*/
class M_crud extends CI_Model
{
	
	function __construct()
	{
		parent::__construct();
	}

	function insert($db, $data) {
		return $this->db->insert($db, $data);
	}

	function selectWhere($db, $select, $where) {
		return $this->db->select($select)->get_where($db, $where);
	}

	function update($db, $set, $where) {
		return $this->db->set($set)->where($where)->update($db);
	}

	function join($db, $select, $join, $where) {

		$this->db->select($select);
		$this->db->from($db);

		foreach ($join as $j) {
			$this->db->join($join);
		}

		if ($where != '') {
			$this->db->where();
		}

		$this->db->get();
	}

	function get($db) {
		return $this->db->get($db);
	}

	function select($db, $select) {
		return $this->db->select($select)->get($db);
	}

	function delete($db, $where) {
		return $this->db->delete($db, $where);
	}
}

?>