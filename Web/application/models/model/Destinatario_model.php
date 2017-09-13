<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Destinatario_model extends CI_Model {
	public $table = "destinatario";

	function __construct() {
		parent::__construct();
		$this->load->model('basic/Destinatario_basic');
	}

	public function listar() {
		$this->db->select('*')->from($this->table);
		$query = $this->db->get();

		if($query->num_rows() > 0) {
			$result = $query->result();
			$destinatarios = array();
			foreach($result as $row) {
				$destinatario = new Destinatario_basic();

				$destinatario->setCodigo($row->codigo);
				$destinatario->getEmpresa()->setCodigo($row->cod_empresa);
				$destinatario->setRazaoSocial($row->razao_social);
				$destinatario->setNomeFantasia($row->nome_fantasia);
				$destinatario->setTipoPessoa($row->tipo_pessoa);
				$destinatario->setCnpjCpf($row->cnpj_cpf);
				$destinatario->setEmail($row->email);
				$destinatario->setTelefone($row->telefone);
				$destinatario->setLogradouro($row->logradouro);
				$destinatario->setNumero($row->numero);
				$destinatario->setComplemento($row->complemento);
				$destinatario->setBairro($row->bairro);
				$destinatario->setCidade($row->cidade);
				$destinatario->setUf($row->uf);
				$destinatario->setCep($row->cep);
				$destinatario->setLatitude($row->latitude);
				$destinatario->setLongitude($row->longitude);
				$destinatario->setSituacao($row->situacao);

				$destinatarios[] = $destinatario;
			}

			return $destinatarios;
		} else {
			return false;
		}
	}
}