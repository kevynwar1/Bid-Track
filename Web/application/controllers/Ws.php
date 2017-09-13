<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH.'libraries/REST_Controller.php';

class Ws extends REST_Controller {
	function __construct() {
		parent::__construct();

		$this->methods['entrega_get']['limit'] = 500;
		$this->methods['entrega_motorista_get']['limit'] = 500;

		$this->methods['romaneio_get']['limit'] = 500;
        $this->methods['romaneio_ofertavel_get']['limit'] = 500;
		$this->methods['romaneio_motorista_get']['limit'] = 500;

		$this->methods['empresa_get']['limit'] = 500;
		$this->methods['motorista_get']['limit'] = 500;
		$this->methods['usuario_get']['limit'] = 500;
		$this->methods['login_get']['limit'] = 500;
	}

	/* Empresa */
	public function empresa_get() {
        $this->load->model('model/Empresa_model');
		$empresas = $this->Empresa_model->listar();
		$id = $this->get('id');

		if($id === NULL) {
			if($empresas) {
				$this->response($empresas, REST_Controller::HTTP_OK);
			} else {
				$this->response([
					'status' => FALSE,
					'message' => 'Nenhuma Empresa foi encontrado.'
				], REST_Controller::HTTP_NOT_FOUND);
			}
		}

		$id = $this->uri->segment(4);

		if($id <= 0) {
			$this->response(NULL, REST_Controller::HTTP_BAD_REQUEST);
		}

		$empresa = new Empresa_basic();

		if(!empty($empresas)) {
			foreach($empresas as $key => $value) {
				if(isset($value->codigo) && $value->codigo === $id) {
					$empresa = $value;
				}
			}
		}

		if(!empty($empresa)) {
			$this->set_response($empresa, REST_Controller::HTTP_OK);
			} else {
			$this->set_response([
				'status' => FALSE,
				'message' => 'Empresa não pôde ser encontrado.'
			], REST_Controller::HTTP_NOT_FOUND);
		}
    }





    /* Romaneio */
    public function romaneio_get() {
        $this->load->model('model/Romaneio_model');
        $romaneios = $this->Romaneio_model->listar();
        $id = $this->get('id');

        if($id === NULL) {
            if($romaneios) {
                $this->response($romaneios, REST_Controller::HTTP_OK);
            } else {
                $this->response([
                    'status' => FALSE,
                    'message' => 'Nenhum Romaneio foi encontrado.'
                ], REST_Controller::HTTP_NOT_FOUND);
            }
        }

        $id = $this->uri->segment(4);

        if($id <= 0) {
            $this->response(NULL, REST_Controller::HTTP_BAD_REQUEST);
        }

        $romaneio = new Romaneio_basic();

        if(!empty($romaneios)) {
            foreach($romaneios as $key => $value) {
                if(isset($value->codigo) && $value->codigo === $id) {
                    $romaneio = $value;
                }
            }
        }

        if(!empty($romaneio)) {
            $this->set_response($romaneio, REST_Controller::HTTP_OK);
        } else {
            $this->set_response([
                'status' => FALSE,
                'message' => 'Romaneio não pôde ser encontrado.'
            ], REST_Controller::HTTP_NOT_FOUND);
        }
    }

    /* Romaneio do Motorista */
    public function romaneio_ofertavel_get() {
        $this->load->model('model/Romaneio_model');
        $romaneios = $this->Romaneio_model->romaneio_ofertavel($this->uri->segment(3), $this->uri->segment(4));

		if($romaneios) {
			$this->response($romaneios, REST_Controller::HTTP_OK);
		} else {
			$this->response([
				'status' => FALSE,
				'message' => 'Nenhum Romaneio foi encontrado.'
			], REST_Controller::HTTP_NOT_FOUND);
		}

        if(!empty($romaneio)) {
            $this->set_response($romaneio, REST_Controller::HTTP_OK);
        } else {
            $this->set_response([
                'status' => FALSE,
                'message' => 'Romaneio não pôde ser encontrado.'
            ], REST_Controller::HTTP_NOT_FOUND);
        }
    }

    /* Romaneio do Motorista */
    public function romaneio_motorista_get() {
        $this->load->model('model/Romaneio_model');
        $romaneios = $this->Romaneio_model->consultar_motorista_id($this->uri->segment(3));
        $id = $this->get('id');

        if($id === NULL) {
            if($romaneios) {
                $this->response($romaneios, REST_Controller::HTTP_OK);
            } else {
                $this->response([
                    'status' => FALSE,
                    'message' => 'Nenhum Romaneio foi encontrado.'
                ], REST_Controller::HTTP_NOT_FOUND);
            }
        }

        $id = $this->uri->segment(4);

        if($id <= 0) {
            $this->response(NULL, REST_Controller::HTTP_BAD_REQUEST);
        }

        $romaneio = new Romaneio_basic();

        if(!empty($romaneios)) {
            foreach($romaneios as $key => $value) {
                if(isset($value->codigo) && $value->codigo === $id) {
                    $romaneio = $value;
                }
            }
        }

        if(!empty($romaneio)) {
            $this->set_response($romaneio, REST_Controller::HTTP_OK);
        } else {
            $this->set_response([
                'status' => FALSE,
                'message' => 'Romaneio não pôde ser encontrado.'
            ], REST_Controller::HTTP_NOT_FOUND);
        }
    }





