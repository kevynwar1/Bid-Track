<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class TipoOcorrencia_model extends CI_Model {
	private $table = "tipo_ocorrencia";

	function __construct() {
		parent::__construct();
		$this->load->model('basic/TipoOcorrencia_basic');
	}

	public function listar($empresa) {
		$this->db->select('
			tipo_ocorrencia.codigo, 
			tipo_ocorrencia.cod_empresa, 
			tipo_ocorrencia.descricao, 
			tipo_ocorrencia.situacao
		')->from($this->table);
		$this->db->where($this->table.".cod_empresa", $empresa);
		$query = $this->db->get();

		if($query->num_rows() > 0) {
			$result = $query->result();
			$tipoocorrencias = array();
			foreach($result as $row) {
				$tipoocorrencia = new TipoOcorrencia_basic();

				$tipoocorrencia->setCodigo($row->codigo);
				$tipoocorrencia->getEmpresa()->setCodigo($row->cod_empresa);
				$tipoocorrencia->setDescricao($row->descricao);
				$tipoocorrencia->setSituacao($row->situacao);

				$tipoocorrencias[] = $tipoocorrencia;
			}

			return $tipoocorrencias;
		} else {
			return false;
		}
	}
}
?>