<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Veiculo_model extends CI_Model {
	public $table = "veiculo";

	function __construct() {
		parent::__construct();
		$this->load->model('basic/Veiculo_basic');
	}

	public function cadastrar($veiculo) {
		$data = array(
			'cod_empresa' 		=> $veiculo->getEmpresa()->getCodigo(),
			'cod_motorista' 	=> $veiculo->getMotorista()->getCodigo(),
			'cod_tipo_veiculo' 	=> $veiculo->getTipoVeiculo()->getCodigo(),
			'modelo' 			=> $veiculo->getModelo(),
			'placa' 			=> $veiculo->getPlaca(),
			'chassi' 			=> $veiculo->getChassi(),
			'proprio' 			=> $veiculo->getProprio(),
			'capacidade' 		=> $veiculo->getCapacidade(),
			'antt' 				=> $veiculo->getAntt(),
			'situacao' 			=> $veiculo->getSituacao()
		);

		$this->db->insert($this->table, $data);
		if(!$this->db->affected_rows()) {
			return false;
		}
		return true;
	}

	public function editar($veiculo) {
		$this->db->where($this->table.'.codigo', $veiculo['codigo']);
		$this->db->where($this->table.'.cod_empresa', $this->session->userdata('empresa'));
		$this->db->update($this->table, $veiculo);

		return $this->db->affected_rows();
	}

	public function excluir($veiculo) {
		$this->db->where($this->table.'.codigo', $veiculo->getCodigo());
		$this->db->where($this->table.'.cod_empresa', $this->session->userdata('empresa'));
		$this->db->delete($this->table);

		return $this->db->affected_rows(); 
	}

	public function total() {
		$this->db->select('*')->from($this->table);
		$this->db->where($this->table.'.cod_empresa', $this->session->userdata('empresa'));
		$query = $this->db->get();

		return $query->num_rows();
	}

	public function listar($limit = null, $offset = null) {
		$this->db->select('
			veiculo.codigo AS codigo, 
			veiculo.cod_empresa AS cod_empresa,
			veiculo.cod_motorista AS cod_motorista,
			veiculo.cod_tipo_veiculo AS cod_tipo_veiculo, 
			veiculo.modelo AS modelo, 
			veiculo.placa AS placa, 
			veiculo.chassi AS chassi, 
			veiculo.proprio AS proprio, 
			veiculo.capacidade AS capacidade, 
			veiculo.antt AS antt, 
			veiculo.situacao AS situacao, 
			motorista.nome AS nome, 
			tipo_veiculo.descricao AS descricao, 
			tipo_veiculo.peso AS peso
		')->from($this->table);
		$this->db->join('motorista', 'motorista.codigo = '.$this->table.'.cod_motorista');
		$this->db->join('tipo_veiculo', 'tipo_veiculo.codigo = '.$this->table.'.cod_tipo_veiculo');
		$this->db->where($this->table.'.cod_empresa', $this->session->userdata('empresa'));
		if(isset($limit) && isset($offset)) {
			$this->db->limit($limit, $offset);
		}
		$this->db->order_by($this->table.".modelo", "ASC");
		$query = $this->db->get();

		if($query->num_rows() > 0) {
			$result = $query->result();
			$veiculos = array();
			foreach($result as $row) {
				$veiculo = new Veiculo_basic();

				$veiculo->setCodigo($row->codigo);
				$veiculo->getEmpresa()->setCodigo($row->cod_empresa);
				$veiculo->getMotorista()->setCodigo($row->cod_motorista);
				$veiculo->getMotorista()->setNome($row->nome);
				$veiculo->getTipoVeiculo()->setCodigo($row->cod_tipo_veiculo);
				$veiculo->getTipoVeiculo()->setDescricao($row->descricao);
				$veiculo->getTipoVeiculo()->setPeso($row->peso);
				$veiculo->setModelo($row->modelo);
				$veiculo->setPlaca($row->placa);
				$veiculo->setChassi($row->chassi);
				$veiculo->setProprio($row->proprio);
				$veiculo->setCapacidade($row->capacidade);
				$veiculo->setAntt($row->antt);
				$veiculo->setSituacao($row->situacao);

				$veiculos[] = $veiculo;
			}

			return $veiculos;
		} else {
			return false;
		}
	}

	public function consultar($filtro, $procurar) {
		$this->db->select('
			veiculo.codigo AS codigo, 
			veiculo.cod_empresa AS cod_empresa,
			veiculo.cod_motorista AS cod_motorista,
			veiculo.cod_tipo_veiculo AS cod_tipo_veiculo, 
			veiculo.modelo AS modelo, 
			veiculo.placa AS placa, 
			veiculo.chassi AS chassi, 
			veiculo.proprio AS proprio, 
			veiculo.capacidade AS capacidade, 
			veiculo.antt AS antt, 
			veiculo.situacao AS situacao, 
			motorista.nome AS nome, 
			tipo_veiculo.descricao AS descricao, 
			tipo_veiculo.peso AS peso
		')->from($this->table);
		$this->db->join('motorista', 'motorista.codigo = '.$this->table.'.cod_motorista');
		$this->db->join('tipo_veiculo', 'tipo_veiculo.codigo = '.$this->table.'.cod_tipo_veiculo');
		$this->db->where($this->table.'.cod_empresa', $this->session->userdata('empresa'));
		if($filtro == "codigo") {
			$this->db->where($this->table.'.codigo', $procurar);
		} else if($filtro == 'modelo') {
			$this->db->like($this->table.'.modelo', $procurar);
		} else if($filtro == 'motorista') {
			$this->db->like('motorista.nome', $procurar);
		} else if($filtro == 'tipo_veiculo') {
			$this->db->like('tipo_veiculo.descricao', $procurar);
		}
		$this->db->order_by($this->table.'.modelo', 'ASC');
		$query = $this->db->get();

		if($query->num_rows() > 0) {
			$result = $query->result();
			$veiculos = array();
			foreach($result as $row) {
				$veiculo = new Veiculo_basic();

				$veiculo->setCodigo($row->codigo);
				$veiculo->getEmpresa()->setCodigo($row->cod_empresa);
				$veiculo->getMotorista()->setCodigo($row->cod_motorista);
				$veiculo->getMotorista()->setNome($row->nome);
				$veiculo->getTipoVeiculo()->setCodigo($row->cod_tipo_veiculo);
				$veiculo->getTipoVeiculo()->setDescricao($row->descricao);
				$veiculo->getTipoVeiculo()->setPeso($row->peso);
				$veiculo->setModelo($row->modelo);
				$veiculo->setPlaca($row->placa);
				$veiculo->setChassi($row->chassi);
				$veiculo->setProprio($row->proprio);
				$veiculo->setCapacidade($row->capacidade);
				$veiculo->setAntt($row->antt);
				$veiculo->setSituacao($row->situacao);

				$veiculos[] = $veiculo;
			}

			return $veiculos;
		} else {
			return false;
		}
	}
}