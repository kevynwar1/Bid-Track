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
			'seq_entrega' 		 => $entrega->getSeqEntrega(),
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

	public function excluir($romaneio) { // Excluir todas entrega(s) do Romaneio
		$this->db->where($this->table.'.cod_romaneio', $romaneio->codigo);
		$this->db->delete($this->table);

		return $this->db->affected_rows(); 
	}

	public function excluir_entrega($entrega, $romaneio) { // Excluir entrega específica
		$this->db->where($this->table.'.seq_entrega', $entrega);
		$this->db->where($this->table.'.cod_romaneio', $romaneio);
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

	public function verificar_notafiscal($nota_fiscal) {
		$this->db->select($this->table.'.nota_fiscal')->from($this->table);
		$this->db->where($this->table.'.nota_fiscal', $nota_fiscal);
		$query = $this->db->get();

		if($query->num_rows() >= 1) {
			return false;
		} else {
			return true;
		}
	}

	public function listar($romaneio) {
		$this->db->select('*, 
			entrega.seq_entrega AS seq_entrega, 
			lpad(entrega.cod_romaneio, 4, 0) AS cod_romaneio, 
			entrega.cod_destinatario AS cod_destinatario
		')->from($this->table);
		$this->db->join('status_entrega', 'status_entrega.codigo = '.$this->table.'.cod_status_entrega');
		$this->db->join('destinatario', 'destinatario.codigo = '.$this->table.'.cod_destinatario');
		$this->db->where($this->table.'.cod_romaneio', $romaneio);
		$this->db->order_by($this->table.'.seq_entrega', 'ASC');
		$query = $this->db->get();

		if($query->num_rows() > 0) {
			$result = $query->result();
			$entregas = array();
			foreach($result as $row) {
				$entrega = new Entrega_basic();

				$entrega->setSeqEntrega($row->seq_entrega);
				$entrega->getRomaneio()->setCodigo($row->cod_romaneio);
				$entrega->getDestinatario()->setCodigo($row->cod_destinatario);
				$entrega->getDestinatario()->setCnpjCpf($row->cnpj_cpf);
				$entrega->getDestinatario()->setEmail($row->email);
				$entrega->getDestinatario()->setTelefone($row->telefone);
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
			lpad(entrega.cod_romaneio, 4, 0) AS cod_romaneio,
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

				$entrega->setSeqEntrega($row->seq_entrega);
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

	public function entrega_romaneio($motorista) {
		$this->db->select('
			lpad(entrega.cod_romaneio, 4, 0) AS cod_romaneio, 
			romaneio.cod_status_romaneio AS cod_status_romaneio, 
			romaneio.cod_motorista AS cod_motorista, 
			romaneio.cod_estabelecimento AS cod_estabelecimento, 
			romaneio.data_criacao AS data_criacao, 
			romaneio.data_finalizacao AS data_finalizacao, 
			entrega.seq_entrega AS seq_entrega, 
			entrega.nota_fiscal AS nota_fiscal, 
			entrega.peso_carga AS peso_carga, 
			destinatario.razao_social AS razao_social, 
			destinatario.nome_fantasia AS nome_fantasia, 
			destinatario.telefone AS telefone, 
			destinatario.logradouro AS logradouro, 
			destinatario.numero AS numero, 
			destinatario.bairro AS bairro, 
			destinatario.cidade AS cidade,
			destinatario.cep AS cep, 
			destinatario.uf AS uf, 
			destinatario.latitude AS latitude, 
			destinatario.longitude AS longitude, 
			estabelecimento.latitude AS estab_latitude, 
			estabelecimento.longitude AS estab_longitude, 
			status_romaneio.descricao AS descricao_romaneio, 
			status_entrega.codigo AS cod_status_entrega, 
			status_entrega.descricao AS descricao_entrega
			')->from($this->table);
		$this->db->join('romaneio', 'romaneio.codigo = '.$this->table.'.cod_romaneio');
		$this->db->join('estabelecimento', 'estabelecimento.codigo = romaneio.cod_estabelecimento', 'left');
		$this->db->join('status_romaneio', 'status_romaneio.codigo = romaneio.cod_status_romaneio', 'left');
		$this->db->join('destinatario', 'destinatario.codigo = '.$this->table.'.cod_destinatario');
		$this->db->join('motorista', 'motorista.codigo = romaneio.cod_motorista', 'left');
		$this->db->join('status_entrega', 'status_entrega.codigo = '.$this->table.'.cod_status_entrega');
		$this->db->where('romaneio.cod_motorista', $motorista);
		$this->db->where('romaneio.cod_status_romaneio', '1');
		$this->db->order_by($this->table.'.seq_entrega', 'ASC');
		$query = $this->db->get();

		if($query->num_rows() > 0) {
			$result = $query->result();
			$entregas = array();
			foreach($result as $row) {
				$entrega = new Entrega_basic();

				$entrega->setSeqEntrega($row->seq_entrega);
				$entrega->setNotaFiscal($row->nota_fiscal);
				$entrega->setPesoCarga($row->peso_carga);
				$entrega->getDestinatario()->setRazaoSocial($row->razao_social);
				$entrega->getDestinatario()->setNomeFantasia($row->nome_fantasia);
				$entrega->getDestinatario()->setTelefone($row->telefone);
				$entrega->getDestinatario()->setLogradouro($row->logradouro);
				$entrega->getDestinatario()->setNumero($row->numero);
				$entrega->getDestinatario()->setBairro($row->bairro);
				$entrega->getDestinatario()->setCidade($row->cidade);
				$entrega->getDestinatario()->setCep($row->cep);
				$entrega->getDestinatario()->setUf($row->uf);
				$entrega->getDestinatario()->setLatitude($row->latitude);
				$entrega->getDestinatario()->setLongitude($row->longitude);
				$entrega->getRomaneio()->setCodigo($row->cod_romaneio);
				$entrega->getRomaneio()->setDataCriacao($row->data_criacao);
				$entrega->getRomaneio()->getStatusRomaneio()->setCodigo($row->cod_status_romaneio);
				$entrega->getRomaneio()->setDataFinalizacao($row->data_finalizacao);
				$entrega->getRomaneio()->getEstabelecimento()->setCodigo($row->cod_estabelecimento);
				$entrega->getRomaneio()->getEstabelecimento()->setLatitude($row->estab_latitude);
				$entrega->getRomaneio()->getEstabelecimento()->setLongitude($row->estab_longitude);
				$entrega->getRomaneio()->getMotorista()->setCodigo($row->cod_motorista);
				$entrega->getRomaneio()->getStatusRomaneio()->setDescricao($row->descricao_romaneio);
				$entrega->getStatusEntrega()->setCodigo($row->cod_status_entrega);
				$entrega->getStatusEntrega()->setDescricao($row->descricao_entrega);

				$entregas[] = $entrega;
			}

			return $entregas;
		} else {
			return false;
		}
	}

	public function entrega_by_romaneio($romaneio) {
		$this->db->select('
			lpad(entrega.cod_romaneio, 4, 0) AS cod_romaneio, 
			romaneio.cod_status_romaneio AS cod_status_romaneio, 
			romaneio.cod_motorista AS cod_motorista, 
			romaneio.cod_estabelecimento AS cod_estabelecimento, 
			romaneio.data_criacao AS data_criacao, 
			romaneio.data_finalizacao AS data_finalizacao, 
			entrega.seq_entrega AS seq_entrega, 
			entrega.nota_fiscal AS nota_fiscal, 
			entrega.peso_carga AS peso_carga, 
			destinatario.razao_social AS razao_social, 
			destinatario.nome_fantasia AS nome_fantasia, 
			destinatario.telefone AS telefone, 
			destinatario.logradouro AS logradouro, 
			destinatario.numero AS numero, 
			destinatario.bairro AS bairro, 
			destinatario.cidade AS cidade,
			destinatario.cep AS cep, 
			destinatario.uf AS uf, 
			destinatario.latitude AS latitude, 
			destinatario.longitude AS longitude, 
			estabelecimento.latitude AS estab_latitude, 
			estabelecimento.longitude AS estab_longitude, 
			status_romaneio.descricao AS descricao_romaneio, 
			status_entrega.codigo AS cod_status_entrega, 
			status_entrega.descricao AS descricao_entrega
			')->from($this->table);
		$this->db->join('romaneio', 'romaneio.codigo = '.$this->table.'.cod_romaneio');
		$this->db->join('estabelecimento', 'estabelecimento.codigo = romaneio.cod_estabelecimento', 'left');
		$this->db->join('status_romaneio', 'status_romaneio.codigo = romaneio.cod_status_romaneio', 'left');
		$this->db->join('destinatario', 'destinatario.codigo = '.$this->table.'.cod_destinatario');
		$this->db->join('motorista', 'motorista.codigo = romaneio.cod_motorista', 'left');
		$this->db->join('status_entrega', 'status_entrega.codigo = '.$this->table.'.cod_status_entrega');
		$this->db->where('romaneio.codigo', $romaneio);
		$this->db->order_by($this->table.'.seq_entrega', 'ASC');
		$query = $this->db->get();

		if($query->num_rows() > 0) {
			$result = $query->result();
			$entregas = array();
			foreach($result as $row) {
				$entrega = new Entrega_basic();

				$entrega->setSeqEntrega($row->seq_entrega);
				$entrega->setNotaFiscal($row->nota_fiscal);
				$entrega->setPesoCarga($row->peso_carga);
				$entrega->getDestinatario()->setRazaoSocial($row->razao_social);
				$entrega->getDestinatario()->setNomeFantasia($row->nome_fantasia);
				$entrega->getDestinatario()->setTelefone($row->telefone);
				$entrega->getDestinatario()->setLogradouro($row->logradouro);
				$entrega->getDestinatario()->setNumero($row->numero);
				$entrega->getDestinatario()->setBairro($row->bairro);
				$entrega->getDestinatario()->setCidade($row->cidade);
				$entrega->getDestinatario()->setCep($row->cep);
				$entrega->getDestinatario()->setUf($row->uf);
				$entrega->getDestinatario()->setLatitude($row->latitude);
				$entrega->getDestinatario()->setLongitude($row->longitude);
				$entrega->getRomaneio()->setCodigo($row->cod_romaneio);
				$entrega->getRomaneio()->setDataCriacao($row->data_criacao);
				$entrega->getRomaneio()->getStatusRomaneio()->setCodigo($row->cod_status_romaneio);
				$entrega->getRomaneio()->setDataFinalizacao($row->data_finalizacao);
				$entrega->getRomaneio()->getEstabelecimento()->setCodigo($row->cod_estabelecimento);
				$entrega->getRomaneio()->getEstabelecimento()->setLatitude($row->estab_latitude);
				$entrega->getRomaneio()->getEstabelecimento()->setLongitude($row->estab_longitude);
				$entrega->getRomaneio()->getMotorista()->setCodigo($row->cod_motorista);
				$entrega->getRomaneio()->getStatusRomaneio()->setDescricao($row->descricao_romaneio);
				$entrega->getStatusEntrega()->setCodigo($row->cod_status_entrega);
				$entrega->getStatusEntrega()->setDescricao($row->descricao_entrega);

				$entregas[] = $entrega;
			}

			return $entregas;
		} else {
			return false;
		}
	}

	public function entrega_count_romaneio($romaneio) {
		$this->db->select('COUNT(*) as entregas')->from($this->table);
		$this->db->where($this->table.'.cod_romaneio', $romaneio);
		$query = $this->db->get();

		if($query->num_rows() >= 1) {
			$result = $query->result();
			return $result;
		} else {
			return false;
		}
	}

	public function entrega_status($status_entrega, $seq_entrega, $romaneio) {
		$this->db->set($this->table.'.cod_status_entrega', $status_entrega);
		$this->db->where($this->table.'.seq_entrega', $seq_entrega);
		$this->db->where($this->table.'.cod_romaneio', $romaneio);
		$this->db->update($this->table);

		return $this->db->affected_rows();
	}
}
?>