<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {
	public function index() {
		$this->load->model('model/Romaneio_model');

		$data['faturamento'] = $this->Romaneio_model->faturamento();
		$data['middle'] = 'dashboard';
		$this->load->view('pattern/layout', $data);
	}
}