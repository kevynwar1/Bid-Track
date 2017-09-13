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
			'codigo' 				=> $romaneio->getCodigo(),
			'cod_status_romaneio' 	=> $romaneio->getStatusRomaneio()->getCodigo(),
			'cod_estabelecimento' 	=> $romaneio->getEstabelecimento()->getCodigo(),
			'cod_tipo_veiculo' 	 	=> $romaneio->getTipoVeiculo()->getCodigo(),
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

	public function editar($romaneio) {
		$this->db->where($this->table.'.codigo', $romaneio['codigo']);
		$this->db->update($this->table, $romaneio);

		return $this->db->affected_rows(); 
	}

	public function excluir($romaneio) {
		$this->db->where($this->table.'.codigo', $romaneio->getCodigo());
		$this->db->delete($this->table);

		return $this->db->affected_rows(); 
	}

	public function verificar($romaneio) {
		$this->db->select($this->table.'.codigo')->from($this->table);
		$this->db->where($this->table.'.codigo', $romaneio);
		$query = $this->db->get();

		if($query->num_rows() > 0) {
			return false;
		} else {
			return true;
		}
	}

	public function listar() {
		$this->db->select('*, 
			lpad(romaneio.codigo, 4, 0) AS cod_romaneio,
			estabelecimento.razao_social AS est_razao, 
			estabelecimento.logradouro AS est_logradouro, 
			estabelecimento.numero AS est_numero, 
			estabelecimento.bairro AS est_bairro, 
			estabelecimento.cidade AS est_cidade, 
			estabelecimento.uf AS est_uf, 
			tipo_veiculo.codigo AS tip_codigo, 
			tipo_veiculo.descricao AS tip_descricao, 
			motorista.nome AS mot_nome, 
			motorista.cpf AS mot_cpf')->from($this->table);
		$this->db->join('estabelecimento', 'estabelecimento.codigo = '.$this->table.'.cod_estabelecimento');
		$this->db->join('empresa', 'empresa.codigo = estabelecimento.cod_empresa', 'left');
		$this->db->join('motorista', 'motorista.codigo = '.$this->table.'.cod_motorista', 'left');
		$this->db->join('transportadora', 'transportadora.codigo = '.$this->table.'.cod_transportadora', 'left');
		$this->db->join('tipo_veiculo', 'tipo_veiculo.codigo = '.$this->table.'.cod_tipo_veiculo');
		$this->db->join('status_romaneio', 'status_romaneio.codigo = '.$this->table.'.cod_status_romaneio');
		$this->db->where('empresa.codigo', 1); // SESSION - Cód. Empresa
		$this->db->order_by("DATE(data_criacao)", "DESC");
		$query = $this->db->get();

		if($query->num_rows() > 0) {
			$result = $query->result();
			$romaneios = array();
			foreach($result as $row) {
				$romaneio = new Romaneio_basic();

				$romaneio->setCodigo($row->cod_romaneio);
				$romaneio->getStatusRomaneio()->setCodigo($row->cod_status_romaneio);
				$romaneio->getStatusRomaneio()->setDescricao($row->descricao);
				$romaneio->getEstabelecimento()->setCodigo($row->cod_estabelecimento);
				$romaneio->getEstabelecimento()->setRazaoSocial($row->est_razao);
				$romaneio->getEstabelecimento()->setLogradouro($row->est_logradouro);
				$romaneio->getEstabelecimento()->setNumero($row->est_numero);
				$romaneio->getEstabelecimento()->setBairro($row->est_bairro);
				$romaneio->getEstabelecimento()->setCidade($row->est_cidade);
				$romaneio->getEstabelecimento()->setUf($row->est_uf);
				$romaneio->getTipoVeiculo()->setCodigo($row->tip_codigo);
				$romaneio->getTipoVeiculo()->setDescricao($row->tip_descricao);
				$romaneio->getTransportadora()->setCodigo($row->cod_transportadora);
				$romaneio->getTransportadora()->setNomeFantasia($row->nome_fantasia);
				$romaneio->getMotorista()->setCodigo($row->cod_motorista);
				$romaneio->getMotorista()->setNome($row->mot_nome);
				$romaneio->getMotorista()->setCpf($row->mot_cpf);
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

	public function consultar($filtro, $procurar) {
		$this->db->select('*, 
			lpad(romaneio.codigo, 4, 0) AS cod_romaneio, 
			estabelecimento.logradouro AS est_logradouro, 
			estabelecimento.numero AS est_numero, 
			estabelecimento.bairro AS est_bairro, 
			estabelecimento.cidade AS est_cidade, 
			motorista.nome AS mot_nome')->from($this->table);
		$this->db->join('estabelecimento', 'estabelecimento.codigo = '.$this->table.'.cod_estabelecimento');
		$this->db->join('empresa', 'empresa.codigo = estabelecimento.cod_empresa', 'left');
		$this->db->join('motorista', 'motorista.codigo = '.$this->table.'.cod_motorista', 'left');
		$this->db->join('transportadora', 'transportadora.codigo = '.$this->table.'.cod_transportadora');
		$this->db->join('tipo_veiculo', 'tipo_veiculo.codigo = '.$this->table.'.cod_tipo_veiculo');
		$this->db->join('status_romaneio', 'status_romaneio.codigo = '.$this->table.'.cod_status_romaneio');
		$this->db->where('empresa.codigo', 1); // SESSION - Cód. Empresa

		if($filtro == "romaneio") {
			$this->db->where($this->table.'.codigo', $procurar);
		} else if($filtro == "transportadora") {
			$this->db->like('transportadora.nome_fantasia', $procurar);
		} else if($filtro == "motorista") {
			$this->db->like('motorista.nome', $procurar);
		}

		$query = $this->db->get();

		if($query->num_rows() > 0) {
			$result = $query->result();
			$romaneios = array();
			foreach($result as $row) {
				$romaneio = new Romaneio_basic();

				$romaneio->setCodigo($row->cod_romaneio);
				$romaneio->getStatusRomaneio()->setCodigo($row->cod_status_romaneio);
				$romaneio->getStatusRomaneio()->setDescricao($row->descricao);
				$romaneio->getEstabelecimento()->setCodigo($row->cod_estabelecimento);
				$romaneio->getEstabelecimento()->setLogradouro($row->est_logradouro);
				$romaneio->getEstabelecimento()->setNumero($row->est_numero);
				$romaneio->getEstabelecimento()->setBairro($row->est_bairro);
				$romaneio->getEstabelecimento()->setBairro($row->est_cidade);
				$romaneio->getTipoVeiculo()->setCodigo($row->cod_tipo_veiculo);
				$romaneio->getTipoVeiculo()->setDescricao($row->descricao);
				$romaneio->getTransportadora()->setCodigo($row->cod_transportadora);
				$romaneio->getTransportadora()->setNomeFantasia($row->nome_fantasia);
				$romaneio->getMotorista()->setCodigo($row->cod_motorista);
				$romaneio->getMotorista()->setNome($row->mot_nome);
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
		$this->db->select('*, 
			lpad(romaneio.codigo, 4, 0) AS cod_romaneio, 
			estabelecimento.razao_social AS est_razao, 
			estabelecimento.logradouro AS est_logradouro, 
			estabelecimento.numero AS est_numero, 
			estabelecimento.bairro AS est_bairro, 
			estabelecimento.cidade AS est_cidade, 
			estabelecimento.uf AS est_uf, 
			tipo_veiculo.codigo AS tip_codigo, 
			tipo_veiculo.descricao AS tip_descricao, 
			motorista.nome AS mot_nome')->from($this->table);
		$this->db->join('estabelecimento', 'estabelecimento.codigo = '.$this->table.'.cod_estabelecimento');
		$this->db->join('motorista', 'motorista.codigo = '.$this->table.'.cod_motorista', 'left');
		$this->db->join('transportadora', 'transportadora.codigo = '.$this->table.'.cod_transportadora', 'left');
		$this->db->join('tipo_veiculo', 'tipo_veiculo.codigo = '.$this->table.'.cod_tipo_veiculo');
		$this->db->join('status_romaneio', 'status_romaneio.codigo = '.$this->table.'.cod_status_romaneio');
		$this->db->where($this->table.'.codigo', $romaneio);
		$query = $this->db->get();

		if($query->num_rows() > 0) {
			$result = $query->result();
			$romaneios = array();
			foreach($result as $row) {
				$romaneio = new Romaneio_basic();

				$romaneio->setCodigo($row->cod_romaneio);
				$romaneio->getStatusRomaneio()->setCodigo($row->cod_status_romaneio);
				$romaneio->getStatusRomaneio()->setDescricao($row->descricao);
				$romaneio->getEstabelecimento()->setCodigo($row->cod_estabelecimento);
				$romaneio->getEstabelecimento()->setRazaoSocial($row->est_razao);
				$romaneio->getEstabelecimento()->setLogradouro($row->est_logradouro);
				$romaneio->getEstabelecimento()->setNumero($row->est_numero);
				$romaneio->getEstabelecimento()->setBairro($row->est_bairro);
				$romaneio->getEstabelecimento()->setCidade($row->est_cidade);
				$romaneio->getEstabelecimento()->setUf($row->est_uf);
				$romaneio->getTipoVeiculo()->setCodigo($row->tip_codigo);
				$romaneio->getTipoVeiculo()->setDescricao($row->tip_descricao);
				$romaneio->getTransportadora()->setCodigo($row->cod_transportadora);
				$romaneio->getTransportadora()->setNomeFantasia($row->nome_fantasia);
				$romaneio->getMotorista()->setCodigo($row->cod_motorista);
				$romaneio->getMotorista()->setNome($row->mot_nome);
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

	public function consultar_motorista_id($motorista) {
		$this->db->select('*, 
			lpad(romaneio.codigo, 4, 0) AS cod_romaneio, 
			estabelecimento.razao_social AS est_razao, 
			estabelecimento.logradouro AS est_logradouro, 
			estabelecimento.numero AS est_numero, 
			estabelecimento.bairro AS est_bairro, 
			estabelecimento.uf AS est_uf, 
			tipo_veiculo.codigo AS tip_codigo, 
			tipo_veiculo.descricao AS tip_descricao, 
			motorista.nome AS mot_nome')->from($this->table);
		$this->db->join('estabelecimento', 'estabelecimento.codigo = '.$this->table.'.cod_estabelecimento');
		$this->db->join('motorista', 'motorista.codigo = '.$this->table.'.cod_motorista', 'left');
		$this->db->join('transportadora', 'transportadora.codigo = '.$this->table.'.cod_transportadora', 'left');
		$this->db->join('tipo_veiculo', 'tipo_veiculo.codigo = '.$this->table.'.cod_tipo_veiculo');
		$this->db->join('status_romaneio', 'status_romaneio.codigo = '.$this->table.'.cod_status_romaneio');
		$this->db->where("romaneio.cod_motorista", $motorista);
		$query = $this->db->get();

		if($query->num_rows() > 0) {
			$result = $query->result();
			$romaneios = array();
			foreach($result as $row) {
				$romaneio = new Romaneio_basic();

				$romaneio->setCodigo($row->cod_romaneio);
				$romaneio->getStatusRomaneio()->setCodigo($row->cod_status_romaneio);
				$romaneio->getStatusRomaneio()->setDescricao($row->descricao);
				$romaneio->getEstabelecimento()->setCodigo($row->cod_estabelecimento);
				$romaneio->getEstabelecimento()->setRazaoSocial($row->est_razao);
				$romaneio->getEstabelecimento()->setLogradouro($row->est_logradouro);
				$romaneio->getEstabelecimento()->setNumero($row->est_numero);
				$romaneio->getEstabelecimento()->setBairro($row->est_bairro);
				$romaneio->getEstabelecimento()->setUf($row->est_uf);
				$romaneio->getTipoVeiculo()->setCodigo($row->tip_codigo);
				$romaneio->getTipoVeiculo()->setDescricao($row->tip_descricao);
				$romaneio->getTransportadora()->setCodigo($row->cod_transportadora);
				$romaneio->getTransportadora()->setNomeFantasia($row->nome_fantasia);
				$romaneio->getMotorista()->setCodigo($row->cod_motorista);
				$romaneio->getMotorista()->setNome($row->mot_nome);
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

	public function romaneio_ofertavel($empresa, $motorista) {
		$sql = "SELECT *, lpad(romaneio.codigo, 4, 0) AS codigo FROM romaneio WHERE cod_estabelecimento
				IN (
					SELECT codigo
					FROM estabelecimento
					WHERE cod_empresa = $empresa
				)
				AND ofertar_viagem = 1
				AND cod_tipo_veiculo = (
					SELECT cod_tipo_veiculo FROM veiculo
					INNER JOIN motorista 
					ON (veiculo.cod_motorista = motorista.codigo) WHERE motorista.codigo = $motorista
				)";
		$query = $this->db->query($sql);

		if($query->num_rows() > 0) {
			$result = $query->result();
			$romaneios = array();
			foreach($result as $row) {
				$romaneio = new Romaneio_basic();

				$romaneio->setCodigo($row->codigo);
				$romaneio->getStatusRomaneio()->setCodigo($row->cod_status_romaneio);
				$romaneio->getEstabelecimento()->setCodigo($row->cod_estabelecimento);
				$romaneio->getTipoVeiculo()->setCodigo($row->cod_tipo_veiculo);
				$romaneio->getTransportadora()->setCodigo($row->cod_transportadora);
				$romaneio->getMotorista()->setCodigo($row->cod_motorista);
				$romaneio->setDataCriacao($row->data_criacao);
				$romaneio->setDataFinalizacao($row->data_finalizacao);
				$romaneio->setOfertarViagem($row->ofertar_viagem);

				$romaneios[] = $romaneio;
			}

			return $romaneios;
		}
	}
}