<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {
	public function index() {
		$this->load->view('index');
	}

	public function erick() {
		$this->load->model('model/Motorista_model');
		$brasil = $this->Motorista_model->login('cesar@gmail.com', '1234');

		p($brasil);
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

	public function cep() {
		$cep = $_POST['cep'];

		$reg = simplexml_load_file("http://cep.republicavirtual.com.br/web_cep.php?formato=xml&cep=".$cep);

		$dados['sucesso'] = (string) $reg->resultado;
		$dados['rua']     = (string) $reg->tipo_logradouro.' '.$reg->logradouro;
		$dados['bairro']  = (string) $reg->bairro;
		$dados['cidade']  = (string) $reg->cidade;
		$dados['uf']  = (string) $reg->uf;
		 
		echo json_encode($dados);
	}

	public function cpf() {
		$cpf = $_POST['cpf'];
		if($cpf == 0) {
			$dados['sucesso'] = 0;
		} else {
			$cpf = preg_replace('/[^0-9]/', '', (string) $cpf);
			if(strlen($cpf) != 11) {
				$dados['sucesso'] = 0;
			}

			for($i = 0, $j = 10, $soma = 0; $i < 9; $i++, $j--) {
				$soma += $cpf{$i} * $j;
				$dados['sucesso'] = 1;
			}

			$resto = $soma % 11;
			if($cpf{9} != ($resto < 2 ? 0 : 11 - $resto)) {
				$dados['sucesso'] = 0;
			}

			for($i = 0, $j = 11, $soma = 0; $i < 10; $i++, $j--) {
				$soma += $cpf{$i} * $j;
				$dados['sucesso'] = 1;
			}

			echo json_encode($dados);
		}
	}
}
