<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class ImagemOcorrencia_model extends CI_Model {
	private $table = "imagem_ocorrencia";

	function __construct() {
		parent::__construct();
		$this->load->model('basic/ImagemOcorrencia_basic');
	}

	public function cadastrar($imagem_ocorrencia) {
		$data = array(
			'cod_ocorrencia' => $imagem_ocorrencia->getOcorrencia()->getCodigo(),
			'foto'			 => $imagem_ocorrencia->getFoto()
		);

		$this->db->insert($this->table, $data);
		if(!$this->db->affected_rows()) {
			return false;
		}
		return true;
	}
}
?>