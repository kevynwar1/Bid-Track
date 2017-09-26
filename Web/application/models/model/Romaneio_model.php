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
			'valor' 				=> $romaneio->getValor(),
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

	public function verificar_romaneio($romaneio) {
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
		$this->db->where('empresa.codigo', '1'); // SESSION Empresa
		$this->db->where($this->table.'.cod_status_romaneio <>', '4');
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
		$this->db->select('  
			romaneio.cod_status_romaneio AS cod_status_romaneio, 
			romaneio.cod_estabelecimento AS cod_estabelecimento, 
			romaneio.cod_tipo_veiculo AS cod_tipo_veiculo, 
			romaneio.cod_transportadora AS cod_transportadora, 
			romaneio.cod_motorista AS cod_motorista, 
			romaneio.valor AS valor, 
			romaneio.data_criacao AS data_criacao, 
			romaneio.data_finalizacao AS data_finalizacao, 
			romaneio.ofertar_viagem AS ofertar_viagem, 

			transportadora.nome_fantasia AS trans_nome_fantasia, 
			transportadora.razao_social AS trans_razao_social, 
			transportadora.logradouro AS trans_logradouro, 
			transportadora.complemento AS trans_complemento, 
			transportadora.numero AS trans_numero, 
			transportadora.bairro AS trans_bairro, 
			transportadora.cidade AS trans_cidade, 

			tipo_veiculo.descricao AS veiculo_descricao, 
			status_romaneio.descricao AS status_descricao, 
			lpad(romaneio.codigo, 4, 0) AS cod_romaneio, 

			estabelecimento.razao_social AS est_razao, 
			estabelecimento.logradouro AS est_logradouro, 
			estabelecimento.complemento AS est_complemento, 
			estabelecimento.numero AS est_numero, 
			estabelecimento.bairro AS est_bairro, 
			estabelecimento.cidade AS est_cidade, 
			motorista.nome AS mot_nome')->from($this->table);
		$this->db->distinct();
		$this->db->join('estabelecimento', 'estabelecimento.codigo = '.$this->table.'.cod_estabelecimento');
		$this->db->join('empresa', 'empresa.codigo = estabelecimento.cod_empresa', 'left');
		$this->db->join('motorista', 'motorista.codigo = '.$this->table.'.cod_motorista', 'left');
		$this->db->join('transportadora', 'transportadora.codigo = '.$this->table.'.cod_transportadora');
		$this->db->join('tipo_veiculo', 'tipo_veiculo.codigo = '.$this->table.'.cod_tipo_veiculo');
		$this->db->join('status_romaneio', 'status_romaneio.codigo = '.$this->table.'.cod_status_romaneio');
		$this->db->where('empresa.codigo', '1'); // SESSION Empresa

		if($filtro == "romaneio") {
			$this->db->where($this->table.'.codigo', $procurar);
		} else if($filtro == "transportadora") {
			$this->db->like('transportadora.nome_fantasia', $procurar);
		} else if($filtro == "motorista") {
			$this->db->like('motorista.nome', $procurar);
		} else if($filtro == "nota") {
			$this->db->join('entrega', 'entrega.cod_romaneio = '.$this->table.'.codigo');
			$this->db->like('entrega.nota_fiscal', $procurar);
		} else if($filtro == "cliente") {
			$this->db->join('entrega', 'entrega.cod_romaneio = '.$this->table.'.codigo');
			$this->db->join('destinatario', 'destinatario.codigo = entrega.cod_destinatario', 'left');
			$this->db->like('destinatario.razao_social', $procurar);
		}

		$query = $this->db->get();

		if($query->num_rows() > 0) {
			$result = $query->result();
			$romaneios = array();
			foreach($result as $row) {
				$romaneio = new Romaneio_basic();

				$romaneio->setCodigo($row->cod_romaneio);
				$romaneio->getStatusRomaneio()->setCodigo($row->cod_status_romaneio);
				$romaneio->getStatusRomaneio()->setDescricao($row->status_descricao);
				$romaneio->getEstabelecimento()->setCodigo($row->cod_estabelecimento);
				$romaneio->getEstabelecimento()->setRazaoSocial($row->est_razao);
				$romaneio->getEstabelecimento()->setLogradouro($row->est_logradouro);
				$romaneio->getEstabelecimento()->setComplemento($row->est_complemento);
				$romaneio->getEstabelecimento()->setNumero($row->est_numero);
				$romaneio->getEstabelecimento()->setBairro($row->est_bairro);
				$romaneio->getEstabelecimento()->setCidade($row->est_cidade);
				$romaneio->getTipoVeiculo()->setCodigo($row->cod_tipo_veiculo);
				$romaneio->getTipoVeiculo()->setDescricao($row->veiculo_descricao);
				$romaneio->getTransportadora()->setCodigo($row->cod_transportadora);
				$romaneio->getTransportadora()->setRazaoSocial($row->trans_razao_social);
				$romaneio->getTransportadora()->setNomeFantasia($row->trans_nome_fantasia);
				$romaneio->getTransportadora()->setLogradouro($row->trans_logradouro);
				$romaneio->getTransportadora()->setComplemento($row->trans_complemento);
				$romaneio->getTransportadora()->setNumero($row->trans_numero);
				$romaneio->getTransportadora()->setBairro($row->trans_bairro);
				$romaneio->getTransportadora()->setCidade($row->trans_cidade);
				$romaneio->getMotorista()->setCodigo($row->cod_motorista);
				$romaneio->getMotorista()->setNome($row->mot_nome);
				$romaneio->setValor($row->valor);
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
			romaneio.valor AS valor, 

			estabelecimento.razao_social AS est_razao, 
			estabelecimento.cnpj AS est_cnpj, 
			estabelecimento.logradouro AS est_logradouro, 
			estabelecimento.numero AS est_numero, 
			estabelecimento.bairro AS est_bairro, 
			estabelecimento.cidade AS est_cidade, 
			estabelecimento.uf AS est_uf, 

			transportadora.cnpj AS trans_cnpj, 
			transportadora.nome_fantasia AS trans_nome_fantasia, 
			transportadora.razao_social AS trans_razao_social, 
			transportadora.logradouro AS trans_logradouro, 
			transportadora.complemento AS trans_complemento, 
			transportadora.numero AS trans_numero, 
			transportadora.bairro AS trans_bairro, 
			transportadora.cidade AS trans_cidade, 
			transportadora.uf AS trans_uf, 

			motorista.nome AS mot_nome, 
			motorista.cpf AS mot_cpf, 
			motorista.logradouro AS mot_logradouro, 
			motorista.complemento AS mot_complemento, 
			motorista.numero AS mot_numero, 
			motorista.bairro AS mot_bairro, 
			motorista.cidade AS mot_cidade, 
			motorista.uf AS mot_uf, 

			tipo_veiculo.codigo AS tip_codigo, 
			tipo_veiculo.descricao AS tip_descricao
			')->from($this->table);
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
				$romaneio->getEstabelecimento()->setCnpj($row->est_cnpj);
				$romaneio->getEstabelecimento()->setRazaoSocial($row->est_razao);
				$romaneio->getEstabelecimento()->setLogradouro($row->est_logradouro);
				$romaneio->getEstabelecimento()->setNumero($row->est_numero);
				$romaneio->getEstabelecimento()->setBairro($row->est_bairro);
				$romaneio->getEstabelecimento()->setCidade($row->est_cidade);
				$romaneio->getEstabelecimento()->setUf($row->est_uf);
				$romaneio->getTipoVeiculo()->setCodigo($row->tip_codigo);
				$romaneio->getTipoVeiculo()->setDescricao($row->tip_descricao);
				$romaneio->getTransportadora()->setCodigo($row->cod_transportadora);
				$romaneio->getTransportadora()->setCnpj($row->trans_cnpj);
				$romaneio->getTransportadora()->setRazaoSocial($row->trans_razao_social);
				$romaneio->getTransportadora()->setNomeFantasia($row->trans_nome_fantasia);
				$romaneio->getTransportadora()->setLogradouro($row->trans_logradouro);
				$romaneio->getTransportadora()->setComplemento($row->trans_complemento);
				$romaneio->getTransportadora()->setNumero($row->trans_numero);
				$romaneio->getTransportadora()->setBairro($row->trans_bairro);
				$romaneio->getTransportadora()->setCidade($row->trans_cidade);
				$romaneio->getTransportadora()->setUf($row->trans_uf);
				$romaneio->getMotorista()->setCodigo($row->cod_motorista);
				$romaneio->getMotorista()->setCpf($row->mot_cpf);
				$romaneio->getMotorista()->setNome($row->mot_nome);
				$romaneio->getMotorista()->setLogradouro($row->mot_logradouro);
				$romaneio->getMotorista()->setComplemento($row->mot_complemento);
				$romaneio->getMotorista()->setNumero($row->mot_numero);
				$romaneio->getMotorista()->setBairro($row->mot_bairro);
				$romaneio->getMotorista()->setCidade($row->mot_cidade);
				$romaneio->getMotorista()->setUf($row->mot_uf);
				$romaneio->setValor($row->valor);
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

	public function faturamento() {
		$this->db->select('SUM('.$this->table.'.valor) AS valor')->from($this->table);
		$this->db->where($this->table.'.cod_empresa', '1'); // SESSION Empresa
		$query = $this->db->get();

		if($query->num_rows() == 1) {
			return $query->result();
		} else {
			return false;
		}
	}















	/* Web Service */
	public function romaneio_aceitar($motorista, $romaneio, $empresa, $estabelecimento) {
		$data = array(
			'cod_motorista' => $motorista,
			'cod_status_romaneio' => '5'
		);

		$this->db->where($this->table.'.codigo', $romaneio);
		$this->db->where($this->table.'.cod_empresa', $empresa);
		$this->db->where($this->table.'.cod_estabelecimento', $estabelecimento);
		$this->db->where($this->table.'.cod_motorista IS NULL');
		$this->db->update($this->table, $data);

		return $this->db->affected_rows(); 
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
		$sql = "SELECT r.codigo, r.cod_empresa, r.cod_status_romaneio, r.cod_estabelecimento, r.cod_tipo_veiculo, r.cod_transportadora, r.cod_motorista, r.valor, r.data_criacao, r.data_finalizacao, r.ofertar_viagem FROM romaneio r
				WHERE r.cod_empresa = ".$empresa."
				AND r.cod_status_romaneio = 2
				AND r.ofertar_viagem = TRUE
				AND r.cod_tipo_veiculo = (
					SELECT cod_tipo_veiculo FROM veiculo
					WHERE cod_motorista = ".$motorista."
				)";

		$query = $this->db->query($sql);

		if($query->num_rows() > 0) {
			$result = $query->result();
			$romaneios = array();
			foreach($result as $row) {
				$romaneio = new Romaneio_basic();

				$romaneio->setCodigo($row->codigo);
				$romaneio->getEmpresa()->setCodigo($row->cod_empresa);
				$romaneio->getStatusRomaneio()->setCodigo($row->cod_status_romaneio);
				$romaneio->getEstabelecimento()->setCodigo($row->cod_estabelecimento);
				$romaneio->getTipoVeiculo()->setCodigo($row->cod_tipo_veiculo);
				$romaneio->getTransportadora()->setCodigo($row->cod_transportadora);
				$romaneio->getMotorista()->setCodigo($row->cod_motorista);
				$romaneio->setValor($row->valor);
				$romaneio->setDataCriacao($row->data_criacao);
				$romaneio->setDataFinalizacao($row->data_finalizacao);
				$romaneio->setOfertarViagem($row->ofertar_viagem);

				$romaneios[] = $romaneio;
			}

			return $romaneios;
		}
	}

	public function romaneio_empresa_motorista($empresa, $motorista) {
		$this->db->select('*, 
			lpad(romaneio.codigo, 4, 0) AS cod_romaneio,
			romaneio.cod_status_romaneio AS cod_status_romaneio, 
			romaneio.cod_estabelecimento AS cod_estabelecimento, 
			romaneio.cod_tipo_veiculo AS cod_tipo_veiculo, 
			romaneio.cod_transportadora AS cod_transportadora, 
			romaneio.cod_motorista AS cod_motorista, 
			romaneio.data_criacao AS data_criacao, 
			romaneio.data_finalizacao AS data_finalizacao, 
			romaneio.ofertar_viagem AS ofertar_viagem,  
			estabelecimento.razao_social AS est_razao, 
			estabelecimento.logradouro AS est_logradouro, 
			estabelecimento.numero AS est_numero, 
			estabelecimento.bairro AS est_bairro, 
			estabelecimento.cidade AS est_cidade, 
			estabelecimento.uf AS est_uf, 
			tipo_veiculo.codigo AS tip_codigo, 
			tipo_veiculo.descricao AS tip_descricao')->from($this->table);
		$this->db->join('estabelecimento', 'estabelecimento.codigo = '.$this->table.'.cod_estabelecimento');
		$this->db->join('tipo_veiculo', 'tipo_veiculo.codigo = '.$this->table.'.cod_tipo_veiculo');
		$this->db->join('empresa', 'empresa.codigo = estabelecimento.cod_empresa', 'left');
		$this->db->where('empresa.codigo', $empresa);
		$this->db->where('romaneio.cod_motorista', $motorista);
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

	public function romaneio_entrega($motorista) {
		$this->db->select('*, 
			romaneio.cod_motorista AS cod_motorista, 
			entrega.seq_entrega AS seq_entrega, 
			destinatario.razao_social AS razao_social, 
			destinatario.bairro AS bairro, 
			destinatario.cidade AS cidade,
			destinatario.uf AS uf, 
			status_romaneio.descricao AS descricao_romaneio, 
			status_entrega.descricao AS descricao_entrega,
			lpad(entrega.cod_romaneio, 4, 0) AS cod_romaneio, 
			romaneio.cod_estabelecimento AS estabelecimento')->from($this->table);
		$this->db->join('entrega', 'entrega.cod_romaneio = '.$this->table.'.codigo');
		$this->db->join('destinatario', 'destinatario.codigo = entrega.cod_destinatario');
		$this->db->join('motorista', 'motorista.codigo = romaneio.cod_motorista');
		$this->db->join('estabelecimento', 'estabelecimento.codigo = romaneio.cod_estabelecimento');
		$this->db->join('status_romaneio', 'status_romaneio.codigo = romaneio.cod_status_romaneio');
		$this->db->join('status_entrega', 'status_entrega.codigo = entrega.cod_status_entrega');
		$this->db->where('romaneio.cod_status_romaneio', '1');
		$this->db->or_where('romaneio.cod_status_romaneio', '3');
		$this->db->where('romaneio.cod_motorista', $motorista);
		$query = $this->db->get();

		if($query->num_rows() > 0) {
			return $query->result();
		} else {
			return false;
		}
	}
}