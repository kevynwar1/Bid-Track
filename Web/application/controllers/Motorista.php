<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Motorista extends CI_Controller {
	function __construct() {
		parent::__construct();
		$this->load->model('basic/Motorista_basic');
		$this->load->model('model/Motorista_model');
		date_default_timezone_set('America/Sao_Paulo');
	}

	public function index() {
		$offset = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
		$config = array(
			'base_url' 		=> base_url('motorista/p'), 
			'per_page' 		=> 5, 
			'num_links' 	=> 3, 
			'uri_segment' 	=> 3, 
			'total_rows' 	=> $this->Motorista_model->total(), 
			'prev_link' 	=> '<small class="desc bt">
									<i class="fa fa-angle-left" aria-hidden="true"></i> Anterior
								</small>', 
			'next_link' 	=> '<small class="desc bt">
									Próximo <i class="fa fa-angle-right" aria-hidden="true"></i>
								</small>', 
			'cur_tag_open'	=> '<li class="num">', 
			'cur_tag_close'	=> '</li>', 
			'num_tag_open'	=> '<li class="num">', 
			'num_tag_close'	=> '</li>' 
		);
		$this->pagination->initialize($config);

		$data['pagination'] = $this->pagination->create_links();
		$data['total'] = $this->Motorista_model->total();
		$data['motorista'] = $this->Motorista_model->listar($config['per_page'], $offset);
		$data['middle'] = 'motorista';
		$this->load->view('pattern/layout', $data);
	}

	public function cadastrar() {
		$validade = explode("/", strip_tags(trim($this->input->post('validade_carteira'))));

		$motorista = new Motorista_basic();
		$motorista->setNome(strip_tags(trim($this->input->post('nome'))));
		$motorista->setCpf(strip_tags(trim($this->input->post('cpf'))));
		$motorista->setPontuacao(strip_tags(trim($this->input->post('pontuacao'))));
		$motorista->setLogradouro(strip_tags(trim($this->input->post('logradouro'))));
		$motorista->setNumero(strip_tags(trim($this->input->post('numero'))));
		$motorista->setComplemento(strip_tags(trim($this->input->post('complemento'))));
		$motorista->setBairro(strip_tags(trim($this->input->post('bairro'))));
		$motorista->setCidade(strip_tags(trim($this->input->post('cidade'))));
		$motorista->setUf(strip_tags(trim($this->input->post('uf'))));
		$motorista->setCep(strip_tags(trim($this->input->post('cep'))));
		$motorista->setEmail(strip_tags(trim($this->input->post('email'))));
		$motorista->setSenha(rand(0, 99999));
		$motorista->setTipoCarteira(strip_tags(trim($this->input->post('tipo_carteira'))));
		$motorista->setValidadeCarteira($validade[2].'-'.$validade[1].'-'.$validade[0]);
		$motorista->setDisponibilidade(TRUE);

		$json_url = "https://maps.googleapis.com/maps/api/geocode/json?address=".str_replace(" ", "+", acentuacao($motorista->getLogradouro()).", ".$motorista->getNumero()." ".acentuacao($motorista->getBairro()))."&key=AIzaSyDyIn0nbXxWrWrdyV9plcwTO_bJ-Rm9y7w";
		$json = file_get_contents(str_replace("&amp;", "&", $json_url));
		$coordenadas = json_decode($json, TRUE);

		$motorista->setLatitude($coordenadas['results'][0]['geometry']['location']['lat']);
		$motorista->setLongitude($coordenadas['results'][0]['geometry']['location']['lng']);
		$motorista->setSituacao(TRUE);
		
		$result = $this->Motorista_model->cadastrar($motorista);
		if($result) {
			$empresa = $this->Motorista_model->cadastrar_empresa($this->session->userdata('empresa'), $result);
			if($empresa) {
				$mensagem = "
					Olá <b>".$motorista->getNome()."</b>,<br>
					Bem-vindo(a) à Bid & Track.<br><br>

					Você está recebendo este e-mail pois a empresa '".$this->session->userdata('n_empresa')."' realizou o seu cadastro em sua lista de motorista.<br>
					Os dados de acesso da sua conta ao aplicativo estão logo abaixo.<br><br>
					E-mail: ".$motorista->getEmail()."<br>
					Senha: ".$motorista->getSenha()."<br><br>
				";
				$this->enviar($motorista->getEmail(), 'Acesso — Bid & Track', $mensagem);
				
				$this->session->set_flashdata('success', 'Motorista, cadastrado com Sucesso.');
			}
		} else {
			$this->session->set_flashdata('error', 'Ocorreu um erro, ao cadastrar o Motorista.');
		}

		redirect(base_url().'motorista');
	}

	public function editar() {
		$editar = (!is_null($this->input->post('editar'))) ? true : false;
		if($editar) {
			$validade = explode("/", strip_tags(trim($this->input->post('validade_carteira'))));
			$json_url = "https://maps.googleapis.com/maps/api/geocode/json?address=".str_replace(" ", "+", acentuacao(strip_tags(trim($this->input->post('logradouro')))).", ".strip_tags(trim($this->input->post('numero')))." ".acentuacao(strip_tags(trim($this->input->post('bairro')))))."&key=AIzaSyDyIn0nbXxWrWrdyV9plcwTO_bJ-Rm9y7w";
			$json = file_get_contents(str_replace("&amp;", "&", $json_url));
			$coordenadas = json_decode($json, TRUE);

			$data = array(
				'codigo'			=> $this->input->post('codigo'),
				'nome' 				=> strip_tags(trim($this->input->post('nome'))),
				'cpf' 				=> strip_tags(trim($this->input->post('cpf'))),
				'email' 			=> strip_tags(trim($this->input->post('email'))),
				'cep' 				=> strip_tags(trim($this->input->post('cep'))),
				'logradouro' 		=> strip_tags(trim($this->input->post('logradouro'))),
				'numero' 			=> strip_tags(trim($this->input->post('numero'))),
				'complemento' 		=> strip_tags(trim($this->input->post('complemento'))),
				'bairro' 			=> strip_tags(trim($this->input->post('bairro'))),
				'cidade' 			=> strip_tags(trim($this->input->post('cidade'))),
				'uf' 				=> strip_tags(trim($this->input->post('uf'))),
				'tipo_carteira' 	=> strip_tags(trim($this->input->post('tipo_carteira'))),
				'validade_carteira' => $validade[2].'-'.$validade[1].'-'.$validade[0],
				'latitude'			=> $coordenadas['results'][0]['geometry']['location']['lat'],
				'longitude'			=> $coordenadas['results'][0]['geometry']['location']['lng']
			);

			$result = $this->Motorista_model->editar($data);
			if($result) {
				$this->session->set_flashdata('success', 'Motorista, Editado com Sucesso.');
			} else {
				$this->session->set_flashdata('error', 'Ocorreu um erro, ao editar o Motorista.');
			}

			redirect(base_url().'motorista/editar/'.$data['codigo']);
		} else {
			$this->load->model('model/Romaneio_model');

			$data['motorista'] = $this->Motorista_model->consultar('codigo', $this->uri->segment(3));
			$data['romaneio'] = $this->Romaneio_model->romaneio_empresa_motorista($this->session->userdata('empresa'), $this->uri->segment(3));
			$data['middle'] = 'motorista/editar';
			$this->load->view('pattern/layout', $data);
		}
	}

	public function add() {
		$data['middle'] = 'motorista/cadastrar';
		$this->load->view('pattern/layout', $data);
	}

	public function excluir() {
		$motorista = new Motorista_basic();
		$motorista->setCodigo($this->uri->segment(3));

		$result = $this->Motorista_model->excluir($motorista);
		if($result) {
			$this->session->set_flashdata('success', 'Motorista, Excluída com Sucesso.');
		} else {
			$this->session->set_flashdata('error', 'Ocorreu um erro, ao excluir a Motorista.');
		}

		redirect(base_url().'motorista');
	}

	public function s() {
		$filtro = $this->input->get('filtro');
		$procurar = strip_tags(trim($this->input->get('procurar')));

		$data['motorista'] = $this->Motorista_model->consultar($filtro, $procurar);
		$data['middle'] = 'motorista';
		$this->load->view('pattern/layout', $data);
	}

	public function verificar_email() {
		$email = $this->input->post('email');

		echo json_encode($this->Motorista_model->verificar_email($email));
	}

	public function enviar($para, $assunto, $mensagem) {
		$config['protocol'] = 'mail';
		$config['wordwrap'] = TRUE;
		$config['validate'] = TRUE;

		$this->email->initialize($config);
		$this->email->from('contato@coopera.pe.hu', SYSTEM_NAME);
		$this->email->to($para);
		$this->email->cc('ikarosales7@gmail.com, lfcalabria@gmail.com, brunomulatinho@gmail.com');

		$this->email->subject($assunto);
		$this->email->message(estrutura($assunto, $mensagem));

		$this->email->send();
	}
}