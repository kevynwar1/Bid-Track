<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {
	public function index() {
		$this->load->model('model/Entrega_model');
		$this->load->model('model/Romaneio_model');
		$this->load->model('model/Ocorrencia_model');

		$data['entrega'] = $this->Entrega_model->total();
		$data['faturamento'] = $this->Romaneio_model->faturamento();
		$data['ocorrencia'] = $this->Ocorrencia_model->total();
		$data['middle'] = 'dashboard';
		$this->load->view('pattern/layout', $data);
	}
}