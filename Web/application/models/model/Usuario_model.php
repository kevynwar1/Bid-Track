<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Usuario_model extends CI_Model {
	public $table = "usuario";

	function __construct() {
		parent::__construct();
		$this->load->model('basic/Usuario_basic');
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

	public function login($email, $senha) {
		$this->db->select('*')->from($this->table);
		$this->db->where($this->table.'.email', $email);
		$this->db->where($this->table.'.senha', $senha);
		$query = $this->db->get();

		if($query->num_rows() > 0) {
			$result = $query->result();
			$usuarios = array();
			foreach($result as $row) {
				$usuario = new Usuario_basic();

				$usuario->setCodigo($row->codigo);
				$usuario->getEmpresa()->setCodigo($row->cod_empresa);
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