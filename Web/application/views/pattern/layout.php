<?php 
	$this->load->view('pattern/header');

	if(isset($middle)){
		$this->load->view($middle);
	} else {
		echo "Controller <b>".$this->uri->segment(1)."</b><br>";
		echo "Função     <b>".$this->uri->segment(2)."</b><br>";
	}

	$this->load->view('pattern/footer');
?>