<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {
	public function index() {
		$this->load->view('index');
	}

	public function apresentacao() {
		if($this->uri->segment(3) == 'index') {
			$this->load->view('apresentacao/index');
		} else {
			$this->load->view('apresentacao');
		}
	}
}
