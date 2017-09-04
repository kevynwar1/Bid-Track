<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {
	public function index() {
		$data['middle'] = 'dashboard';
		$this->load->view('pattern/layout', $data);
	}
}