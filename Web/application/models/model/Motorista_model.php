<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Motorista_model extends CI_Model {
	public $table = "motorista";

	function __construct() {
		parent::__construct();
		$this->load->model('basic/Motorista_basic');
	}

	public function listar() {
		$this->db->select('*')->from($this->table);
		$this->db->join('empresa', 'empresa.codigo = '.$this->table.'.cod_empresa');
		$query = $this->db->get();

		if($query->num_rows() > 0) {
			$result = $query->result();
			$motoristas = array();
			foreach($result as $row) {
				$motorista = new Motorista_basic();

				$motorista->setCodigo($row->codigo);
				$motorista->getEmpresa()->setCodigo($row->cod_empresa);
				$motorista->getEmpresa()->setCnpj($row->cnpj);
				$motorista->getEmpresa()->setNomeFantasia($row->nome_fantasia);
				$motorista->setNome($row->nome);
				$motorista->setCpf($row->cpf);
				$motorista->setPontuacao($row->pontuacao);
				$motorista->setLogradouro($row->logradouro);
				$motorista->setNumero($row->numero);
				$motorista->setComplemento($row->complemento);
				$motorista->setBairro($row->bairro);
				$motorista->setCidade($row->cidade);
				$motorista->setUf($row->uf);
				$motorista->setCep($row->cep);
				$motorista->setLatitude($row->latitude);
				$motorista->setLongitude($row->longitude);
				$motorista->setTipoCarteira($row->tipo_carteira);
				$motorista->setValidadeCarteira($row->validade_carteira);
				$motorista->setSituacao($row->situacao);

				$motoristas[] = $motorista;
			}

			return $motoristas;
		} else {
			return false;
		}
	}
}