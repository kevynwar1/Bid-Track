<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['default_controller'] = 'home';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

$route['destinatario/p'] = 'destinatario';
$route['destinatario/p/(:num)'] = 'destinatario';

$route['estabelecimento/p'] = 'estabelecimento';
$route['estabelecimento/p/(:num)'] = 'estabelecimento';

$route['motorista/p'] = 'motorista';
$route['motorista/p/(:num)'] = 'motorista';

$route['romaneio/p'] = 'romaneio';
$route['romaneio/p/(:num)'] = 'romaneio';

$route['transportadora/p'] = 'transportadora';
$route['transportadora/p/(:num)'] = 'transportadora';

$route['tipoveiculo/p'] = 'tipoveiculo';
$route['tipoveiculo/p/(:num)'] = 'tipoveiculo';

$route['tipoocorrencia/p'] = 'tipoocorrencia';
$route['tipoocorrencia/p/(:num)'] = 'tipoocorrencia';

$route['veiculo/p'] = 'veiculo';
$route['veiculo/p/(:num)'] = 'veiculo';