<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class TipoVeiculo extends CI_Controller {
	function __construct() {
		parent::__construct();
		$this->load->model('basic/TipoVeiculo_basic');
		$this->load->model('model/TipoVeiculo_model');
		date_default_timezone_set('America/Sao_Paulo');
	}

	public function index() {
		$offset = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
		$config = array(
			'base_url' 		=> base_url('tipoveiculo/p'), 
			'per_page' 		=> 7, 
			'num_links' 	=> 3, 
			'uri_segment' 	=> 3, 
			'total_rows' 	=> $this->TipoVeiculo_model->total(), 
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
		$data['tipo_veiculo'] = $this->TipoVeiculo_model->listar($config['per_page'], $offset);
		$data['total'] = $this->TipoVeiculo_model->total();
		$data['middle'] = 'veiculo/tipoveiculo';
		$this->load->view('pattern/layout', $data);
	}

	public function cadastrar() {
		$tipoveiculo = new TipoVeiculo_basic();
		$tipoveiculo->getEmpresa()->setCodigo($this->session->userdata('empresa'));
		$tipoveiculo->setDescricao(strip_tags(trim($this->input->post('descricao'))));
		$tipoveiculo->setPeso(strip_tags(trim($this->input->post('peso'))));
		$tipoveiculo->setSituacao(TRUE);

		$result = $this->TipoVeiculo_model->cadastrar($tipoveiculo);
		if($result) {
			$this->session->set_flashdata('success', 'Tipo de Veículo, cadastrado com Sucesso.');
		} else {
			$this->session->set_flashdata('error', 'Ocorreu um erro, ao cadastrar o Tipo de Veículo.');
		}

		redirect(base_url().'tipoveiculo');
	}

	public function editar() {
		$editar = (!is_null($this->input->post('editar'))) ? true : false;
		if($editar) {
			$data = array(
				'codigo'			=> $this->input->post('codigo'),
				'cod_empresa'		=> $this->session->userdata('empresa'),
				'descricao'			=> strip_tags(trim($this->input->post('descricao'))),
				'peso'				=> strip_tags(trim($this->input->post('peso')))
			);

			$result = $this->TipoVeiculo_model->editar($data);
			if($result) {
				$this->session->set_flashdata('success', 'Tipo de Veículo, Editado com Sucesso.');
			} else {
				$this->session->set_flashdata('error', 'Ocorreu um erro, ao editar o Tipo de Veículo.');
			}

			redirect(base_url().'tipoveiculo/editar/'.$data['codigo']);
		} else {
			$offset = 0;
			$config = array(
				'base_url' 		=> base_url('tipoveiculo/p'), 
				'per_page' 		=> 7, 
				'num_links' 	=> 3, 
				'uri_segment' 	=> 3, 
				'total_rows' 	=> $this->TipoVeiculo_model->total(), 
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
			$data['tipo_veiculo'] = $this->TipoVeiculo_model->listar($config['per_page'], $offset);
			$data['total'] = $this->TipoVeiculo_model->total();
			$data['tipo_edt'] = $this->TipoVeiculo_model->consultar('codigo', $this->uri->segment(3));

			$data['middle'] = 'veiculo/tipoveiculo';
			$this->load->view('pattern/layout', $data);
		}
	}

	public function excluir() {
		$tipoveiculo = new TipoVeiculo_basic();
		$tipoveiculo->setCodigo($this->uri->segment(3));

		$result = $this->TipoVeiculo_model->excluir($tipoveiculo);
		if($result) {
			$this->session->set_flashdata('success', 'Tipo de Veículo, Excluído com Sucesso.');
		} else {
			$this->session->set_flashdata('error', 'Ocorreu um erro, ao excluir o Tipo de Veículo.');
		}

		redirect(base_url().'tipoveiculo');
	}

	public function s() {
		$filtro = $this->input->get('filtro');
		$procurar = strip_tags(trim($this->input->get('procurar')));

		$data['tipo_veiculo'] = $this->TipoVeiculo_model->consultar($filtro, $procurar);
		$data['middle'] = 'veiculo/tipoveiculo';
		$this->load->view('pattern/layout', $data);
	}
}