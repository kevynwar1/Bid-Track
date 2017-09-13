<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Entrega_model extends CI_Model {
	public $table = "entrega";

	function __construct() {
		parent::__construct();
		$this->load->model('basic/Entrega_basic');
	}

	public function cadastrar($entrega) {
		$data = array(
			'cod_romaneio' 		 => $entrega->getRomaneio()->getCodigo(),
			'cod_destinatario' 	 => $entrega->getDestinatario()->getCodigo(),
			'cod_status_entrega' => $entrega->getStatusEntrega()->getCodigo(),
			'peso_carga' 		 => $entrega->getPesoCarga(),
			'nota_fiscal' 		 => $entrega->getNotaFiscal()
		);

		$this->db->insert($this->table, $data);
		if(!$this->db->affected_rows()) {
			return false;
		}
		return true;
	}

	public function excluir_romaneio($romaneio) {
		$this->db->where($this->table.'.cod_romaneio', $romaneio->getCodigo());
		$this->db->delete($this->table);

		return $this->db->affected_rows(); 
	}

	public function verificar($romaneio) {
		$this->db->select($this->table.'.cod_romaneio')->from($this->table);
		$this->db->where($this->table.'.cod_romaneio', $romaneio);
		$query = $this->db->get();

		if($query->num_rows() > 0) {
			return true;
		} else {
			return false;
		}
	}

	public function listar($romaneio) {
		$this->db->select('*')->from($this->table);
		$this->db->join('status_entrega', 'status_entrega.codigo = '.$this->table.'.cod_status_entrega');
		$this->db->join('destinatario', 'destinatario.codigo = '.$this->table.'.cod_destinatario');
		$this->db->where($this->table.'.cod_romaneio', $romaneio);
		$query = $this->db->get();

		if($query->num_rows() > 0) {
			$result = $query->result();
			$entregas = array();
			foreach($result as $row) {
				$entrega = new Entrega_basic();

				$entrega->setCodigo($row->seq_entrega);
				$entrega->getRomaneio()->setCodigo($row->cod_romaneio);
				$entrega->getDestinatario()->setCodigo($row->cod_destinatario);
				$entrega->getDestinatario()->setRazaoSocial($row->razao_social);
				$entrega->getDestinatario()->setLogradouro($row->logradouro);
				$entrega->getDestinatario()->setNumero($row->numero);
				$entrega->getDestinatario()->setComplemento($row->complemento);
				$entrega->getDestinatario()->setBairro($row->bairro);
				$entrega->getDestinatario()->setCidade($row->cidade);
				$entrega->getDestinatario()->setUf($row->uf);
				$entrega->getDestinatario()->setCep($row->cep);
				$entrega->getStatusEntrega()->setCodigo($row->cod_status_entrega);
				$entrega->getStatusEntrega()->setDescricao($row->descricao);
				$entrega->setPesoCarga($row->peso_carga);
				$entrega->setNotaFiscal($row->nota_fiscal);

				$entregas[] = $entrega;
			}

			return $entregas;
		} else {
			return false;
		}
	}

	public function entrega_motorista($motorista) {
		$this->db->select('
			romaneio.cod_motorista, 
			entrega.seq_entrega, 
			entrega.cod_romaneio,
			entrega.cod_status_entrega,
			entrega.peso_carga,
			entrega.nota_fiscal,
			destinatario.codigo as cod_destinatario, 
			destinatario.razao_social, 
			destinatario.nome_fantasia, 
			destinatario.logradouro, 
			destinatario.numero, 
			destinatario.complemento, 
			destinatario.bairro, 
			destinatario.cidade, 
			destinatario.cep, 
			destinatario.latitude, 
			destinatario.longitude, 
			destinatario.uf, 
			status_entrega.descricao')->from($this->table);
		$this->db->join('romaneio', 'romaneio.codigo = '.$this->table.'.cod_romaneio');
		$this->db->join('destinatario', 'destinatario.codigo = '.$this->table.'.cod_destinatario');
		$this->db->join('status_entrega', 'status_entrega.codigo = '.$this->table.'.cod_status_entrega');
		$this->db->join('motorista', 'motorista.codigo = romaneio.cod_motorista');
		$this->db->where('motorista.codigo', $motorista);
		$query = $this->db->get();

		if($query->num_rows() > 0) {
			$result = $query->result();
			$entregas = array();
			foreach($result as $row) {
				$entrega = new Entrega_basic();

				$entrega->setCodigo($row->seq_entrega);
				$entrega->getRomaneio()->setCodigo($row->cod_romaneio);
				$entrega->getRomaneio()->getMotorista()->setCodigo($row->cod_motorista);
				$entrega->getDestinatario()->setCodigo($row->cod_destinatario);
				$entrega->getDestinatario()->setRazaoSocial($row->razao_social);
				$entrega->getDestinatario()->setNomeFantasia($row->nome_fantasia);
				$entrega->getDestinatario()->setLogradouro($row->logradouro);
				$entrega->getDestinatario()->setNumero($row->numero);
				$entrega->getDestinatario()->setComplemento($row->complemento);
				$entrega->getDestinatario()->setBairro($row->bairro);
				$entrega->getDestinatario()->setCidade($row->cidade);
				$entrega->getDestinatario()->setUf($row->uf);
				$entrega->getDestinatario()->setCep($row->cep);
				$entrega->getDestinatario()->setLatitude($row->latitude);
				$entrega->getDestinatario()->setLongitude($row->longitude);
				$entrega->getStatusEntrega()->setCodigo($row->cod_status_entrega);
				$entrega->getStatusEntrega()->setDescricao($row->descricao);
				$entrega->setPesoCarga($row->peso_carga);
				$entrega->setNotaFiscal($row->nota_fiscal);

				$entregas[] = $entrega;
			}

			return $entregas;
		} else {
			return false;
		}
	}
}
?>