<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Estabelecimento extends CI_Controller {
	function __construct() {
		parent::__construct();
		$this->load->model('basic/Estabelecimento_basic');
		$this->load->model('model/Estabelecimento_model');
		date_default_timezone_set('America/Sao_Paulo');
	}

	public function index() {
		$offset = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
		$config = array(
			'base_url' 		=> base_url('estabelecimento/p'), 
			'per_page' 		=> 5, 
			'num_links' 	=> 3, 
			'uri_segment' 	=> 3, 
			'total_rows' 	=> $this->Estabelecimento_model->total(), 
			'prev_link' 	=> '<small class="desc bt">
									<i class="fa fa-angle-left" aria-hidden="true"></i> Anterior
								</small>', 
			'next_link' 	=> '<small class="desc bt">
									Próximo <i class="fa fa-angle-right" aria-hidden="true"></i>
								</small>', 
			'cur_tag_open'	=> '<li class="num">', 
			'cur_tag_close'	=> '</li>', 
			'num_tag_open'	=> '<li class="num">', 
			'num_tag_close'	=> '</li>' 
		);
		$this->pagination->initialize($config);

		$data['pagination'] = $this->pagination->create_links();
		$data['estabelecimento'] = $this->Estabelecimento_model->listar($config['per_page'], $offset);
		$data['middle'] = 'estabelecimento';
		$this->load->view('pattern/layout', $data);
	}

	public function add() {
		$data['middle'] = 'estabelecimento/cadastrar';
		$this->load->view('pattern/layout', $data);
	}

	public function cadastrar() {
		$estabelecimento = new Estabelecimento_basic();
		$estabelecimento->getEmpresa()->setCodigo($this->session->userdata('empresa'));
		$estabelecimento->setRazaoSocial(strip_tags(trim($this->input->post('razao_social'))));
		$estabelecimento->setCnpj(strip_tags(trim($this->input->post('cnpj'))));
		$estabelecimento->setLogradouro(strip_tags(trim($this->input->post('logradouro'))));
		$estabelecimento->setNumero(strip_tags(trim($this->input->post('numero'))));
		$estabelecimento->setComplemento(strip_tags(trim($this->input->post('complemento'))));
		$estabelecimento->setBairro(strip_tags(trim($this->input->post('bairro'))));
		$estabelecimento->setCidade(strip_tags(trim($this->input->post('cidade'))));
		$estabelecimento->setUf(strip_tags(trim($this->input->post('uf'))));
		$estabelecimento->setCep(strip_tags(trim($this->input->post('cep'))));
		
		$json_url = "https://maps.googleapis.com/maps/api/geocode/json?address=".str_replace(" ", "+", $estabelecimento->getLogradouro().", ".$estabelecimento->getNumero()." - ".$estabelecimento->getBairro())."&key=AIzaSyDyIn0nbXxWrWrdyV9plcwTO_bJ-Rm9y7w";
		$json = file_get_contents(str_replace("&amp;", "&", $json_url));
		$coordenadas = json_decode($json, TRUE);
		$estabelecimento->setLatitude(str_replace(",", ".", $coordenadas['results'][0]['geometry']['location']['lat']));
		$estabelecimento->setLongitude(str_replace(",", ".", $coordenadas['results'][0]['geometry']['location']['lng']));

		$result = $this->Estabelecimento_model->cadastrar($estabelecimento);
		if($result) {
			$this->session->set_flashdata('success', 'Estabelecimento, cadastrado com Sucesso.');
		} else {
			$this->session->set_flashdata('error', 'Ocorreu um erro, ao cadastrar o Estabelecimento.');
		}

		redirect(base_url().'estabelecimento');
	}

	public function excluir() {
		$estabelecimento = new Estabelecimento_basic();
		$estabelecimento->setCodigo($this->uri->segment(3));

		$result = $this->Estabelecimento_model->excluir($estabelecimento);
		if($result) {
			$this->session->set_flashdata('success', 'Estabelecimento, Excluída com Sucesso.');
		} else {
			$this->session->set_flashdata('error', 'Ocorreu um erro, ao excluir a Estabelecimento.');
		}

		redirect(base_url().'estabelecimento');
	}

	public function s() {
		$filtro = $this->input->get('filtro');
		$procurar = strip_tags(trim($this->input->get('procurar')));

		$data['estabelecimento'] = $this->Estabelecimento_model->consultar($filtro, $procurar);
		$data['middle'] = 'estabelecimento';
		$this->load->view('pattern/layout', $data);
	}
}
?>