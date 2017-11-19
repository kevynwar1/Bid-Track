<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Transportadora extends CI_Controller {
	function __construct() {
		parent::__construct();
		$this->load->model('basic/Transportadora_basic');
		$this->load->model('model/Transportadora_model');
		
		date_default_timezone_set('America/Sao_Paulo');
		setlocale(LC_ALL, 'pt_BR');
	}

	public function index() {
		$offset = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
		$config = array(
			'base_url' 		=> base_url('transportadora/p'), 
			'per_page' 		=> 5, 
			'num_links' 	=> 3, 
			'uri_segment' 	=> 3, 
			'total_rows' 	=> $this->Transportadora_model->total(), 
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
		$data['transportadora'] = $this->Transportadora_model->listar($config['per_page'], $offset);
		$data['middle'] = 'transportadora';
		$this->load->view('pattern/layout', $data);
	}

	public function add() {
		$data['middle'] = 'transportadora/cadastrar';
		$this->load->view('pattern/layout', $data);
	}

	public function cadastrar() {
		$transportadora = new Transportadora_basic();
		$transportadora->getEmpresa()->setCodigo($this->session->userdata('empresa'));
		$transportadora->setRazaoSocial(strip_tags(trim($this->input->post('razao_social'))));
		$transportadora->setNomeFantasia(strip_tags(trim($this->input->post('razao_social'))));
		$transportadora->setCnpj(strip_tags(trim($this->input->post('cnpj'))));
		$transportadora->setLogradouro(strip_tags(trim($this->input->post('logradouro'))));
		$transportadora->setNumero(strip_tags(trim($this->input->post('numero'))));
		$transportadora->setComplemento(strip_tags(trim($this->input->post('complemento'))));
		$transportadora->setBairro(strip_tags(trim($this->input->post('bairro'))));
		$transportadora->setCidade(strip_tags(trim($this->input->post('cidade'))));
		$transportadora->setUf(strip_tags(trim($this->input->post('uf'))));
		$transportadora->setCep(strip_tags(trim($this->input->post('cep'))));
		
		$json_url = "https://maps.googleapis.com/maps/api/geocode/json?address=".str_replace(" ", "+", $transportadora->getLogradouro().", ".$transportadora->getNumero())."&key=AIzaSyDyIn0nbXxWrWrdyV9plcwTO_bJ-Rm9y7w";
		$json = file_get_contents(str_replace("&amp;", "&", $json_url));
		$coordenadas = json_decode($json, TRUE);
		$transportadora->setLatitude(str_replace(",", ".", $coordenadas['results'][0]['geometry']['location']['lat']));
		$transportadora->setLongitude(str_replace(",", ".", $coordenadas['results'][0]['geometry']['location']['lng']));

		$result = $this->Transportadora_model->cadastrar($transportadora);
		if($result) {
			$this->session->set_flashdata('success', 'Transportadora, cadastrada com Sucesso.');
		} else {
			$this->session->set_flashdata('error', 'Ocorreu um erro, ao cadastrar a Transportadora.');
		}

		redirect(base_url().'transportadora');
	}

	public function editar() {
		$editar = (!is_null($this->input->post('editar'))) ? true : false;
		if($editar) {
			$data = array(
				'codigo' => $this->input->post('codigo'),
				'razao_social' => strip_tags(trim($this->input->post('razao_social'))),
				'nome_fantasia' => strip_tags(trim($this->input->post('razao_social'))),
				'logradouro' => strip_tags(trim($this->input->post('logradouro'))),
				'numero' => strip_tags(trim($this->input->post('numero'))),
				'complemento' => strip_tags(trim($this->input->post('complemento'))),
				'bairro' => strip_tags(trim($this->input->post('bairro'))),
				'cidade' => strip_tags(trim($this->input->post('cidade'))),
				'uf' => strip_tags(trim($this->input->post('uf'))),
				'cep' => strip_tags(trim($this->input->post('cep')))
			);

			$result = $this->Transportadora_model->editar($data);
			if($result) {
				$this->session->set_flashdata('success', 'Romaneio, Editado com Sucesso.');
				redirect(base_url().'transportadora/editar/'.$data['codigo']);
			} else {
				$this->session->set_flashdata('error', 'Ocorreu um erro, ao editar a Transportadora.');
				redirect(base_url().'transportadora');
			}
		} else {
			if($this->session->userdata('perfil') == 'A') {
				$this->load->model('model/Romaneio_model');
				$data['transportadora'] = $this->Transportadora_model->consultar_transportadora($this->uri->segment(3));
				$data['romaneios'] = $this->Romaneio_model->consultar('transportadora_codigo', $this->uri->segment(3));
				$data['middle'] = 'transportadora/editar';
				$this->load->view('pattern/layout', $data);
			} else {
				$this->session->set_flashdata('error', 'Desculpe, você não tem permissão.');
				redirect(base_url().'transportadora');
			}
		}
	}

	public function excluir() {
		$transportadora = new Transportadora_basic();
		$transportadora->setCodigo($this->uri->segment(3));

		$result = $this->Transportadora_model->excluir($transportadora);
		if($result) {
			$this->session->set_flashdata('success', 'Transportadora, Excluída com Sucesso.');
		} else {
			$this->session->set_flashdata('error', 'Ocorreu um erro, ao excluir a Transportadora.');
		}

		redirect(base_url().'transportadora');
	}

	public function s() {
		$filtro = $this->input->get('filtro');
		$procurar = strip_tags(trim($this->input->get('procurar')));

		$data['transportadora'] = $this->Transportadora_model->consultar($filtro, $procurar);
		$data['middle'] = 'transportadora';
		$this->load->view('pattern/layout', $data);
	}
}
?>