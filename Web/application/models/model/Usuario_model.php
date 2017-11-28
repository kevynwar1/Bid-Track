<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Usuario_model extends CI_Model {
	public $table = "usuario";

	function __construct() {
		parent::__construct();
		$this->load->model('basic/Usuario_basic');
	}

	public function cadastrar($usuario) {
		$data = array(
			'cod_empresa' 	=> $usuario->getEmpresa()->getCodigo(),
			'nome' 			=> $usuario->getNome(),
			'email' 		=> $usuario->getEmail(),
			'senha' 		=> $usuario->getSenha(),
			'perfil' 		=> $usuario->getPerfil(),
			'situacao'		=> $usuario->getSituacao()
		);

		$this->db->insert($this->table, $data);
		if(!$this->db->affected_rows()) {
			return false;
		}
		return true;
	}

	public function editar($usuario) {
		$this->db->where($this->table.'.codigo', $this->session->userdata('codigo'));
		$this->db->where($this->table.'.cod_empresa', $this->session->userdata('empresa'));
		$this->db->update($this->table, $usuario);

		return $this->db->affected_rows();
	}

	public function editar_usuario($codigo, $usuario) {
		$this->db->where($this->table.'.codigo', $codigo);
		$this->db->where($this->table.'.cod_empresa', $this->session->userdata('empresa'));
		$this->db->update($this->table, $usuario);

		return $this->db->affected_rows();
	}

	public function senha($senha, $codigo) {
		$this->db->set($this->table.'.senha', $senha);
		$this->db->where($this->table.'.codigo', $codigo);
		$this->db->where($this->table.'.cod_empresa', $this->session->userdata('empresa'));
		$this->db->update($this->table);

		return $this->db->affected_rows();
	}

	public function verificar_email($email) {
		$this->db->select($this->table.'.codigo')->from($this->table);
		$this->db->where($this->table.'.cod_empresa', $this->session->userdata('empresa'));
		$this->db->where($this->table.'.email', $email);
		$query = $this->db->get();

		if($query->num_rows() >= 1) {
			return false;
		} else {
			return true;
		}
	}

	public function login($usuario) {
		$this->db->select('
			usuario.codigo AS codigo,
			usuario.cod_empresa AS cod_empresa,
			empresa.cnpj AS cnpj,
			empresa.nome_fantasia AS nome_fantasia,
			empresa.foto AS foto, 
			usuario.nome AS nome,
			usuario.email AS email,
			usuario.cep AS cep,
			usuario.logradouro AS logradouro,
			usuario.numero AS numero,
			usuario.complemento AS complemento,
			usuario.bairro AS bairro,
			usuario.cidade AS cidade,
			usuario.uf AS uf,
			usuario.telefone AS telefone,
			usuario.senha AS senha,
			usuario.perfil AS perfil,
			usuario.situacao AS situacao
		')->from($this->table);
		$this->db->join('empresa', 'empresa.codigo = '.$this->table.'.cod_empresa');
		$this->db->where($this->table.'.email', $usuario->getEmail());
		$this->db->where($this->table.'.senha', $usuario->getSenha());
		$this->db->where($this->table.'.situacao', TRUE);
		$query = $this->db->get();

		if($query->num_rows() == 1) {
			$result = $query->result();
			$usuario = new Usuario_basic();
			foreach($result as $row) {
				$usuario->setCodigo($row->codigo);
				$usuario->getEmpresa()->setCodigo($row->cod_empresa);
				$usuario->getEmpresa()->setCnpj($row->cnpj);
				$usuario->getEmpresa()->setNomeFantasia($row->nome_fantasia);
				$usuario->getEmpresa()->setFoto($row->foto);
				$usuario->setNome($row->nome);
				$usuario->setEmail($row->email);
				$usuario->setLogradouro($row->logradouro);
				$usuario->setNumero($row->numero);
				$usuario->setComplemento($row->complemento);
				$usuario->setBairro($row->bairro);
				$usuario->setCidade($row->cidade);
				$usuario->setUf($row->uf);
				$usuario->setTelefone($row->telefone);
				$usuario->setSenha($row->senha);
				$usuario->setPerfil($row->perfil);
				$usuario->setSituacao($row->situacao);
			}

			return $usuario;
		} else {
			return false;
		}
	}

	public function listar($codigo = NULL, $situacao) {
		$this->db->select('
			usuario.codigo AS codigo,
			usuario.cod_empresa AS cod_empresa,
			empresa.cnpj AS cnpj,
			empresa.nome_fantasia AS nome_fantasia,
			usuario.nome AS nome,
			usuario.email AS email,
			usuario.cep AS cep,
			usuario.logradouro AS logradouro,
			usuario.numero AS numero,
			usuario.complemento AS complemento,
			usuario.bairro AS bairro,
			usuario.cidade AS cidade,
			usuario.uf AS uf,
			usuario.telefone AS telefone,
			usuario.senha AS senha,
			usuario.perfil AS perfil,
			usuario.situacao AS situacao
		')->from($this->table);
		$this->db->join('empresa', 'empresa.codigo = '.$this->table.'.cod_empresa');
		if(!is_null($codigo)) {
			$this->db->where($this->table.'.codigo', $codigo);
		} else {
			$this->db->where_not_in($this->table.'.codigo', $this->session->userdata('codigo')); // VERIFICAR
		}
		$this->db->where($this->table.'.cod_empresa', $this->session->userdata('empresa'));
		$this->db->where($this->table.'.situacao', $situacao);
		$this->db->order_by($this->table.'.nome', 'ASC');
		$query = $this->db->get();

		if($query->num_rows() > 0) {
			$result = $query->result();
			$usuarios = array();
			foreach($result as $row) {
				$usuario = new Usuario_basic();

				$usuario->setCodigo($row->codigo);
				$usuario->getEmpresa()->setCodigo($row->cod_empresa);
				$usuario->getEmpresa()->setCnpj($row->cnpj);
				$usuario->getEmpresa()->setNomeFantasia($row->nome_fantasia);
				$usuario->setNome($row->nome);
				$usuario->setEmail($row->email);
				$usuario->setCep($row->cep);
				$usuario->setLogradouro($row->logradouro);
				$usuario->setNumero($row->numero);
				$usuario->setComplemento($row->complemento);
				$usuario->setBairro($row->bairro);
				$usuario->setCidade($row->cidade);
				$usuario->setUf($row->uf);
				$usuario->setTelefone($row->telefone);
				$usuario->setSenha($row->senha);
				$usuario->setPerfil($row->perfil);
				$usuario->setSituacao($row->situacao);

				$usuarios[] = $usuario;
			}

			return $usuarios;
		} else {
			return false;
		}
	}

	public function status($status, $codigo) {
		$this->db->set($this->table.'.situacao', $status);
		$this->db->where($this->table.'.codigo', $codigo);
		$this->db->where($this->table.'.cod_empresa', $this->session->userdata('empresa'));
		$this->db->update($this->table);

		return $this->db->affected_rows();
	}
}