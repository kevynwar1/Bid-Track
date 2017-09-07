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

	public function maps() {
		$address = trim(str_replace(" ", "+", $this->input->post('address')));
		$json_url = "https://maps.googleapis.com/maps/api/geocode/json?address=$address&key=AIzaSyDHWJdTCd5dUDdZFg5OjIE7rRd2t-EZO3w";
		$json = file_get_contents(str_replace("&amp;", "&", $json_url));
		$data = json_decode($json, TRUE);

		echo json_encode($data);
	}
}
