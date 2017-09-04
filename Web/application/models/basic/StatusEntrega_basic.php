<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class StatusEntrega_basic extends CI_Model {
	public $cod_status;
	public $ocorrencia;
	public $data_ocorrencia;
	public $latitude;
	public $longitude;

	function __construct() {
		parent::__construct();
		$this->load->model('basic/Ocorrencia_basic');

		$this->ocorrencia = new Ocorrencia_basic();
	}

	public function getCodStatus() { return $this->cod_status; }
	public function setCodStatus($cod_status) { $this->cod_status = $cod_status; }

	public function getOcorrencia() { return $this->ocorrencia; }
	public function setOcorrencia($ocorrencia) { $this->ocorrencia = $ocorrencia; }

	public function getDataOcorrencia() { return $this->data_ocorrencia; }
	public function setDataOcorrencia($data_ocorrencia) { $this->data_ocorrencia = $data_ocorrencia; }

	public function getLatitude() { return $this->latitude; }
	public function setLatitude($latitude) { $this->latitude = $latitude; }

	public function getLongitude() { return $this->longitude; }
	public function setLongitude($longitude) { $this->longitude = $longitude; }
}
?>