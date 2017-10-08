<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Transportadora_model extends CI_Model {
	public $table = "transportadora";

	function __construct() {
		parent::__construct();
		$this->load->model('basic/Transportadora_basic');
	}

	public function cadastrar($transportadora) {
		$data = array(
			'codigo' 		=> $transportadora->getCodigo(), 
			'cod_empresa'	=> $transportadora->getEmpresa()->getCodigo(),
			'razao_social'	=> $transportadora->getRazaoSocial(),
			'nome_fantasia'	=> $transportadora->getNomeFantasia(),
			'cnpj'			=> $transportadora->getCnpj(),
			'logradouro'	=> $transportadora->getLogradouro(),
			'numero'		=> $transportadora->getNumero(),
			'complemento'	=> $transportadora->getComplemento(),
			'bairro'		=> $transportadora->getBairro(),
			'cidade'		=> $transportadora->getCidade(),
			'uf'			=> $transportadora->getUf(),
			'cep'			=> $transportadora->getCep(),
			'latitude'		=> $transportadora->getLatitude(),
			'longitude'		=> $transportadora->getLongitude()
		);

		$this->db->insert($this->table, $data);
		if(!$this->db->affected_rows()) {
			return false;
		}
		return true;
	}

	public function editar($transportadora) {
		$this->db->where($this->table.'.codigo', $transportadora['codigo']);
		$this->db->update($this->table, $transportadora);

		return $this->db->affected_rows();
	}

	public function excluir($transportadora) {
		$this->db->where($this->table.'.codigo', $transportadora->getCodigo());
		$this->db->delete($this->table);

		return $this->db->affected_rows(); 
	}

	public function listar() {
		$this->db->select('
			transportadora.codigo AS codigo, 
			transportadora.cod_empresa AS cod_empresa, 
			transportadora.razao_social AS razao_social, 
			transportadora.nome_fantasia AS nome_fantasia, 
			transportadora.cnpj AS cnpj, 
			transportadora.logradouro AS logradouro, 
			transportadora.numero AS numero, 
			transportadora.complemento AS complemento, 
			transportadora.bairro AS bairro, 
			transportadora.cidade AS cidade, 
			transportadora.uf AS uf, 
			transportadora.cep AS cep, 
			transportadora.latitude AS latitude, 
			transportadora.longitude AS longitude, 
			transportadora.situacao AS situacao
		')->from($this->table);
		$this->db->where($this->table.'.cod_empresa', $this->session->userdata('empresa'));
		$this->db->order_by($this->table.".nome_fantasia", "ASC");

		$query = $this->db->get();

		if($query->num_rows() > 0) {
			$result = $query->result();
			$transportadoras = array();
			foreach($result as $row) {
				$transportadora = new Transportadora_basic();

				$transportadora->setCodigo($row->codigo);
				$transportadora->getEmpresa()->setCodigo($row->cod_empresa);
				$transportadora->setRazaoSocial($row->razao_social);
				$transportadora->setNomeFantasia($row->nome_fantasia);
				$transportadora->setCnpj($row->cnpj);
				$transportadora->setLogradouro($row->logradouro);
				$transportadora->setNumero($row->numero);
				$transportadora->setComplemento($row->complemento);
				$transportadora->setBairro($row->bairro);
				$transportadora->setCidade($row->cidade);
				$transportadora->setUf($row->uf);
				$transportadora->setCep($row->cep);
				$transportadora->setLatitude($row->latitude);
				$transportadora->setLongitude($row->longitude);
				$transportadora->setSituacao($row->situacao);

				$transportadoras[] = $transportadora;
			}

			return $transportadoras;
		} else {
			return false;
		}
	}

	public function romaneios($codigo) {
		$this->db->select('codigo')->from('romaneio');
		$this->db->where('romaneio.cod_transportadora', $codigo);
		$query = $this->db->get();

		return $query->num_rows();
	}
}