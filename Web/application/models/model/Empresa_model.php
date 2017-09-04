<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Empresa_model extends CI_Model {
	public $table = "empresa";

	function __construct() {
		parent::__construct();
		$this->load->model('basic/Empresa_basic');
	}

	public function listar() {
		$this->db->select('*')->from($this->table);
		$query = $this->db->get();

		if($query->num_rows() > 0) {
			$result = $query->result();
			$empresas = array();
			foreach($result as $row) {
				$empresa = new Empresa_basic();

				$empresa->setCodEmpresa($row->cod_empresa);
				$empresa->setRazaoSocial($row->razao_social);
				$empresa->setCnpj($row->cnpj);
				$empresa->setLogradouro($row->logradouro);
				$empresa->setNumero($row->numero);
				$empresa->setNomeFantasia($row->nome_fantasia);
				$empresa->setComplemento($row->complemento);
				$empresa->setBairro($row->bairro);
				$empresa->setCidade($row->cidade);
				$empresa->setUf($row->uf);
				$empresa->setCep($row->cep);
				$empresa->setLatitude($row->latitude);
				$empresa->setLongitude($row->longitude);
				$empresa->setSituacao($row->situacao);

				$empresas[] = $empresa;
			}

			return $empresas;
		} else {
			return false;
		}
	}
}