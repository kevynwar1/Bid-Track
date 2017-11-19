<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Veiculo extends CI_Controller {
	function __construct() {
		parent::__construct();
		$this->load->model('basic/Veiculo_basic');
		$this->load->model('model/Veiculo_model');
		date_default_timezone_set('America/Sao_Paulo');
	}

	public function index() {
		$offset = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
		$config = array(
			'base_url' 		=> base_url('estabelecimento/p'), 
			'per_page' 		=> 5, 
			'num_links' 	=> 3, 
			'uri_segment' 	=> 3, 
			'total_rows' 	=> $this->Veiculo_model->total(), 
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
		$data['total'] = $this->Veiculo_model->total();
		$data['veiculo'] = $this->Veiculo_model->listar($config['per_page'], $offset);
		$data['middle'] = 'veiculo';
		$this->load->view('pattern/layout', $data);
	}

	public function cadastrar() {
		$veiculo = new Veiculo_basic();
		$veiculo->getEmpresa()->setCodigo($this->session->userdata('empresa'));
		$veiculo->getMotorista()->setCodigo(strip_tags(trim($this->input->post('motorista'))));
		$veiculo->getTipoVeiculo()->setCodigo(strip_tags(trim($this->input->post('tipoveiculo'))));
		$veiculo->setModelo(strip_tags(trim($this->input->post('modelo'))));
		$veiculo->setPlaca(strtoupper(strip_tags(trim($this->input->post('placa')))));
		$veiculo->setChassi(strtoupper(strip_tags(trim($this->input->post('chassi')))));
		$veiculo->setProprio(strip_tags(trim($this->input->post('proprio'))));
		$veiculo->setCapacidade(strip_tags(trim($this->input->post('capacidade'))));
		$veiculo->setAntt(strtoupper(strip_tags(trim($this->input->post('antt')))));
		$veiculo->setSituacao(TRUE);

		$result = $this->Veiculo_model->cadastrar($veiculo);
		if($result) {
			$this->session->set_flashdata('success', 'Veículo, cadastrado com Sucesso.');
		} else {
			$this->session->set_flashdata('error', 'Ocorreu um erro, ao cadastrar o Veículo.');
		}

		redirect(base_url().'veiculo');
	}

	public function editar() {
		$editar = (!is_null($this->input->post('editar'))) ? true : false;
		if($editar) {
			$data = array(
				'codigo'			=> $this->input->post('codigo'),
				'cod_empresa'		=> $this->session->userdata('empresa'),
				'cod_motorista'		=> $this->input->post('motorista'),
				'cod_tipo_veiculo'	=> $this->input->post('tipo_veiculo'),
				'modelo'			=> strip_tags(trim($this->input->post('modelo'))),
				'placa'				=> strtoupper(strip_tags(trim($this->input->post('placa')))),
				'chassi'			=> strtoupper(strip_tags(trim($this->input->post('chassi')))),
				'proprio'			=> strip_tags(trim($this->input->post('proprio'))),
				'capacidade'		=> strip_tags(trim($this->input->post('capacidade'))),
				'antt'				=> strtoupper(strip_tags(trim($this->input->post('antt'))))
			);

			$result = $this->Veiculo_model->editar($data);
			if($result) {
				$this->session->set_flashdata('success', 'Veículo, Editado com Sucesso.');
			} else {
				$this->session->set_flashdata('error', 'Ocorreu um erro, ao editar o Veículo.');
			}

			redirect(base_url().'veiculo/editar/'.$data['codigo']);
		} else {
			$this->load->model('model/Motorista_model');
			$this->load->model('model/TipoVeiculo_model');

			$data['veiculo'] = $this->Veiculo_model->consultar('codigo', $this->uri->segment(3));
			$data['motorista'] = $this->Motorista_model->listar();
			$data['tipoveiculo'] = $this->TipoVeiculo_model->listar();
			$data['middle'] = 'veiculo/editar';

			$this->load->view('pattern/layout', $data);
		}
	}

	public function add() {
		$this->load->model('model/Motorista_model');
		$this->load->model('model/TipoVeiculo_model');

		$data['middle'] = 'veiculo/cadastrar';
		$data['motorista'] = $this->Motorista_model->listar();
		$data['tipoveiculo'] = $this->TipoVeiculo_model->listar();

		$this->load->view('pattern/layout', $data);
	}

	public function excluir() {
		$veiculo = new Veiculo_basic();
		$veiculo->setCodigo($this->uri->segment(3));

		$result = $this->Veiculo_model->excluir($veiculo);
		if($result) {
			$this->session->set_flashdata('success', 'Veículo, Excluído com Sucesso.');
		} else {
			$this->session->set_flashdata('error', 'Ocorreu um erro, ao excluir o Veículo.');
		}

		redirect(base_url().'veiculo');
	}

	public function s() {
		$filtro = $this->input->get('filtro');
		$procurar = strip_tags(trim($this->input->get('procurar')));

		$data['veiculo'] = $this->Veiculo_model->consultar($filtro, $procurar);
		$data['middle'] = 'veiculo';
		$this->load->view('pattern/layout', $data);
	}
}