<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Romaneio_model extends CI_Model {
	public $table = "romaneio";

	function __construct() {
		parent::__construct();
		$this->load->model('basic/Romaneio_basic');
	}

	public function cadastrar($romaneio) {
		$data = array(
			'codigo' => $romaneio->getCodigo(),
			'cod_status_romaneio' 	=> $romaneio->getStatusRomaneio()->getCodigo(),
			'cod_estabelecimento' 	=> $romaneio->getEstabelecimento()->getCodigo(),
			'cod_veiculo' 	 		=> $romaneio->getVeiculo()->getCodigo(),
			'cod_transportadora'	=> $romaneio->getTransportadora()->getCodigo(),
			'cod_motorista' 		=> $romaneio->getMotorista()->getCodigo(),
			'data_criacao' 			=> $romaneio->getDataCriacao(),
			'data_finalizacao' 		=> $romaneio->getDataFinalizacao(),
			'ofertar_viagem' 		=> $romaneio->getOfertarViagem()
		);

		$this->db->insert($this->table, $data);
		if(!$this->db->affected_rows()) {
			return false;
		}
		return true;
	}

	public function listar() {
		$this->db->select('*')->from($this->table);
		$this->db->join('motorista', 'motorista.codigo = '.$this->table.'.cod_motorista');
		$this->db->join('transportadora', 'transportadora.codigo = '.$this->table.'.cod_transportadora');
		$this->db->join('veiculo', 'veiculo.codigo = '.$this->table.'.cod_veiculo');
		$query = $this->db->get();

		if($query->num_rows() > 0) {
			$result = $query->result();
			$romaneios = array();
			foreach($result as $row) {
				$romaneio = new Romaneio_basic();

				$romaneio->setCodigo($row->cod_romaneio);
				$romaneio->getVeiculo()->setCodigo($row->cod_veiculo);
				$romaneio->getVeiculo()->setPlaca($row->placa);
				$romaneio->getTransportadora()->setCodigo($row->cod_transportadora);
				$romaneio->getTransportadora()->setNomeFantasia($row->nome_fantasia);
				$romaneio->getTransportadora()->setCnpj($row->cnpj);
				$romaneio->getMotorista()->setCodigo($row->cod_motorista);
				$romaneio->getMotorista()->setNome($row->nome);
				$romaneio->getMotorista()->setCpf($row->cpf);
				$romaneio->setDataCriacao($row->data_criacao);
				$romaneio->setDataFinalizacao($row->data_finalizacao);
				$romaneio->setOfertarViagem($row->ofertar_viagem);

				$romaneios[] = $romaneio;
			}

			return $romaneios;
		} else {
			return false;
		}
	}

	public function consultar_romaneio($romaneio) {
		$this->db->select('*')->from($this->table);
		$this->db->join('motorista', 'motorista.cod_motorista = '.$this->table.'.cod_motorista');
		$this->db->join('transportadora', 'transportadora.cod_transportadora = '.$this->table.'.cod_transportadora');
		$this->db->join('veiculo', 'veiculo.cod_veiculo = '.$this->table.'.cod_veiculo');
		$this->db->where($this->table.'.cod_romaneio', $romaneio);
		$query = $this->db->get();

		if($query->num_rows() > 0) {
			$result = $query->result();
			$romaneios = array();
			foreach($result as $row) {
				$romaneio = new Romaneio_basic();

				$romaneio->setCodRomaneio($row->cod_romaneio);
				$romaneio->getVeiculo()->setCodVeiculo($row->cod_veiculo);
				$romaneio->getVeiculo()->setPlaca($row->placa);
				$romaneio->getTransportadora()->setCodTransportadora($row->cod_transportadora);
				$romaneio->getTransportadora()->setNomeFantasia($row->nome_fantasia);
				$romaneio->getTransportadora()->setCnpj($row->cnpj);
				$romaneio->getMotorista()->setCodMotorista($row->cod_motorista);
				$romaneio->getMotorista()->setNome($row->nome);
				$romaneio->getMotorista()->setCpf($row->cpf);
				$romaneio->setFinalizado($row->finalizado);
				$romaneio->setOfertarViagem($row->ofertar_viagem);
				$romaneio->setIntegrado($row->integrado);
				$romaneio->setSituacao($row->situacao);

				$romaneios[] = $romaneio;
			}

			return $romaneios;
		} else {
			return false;
		}
	}

	public function consultar_motorista($motorista) {
		$this->db->select('*')->from($this->table);
		$this->db->join('motorista', 'motorista.cod_motorista = '.$this->table.'.cod_motorista');
		$this->db->join('transportadora', 'transportadora.cod_transportadora = '.$this->table.'.cod_transportadora');
		$this->db->join('veiculo', 'veiculo.cod_veiculo = '.$this->table.'.cod_veiculo');
		$this->db->like('motorista.nome', $motorista);
		$query = $this->db->get();

		if($query->num_rows() > 0) {
			$result = $query->result();
			$romaneios = array();
			foreach($result as $row) {
				$romaneio = new Romaneio_basic();

				$romaneio->setCodRomaneio($row->cod_romaneio);
				$romaneio->getVeiculo()->setCodVeiculo($row->cod_veiculo);
				$romaneio->getVeiculo()->setPlaca($row->placa);
				$romaneio->getTransportadora()->setCodTransportadora($row->cod_transportadora);
				$romaneio->getTransportadora()->setNomeFantasia($row->nome_fantasia);
				$romaneio->getTransportadora()->setCnpj($row->cnpj);
				$romaneio->getMotorista()->setCodMotorista($row->cod_motorista);
				$romaneio->getMotorista()->setNome($row->nome);
				$romaneio->getMotorista()->setCpf($row->cpf);
				$romaneio->setFinalizado($row->finalizado);
				$romaneio->setOfertarViagem($row->ofertar_viagem);
				$romaneio->setIntegrado($row->integrado);
				$romaneio->setSituacao($row->situacao);

				$romaneios[] = $romaneio;
			}

			return $romaneios;
		} else {
			return false;
		}
	}

	public function consultar_transportadora($transportadora) {
		$this->db->select('*')->from($this->table);
		$this->db->join('motorista', 'motorista.cod_motorista = '.$this->table.'.cod_motorista');
		$this->db->join('transportadora', 'transportadora.cod_transportadora = '.$this->table.'.cod_transportadora');
		$this->db->join('veiculo', 'veiculo.cod_veiculo = '.$this->table.'.cod_veiculo');
		$this->db->like('transportadora.nome_fantasia', $transportadora);
		$query = $this->db->get();

		if($query->num_rows() > 0) {
			$result = $query->result();
			$romaneios = array();
			foreach($result as $row) {
				$romaneio = new Romaneio_basic();

				$romaneio->setCodRomaneio($row->cod_romaneio);
				$romaneio->getVeiculo()->setCodVeiculo($row->cod_veiculo);
				$romaneio->getVeiculo()->setPlaca($row->placa);
				$romaneio->getTransportadora()->setCodTransportadora($row->cod_transportadora);
				$romaneio->getTransportadora()->setNomeFantasia($row->nome_fantasia);
				$romaneio->getTransportadora()->setCnpj($row->cnpj);
				$romaneio->getMotorista()->setCodMotorista($row->cod_motorista);
				$romaneio->getMotorista()->setNome($row->nome);
				$romaneio->getMotorista()->setCpf($row->cpf);
				$romaneio->setFinalizado($row->finalizado);
				$romaneio->setOfertarViagem($row->ofertar_viagem);
				$romaneio->setIntegrado($row->integrado);
				$romaneio->setSituacao($row->situacao);

				$romaneios[] = $romaneio;
			}

			return $romaneios;
		} else {
			return false;
		}
	}
}