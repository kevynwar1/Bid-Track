<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Estabelecimento_model extends CI_Model {
	public $table = "estabelecimento";

	function __construct() {
		parent::__construct();
		$this->load->model('basic/Estabelecimento_basic');
	}

	public function listar() {
		$this->db->select('*')->from($this->table);
		$query = $this->db->get();

		if($query->num_rows() > 0) {
			$result = $query->result();
			$estabelecimetos = array();
			foreach($result as $row) {
				$estabelecimento = new Estabelecimento_basic();

				$estabelecimento->setCodigo($row->codigo);
				$estabelecimento->getEmpresa()->setCodigo($row->cod_empresa);
				$estabelecimento->setRazaoSocial($row->razao_social);
				$estabelecimento->setCnpj($row->cnpj);
				$estabelecimento->setLogradouro($row->logradouro);
				$estabelecimento->setNumero($row->numero);
				$estabelecimento->setComplemento($row->complemento);
				$estabelecimento->setBairro($row->bairro);
				$estabelecimento->setCidade($row->cidade);
				$estabelecimento->setUf($row->uf);
				$estabelecimento->setCep($row->cep);
				$estabelecimento->setLatitude($row->latitude);
				$estabelecimento->setLongitude($row->longitude);
				$estabelecimento->setSituacao($row->situacao);

				$estabelecimetos[] = $estabelecimento;
			}

			return $estabelecimetos;
		} else {
			return false;
		}
	}
}