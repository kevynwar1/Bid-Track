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

	public function total() {
		$this->db->select('*')->from($this->table);
		$this->db->where($this->table.'.cod_empresa', $this->session->userdata('empresa'));
		$query = $this->db->get();

		return $query->num_rows();
	}

	public function listar($limit = null, $offset = null) {
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
		if(isset($limit) && isset($offset)) {
			$this->db->limit($limit, $offset);
		}
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

	public function consultar($filtro, $procurar) {
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
		if($filtro == "razao_social") {
			$this->db->like($this->table.'.razao_social', $procurar);
		} else if($filtro == "cnpj") {
			$this->db->like($this->table.'.cnpj', $procurar);
		} else if($filtro == "bairro") {
			$this->db->like($this->table.'.bairro', $procurar);
		} else if($filtro == "cidade") {
			$this->db->like($this->table.'.cidade', $procurar);
		}
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

	public function consultar_transportadora($transportadora) {
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
		$this->db->where($this->table.'.codigo', $transportadora);
		$query = $this->db->get();

		if($query->num_rows() == 1) {
			$result = $query->result();
			$transportadora = new Transportadora_basic();

			$transportadora->setCodigo($result[0]->codigo);
			$transportadora->getEmpresa()->setCodigo($result[0]->cod_empresa);
			$transportadora->setRazaoSocial($result[0]->razao_social);
			$transportadora->setNomeFantasia($result[0]->nome_fantasia);
			$transportadora->setCnpj($result[0]->cnpj);
			$transportadora->setLogradouro($result[0]->logradouro);
			$transportadora->setNumero($result[0]->numero);
			$transportadora->setComplemento($result[0]->complemento);
			$transportadora->setBairro($result[0]->bairro);
			$transportadora->setCidade($result[0]->cidade);
			$transportadora->setUf($result[0]->uf);
			$transportadora->setCep($result[0]->cep);
			$transportadora->setLatitude($result[0]->latitude);
			$transportadora->setLongitude($result[0]->longitude);
			$transportadora->setSituacao($result[0]->situacao);

			return $transportadora;
		} else {
			return false;
		}
	}

	public function romaneios($codigo) { // Romaneio por Transportadora
		$this->db->select('codigo')->from('romaneio');
		$this->db->where('romaneio.cod_transportadora', $codigo);
		$query = $this->db->get();

		return $query->num_rows();
	}
}