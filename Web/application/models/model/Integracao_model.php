<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Integracao_model extends CI_Model {
	// Romaneio
	public function estabelecimento($cnpj) {
		$this->load->model('basic/Estabelecimento_basic');
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
		')->from('estabelecimento');
		$this->db->where('estabelecimento.cod_empresa', $this->session->userdata('empresa'));
		$this->db->where('estabelecimento.cnpj', $cnpj);
		$query = $this->db->get();

		if($query->num_rows() == 1) {
			$result = $query->result();
			$estabelecimento = new Estabelecimento_basic();
			foreach($result as $row) {
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
			}

			return $estabelecimento;
		} else {
			return false;
		}
	}

	public function verificar_estabelecimento($estabelecimento) {
		$this->db->select('estabelecimento.codigo')->from('estabelecimento');
		$this->db->where('estabelecimento.cod_empresa', $this->session->userdata('empresa'));
		$this->db->where('estabelecimento.cnpj', $estabelecimento);
		$query = $this->db->get();

		if($query->num_rows() >= 1) {
			return false;
		} else {
			return true;
		}
	}

	public function transportadora($cnpj) {
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
		')->from('transportadora');
		$this->db->where('transportadora.cod_empresa', $this->session->userdata('empresa'));
		$this->db->where('transportadora.cnpj', $cnpj);
		$query = $this->db->get();

		if($query->num_rows() == 1) {
			$result = $query->result();
			$transportadora = new Transportadora_basic();
			foreach($result as $row) {
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
			}

			return $transportadora;
		} else {
			return false;
		}
	}

	public function verificar_transportadora($transportadora) {
		if($transportadora == 0) {
			return false;
		} else {
			$this->db->select('transportadora.codigo')->from('transportadora');
			$this->db->where('transportadora.cod_empresa', $this->session->userdata('empresa'));
			$this->db->where('transportadora.cnpj', $transportadora);
			$query = $this->db->get();

			if($query->num_rows() >= 1) {
				return false;
			} else {
				return true;
			}
		}
	}

	public function motorista($cpf) {
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
		')->from('motorista');
		$this->db->join('empresa_motorista', 'empresa_motorista.cod_motorista = motorista.codigo');
		$this->db->where('empresa_motorista.cod_empresa', $this->session->userdata('empresa'));
		$this->db->where('motorista.cpf', $cpf);
		$query = $this->db->get();

		if($query->num_rows() == 1) {
			$result = $query->result();
			$motorista = new Motorista_basic();
			foreach($result as $row) {
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
			}

			return $motorista;
		} else {
			return false;
		}
	}

	public function verificar_motorista($motorista) {
		if($motorista == 0) {
			return false;
		} else {
			$this->db->select('motorista.codigo')->from('motorista');
			$this->db->join('empresa_motorista', 'empresa_motorista.cod_motorista = motorista.codigo');
			$this->db->where('empresa_motorista.cod_empresa', $this->session->userdata('empresa'));
			$this->db->where('motorista.cpf', $motorista);
			$query = $this->db->get();

			if($query->num_rows() >= 1) {
				return false;
			} else {
				return true;
			}
		}
	}

	public function verificar_motorista_disponibilidade($motorista) {
		if($motorista == 0) {
			return true;
		} else {
			$this->db->select('motorista.codigo')->from('motorista');
			$this->db->join('empresa_motorista', 'empresa_motorista.cod_motorista = motorista.codigo');
			$this->db->where('empresa_motorista.cod_empresa', $this->session->userdata('empresa'));
			$this->db->where('motorista.cpf', $motorista);
			$this->db->where('motorista.disponibilidade', TRUE);
			$query = $this->db->get();

			if($query->num_rows() >= 1) {
				return true;
			} else {
				return false;
			}
		}
	}

	public function tipo_veiculo($descricao) {
		$this->db->select('
			tipo_veiculo.codigo AS codigo, 
			tipo_veiculo.cod_empresa AS cod_empresa, 
			tipo_veiculo.descricao AS descricao, 
			tipo_veiculo.peso AS peso, 
			tipo_veiculo.situacao AS situacao
		')->from('tipo_veiculo');
		$this->db->where("tipo_veiculo.cod_empresa", $this->session->userdata('empresa'));
		$this->db->like("tipo_veiculo.descricao", $descricao);
		$query = $this->db->get();

		if($query->num_rows() == 1) {
			$result = $query->result();
			$tipoveiculo = new TipoVeiculo_basic();
			foreach($result as $row) {
				$tipoveiculo->setCodigo($row->codigo);
				$tipoveiculo->getEmpresa()->setCodigo($row->cod_empresa);
				$tipoveiculo->setDescricao($row->descricao);
				$tipoveiculo->setPeso($row->peso);
				$tipoveiculo->setSituacao($row->situacao);
			}

			return $tipoveiculo;
		} else {
			return false;
		}
	}

	public function verificar_tipoveiculo($tipo_veiculo) {
		$this->db->select('tipo_veiculo.codigo')->from('tipo_veiculo');
		$this->db->where('tipo_veiculo.cod_empresa', $this->session->userdata('empresa'));
		$this->db->like('tipo_veiculo.descricao', $tipo_veiculo);
		$query = $this->db->get();

		if($query->num_rows() >= 1) {
			return false;
		} else {
			return true;
		}
	}





	// Entrega
	public function destinatario($cnpj_cpf) {
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
		')->from('destinatario');
		$this->db->where('destinatario.cod_empresa', $this->session->userdata('empresa'));
		$this->db->where('destinatario.cnpj_cpf', $cnpj_cpf);
		$query = $this->db->get();

		if($query->num_rows() > 0) {
			$result = $query->result();
			$destinatario = new Destinatario_basic();
			foreach($result as $row) {
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
			}

			return $destinatario;
		} else {
			return false;
		}
	}

	public function verificar_destinatario($destinatario) {
		$this->db->select('destinatario.codigo')->from('destinatario');
		$this->db->where('destinatario.cod_empresa', $this->session->userdata('empresa'));
		$this->db->where('destinatario.cnpj_cpf', $destinatario);
		$query = $this->db->get();

		if($query->num_rows() >= 1) {
			return false;
		} else {
			return true;
		}
	}
}
?>