<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Empresa extends CI_Controller {
	function __construct() {
		parent::__construct();
		$this->load->model('basic/Empresa_basic');
		$this->load->model('model/Empresa_model');
		date_default_timezone_set('America/Sao_Paulo');
	}

	public function index() {
		$empresa = new Empresa_basic();
		$empresas = new Empresa_basic();
		$empresas = $this->Empresa_model->listar();
	}

	public function cadastrar() {
		$empresa = new Empresa_basic();
		$empresa->setCnpj(strip_tags(trim($this->input->post('cnpj'))));
		$empresa->setRazaoSocial(strip_tags(trim($this->input->post('razao_social'))));
		$empresa->setNomeFantasia(strip_tags(trim($this->input->post('razao_social'))));
		$empresa->setLogradouro(strip_tags(trim($this->input->post('endereco'))));
		$empresa->setComplemento(strip_tags(trim($this->input->post('complemento'))));
		$empresa->setNumero(strip_tags(trim($this->input->post('numero'))));
		$empresa->setBairro(strip_tags(trim($this->input->post('bairro'))));
		$empresa->setCidade(strip_tags(trim($this->input->post('cidade'))));
		$empresa->setCep(strip_tags(trim($this->input->post('cep'))));
		$empresa->setUf(strip_tags(trim($this->input->post('uf'))));

		$json_url = "https://maps.googleapis.com/maps/api/geocode/json?address=".str_replace(" ", "+", acentuacao($empresa->getLogradouro()).", ".$empresa->getNumero()." ".acentuacao($empresa->getBairro()))."&key=AIzaSyDyIn0nbXxWrWrdyV9plcwTO_bJ-Rm9y7w";
		$json = file_get_contents(str_replace("&amp;", "&", $json_url));
		$coordenadas = json_decode($json, TRUE);

		$empresa->setLatitude((is_null($coordenadas) ? '0' : $coordenadas['results'][0]['geometry']['location']['lat']));
		$empresa->setLongitude((is_null($coordenadas) ? '0' : $coordenadas['results'][0]['geometry']['location']['lng']));
		$empresa->setSituacao(TRUE);

		$result = $this->Empresa_model->cadastrar($empresa);
		if($result != FALSE) {
			$this->load->model('basic/Usuario_basic');
			$this->load->model('model/Usuario_model');
			$usuario = new Usuario_basic();
			$usuario->getEmpresa()->setCodigo($result);
			$usuario->setNome(strip_tags(trim($this->input->post('nome'))));
			$usuario->setEmail(strip_tags(trim($this->input->post('email'))));
			$usuario->setSenha(rand(0, 99999));
			$usuario->setPerfil('A');
			$usuario->setSituacao(TRUE);

			$mensagem = "
				Olá <b>".$usuario->getNome()."</b>,<br>
				Bem-vindo(a) à Bid & Track.<br>
				Agradecemos o seu cadastro em nossa plataforma.<br><br>

				Você está recebendo este e-mail devido ao cadastro na empresa '".$empresa->getRazaoSocial()."',<br>
				os dados de acesso da sua conta ao sistema estão logo abaixo.<br><br>
				E-mail: ".$usuario->getEmail()."<br>
				Senha: ".$usuario->getSenha()."<br><br><br>
				<a href='".base_url()."' style='padding: 10px; background: linear-gradient(to right, #BF2C38 0%, #DB151C 100%); border-radius: 3px; color: #FFF; text-decoration: none; text-transform: uppercase; font-size: 11px;'>
					Acessar — Bid &amp; Track
				</a>
			";
			$this->enviar($usuario->getEmail(), 'Acesso — Bid & Track', $mensagem);
			$result = $this->Usuario_model->cadastrar($usuario);
			$this->session->set_flashdata('ok', 'Empresa, cadastrada com Sucesso.');
		} else {
			$this->session->set_flashdata('mistake', 'Ocorreu um erro, ao cadastrar a Empresa.');
		}

		redirect(base_url().'administrador');
	}

	public function cnpj() {
		$cnpj = $_POST['cnpj'];
		$cnpj = str_replace(".", "", $cnpj);
		$cnpj = str_replace("-", "", $cnpj);
		$cnpj = str_replace("/", "", $cnpj);

		$json_url = "https://www.receitaws.com.br/v1/cnpj/$cnpj";
		$json = file_get_contents($json_url);
		$data = json_decode($json, TRUE);

		if($data['status'] == 'OK') {
			$dados['nome'] 			= (string) refatorar_campos($data['nome']);
			$dados['atividade']		= (string) $data['atividade_principal']['0']['text'];
			$dados['abertura']		= (string) $data['abertura'];
			$dados['tipo']			= (string) ucwords(strtolower($data['tipo']));
			$dados['situacao']		= (string) ucwords(strtolower($data['situacao']));
			$dados['endereco'] 		= (string) refatorar_campos($data['logradouro']);
			$dados['numero'] 		= (string) $data['numero'];
			$dados['complemento'] 	= (string) refatorar_campos($data['complemento']);
			$dados['bairro'] 		= (string) refatorar_campos($data['bairro']);
			$dados['cidade']  		= (string) refatorar_campos($data['municipio']);
			$dados['cep']			= (string) str_replace(".", "", $data['cep']);
			$dados['uf']			= (string) $data['uf'];
			$dados['telefone'] 		= (string) $data['telefone'];
			$dados['email'] 		= (string) $data['email'];

			$dados['mapa'] = str_replace(" ", "+", $dados['endereco'].", ".$dados['numero']." - ".$dados['bairro']." ".$dados['cidade']);
		} else {
			return false;
		}

		echo json_encode($dados);
	}

	function enviar($para, $assunto, $mensagem) {
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