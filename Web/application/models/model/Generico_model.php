<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Generico_model extends CI_Model {
	public function cadastrar($table, $object) {
		$this->db->insert($table, $object);
		if(!$this->db->affected_rows()) {
			return false;
		}
		return true;
	}

	public function excluir($table, $pk, $id) {
		$this->db->delete($table);
		$this->db->where($pk, $id);
		if(!$this->db->affected_rows()) {
			return false;
		}
		return true;
	}
}