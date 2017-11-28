<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Entrega extends CI_Controller {
	function __construct() {
		parent::__construct();
		$this->load->model('basic/Entrega_basic');
		$this->load->model('model/Entrega_model');
		date_default_timezone_set('America/Sao_Paulo');
	}

	public function cadastrar() {
		$entrega = new Entrega_basic();
		$entrega->setSeqEntrega($this->input->post('entrega'));
		$entrega->getEmpresa()->setCodigo($this->session->userdata('empresa'));
		$entrega->getRomaneio()->setCodigo($this->input->post('romaneio'));
		$entrega->getDestinatario()->setCodigo(strip_tags(trim($this->input->post('destinatario'))));
		$entrega->setPesoCarga($this->input->post('peso_carga').' '.trim($this->input->post('medida')));
		if(empty($this->input->post('nota_fiscal'))) {
			$entrega->setNotaFiscal("0");
			$entrega->getStatusEntrega()->setCodigo("2"); // Pendente
		} else {
			$entrega->setNotaFiscal(trim(strip_tags($this->input->post('nota_fiscal'))));
			$entrega->getStatusEntrega()->setCodigo("1"); // Liberado
		}

		$result = $this->Entrega_model->cadastrar($entrega);
		if($result) {
			$this->session->set_flashdata('success', 'Entrega, cadastrado com Sucesso.');
			$this->session->set_flashdata('entrega', 'Tab Entrega ativa.');
			redirect(base_url().'romaneio/editar/'.strip_tags(trim($this->input->post('romaneio'))));
		} else {
			$this->session->set_flashdata('error', 'Ocorreu um erro, ao cadastrar a Entrega.');
			redirect(base_url().'romaneio');
		}
	}

	public function editar() {
		$this->load->model('basic/Romaneio_basic');
		$romaneio = new Romaneio_basic();
		$romaneio->setCodigo($this->input->post("romaneio"));
		$i = 1;

		$result = $this->Entrega_model->excluir($romaneio);
		if($result) {
			$ordem = explode("&", $this->input->post("order"));
			for($a = 0; $a < count($ordem); $a++) {
				$seq = substr($ordem[$a], -1);

				$entrega = new Entrega_basic();
				$entrega->setSeqEntrega($i);
				$entrega->getEmpresa()->setCodigo($this->session->userdata('empresa'));
				$entrega->getRomaneio()->setCodigo(strip_tags(trim($this->input->post("romaneio"))));
				$entrega->getDestinatario()->setCodigo(strip_tags(trim($this->input->post("destinatario-".$seq))));
				$entrega->setPesoCarga($this->input->post("peso_carga-".$seq)." ".$this->input->post("medida-".$seq));
				if(empty($this->input->post('nota_fiscal-'.$seq))) {
					$entrega->setNotaFiscal("0");
					$entrega->getStatusEntrega()->setCodigo("2"); // Pendente
				} else {
					$entrega->setNotaFiscal(trim(strip_tags($this->input->post('nota_fiscal-'.$seq))));
					$entrega->getStatusEntrega()->setCodigo("1"); // Liberado
				}

				$result = $this->Entrega_model->cadastrar($entrega);
				$i++;
			}

			if($result) {
				$this->session->set_flashdata('success', 'Entrega(s), editada com Sucesso.');
				$this->session->set_flashdata('entrega', 'Tab Entrega ativa.');
				redirect(base_url().'romaneio/editar/'.$this->input->post('romaneio'));
			} else {
				$this->session->set_flashdata('error', 'Ocorreu um erro, ao editar a(s) Entrega(s).');
				redirect(base_url().'romaneio');
			}
		}
	}

	public function excluir() {
		$entrega = $this->uri->segment(3);
		$romaneio = $this->uri->segment(4);

		$result = $this->Entrega_model->excluir_entrega($entrega, $romaneio);
		if($result) {
			$this->load->model('model/Ocorrencia_model');
			$this->Ocorrencia_model->excluir_ocorrencia($entrega, $romaneio);
			
			$this->session->set_flashdata('entrega', 'Tab Entrega ativa.');
			$this->session->set_flashdata('success', 'Entrega, excluída com Sucesso.');
		} else {
			$this->session->set_flashdata('error', 'Ocorreu um erro, ao excluir a Entrega.');
		}

		redirect(base_url().'romaneio/editar/'.$romaneio);
	}

	public function verificar() {
		$nota_fiscal = $this->input->post('nota_fiscal');

		echo json_encode($this->Entrega_model->verificar_notafiscal($nota_fiscal));
	}
}
?>