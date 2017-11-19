<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Destinatario extends CI_Controller {
	function __construct() {
		parent::__construct();
		$this->load->model('basic/Destinatario_basic');
		$this->load->model('model/Destinatario_model');
		date_default_timezone_set('America/Sao_Paulo');
	}

	public function index() {
		$offset = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
		$config = array(
			'base_url' 		=> base_url('destinatario/p'), 
			'per_page' 		=> 5, 
			'num_links' 	=> 3, 
			'uri_segment' 	=> 3, 
			'total_rows' 	=> $this->Destinatario_model->total(), 
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
		$data['destinatario'] = $this->Destinatario_model->listar(null, $config['per_page'], $offset);
		$data['middle'] = 'destinatario';
		$this->load->view('pattern/layout', $data);
	}

	public function add() {
		$data['middle'] = ($this->uri->segment(3) == 'j') ? 'destinatario/cadastrar_juridica':'destinatario/cadastrar_fisica';
		$this->load->view('pattern/layout', $data);
	}

	public function cadastrar() {
		$destinatario = new Destinatario_basic();
		$destinatario->getEmpresa()->setCodigo($this->session->userdata('empresa'));
		$destinatario->setRazaoSocial(strip_tags(trim($this->input->post('razao_social'))));
		$destinatario->setNomeFantasia(strip_tags(trim($this->input->post('razao_social'))));
		$destinatario->setTipoPessoa(strip_tags(trim($this->input->post('tipo_pessoa'))));
		$destinatario->setCnpjCpf(strip_tags(trim($this->input->post('cnpj_cpf'))));
		$destinatario->setEmail(strip_tags(trim($this->input->post('email'))));
		$destinatario->setTelefone(strip_tags(trim($this->input->post('telefone'))));
		$destinatario->setLogradouro(strip_tags(trim($this->input->post('logradouro'))));
		$destinatario->setNumero(strip_tags(trim($this->input->post('numero'))));
		$destinatario->setComplemento(strip_tags(trim($this->input->post('complemento'))));
		$destinatario->setBairro(strip_tags(trim($this->input->post('bairro'))));
		$destinatario->setCidade(strip_tags(trim($this->input->post('cidade'))));
		$destinatario->setCep(strip_tags(trim($this->input->post('cep'))));
		$destinatario->setUf(strip_tags(trim($this->input->post('uf'))));

		$json_url = "https://maps.googleapis.com/maps/api/geocode/json?address=".str_replace(" ", "+", acentuacao($destinatario->getLogradouro()).", ".$destinatario->getNumero()." ".acentuacao($destinatario->getBairro()))."&key=AIzaSyDyIn0nbXxWrWrdyV9plcwTO_bJ-Rm9y7w";
		$json = file_get_contents(str_replace("&amp;", "&", $json_url));
		$coordenadas = json_decode($json, TRUE);

		$destinatario->setLatitude((is_null($coordenadas) ? '0' : $coordenadas['results'][0]['geometry']['location']['lat']));
		$destinatario->setLongitude((is_null($coordenadas) ? '0' : $coordenadas['results'][0]['geometry']['location']['lng']));
		$destinatario->setSituacao(TRUE);

		$result = $this->Destinatario_model->cadastrar($destinatario);
		if($result) {
			$this->session->set_flashdata('success', 'Destinatário, cadastrado com Sucesso.');
		} else {
			$this->session->set_flashdata('error', 'Ocorreu um erro, ao cadastrar o Destinatário.');
		}

		redirect(base_url().'destinatario');
	}

	public function editar() {
		$editar = (!is_null($this->input->post('editar'))) ? true : false;
		if($editar) {
			$json_url = "https://maps.googleapis.com/maps/api/geocode/json?address=".str_replace(" ", "+", acentuacao(strip_tags(trim($this->input->post('logradouro')))).", ".strip_tags(trim($this->input->post('numero')))." ".acentuacao(strip_tags(trim($this->input->post('bairro')))))."&key=AIzaSyDyIn0nbXxWrWrdyV9plcwTO_bJ-Rm9y7w";
			$json = file_get_contents(str_replace("&amp;", "&", $json_url));
			$coordenadas = json_decode($json, TRUE);
			
			$data = array(
				'codigo'		=> $this->input->post('codigo'),
				'cod_empresa'	=> $this->session->userdata('empresa'),
				'razao_social'	=> strip_tags(trim($this->input->post('razao_social'))),
				'nome_fantasia' => strip_tags(trim($this->input->post('nome_fantasia'))),
				'tipo_pessoa' 	=> strip_tags(trim($this->input->post('tipo_pessoa'))),
				'cnpj_cpf' 		=> strip_tags(trim($this->input->post('cnpj_cpf'))),
				'email' 		=> strip_tags(trim($this->input->post('email'))),
				'telefone' 		=> strip_tags(trim($this->input->post('telefone'))),
				'logradouro' 	=> strip_tags(trim($this->input->post('logradouro'))),
				'numero' 		=> strip_tags(trim($this->input->post('numero'))),
				'complemento' 	=> strip_tags(trim($this->input->post('complemento'))),
				'bairro' 		=> strip_tags(trim($this->input->post('bairro'))),
				'cidade' 		=> strip_tags(trim($this->input->post('cidade'))),
				'cep' 			=> strip_tags(trim($this->input->post('cep'))),
				'uf' 			=> strip_tags(trim($this->input->post('uf'))),
				'latitude'		=> $coordenadas['results'][0]['geometry']['location']['lat'],
				'longitude'		=> $coordenadas['results'][0]['geometry']['location']['lng']
			);

			$result = $this->Destinatario_model->editar($data);
			if($result) {
				$this->session->set_flashdata('success', 'Destinatário, Editado com Sucesso.');
			} else {
				$this->session->set_flashdata('error', 'Ocorreu um erro, ao editar o Destinatário.');
			}

			redirect(base_url().'destinatario/editar/'.$data['codigo']);
		} else {
			$data['destinatario'] = $this->Destinatario_model->consultar('codigo', $this->uri->segment(3));
			$data['middle'] = 'destinatario/editar';
			$this->load->view('pattern/layout', $data);
		}
	}

	public function excluir() {
		$destinatario = new Destinatario_basic();
		$destinatario->setCodigo($this->uri->segment(3));

		$result = $this->Destinatario_model->excluir($destinatario);
		if($result) {
			$this->session->set_flashdata('success', 'Destinatário, Excluído com Sucesso.');
		} else {
			$this->session->set_flashdata('error', 'Ocorreu um erro, ao excluir o Destinatário.');
		}

		redirect(base_url().'destinatario');
	}

	public function s() {
		$filtro = $this->input->get('filtro');
		$procurar = strip_tags(trim($this->input->get('procurar')));

		$data['destinatario'] = $this->Destinatario_model->consultar($filtro, $procurar);
		$data['middle'] = 'destinatario';
		$this->load->view('pattern/layout', $data);
	}
}