    /* Entrega */
    public function entrega_get() {
		$this->load->model('model/Entrega_model');
        $entregas = $this->Entrega_model->listar();
        $id = $this->get('id');

        if($id === NULL) {
            if($entregas) {
                $this->response($entregas, REST_Controller::HTTP_OK);
            } else {
                $this->response([
                    'status' => FALSE,
                    'message' => 'Nenhuma Entrega foi encontrada.'
                ], REST_Controller::HTTP_NOT_FOUND);
            }
        }

        $id = $this->uri->segment(4);

        if($id <= 0) {
            $this->response(NULL, REST_Controller::HTTP_BAD_REQUEST);
        }

        $entrega = new Entrega_basic();

        if(!empty($entregas)) {
            foreach($entregas as $key => $value) {
                if(isset($value->codigo) && $value->codigo === $id) {
                    $entrega = $value;
                }
            }
        }

        if(!empty($entrega)) {
            $this->set_response($entrega, REST_Controller::HTTP_OK);
        } else {
            $this->set_response([
                'status' => FALSE,
                'message' => 'Entrega não pôde ser encontrada.'
            ], REST_Controller::HTTP_NOT_FOUND);
        }
    }

    /* Entregas do Motorista */
	public function entrega_motorista_get() {
        $this->load->model('model/Entrega_model');
        $entregas = $this->Entrega_model->entrega_motorista($this->uri->segment(3));
        $id = $this->get('id');

        if($id === NULL) {
            if($entregas) {
                $this->response($entregas, REST_Controller::HTTP_OK);
            } else {
                $this->response([
                    'status' => FALSE,
                    'message' => 'Nenhuma Entrega foi encontrado.'
                ], REST_Controller::HTTP_NOT_FOUND);
            }
        }

        $id = $this->uri->segment(4);

        if($id <= 0) {
            $this->response(NULL, REST_Controller::HTTP_BAD_REQUEST);
        }

        $entrega = new Entrega_basic();

        if(!empty($entregas)) {
            foreach($entregas as $key => $value) {
                if(isset($value->codigo) && $value->codigo === $id) {
                    $entrega = $value;
                }
            }
        }

        if(!empty($entrega)) {
            $this->set_response($entrega, REST_Controller::HTTP_OK);
            } else {
            $this->set_response([
                'status' => FALSE,
                'message' => 'Entrega do Motorista não pôde ser encontrado.'
            ], REST_Controller::HTTP_NOT_FOUND);
        }
	}





    /* Motorista */
    public function motorista_get() {
        $this->load->model('model/Motorista_model');
        $motoristas = $this->Motorista_model->listar();
        $id = $this->get('id');

        if($id === NULL) {
            if($motoristas) {
                $this->response($motoristas, REST_Controller::HTTP_OK);
            } else {
                $this->response([
                    'status' => FALSE,
                    'message' => 'Nenhum Motorista foi encontrado.'
                ], REST_Controller::HTTP_NOT_FOUND);
            }
        }

        $id = $this->uri->segment(4);

        if($id <= 0) {
            $this->response(NULL, REST_Controller::HTTP_BAD_REQUEST);
        }

        $motorista = new Motorista_basic();

        if(!empty($motoristas)) {
            foreach($motoristas as $key => $value) {
                if(isset($value->codigo) && $value->codigo === $id) {
                    $motorista = $value;
                }
            }
        }

        if(!empty($motorista)) {
            $this->set_response($motorista, REST_Controller::HTTP_OK);
        } else {
            $this->set_response([
                'status' => FALSE,
                'message' => 'Motorista não pôde ser encontrada.'
            ], REST_Controller::HTTP_NOT_FOUND);
        }
    }





    /* Usuário */
    public function usuario_get() {
        $this->load->model('model/Usuario_model');
        $usuarios = $this->Usuario_model->listar();
        $id = $this->get('id');

        if($id === NULL) {
            if($usuarios) {
                $this->response($usuarios, REST_Controller::HTTP_OK);
            } else {
                $this->response([
                    'status' => FALSE,
                    'message' => 'Nenhum Usuário foi encontrado.'
                ], REST_Controller::HTTP_NOT_FOUND);
            }
        }

        $id = $this->uri->segment(4);

        if($id <= 0) {
            $this->response(NULL, REST_Controller::HTTP_BAD_REQUEST);
        }

        $usuario = new usuario_basic();

        if(!empty($usuarios)) {
            foreach($usuarios as $key => $value) {
                if(isset($value->codigo) && $value->codigo === $id) {
                    $usuario = $value;
                }
            }
        }

        if(!empty($usuario)) {
            $this->set_response($usuario, REST_Controller::HTTP_OK);
        } else {
            $this->set_response([
                'status' => FALSE,
                'message' => 'Usuário não pôde ser encontrada.'
            ], REST_Controller::HTTP_NOT_FOUND);
        }
    }





	/* Login */
	public function login_get() {
		$email = explode("%40", $this->uri->segment(3));
		$email = $email[0].'@'.$email[1];
		$senha = $this->uri->segment(4);

		$this->load->model('model/Usuario_model');
		$usuario = $this->Usuario_model->login($email, $senha);

		if($usuario) {
			$this->load->model('model/Motorista_model');
        	$motorista = $this->Motorista_model->motorista_usuario($usuario[0]->codigo);

			$this->response($motorista, REST_Controller::HTTP_OK);
		} else {
			$this->response([
				'status' => FALSE,
				'message' => 'Nenhum Usuário foi encontrado.'
			], REST_Controller::HTTP_NOT_FOUND);
		}
	}
}