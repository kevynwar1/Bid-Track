<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Usuario_model extends CI_Model {
	public $table = "usuario";

	function __construct() {
		parent::__construct();
		$this->load->model('basic/Usuario_basic');
	}

	public function login($usuario) {
		$this->db->select('
			usuario.codigo, 
			usuario.cod_empresa, 
			usuario.nome, 
			usuario.telefone, 
			usuario.email, 
			usuario.senha,
			usuario.perfil, 
			usuario.situacao, 
			empresa.cnpj, 
			empresa.nome_fantasia
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
				$usuario->setNome($row->nome);
				$usuario->setEmail($row->email);
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

	public function listar() {
		$this->db->select('*')->from($this->table);
		$this->db->join('empresa', 'empresa.codigo = '.$this->table.'.cod_empresa');
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
}