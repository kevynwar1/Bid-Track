<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class TipoOcorrencia_model extends CI_Model {
	private $table = "tipo_ocorrencia";

	function __construct() {
		parent::__construct();
		$this->load->model('basic/TipoOcorrencia_basic');
	}

	public function cadastrar($tipo_ocorrencia) {
		$data = array(
			'cod_empresa' 		=> $tipo_ocorrencia->getEmpresa()->getCodigo(),
			'descricao' 		=> $tipo_ocorrencia->getDescricao(),
			'situacao' 			=> $tipo_ocorrencia->getSituacao()
		);

		$this->db->insert($this->table, $data);
		if(!$this->db->affected_rows()) {
			return false;
		}
		return true;
	}

	public function editar($tipo_ocorrencia) {
		$this->db->where($this->table.'.codigo', $tipo_ocorrencia['codigo']);
		$this->db->where($this->table.'.cod_empresa', $this->session->userdata('empresa'));
		$this->db->update($this->table, $tipo_ocorrencia);

		return $this->db->affected_rows();
	}

	public function excluir($tipo_ocorrencia) {
		$this->db->where($this->table.'.codigo', $tipo_ocorrencia->getCodigo());
		$this->db->where($this->table.'.cod_empresa', $this->session->userdata('empresa'));
		$this->db->delete($this->table);

		return $this->db->affected_rows(); 
	}

	public function total() {
		$this->db->select('*')->from($this->table);
		$this->db->where($this->table.'.cod_empresa', $this->session->userdata('empresa'));
		$query = $this->db->get();

		return $query->num_rows();
	}

	public function listar_mb($empresa) {
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

	public function listar($limit = null, $offset = null) {
		$this->db->select('
			tipo_ocorrencia.codigo, 
			tipo_ocorrencia.cod_empresa, 
			tipo_ocorrencia.descricao, 
			tipo_ocorrencia.situacao
		')->from($this->table);
		if(isset($limit) && isset($offset)) {
			$this->db->limit($limit, $offset);
		}
		$this->db->where($this->table.".cod_empresa", $this->session->userdata('empresa'));
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

	public function consultar($filtro, $procurar) {
		$this->db->select('
			tipo_ocorrencia.codigo, 
			tipo_ocorrencia.cod_empresa, 
			tipo_ocorrencia.descricao, 
			tipo_ocorrencia.situacao
		')->from($this->table);
		$this->db->where($this->table.'.cod_empresa', $this->session->userdata('empresa'));
		if($filtro == 'codigo') {
			$this->db->where($this->table.'.codigo', $procurar);
		}
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