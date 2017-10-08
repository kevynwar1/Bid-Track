<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH.'libraries/REST_Controller.php';

class Ws extends REST_Controller {
	function __construct() {
		parent::__construct();

		$this->methods['entrega_get']['limit'] = 500;
		$this->methods['entrega_motorista_get']['limit'] = 500;
        $this->methods['entrega_romaneio_get']['limit'] = 500; // Carlos E. - 25/09
        $this->methods['entrega_by_romaneio_get']['limit'] = 500; // Erick B. - 02/10
        $this->methods['entrega_count_romaneio_get']['limit'] = 500; // Erick B. - 02/10
        $this->methods['entrega_status_get']['limit'] = 500; // Carlos E. - 06/10

		$this->methods['romaneio_get']['limit'] = 500;
        $this->methods['romaneio_aceitar_get']['limit'] = 500; // Erick B. - 26/09
        $this->methods['romaneio_ofertavel_get']['limit'] = 500; // Erick B. - 25/09
		$this->methods['romaneio_motorista_get']['limit'] = 500;
        $this->methods['romaneio_motorista_empresa_get']['limit'] = 500; // Kevyn H. - 23/09
        $this->methods['romaneio_status_get']['limit'] = 500; // Carlos E. - 02/10

		$this->methods['motorista_get']['limit'] = 500;
        $this->methods['motorista_esqueci_senha_get']['limit'] = 500; // Kevyn H. - 26/09
        $this->methods['motorista_login_get']['limit'] = 500;

        $this->methods['empresa_get']['limit'] = 500;
        $this->methods['empresa_motorista_get']['limit'] = 500;

        $this->methods['usuario_get']['limit'] = 500;

        $this->methods['ocorrencia_add_post']['limit'] = 100; // Willi G. - 04/10
        $this->methods['ocorrencia_entrega_get']['limit'] = 500; // Willi G. - 04/10

        $this->methods['imagem_ocorrencia_add_post']['limit'] = 100; // Kevyn H. - 04/10

        $this->methods['tipo_ocorrencia_get']['limit'] = 500; // Willi G. - 04/10
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

    public function empresa_motorista_get() {
        $this->load->model('model/Empresa_model');
        $empresas = $this->Empresa_model->empresa_motorista($this->uri->segment(3));

        if($empresas) {
            $this->response($empresas, REST_Controller::HTTP_OK);
        } else {
            $this->response([
                'status' => FALSE,
                'message' => 'Nenhum Empresa foi encontrado para este Motorista.'
            ], REST_Controller::HTTP_NOT_FOUND);
        }

        if(!empty($empresas)) {
            $this->set_response($empresas, REST_Controller::HTTP_OK);
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

    /* Aceita Oferta de Romaneio */
    public function romaneio_aceitar_get() {
        $this->load->model('model/Motorista_model');
        $this->load->model('model/Romaneio_model');

        $motorista = $this->uri->segment(3);
        $romaneio = $this->uri->segment(4);
        $empresa = $this->uri->segment(5);
        $estabelecimento = $this->uri->segment(6);

        $romaneios = $this->Romaneio_model->romaneio_aceitar($motorista, $romaneio, $empresa, $estabelecimento);

        if($romaneios) {
            $this->Motorista_model->disponibilidade(FALSE, $motorista);
            $this->response($romaneios, REST_Controller::HTTP_OK);
        } else {
            $this->response([
                'status' => FALSE,
                'message' => 'Nenhum linha foi afetada.'
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

    /* Romaneio do Motorista com Empresa */
    public function romaneio_motorista_empresa_get() {
        $empresa = $this->uri->segment(3);
        $motorista = $this->uri->segment(4);

        $this->load->model('model/Romaneio_model');
        $romaneios = $this->Romaneio_model->romaneio_empresa_motorista($empresa, $motorista);

        if($romaneios) {
            $this->response($romaneios, REST_Controller::HTTP_OK);
        } else {
            $this->response([
                'status' => FALSE,
                'message' => 'Nenhum Romaneio foi encontrado.'
            ], REST_Controller::HTTP_NOT_FOUND);
        }
    }

    /* Mudar Status do Romaneio */
    public function romaneio_status_get() {
        $status = $this->uri->segment(3);
        $romaneio = $this->uri->segment(4);

        $this->load->model('model/Romaneio_model');
        $romaneios = $this->Romaneio_model->romaneio_status($status, $romaneio);

        if($romaneios) {
            $this->response($romaneios, REST_Controller::HTTP_OK);
        } else {
            $this->response([
                'status' => FALSE,
                'message' => 'Nenhum Romaneio foi encontrado.'
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

    public function entrega_romaneio_get() {
        $this->load->model('model/Entrega_model');
        $entregas = $this->Entrega_model->entrega_romaneio($this->uri->segment(3));

        if($entregas) {
            $this->response($entregas, REST_Controller::HTTP_OK);
        } else {
            $this->response([
                'status' => FALSE,
                'message' => 'Nenhum Entrega para o Romaneio foi encontrado.'
            ], REST_Controller::HTTP_NOT_FOUND);
        }

        if(!empty($romaneio)) {
            $this->set_response($romaneio, REST_Controller::HTTP_OK);
        } else {
            $this->set_response([
                'status' => FALSE,
                'message' => 'Entregas não pôde ser encontrada.'
            ], REST_Controller::HTTP_NOT_FOUND);
        }
    }

    /* Mudar Status da Entrega */
    public function entrega_status_get() {
        $status_entrega = $this->uri->segment(3);
        $seq_entrega = $this->uri->segment(4);
        $romaneio = $this->uri->segment(5);

        $this->load->model('model/Entrega_model');
        $entregas = $this->Entrega_model->entrega_status($status_entrega, $seq_entrega, $romaneio);

        if($entregas) {
            $this->response($entregas, REST_Controller::HTTP_OK);
        } else {
            $this->response([
                'status' => FALSE,
                'message' => 'Nenhum Romaneio foi encontrado.'
            ], REST_Controller::HTTP_NOT_FOUND);
        }
    }

    public function entrega_by_romaneio_get() {
        $this->load->model('model/Entrega_model');
        $entregas = $this->Entrega_model->entrega_by_romaneio($this->uri->segment(3));

        if($entregas) {
            $this->response($entregas, REST_Controller::HTTP_OK);
        } else {
            $this->response([
                'status' => FALSE,
                'message' => 'Nenhum Entrega para o Romaneio foi encontrado.'
            ], REST_Controller::HTTP_NOT_FOUND);
        }

        if(!empty($romaneio)) {
            $this->set_response($romaneio, REST_Controller::HTTP_OK);
        } else {
            $this->set_response([
                'status' => FALSE,
                'message' => 'Entregas não pôde ser encontrada.'
            ], REST_Controller::HTTP_NOT_FOUND);
        }
    }

    public function entrega_count_romaneio_get() {
        $this->load->model('model/Entrega_model');
        $entregas = $this->Entrega_model->entrega_count_romaneio($this->uri->segment(3));

        if($entregas) {
            $this->response($entregas, REST_Controller::HTTP_OK);
        } else {
            $this->response([
                'status' => FALSE,
                'message' => 'Nenhum Entrega para o Romaneio foi encontrado.'
            ], REST_Controller::HTTP_NOT_FOUND);
        }

        if(!empty($entregas)) {
            $this->set_response($entregas, REST_Controller::HTTP_OK);
        } else {
            $this->set_response([
                'status' => FALSE,
                'message' => 'Entregas não pôde ser encontrada.'
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

	/* Motorista Login */
    public function motorista_login_get() {
        $email = explode("%40", $this->uri->segment(3));
        $email = $email[0].'@'.$email[1];
        $senha = $this->uri->segment(4);

        $this->load->model('model/Motorista_model');
        $motorista = $this->Motorista_model->login($email, $senha);

        if($motorista) {
            $this->response($motorista, REST_Controller::HTTP_OK);
        } else {
            $this->response([
                'status' => FALSE,
                'message' => 'Nenhum Usuário foi encontrado.'
            ], REST_Controller::HTTP_NOT_FOUND);
        }
    }

    /* Motorista Esqueci Senha */
    public function motorista_esqueci_senha_get() {
        $email = explode("%40", $this->uri->segment(3));
        $email = $email[0].'@'.$email[1];

        $this->load->model('model/Motorista_model');
        $motorista = $this->Motorista_model->esqueci_senha($email);

        if($motorista) {
            $this->response($motorista, REST_Controller::HTTP_OK);
        } else {
            $this->response([
                'status' => FALSE,
                'message' => 'Nenhum Usuário foi encontrado.'
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





    /* Adicionar Ocorrência */
    public function ocorrencia_add_post() {
        $data = json_decode(file_get_contents('php://input'), true);

        $this->load->model('basic/Ocorrencia_basic');
        $this->load->model('model/Ocorrencia_model');

        $ocorrencia = new Ocorrencia_basic();
        $ocorrencia->getEmpresa()->setCodigo($data['empresa']);
        $ocorrencia->getEntrega()->setSeqEntrega($data['entrega']);
        $ocorrencia->getRomaneio()->setCodigo($data['romaneio']);
        $ocorrencia->getTipoOcorrencia()->setCodigo($data['tipo_ocorrencia']);
        $ocorrencia->setDescricao($data['descricao']);
        $ocorrencia->setData(date("Y-m-d"));

        $result = $this->Ocorrencia_model->cadastrar($ocorrencia);
        if($result) {
            $this->response("201", REST_Controller::HTTP_OK);
        } else {
            $this->response([
                'status' => FALSE,
                'message' => 'Ocorreu um erro ao Inserir a Ocorrência.'
            ], REST_Controller::HTTP_NOT_FOUND);
        }
    }

    public function ocorrencia_entrega_get() {
        $this->load->model('model/Ocorrencia_model');

        $entrega = $this->uri->segment(3);
        $romaneio = $this->uri->segment(4);

        $ocorrencias = $this->Ocorrencia_model->ocorrencia_entrega($entrega, $romaneio);

        if($ocorrencias) {
            $this->response($ocorrencias, REST_Controller::HTTP_OK);
        } else {
            $this->response([
                'status' => FALSE,
                'message' => 'Nenhuma Ocorrência foi encontrada para esta Entrega.'
            ], REST_Controller::HTTP_NOT_FOUND);
        }

        if(!empty($ocorrencias)) {
            $this->set_response($ocorrencias, REST_Controller::HTTP_OK);
        } else {
            $this->set_response([
                'status' => FALSE,
                'message' => 'Ocorrência não pôde ser encontrado.'
            ], REST_Controller::HTTP_NOT_FOUND);
        }
    }





    /* Adicionar Ocorrência */
    public function imagem_ocorrencia_add_post() {
        $data = json_decode(file_get_contents('php://input'), true);

        $this->load->model('basic/ImagemOcorrencia_basic');
        $this->load->model('model/ImagemOcorrencia_model');

        $imagem_ocorrencia = new ImagemOcorrencia_basic();
        $imagem_ocorrencia->getOcorrencia()->setCodigo($data['ocorrencia']);
        $imagem_ocorrencia->setFoto($data['foto']);

        $result = $this->ImagemOcorrencia_model->cadastrar($imagem_ocorrencia);
        if($result) {
            $this->response("201", REST_Controller::HTTP_OK);
        } else {
            $this->response([
                'status' => FALSE,
                'message' => 'Ocorreu um erro ao Inserir a Imagem da Ocorrência.'
            ], REST_Controller::HTTP_NOT_FOUND);
        }
    }





    public function tipo_ocorrencia_get() {
        $this->load->model('model/TipoOcorrencia_model');
        $tipo_ocorrencia = $this->TipoOcorrencia_model->listar($this->uri->segment(3));

        if($tipo_ocorrencia) {
            $this->response($tipo_ocorrencia, REST_Controller::HTTP_OK);
        } else {
            $this->response([
                'status' => FALSE,
                'message' => 'Nenhum Tipo de Ocorrência foi encontrado para esta Empresa.'
            ], REST_Controller::HTTP_NOT_FOUND);
        }

        if(!empty($tipo_ocorrencia)) {
            $this->set_response($tipo_ocorrencia, REST_Controller::HTTP_OK);
        } else {
            $this->set_response([
                'status' => FALSE,
                'message' => 'Tipo de Ocorrência não pôde ser encontrado.'
            ], REST_Controller::HTTP_NOT_FOUND);
        }
    }
}