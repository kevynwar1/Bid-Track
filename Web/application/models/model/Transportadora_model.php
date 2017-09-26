<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Transportadora_model extends CI_Model {
	public $table = "transportadora";

	function __construct() {
		parent::__construct();
		$this->load->model('basic/Transportadora_basic');
	}

	public function listar() {
		$this->db->select('*')->from($this->table);
		$this->db->order_by($this->table.".nome_fantasia", "ASC");
		$query = $this->db->get();

		if($query->num_rows() > 0) {
			$result = $query->result();
			$transportadoras = array();
			foreach($result as $row) {
				$transportadora = new Transportadora_basic();

				$transportadora->setCodigo($row->codigo);
				$transportadora->getEmpresa()->setCodigo($row->cod_empresa);
				$transportadora->setRazaoSocial($row->razao_social);
				$transportadora->setNomeFantasia($row->nome_fantasia);
				$transportadora->setCnpj($row->cnpj);
				$transportadora->setLogradouro($row->logradouro);
				$transportadora->setNumero($row->numero);
				$transportadora->setComplemento($row->complemento);
				$transportadora->setBairro($row->bairro);
				$transportadora->setCidade($row->cidade);
				$transportadora->setUf($row->uf);
				$transportadora->setCep($row->cep);
				$transportadora->setLatitude($row->latitude);
				$transportadora->setLongitude($row->longitude);
				$transportadora->setSituacao($row->situacao);

				$transportadoras[] = $transportadora;
			}

			return $transportadoras;
		} else {
			return false;
		}
	}
}