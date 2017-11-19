<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Estabelecimento_model extends CI_Model {
	public $table = "estabelecimento";

	function __construct() {
		parent::__construct();
		$this->load->model('basic/Estabelecimento_basic');
	}

	public function cadastrar($estabelecimento) {
		$data = array(
			'cod_empresa'	=> $estabelecimento->getEmpresa()->getCodigo(),
			'razao_social'	=> $estabelecimento->getRazaoSocial(),
			'cnpj'			=> $estabelecimento->getCnpj(),
			'logradouro'	=> $estabelecimento->getLogradouro(),
			'numero'		=> $estabelecimento->getNumero(),
			'complemento'	=> $estabelecimento->getComplemento(),
			'bairro'		=> $estabelecimento->getBairro(),
			'cidade'		=> $estabelecimento->getCidade(),
			'uf'			=> $estabelecimento->getUf(),
			'cep'			=> $estabelecimento->getCep(),
			'latitude'		=> $estabelecimento->getLatitude(),
			'longitude'		=> $estabelecimento->getLongitude()
		);

		$this->db->insert($this->table, $data);
		if(!$this->db->affected_rows()) {
			return false;
		}
		return true;
	}

	public function editar($estabelecimento) {
		$this->db->where($this->table.'.codigo', $estabelecimento['codigo']);
		$this->db->update($this->table, $estabelecimento);

		return $this->db->affected_rows();
	}

	public function excluir($estabelecimento) {
		$this->db->where($this->table.'.codigo', $estabelecimento->getCodigo());
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
			estabelecimento.codigo AS codigo, 
			estabelecimento.cod_empresa AS cod_empresa, 
			estabelecimento.razao_social AS razao_social, 
			estabelecimento.cnpj AS cnpj, 
			estabelecimento.logradouro AS logradouro, 
			estabelecimento.numero AS numero, 
			estabelecimento.complemento AS complemento, 
			estabelecimento.bairro AS bairro, 
			estabelecimento.cidade AS cidade, 
			estabelecimento.uf AS uf, 
			estabelecimento.cep AS cep, 
			estabelecimento.latitude AS latitude, 
			estabelecimento.longitude AS longitude, 
			estabelecimento.situacao AS situacao
		')->from($this->table);
		$this->db->order_by($this->table.".bairro", "ASC");
		$this->db->where($this->table.'.cod_empresa', $this->session->userdata('empresa'));
		if(isset($limit) && isset($offset)) {
			$this->db->limit($limit, $offset);
		}
		$query = $this->db->get();

		if($query->num_rows() > 0) {
			$result = $query->result();
			$estabelecimentos = array();
			foreach($result as $row) {
				$estabelecimento = new Estabelecimento_basic();

				$estabelecimento->setCodigo($row->codigo);
				$estabelecimento->getEmpresa()->setCodigo($row->cod_empresa);
				$estabelecimento->setRazaoSocial($row->razao_social);
				$estabelecimento->setCnpj($row->cnpj);
				$estabelecimento->setLogradouro($row->logradouro);
				$estabelecimento->setNumero($row->numero);
				$estabelecimento->setComplemento($row->complemento);
				$estabelecimento->setBairro($row->bairro);
				$estabelecimento->setCidade($row->cidade);
				$estabelecimento->setUf($row->uf);
				$estabelecimento->setCep($row->cep);
				$estabelecimento->setLatitude($row->latitude);
				$estabelecimento->setLongitude($row->longitude);
				$estabelecimento->setSituacao($row->situacao);

				$estabelecimentos[] = $estabelecimento;
			}

			return $estabelecimentos;
		} else {
			return false;
		}
	}

	public function consultar($filtro, $procurar) {
		$this->db->select('
			estabelecimento.codigo AS codigo, 
			estabelecimento.cod_empresa AS cod_empresa, 
			estabelecimento.razao_social AS razao_social, 
			estabelecimento.cnpj AS cnpj, 
			estabelecimento.logradouro AS logradouro, 
			estabelecimento.numero AS numero, 
			estabelecimento.complemento AS complemento, 
			estabelecimento.bairro AS bairro, 
			estabelecimento.cidade AS cidade, 
			estabelecimento.uf AS uf, 
			estabelecimento.cep AS cep, 
			estabelecimento.latitude AS latitude, 
			estabelecimento.longitude AS longitude, 
			estabelecimento.situacao AS situacao
		')->from($this->table);
		$this->db->order_by($this->table.".bairro", "ASC");
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
			$estabelecimentos = array();
			foreach($result as $row) {
				$estabelecimento = new Estabelecimento_basic();

				$estabelecimento->setCodigo($row->codigo);
				$estabelecimento->getEmpresa()->setCodigo($row->cod_empresa);
				$estabelecimento->setRazaoSocial($row->razao_social);
				$estabelecimento->setCnpj($row->cnpj);
				$estabelecimento->setLogradouro($row->logradouro);
				$estabelecimento->setNumero($row->numero);
				$estabelecimento->setComplemento($row->complemento);
				$estabelecimento->setBairro($row->bairro);
				$estabelecimento->setCidade($row->cidade);
				$estabelecimento->setUf($row->uf);
				$estabelecimento->setCep($row->cep);
				$estabelecimento->setLatitude($row->latitude);
				$estabelecimento->setLongitude($row->longitude);
				$estabelecimento->setSituacao($row->situacao);

				$estabelecimentos[] = $estabelecimento;
			}

			return $estabelecimentos;
		} else {
			return false;
		}
	}
}