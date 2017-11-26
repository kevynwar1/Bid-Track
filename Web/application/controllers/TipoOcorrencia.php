<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class TipoOcorrencia extends CI_Controller {
	function __construct() {
		parent::__construct();
		$this->load->model('basic/TipoOcorrencia_basic');
		$this->load->model('model/TipoOcorrencia_model');
		date_default_timezone_set('America/Sao_Paulo');
	}

	public function index() {
		$offset = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
		$config = array(
			'base_url' 		=> base_url('tipoocorrencia/p'), 
			'per_page' 		=> 7, 
			'num_links' 	=> 3, 
			'uri_segment' 	=> 3, 
			'total_rows' 	=> $this->TipoOcorrencia_model->total(), 
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
		$data['ocorrencia'] = $this->TipoOcorrencia_model->listar($config['per_page'], $offset);
		$data['total'] = $this->TipoOcorrencia_model->total();
		$data['middle'] = 'tipoocorrencia';
		$this->load->view('pattern/layout', $data);
	}

	public function cadastrar() {
		$tipoocorrencia = new TipoOcorrencia_basic();
		$tipoocorrencia->getEmpresa()->setCodigo($this->session->userdata('empresa'));
		$tipoocorrencia->setDescricao(strip_tags(trim($this->input->post('descricao'))));
		$tipoocorrencia->setSituacao(TRUE);

		$result = $this->TipoOcorrencia_model->cadastrar($tipoocorrencia);
		if($result) {
			$this->session->set_flashdata('success', 'Tipo de Ocorrência, cadastrado com Sucesso.');
		} else {
			$this->session->set_flashdata('error', 'Ocorreu um erro, ao cadastrar o Tipo de Ocorrência.');
		}

		redirect(base_url().'tipoocorrencia');
	}

	public function editar() {
		$editar = (!is_null($this->input->post('editar'))) ? true : false;
		if($editar) {
			$data = array(
				'codigo'			=> $this->input->post('codigo'),
				'cod_empresa'		=> $this->session->userdata('empresa'),
				'descricao'			=> strip_tags(trim($this->input->post('descricao')))
			);

			$result = $this->TipoOcorrencia_model->editar($data);
			if($result) {
				$this->session->set_flashdata('success', 'Tipo de Ocorrência, Editado com Sucesso.');
			} else {
				$this->session->set_flashdata('error', 'Ocorreu um erro, ao editar o Tipo de Ocorrência.');
			}

			redirect(base_url().'tipoocorrencia/editar/'.$data['codigo']);
		} else {
			$offset = 0;
			$config = array(
				'base_url' 		=> base_url('tipoocorrencia/p'), 
				'per_page' 		=> 7, 
				'num_links' 	=> 3, 
				'uri_segment' 	=> 3, 
				'total_rows' 	=> $this->TipoOcorrencia_model->total(), 
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
			$data['ocorrencia'] = $this->TipoOcorrencia_model->listar($config['per_page'], $offset);
			$data['total'] = $this->TipoOcorrencia_model->total();
			$data['tipo_edt'] = $this->TipoOcorrencia_model->consultar('codigo', $this->uri->segment(3));

			$data['middle'] = 'tipoocorrencia';
			$this->load->view('pattern/layout', $data);
		}
	}

	public function excluir() {
		$tipoocorrencia = new TipoOcorrencia_basic();
		$tipoocorrencia->setCodigo($this->uri->segment(3));

		$result = $this->TipoOcorrencia_model->excluir($tipoocorrencia);
		if($result) {
			$this->session->set_flashdata('success', 'Tipo de Ocorrência, Excluído com Sucesso.');
		} else {
			$this->session->set_flashdata('error', 'Ocorreu um erro, ao excluir o Tipo de Ocorrência.');
		}

		redirect(base_url().'tipoocorrencia');
	}

	public function s() {
		$filtro = $this->input->get('filtro');
		$procurar = strip_tags(trim($this->input->get('procurar')));

		$data['tipoocorrencia'] = $this->TipoOcorrencia_model->consultar($filtro, $procurar);
		$data['middle'] = 'tipoocorrencia';
		$this->load->view('pattern/layout', $data);
	}
}