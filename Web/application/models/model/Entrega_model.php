<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Entrega_model extends CI_Model {
	public $table = "entrega";

	function __construct() {
		parent::__construct();
		$this->load->model('basic/Entrega_basic');
	}

	public function listar() {
		$this->db->select('*')->from($this->table);
		$query = $this->db->get();

		if($query->num_rows() > 0) {
			$result = $query->result();
			$entregas = array();
			foreach($result as $row) {
				$entrega = new Entrega_basic();

				$entrega->setCodEntrega($row->cod_entrega);
				$entrega->getRomaneio()->setCodRomaneio($row->cod_romaneio);
				$entrega->getDestinatario()->setCodDestinatario($row->cod_destinatario);
				$entrega->getStatusEntrega()->getCodStatus($row->cod_status);
				$entrega->setPesoCarga($row->peso_carga);
				$entrega->setImagem($row->imagem);
				$entrega->setNotaFiscal($row->nota_fiscal);
				$entrega->setFinalizado($row->finalizado);
				$entrega->setSituacao($row->situacao);

				$entregas[] = $entrega;
			}

			return $entregas;
		} else {
			return false;
		}
	}
}
?>