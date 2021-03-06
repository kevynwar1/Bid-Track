<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Destinatario_model extends CI_Model {
	public $table = "destinatario";

	function __construct() {
		parent::__construct();
		$this->load->model('basic/Destinatario_basic');
	}

	public function cadastrar($destinatario) {
		$data = array(
			'cod_empresa'		=> $destinatario->getEmpresa()->getCodigo(),
			'razao_social' 	=> $destinatario->getRazaoSocial(),
			'nome_fantasia' => $destinatario->getNomeFantasia(),
			'tipo_pessoa'	=> $destinatario->getTipoPessoa(),
			'cnpj_cpf'		=> $destinatario->getCnpjCpf(),
			'email' 		=> $destinatario->getEmail(),
			'telefone' 		=> $destinatario->getTelefone(),
			'logradouro' 	=> $destinatario->getLogradouro(),
			'numero' 		=> $destinatario->getNumero(),
			'complemento' 	=> $destinatario->getComplemento(),
			'bairro' 		=> $destinatario->getBairro(),
			'cidade' 		=> $destinatario->getCidade(),
			'uf' 			=> $destinatario->getUf(),
			'cep' 			=> $destinatario->getCep(),
			'latitude' 		=> $destinatario->getLatitude(),
			'longitude' 	=> $destinatario->getLongitude(),
			'situacao'		=> $destinatario->getSituacao()
		);

		$this->db->insert($this->table, $data);
		if(!$this->db->affected_rows()) {
			return false;
		}
		return $this->db->insert_id();
	}

	public function editar($destinatario) {
		$this->db->where($this->table.'.codigo', $destinatario['codigo']);
		$this->db->where($this->table.'.cod_empresa', $this->session->userdata('empresa'));
		$this->db->update($this->table, $destinatario);

		return $this->db->affected_rows();
	}

	public function excluir($destinatario) {
		$this->db->where($this->table.'.codigo', $destinatario->getCodigo());
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

	public function listar($romaneio = NULL, $limit = null, $offset = null) {
		$this->db->select('
			destinatario.codigo AS codigo, 
			destinatario.cod_empresa AS cod_empresa, 
			destinatario.razao_social AS razao_social, 
			destinatario.nome_fantasia AS nome_fantasia, 
			destinatario.tipo_pessoa AS tipo_pessoa, 
			destinatario.cnpj_cpf AS cnpj_cpf, 
			destinatario.email AS email, 
			destinatario.telefone AS telefone, 
			destinatario.logradouro AS logradouro, 
			destinatario.numero AS numero, 
			destinatario.complemento AS complemento, 
			destinatario.bairro AS bairro, 
			destinatario.cidade AS cidade, 
			destinatario.uf AS uf, 
			destinatario.cep AS cep, 
			destinatario.latitude AS latitude, 
			destinatario.longitude AS longitude, 
			destinatario.situacao AS situacao
		')->from($this->table);
		if(isset($limit) && isset($offset)) {
			$this->db->limit($limit, $offset);
		}
		if(!is_null($romaneio)) {
			$this->db->join('entrega', 'entrega.cod_destinatario = '.$this->table.'.codigo');
			$this->db->where('entrega.cod_romaneio', $romaneio);
		}
		$this->db->where($this->table.'.cod_empresa', $this->session->userdata('empresa'));
		$query = $this->db->get();

		if($query->num_rows() > 0) {
			$result = $query->result();
			$destinatarios = array();
			foreach($result as $row) {
				$destinatario = new Destinatario_basic();

				$destinatario->setCodigo($row->codigo);
				$destinatario->getEmpresa()->setCodigo($row->cod_empresa);
				$destinatario->setRazaoSocial($row->razao_social);
				$destinatario->setNomeFantasia($row->nome_fantasia);
				$destinatario->setTipoPessoa($row->tipo_pessoa);
				$destinatario->setCnpjCpf($row->cnpj_cpf);
				$destinatario->setEmail($row->email);
				$destinatario->setTelefone($row->telefone);
				$destinatario->setLogradouro($row->logradouro);
				$destinatario->setNumero($row->numero);
				$destinatario->setComplemento($row->complemento);
				$destinatario->setBairro($row->bairro);
				$destinatario->setCidade($row->cidade);
				$destinatario->setUf($row->uf);
				$destinatario->setCep($row->cep);
				$destinatario->setLatitude($row->latitude);
				$destinatario->setLongitude($row->longitude);
				$destinatario->setSituacao($row->situacao);

				$destinatarios[] = $destinatario;
			}

			return $destinatarios;
		} else {
			return false;
		}
	}

	public function consultar($filtro, $procurar) {
		$this->db->select('
			destinatario.codigo AS codigo, 
			destinatario.cod_empresa AS cod_empresa, 
			destinatario.razao_social AS razao_social, 
			destinatario.nome_fantasia AS nome_fantasia, 
			destinatario.tipo_pessoa AS tipo_pessoa, 
			destinatario.cnpj_cpf AS cnpj_cpf, 
			destinatario.email AS email, 
			destinatario.telefone AS telefone, 
			destinatario.logradouro AS logradouro, 
			destinatario.numero AS numero, 
			destinatario.complemento AS complemento, 
			destinatario.bairro AS bairro, 
			destinatario.cidade AS cidade, 
			destinatario.uf AS uf, 
			destinatario.cep AS cep, 
			destinatario.latitude AS latitude, 
			destinatario.longitude AS longitude, 
			destinatario.situacao AS situacao
		')->from($this->table);
		if($filtro == 'codigo') {
			$this->db->where($this->table.'.codigo', $procurar);
		} else if($filtro == "razao_social") {
			$this->db->like($this->table.'.razao_social', $procurar);
		} else if($filtro == "cnpj") {
			$this->db->like($this->table.'.cnpj', $procurar);
		} else if($filtro == "bairro") {
			$this->db->like($this->table.'.bairro', $procurar);
		} else if($filtro == "cidade") {
			$this->db->like($this->table.'.cidade', $procurar);
		}
		$this->db->where($this->table.'.cod_empresa', $this->session->userdata('empresa'));
		$query = $this->db->get();

		if($query->num_rows() > 0) {
			$result = $query->result();
			$destinatarios = array();
			foreach($result as $row) {
				$destinatario = new Destinatario_basic();

				$destinatario->setCodigo($row->codigo);
				$destinatario->getEmpresa()->setCodigo($row->cod_empresa);
				$destinatario->setRazaoSocial($row->razao_social);
				$destinatario->setNomeFantasia($row->nome_fantasia);
				$destinatario->setTipoPessoa($row->tipo_pessoa);
				$destinatario->setCnpjCpf($row->cnpj_cpf);
				$destinatario->setEmail($row->email);
				$destinatario->setTelefone($row->telefone);
				$destinatario->setLogradouro($row->logradouro);
				$destinatario->setNumero($row->numero);
				$destinatario->setComplemento($row->complemento);
				$destinatario->setBairro($row->bairro);
				$destinatario->setCidade($row->cidade);
				$destinatario->setUf($row->uf);
				$destinatario->setCep($row->cep);
				$destinatario->setLatitude($row->latitude);
				$destinatario->setLongitude($row->longitude);
				$destinatario->setSituacao($row->situacao);

				$destinatarios[] = $destinatario;
			}

			return $destinatarios;
		} else {
			return false;
		}
	}
}