<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Usuario extends CI_Controller {
	function __construct() {
		parent::__construct();
		$this->load->model('basic/Usuario_basic');
		$this->load->model('model/Usuario_model');
		
		date_default_timezone_set('America/Sao_Paulo');
		setlocale(LC_ALL, 'pt_BR');
	}

	public function index() {
		$data['usuario'] = $this->Usuario_model->listar($this->session->userdata('codigo'), 1);
		$data['ativos'] = $this->Usuario_model->listar(null, '1');
		$data['excluidos'] = $this->Usuario_model->listar(null, '0');
		$data['middle'] = 'configuracao';
		$this->load->view('pattern/layout', $data);
	}

	public function entrar() {
		$usuario = new Usuario_basic();
		$usuario->setEmail(strip_tags(trim($this->input->post('email'))));
		$usuario->setSenha(strip_tags(trim($this->input->post('senha'))));

		$usuario = $this->Usuario_model->login($usuario);
		if($usuario) {
			$this->session->set_userdata('codigo', 	 $usuario->codigo);
			$this->session->set_userdata('empresa',  $usuario->empresa->codigo);
			$this->session->set_userdata('n_empresa',$usuario->empresa->nome_fantasia);
			$this->session->set_userdata('nome', 	 $usuario->nome);
			$this->session->set_userdata('email', 	 $usuario->email);
			$this->session->set_userdata('telefone', $usuario->telefone);
			$this->session->set_userdata('perfil', 	 $usuario->perfil);
			$this->session->set_userdata('foto', 	 $usuario->empresa->foto);

			redirect(base_url().'dashboard');
		} else if($this->input->post('email') == 'admin@coopera.pe.hu' && $this->input->post('senha') == 'admin') {
			$this->session->set_userdata('administrador', 'Administrador');
			redirect(base_url().'administrador');
		} else {
			$this->session->set_flashdata('error', 'Usuário e/ou Senha incorretos.');
			redirect(base_url());
		}
	}

	public function cadastrar() {
		$usuario = new Usuario_basic();
		$usuario->getEmpresa()->setCodigo($this->session->userdata('empresa'));
		$usuario->setNome(strip_tags(trim($this->input->post('nome'))));
		$usuario->setEmail(strip_tags(trim($this->input->post('email'))));
		$usuario->setSenha(strip_tags(trim($this->input->post('senha'))));
		$usuario->setPerfil($this->input->post('perfil'));
		$usuario->setSituacao(TRUE);

		$result = $this->Usuario_model->cadastrar($usuario);
		if($result) {
			$this->session->set_flashdata('success', 'Usuário, cadastrado com Sucesso.');
			$this->session->set_flashdata('usuario', 'Tab Usuário ativa.');
		} else {
			$this->session->set_flashdata('error', 'Ocorreu um erro, ao cadastrar o Usuário.');
		}
		
		redirect(base_url().'usuario');
	}

	public function editar() {
		$editar = (!is_null($this->input->post('editar'))) ? true : false;
		$editar_tab = (!is_null($this->input->post('editar_tab'))) ? true : false;
		if($editar) {
			$data = array(
				'cod_empresa' 	=> $this->session->userdata('empresa'),
				'nome' 			=> strip_tags(trim($this->input->post('nome'))),
				'email' 		=> strip_tags(trim($this->input->post('email'))),
				'cep' 			=> strip_tags(trim($this->input->post('cep'))),
				'logradouro' 	=> strip_tags(trim($this->input->post('logradouro'))),
				'numero' 		=> strip_tags(trim($this->input->post('numero'))),
				'complemento' 	=> strip_tags(trim($this->input->post('complemento'))),
				'bairro' 		=> strip_tags(trim($this->input->post('bairro'))),
				'cidade' 		=> strip_tags(trim($this->input->post('cidade'))),
				'uf' 			=> strip_tags(trim($this->input->post('uf'))),
				'telefone' 		=> str_replace("-", "", str_replace(" ", "", $this->input->post('telefone')))
			);

			$result = $this->Usuario_model->editar($data);
			if($result) {
				$this->session->set_flashdata('success', 'Usuário, Editado com Sucesso.');
			} else {
				$this->session->set_flashdata('error', 'Ocorreu um erro, ao editar o Usuário.');
			}

			redirect(base_url().'usuario');
		} else if($editar_tab) {
			$data = array(
				'cod_empresa' 	=> $this->session->userdata('empresa'),
				'nome' 			=> strip_tags(trim($this->input->post('nome'))),
				'email' 		=> strip_tags(trim($this->input->post('email'))),
				'perfil'		=> strip_tags(trim($this->input->post('perfil')))
			);

			$result = $this->Usuario_model->editar_usuario($this->input->post('codigo'), $data);
			if($result) {
				$this->session->set_flashdata('success', 'Usuário, Editado com Sucesso.');
				$this->session->set_flashdata('usuario', 'Tab Usuário ativa.');
			} else {
				$this->session->set_flashdata('error', 'Ocorreu um erro, ao editar o Usuário.');
			}

			redirect(base_url().'usuario');
		} else {
			if($this->session->userdata('perfil') == 'A') {
				$this->session->set_flashdata('usuario', 'Tab Usuário ativa.');
				$data['usuario'] = $this->Usuario_model->listar($this->session->userdata('codigo'), 1);
				$data['usuario_select'] = $this->Usuario_model->listar($this->uri->segment(3), 1);
				$data['ativos'] = $this->Usuario_model->listar(null, '1');
				$data['excluidos'] = $this->Usuario_model->listar(null, '0');
				$data['middle'] = 'configuracao';
				$this->load->view('pattern/layout', $data);
			}
		}
	}

	public function senha() {
		$codigo = $this->input->post('codigo');
		$senha = strip_tags(trim($this->input->post('senha')));

		$result = $this->Usuario_model->senha($senha, $codigo);
		if($result) {
			$this->session->set_flashdata('success', 'Senha do Usuário, Editado com Sucesso.');
			$this->session->set_flashdata('usuario', 'Tab Usuário ativa.');
		} else {
			$this->session->set_flashdata('error', 'Ocorreu um erro, ao editar a Senha do Usuário.');
		}

		redirect(base_url().'usuario');
	}

	public function excluir() {
		$result = $this->Usuario_model->status(FALSE, $this->uri->segment(3));
		if($result) {			
			$this->session->set_flashdata('usuario', 'Tab Usuário ativa.');
			$this->session->set_flashdata('success', 'Usuário, excluída com Sucesso.');
		} else {
			$this->session->set_flashdata('error', 'Ocorreu um erro, ao excluir o Usuário.');
		}

		redirect(base_url().'usuario');
	}

	public function reativar() {
		$result = $this->Usuario_model->status(TRUE, $this->uri->segment(3));
		if($result) {			
			$this->session->set_flashdata('usuario', 'Tab Usuário ativa.');
			$this->session->set_flashdata('success', 'Usuário, reativado com Sucesso.');
		} else {
			$this->session->set_flashdata('error', 'Ocorreu um erro, ao reativado o Usuário.');
		}

		redirect(base_url().'usuario');
	}

	public function sair() {
		$this->session->unset_userdata('codigo');
		$this->session->unset_userdata('empresa');
		$this->session->unset_userdata('nome');
		$this->session->unset_userdata('email');
		$this->session->unset_userdata('perfil');

		$this->session->sess_destroy();
		redirect(base_url(), 'refresh');
	}
}
?>