<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {
	public function index() {
		$this->load->view('index');
	}

	public function joana() {
		$this->load->view('joana/index');
	}

	public function apresentacao() {
		if($this->uri->segment(3) == 'index') {
			$this->load->view('apresentacao/index');
		} else {
			$this->load->view('apresentacao');
		}
	}

	public function maps() {
		$address = trim(str_replace(" ", "+", $this->input->post('address')));
		$json_url = "https://maps.googleapis.com/maps/api/geocode/json?address=$address&key=AIzaSyDHWJdTCd5dUDdZFg5OjIE7rRd2t-EZO3w";
		$json = file_get_contents(str_replace("&amp;", "&", $json_url));
		$data = json_decode($json, TRUE);

		echo json_encode($data);
	}

	public function mapa() {
		$address = trim(str_replace(" ", "+", $this->input->get('endereco')));
		$json_url = "https://maps.googleapis.com/maps/api/geocode/json?address=$address&key=AIzaSyDyIn0nbXxWrWrdyV9plcwTO_bJ-Rm9y7w";
		$json = file_get_contents(str_replace("&amp;", "&", $json_url));
		$coordenadas = json_decode($json, TRUE);

		$data['coordenadas'] = $coordenadas;
		$data['middle'] = 'mapa';
		$this->load->view('pattern/layout', $data);
	}

	public function rr() {
		$this->load->model('model/Integracao_model');
		$estabelecimento = explode(" ", "Cazan Pina");
		$est = $this->Integracao_model->estabelecimento($estabelecimento);
		p($est);
	}
}
