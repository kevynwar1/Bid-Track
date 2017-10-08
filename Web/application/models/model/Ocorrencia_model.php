<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Ocorrencia_model extends CI_Model {
	private $table = "ocorrencia";

	function __construct() {
		parent::__construct();
		$this->load->model('basic/Ocorrencia_basic');
	}

	public function cadastrar($ocorrencia) {
		$data = array(
			'cod_empresa' 			=> $ocorrencia->getEmpresa()->getCodigo(),
			'seq_entrega' 			=> $ocorrencia->getEntrega()->getSeqEntrega(),
			'cod_romaneio' 			=> $ocorrencia->getRomaneio()->getCodigo(),
			'cod_tipo_ocorrencia'	=> $ocorrencia->getTipoOcorrencia()->getCodigo(),
			'descricao'				=> $ocorrencia->getDescricao(),
			'data'					=> $ocorrencia->getData()
		);

		$this->db->insert($this->table, $data);
		if(!$this->db->affected_rows()) {
			return false;
		}
		return true;
	}

	public function excluir($romaneio) { // Excluir todas Ocorrências de um Romaneio
		$this->db->where($this->table.'.cod_romaneio', $romaneio->codigo);
		$this->db->delete($this->table);

		return $this->db->affected_rows(); 
	}

	public function excluir_ocorrencia($entrega, $romaneio) { // Excluir Ocorrência(s) de Entrega específica
		$this->db->where($this->table.'.seq_entrega', $entrega);
		$this->db->where($this->table.'.cod_romaneio', $romaneio);
		$this->db->delete($this->table);

		return $this->db->affected_rows();
	}

	public function total() {
		$this->db->select('*')->from($this->table);
		$query = $this->db->get();

		return $query->num_rows();
	}

	public function ocorrencia_entrega($entrega, $romaneio) {
		$this->db->select('
			ocorrencia.codigo AS codigo, 
			ocorrencia.cod_empresa AS cod_empresa, 
			empresa.razao_social AS razao_social, 
			empresa.nome_fantasia AS nome_fantasia, 
			ocorrencia.seq_entrega AS seq_entrega, 
			lpad(ocorrencia.cod_romaneio, 4, 0) AS cod_romaneio, 
			ocorrencia.cod_tipo_ocorrencia AS cod_tipo_ocorrencia, 
			tipo_ocorrencia.descricao AS tip_descricao, 
			ocorrencia.descricao AS descricao, 
			ocorrencia.data AS data, 
			ocorrencia.situacao AS situacao
		')->from($this->table);
		$this->db->join('empresa', 'empresa.codigo = '.$this->table.'.cod_empresa');
		$this->db->join('romaneio', 'romaneio.codigo = '.$this->table.'.cod_romaneio');
		$this->db->join('tipo_ocorrencia', 'tipo_ocorrencia.codigo = '.$this->table.'.cod_tipo_ocorrencia');
		$this->db->where($this->table.'.seq_entrega', $entrega);
		$this->db->where($this->table.'.cod_romaneio', $romaneio);
		$query = $this->db->get();

		if($query->num_rows() > 0) {
			$result = $query->result();
			$ocorrencias = array();
			foreach($result as $row) {
				$ocorrencia = new Ocorrencia_basic();

				$ocorrencia->setCodigo($row->codigo);
				$ocorrencia->getEmpresa()->setCodigo($row->cod_empresa);
				$ocorrencia->getEmpresa()->setRazaoSocial($row->razao_social);
				$ocorrencia->getEmpresa()->setNomeFantasia($row->nome_fantasia);
				$ocorrencia->getEntrega()->setSeqEntrega($row->seq_entrega);
				$ocorrencia->getRomaneio()->setCodigo($row->cod_romaneio);
				$ocorrencia->getTipoOcorrencia()->setCodigo($row->cod_tipo_ocorrencia);
				$ocorrencia->getTipoOcorrencia()->setDescricao($row->tip_descricao);
				$ocorrencia->setDescricao($row->descricao);
				$ocorrencia->setData($row->data);
				$ocorrencia->setSituacao($row->situacao);

				$ocorrencias[] = $ocorrencia;
			}

			return $ocorrencias;
		} else {
			return false;
		}
	}
}
?>