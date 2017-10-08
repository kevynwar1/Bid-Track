<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Usuario extends CI_Controller {
	function __construct() {
		parent::__construct();
		$this->load->model('basic/Usuario_basic');
		$this->load->model('model/Usuario_model');
		date_default_timezone_set('America/Sao_Paulo');
	}

	public function entrar() {
		$usuario = new Usuario_basic();
		$usuario->setEmail($this->input->post('email'));
		$usuario->setSenha($this->input->post('senha'));

		$usuario = $this->Usuario_model->login($usuario);
		if($usuario) {
			$this->load->model('model/Romaneio_model');
			$this->load->model('model/Ocorrencia_model');

			$this->session->set_userdata('codigo', 	$usuario->codigo);
			$this->session->set_userdata('empresa', $usuario->empresa->codigo);
			$this->session->set_userdata('nome', 	$usuario->nome);
			$this->session->set_userdata('email', 	$usuario->email);
			$this->session->set_userdata('perfil', 	$usuario->perfil);

			$data['faturamento'] = $this->Romaneio_model->faturamento();
			$data['ocorrencia'] = $this->Ocorrencia_model->total();
			$data['middle'] = 'dashboard';
			$this->load->view('pattern/layout', $data);
		} else {
			$this->session->set_flashdata('error', 'Usuário e/ou Senha incorretos.');
			redirect(base_url());
		}
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