<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Motorista_model extends CI_Model {
	private $table = "motorista";

	function __construct() {
		parent::__construct();
		$this->load->model('basic/Motorista_basic');
	}

	public function cadastrar($motorista) {
		$data = array(
			'nome' 				=> $motorista->getNome(),
			'cpf' 				=> $motorista->getCpf(),
			'pontuacao' 		=> $motorista->getPontuacao(),
			'logradouro'		=> $motorista->getLogradouro(),
			'numero'			=> $motorista->getNumero(),
			'complemento'		=> $motorista->getComplemento(),
			'bairro'			=> $motorista->getBairro(),
			'cidade'			=> $motorista->getCidade(),
			'uf'				=> $motorista->getUf(),
			'cep'				=> $motorista->getCep(),
			'email'				=> $motorista->getEmail(),
			'senha'				=> $motorista->getSenha(),
			'latitude'			=> $motorista->getLatitude(),
			'longitude'			=> $motorista->getLongitude(),
			'tipo_carteira'		=> $motorista->getTipoCarteira(),
			'validade_carteira' => $motorista->getValidadeCarteira(),
			'disponibilidade' 	=> $motorista->getDisponibilidade(),
			'situacao' 			=> $motorista->getSituacao()
		);

		$this->db->insert($this->table, $data);
		if(!$this->db->affected_rows()) {
			return false;
		}
		return $this->db->insert_id();
	}

	public function cadastrar_empresa($empresa, $motorista) {
		$data = array(
			'cod_empresa' 	=> $empresa,
			'cod_motorista'	=> $motorista
		);

		$this->db->insert('empresa_motorista', $data);
		if(!$this->db->affected_rows()) {
			return false;
		}
		return true;
	}

	public function editar($motorista) {
		$this->db->where($this->table.'.codigo', $motorista['codigo']);
		$this->db->update($this->table, $motorista);

		return $this->db->affected_rows();
	}

	public function excluir($motorista) {
		$this->db->where($this->table.'.codigo', $motorista->getCodigo());
		$this->db->delete($this->table);

		return $this->db->affected_rows(); 
	}

	public function total() {
		$this->db->select('*')->from($this->table);
		$this->db->join('empresa_motorista', 'empresa_motorista.cod_motorista = '.$this->table.'.codigo');
		$this->db->where('empresa_motorista.cod_empresa', $this->session->userdata('empresa'));
		$query = $this->db->get();

		return $query->num_rows();
	}

	public function disponibilidade($status, $motorista) {
		$this->db->set($this->table.'.disponibilidade', $status);
		$this->db->where($this->table.'.codigo', $motorista);
		$this->db->update($this->table);

		return $this->db->affected_rows();
	}

	public function consultar($filtro, $procurar) {
		$this->db->select('*,
			motorista.cep AS cep, 
			motorista.logradouro AS logradouro, 
			motorista.complemento AS complemento, 
			motorista.numero AS numero, 
			motorista.bairro AS bairro, 
			motorista.cidade AS cidade, 
			motorista.disponibilidade AS disponibilidade, 
			'.$this->table.'.codigo AS cod, 
			empresa_motorista.cod_empresa AS cod_empresa
		')->from($this->table);
		$this->db->join('empresa_motorista', 'empresa_motorista.cod_motorista = '.$this->table.'.codigo');
		$this->db->join('empresa', 'empresa.codigo = empresa_motorista.cod_empresa', 'left');
		$this->db->where('empresa_motorista.cod_empresa', $this->session->userdata('empresa'));
		if($filtro == 'codigo') {
			$this->db->where($this->table.'.codigo', $procurar);
		} else if($filtro == "nome") {
			$this->db->like($this->table.'.nome', $procurar);
		} else if($filtro == "bairro") {
			$this->db->like($this->table.'.bairro', $procurar);
		} else if($filtro == "cidade") {
			$this->db->like($this->table.'.cidade', $procurar);
		}
		$this->db->order_by($this->table.'.nome', 'ASC');
		$query = $this->db->get();

		if($query->num_rows() > 0) {
			$result = $query->result();
			$motoristas = array();
			foreach($result as $row) {
				$motorista = new Motorista_basic();

				$motorista->setCodigo($row->cod);
				$motorista->getEmpresa()->setCodigo($row->cod_empresa);
				$motorista->getEmpresa()->setCnpj($row->cnpj);
				$motorista->getEmpresa()->setNomeFantasia($row->nome_fantasia);
				$motorista->setNome($row->nome);
				$motorista->setEmail($row->email);
				$motorista->setCpf($row->cpf);
				$motorista->setPontuacao($row->pontuacao);
				$motorista->setLogradouro($row->logradouro);
				$motorista->setNumero($row->numero);
				$motorista->setComplemento($row->complemento);
				$motorista->setBairro($row->bairro);
				$motorista->setCidade($row->cidade);
				$motorista->setUf($row->uf);
				$motorista->setCep($row->cep);
				$motorista->setLatitude($row->latitude);
				$motorista->setLongitude($row->longitude);
				$motorista->setTipoCarteira($row->tipo_carteira);
				$motorista->setValidadeCarteira($row->validade_carteira);
				$motorista->setDisponibilidade($row->disponibilidade);
				$motorista->setSituacao($row->situacao);

				$motoristas[] = $motorista;
			}

			return $motoristas;
		} else {
			return false;
		}
	}

	public function listar($limit = null, $offset = null, $romaneio = null) {
		$this->db->select('*,
			motorista.logradouro AS logradouro, 
			motorista.numero AS numero, 
			motorista.bairro AS bairro, 
			motorista.cidade AS cidade, 
			motorista.disponibilidade AS disponibilidade, 
			'.$this->table.'.codigo AS cod, 
			empresa_motorista.cod_empresa AS cod_empresa
		')->from($this->table);
		$this->db->join('empresa_motorista', 'empresa_motorista.cod_motorista = '.$this->table.'.codigo');
		$this->db->join('empresa', 'empresa.codigo = empresa_motorista.cod_empresa', 'left');
		if(!is_null($romaneio)) { // Listar Motorista específico para Editar Romaneio
			$this->db->join('romaneio', 'romaneio.cod_motorista = '.$this->table.'.codigo');
			$this->db->where('romaneio.codigo', $romaneio);
		}
		if(isset($limit) && isset($offset)) {
			$this->db->limit($limit, $offset);
		}
		$this->db->where('empresa_motorista.cod_empresa', $this->session->userdata('empresa'));
		$this->db->order_by($this->table.'.nome', 'ASC');
		$query = $this->db->get();

		if($query->num_rows() > 0) {
			$result = $query->result();
			$motoristas = array();
			foreach($result as $row) {
				$motorista = new Motorista_basic();

				$motorista->setCodigo($row->cod);
				$motorista->getEmpresa()->setCodigo($row->cod_empresa);
				$motorista->getEmpresa()->setCnpj($row->cnpj);
				$motorista->getEmpresa()->setNomeFantasia($row->nome_fantasia);
				$motorista->setNome($row->nome);
				$motorista->setCpf($row->cpf);
				$motorista->setPontuacao($row->pontuacao);
				$motorista->setLogradouro($row->logradouro);
				$motorista->setNumero($row->numero);
				$motorista->setComplemento($row->complemento);
				$motorista->setBairro($row->bairro);
				$motorista->setCidade($row->cidade);
				$motorista->setUf($row->uf);
				$motorista->setCep($row->cep);
				$motorista->setLatitude($row->latitude);
				$motorista->setLongitude($row->longitude);
				$motorista->setTipoCarteira($row->tipo_carteira);
				$motorista->setValidadeCarteira($row->validade_carteira);
				$motorista->setDisponibilidade($row->disponibilidade);
				$motorista->setSituacao($row->situacao);

				$motoristas[] = $motorista;
			}

			return $motoristas;
		} else {
			return false;
		}
	}

	public function motorista_disponivel($romaneio = NULL) {
		$this->db->select('*, '.$this->table.'.codigo AS cod')->from($this->table);
		$this->db->join('empresa_motorista', 'empresa_motorista.cod_motorista = '.$this->table.'.codigo');
		$this->db->where('empresa_motorista.cod_empresa', $this->session->userdata('empresa'));
		$this->db->where('disponibilidade', TRUE);
		$this->db->order_by($this->table.'.nome', 'ASC');
		$query = $this->db->get();

		if($query->num_rows() > 0) {
			$result = $query->result();
			$motoristas = array();
			foreach($result as $row) {
				$motorista = new Motorista_basic();

				$motorista->setCodigo($row->cod);
				$motorista->getEmpresa()->setCodigo($row->cod_empresa);
				$motorista->setNome($row->nome);
				$motorista->setCpf($row->cpf);
				$motorista->setPontuacao($row->pontuacao);
				$motorista->setLogradouro($row->logradouro);
				$motorista->setNumero($row->numero);
				$motorista->setComplemento($row->complemento);
				$motorista->setBairro($row->bairro);
				$motorista->setCidade($row->cidade);
				$motorista->setUf($row->uf);
				$motorista->setCep($row->cep);
				$motorista->setLatitude($row->latitude);
				$motorista->setLongitude($row->longitude);
				$motorista->setTipoCarteira($row->tipo_carteira);
				$motorista->setValidadeCarteira($row->validade_carteira);
				$motorista->setDisponibilidade($row->disponibilidade);
				$motorista->setSituacao($row->situacao);

				$motoristas[] = $motorista;
			}

			return $motoristas;
		} else {
			return false;
		}
	}

	public function login($email, $senha) {
		$this->db->select('
			motorista.codigo AS codigo, 
			motorista.nome AS nome, 
			motorista.cpf AS cpf, 
			motorista.pontuacao AS pontuacao, 
			motorista.logradouro AS logradouro, 
			motorista.numero AS numero, 
			motorista.complemento AS complemento, 
			motorista.bairro AS bairro,
			motorista.cidade AS cidade, 
			motorista.uf AS uf, 
			motorista.cep AS cep, 
			motorista.email AS email, 
			motorista.senha AS senha, 
			motorista.latitude AS latitude, 
			motorista.longitude AS longitude, 
			motorista.tipo_carteira AS tipo_carteira, 
			motorista.validade_carteira AS validade_carteira, 
			motorista.situacao AS situacao
		')->from($this->table);
		/*$this->db->join('empresa_motorista', 'empresa_motorista.cod_motorista = '.$this->table.'.codigo');*/
		$this->db->where($this->table.'.email', $email);
		$this->db->where($this->table.'.senha', $senha);
		$query = $this->db->get();

		if($query->num_rows() == 1) {
			$result = $query->result();
			$motoristas = array();
			foreach($result as $row) {
				$motorista = new Motorista_basic();

				$motorista->setCodigo($row->codigo);
				/*$motorista->getEmpresa()->setCodigo($row->cod_empresa);*/
				$motorista->setNome($row->nome);
				$motorista->setCpf($row->cpf);
				$motorista->setPontuacao($row->pontuacao);
				$motorista->setLogradouro($row->logradouro);
				$motorista->setNumero($row->numero);
				$motorista->setComplemento($row->complemento);
				$motorista->setBairro($row->bairro);
				$motorista->setCidade($row->cidade);
				$motorista->setUf($row->uf);
				$motorista->setCep($row->cep);
				$motorista->setEmail($row->email);
				$motorista->setSenha($row->senha);
				$motorista->setLatitude($row->latitude);
				$motorista->setLongitude($row->longitude);
				$motorista->setTipoCarteira($row->tipo_carteira);
				$motorista->setValidadeCarteira($row->validade_carteira);
				$motorista->setSituacao($row->situacao);

				$motoristas[] = $motorista;
			}

			return $motoristas;
		} else {
			return false;
		}
	}

	public function esqueci_senha($email) {
		$this->db->select('
			motorista.codigo AS codigo, 
			motorista.nome AS nome, 
			motorista.cpf AS cpf, 
			motorista.pontuacao AS pontuacao, 
			motorista.logradouro AS logradouro, 
			motorista.numero AS numero, 
			motorista.complemento AS complemento, 
			motorista.bairro AS bairro,
			motorista.cidade AS cidade, 
			motorista.uf AS uf, 
			motorista.cep AS cep, 
			motorista.email AS email, 
			motorista.senha AS senha, 
			motorista.latitude AS latitude, 
			motorista.longitude AS longitude, 
			motorista.tipo_carteira AS tipo_carteira, 
			motorista.validade_carteira AS validade_carteira, 
			motorista.situacao AS situacao
		')->from($this->table);
		$this->db->where($this->table.'.email', $email);
		$query = $this->db->get();

		if($query->num_rows() == 1) {
			$result = $query->result();
			$motoristas = array();
			foreach($result as $row) {
				$motorista = new Motorista_basic();

				$motorista->setCodigo($row->codigo);
				$motorista->setNome($row->nome);
				$motorista->setCpf($row->cpf);
				$motorista->setPontuacao($row->pontuacao);
				$motorista->setLogradouro($row->logradouro);
				$motorista->setNumero($row->numero);
				$motorista->setComplemento($row->complemento);
				$motorista->setBairro($row->bairro);
				$motorista->setCidade($row->cidade);
				$motorista->setUf($row->uf);
				$motorista->setCep($row->cep);
				$motorista->setEmail($row->email);
				$motorista->setSenha($row->senha);
				$motorista->setLatitude($row->latitude);
				$motorista->setLongitude($row->longitude);
				$motorista->setTipoCarteira($row->tipo_carteira);
				$motorista->setValidadeCarteira($row->validade_carteira);
				$motorista->setSituacao($row->situacao);

				$motoristas[] = $motorista;
			}

			return $motoristas;
		} else {
			return false;
		}
	}
}