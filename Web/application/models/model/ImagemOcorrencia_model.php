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

	public function listar() {
		$this->db->select('
			imagem_ocorrencia.codigo AS codigo, 
			imagem_ocorrencia.cod_ocorrencia AS cod_ocorrencia, 
			imagem_ocorrencia.foto AS foto
		')->from($this->table);
		$this->db->join('ocorrencia', 'ocorrencia.codigo = '.$this->table.'.cod_ocorrencia');
		$this->db->where('ocorrencia.cod_empresa', $this->session->userdata('empresa'));
		$query = $this->db->get();

		if($query->num_rows() > 0) {
			$result = $query->result();
			$img_ocorrencias = array();
			foreach($result as $row) {
				$img_ocorrencia = new ImagemOcorrencia_basic();

				$img_ocorrencia->setCodigo($row->codigo);
				$img_ocorrencia->getOcorrencia()->setCodigo($row->cod_ocorrencia);
				$img_ocorrencia->setFoto($row->foto);

				$img_ocorrencias[] = $img_ocorrencia;
			}

			return $img_ocorrencias;
		} else {
			return false;
		}
	}
}
?>