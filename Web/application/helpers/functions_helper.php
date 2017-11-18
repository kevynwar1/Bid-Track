<?php
defined('BASEPATH') OR exit('No direct script access allowed');

function v($data) {
	echo "<pre>";
	var_dump($data);
	die();
}

function p($data) {
	echo "<pre>";
	print_r($data);
	die();
}

function idade($data) {
    list($dia, $mes, $ano) = explode('/', $data);
    $hoje = mktime(0, 0, 0, date('m'), date('d'), date('Y'));
    $nascimento = mktime( 0, 0, 0, $mes, $dia, $ano);

    $idade = floor((((($hoje - $nascimento) / 60) / 60) / 24) / 365.25);
    return $idade;
}

function diasemana($data, $format) {
	$ano = substr("$data", 0, 4);
	$mes = substr("$data", 5, -3);
	$dia = substr("$data", 8, 9);
	$diasemana = date("w", mktime(0, 0, 0, $mes, $dia, $ano));
	if($format == 'extenso') {
		switch($diasemana) {
			case "0": $diasemana = "Domingo";	    break;
			case "1": $diasemana = "Segunda-Feira"; break;
			case "2": $diasemana = "Terça-Feira";   break;
			case "3": $diasemana = "Quarta-Feira";  break;
			case "4": $diasemana = "Quinta-Feira";  break;
			case "5": $diasemana = "Sexta-Feira";   break;
			case "6": $diasemana = "Sábado";		break;
		}
	} else if($format == 'curto') {
		switch($diasemana) {
			case "0": $diasemana = "Dom"; break;
			case "1": $diasemana = "Seg"; break;
			case "2": $diasemana = "Ter"; break;
			case "3": $diasemana = "Qua"; break;
			case "4": $diasemana = "Qui"; break;
			case "5": $diasemana = "Sex"; break;
			case "6": $diasemana = "Sáb"; break;
		}
	}

	echo "$diasemana";
}

function cnpj($cnpj) {
	if($cnpj == 0) {
		return true;
	} else {
		$cnpj = preg_replace('/[^0-9]/', '', (string) $cnpj);
		if(strlen($cnpj) != 14) {
			return false;
		}

		for($i = 0, $j = 5, $soma = 0; $i < 12; $i++) {
			$soma += $cnpj{$i} * $j;
			$j = ($j == 2) ? 9 : $j - 1;
		}
		$resto = $soma % 11;
		
		if($cnpj{12} != ($resto < 2 ? 0 : 11 - $resto)) {
			return false;
		}

		for($i = 0, $j = 6, $soma = 0; $i < 13; $i++) {
			$soma += $cnpj{$i} * $j;
			$j = ($j == 2) ? 9 : $j - 1;
		}
		$resto = $soma % 11;

		return $cnpj{13} == ($resto < 2 ? 0 : 11 - $resto);
	}
}

function cpf($cpf) {
	if($cpf == 0) {
		return true;
	} else {
		$cpf = preg_replace('/[^0-9]/', '', (string) $cpf);
		if(strlen($cpf) != 11) {
			return false;
		}

		for($i = 0, $j = 10, $soma = 0; $i < 9; $i++, $j--) {
			$soma += $cpf{$i} * $j;
		}

		$resto = $soma % 11;
		if($cpf{9} != ($resto < 2 ? 0 : 11 - $resto)) {
			return false;
		}

		for($i = 0, $j = 11, $soma = 0; $i < 10; $i++, $j--) {
			$soma += $cpf{$i} * $j;
		}

		$resto = $soma % 11;
		return $cpf{10} == ($resto < 2 ? 0 : 11 - $resto);
	}
}

function refatorar_campos($string) {
	$campo = str_replace("Galpao", "Galpão ", str_replace("Seccao", "Secção", str_replace("S.A.nto", "Santo", str_replace("Jaboatao", "Jaboatão", str_replace("Jordao", "Jordão", str_replace("Sao", "São", str_replace("S.A.o", "São", str_replace("Comercio", "Comércio", str_replace("Ltda", "LTDA.", str_replace("S.a.", "S.A.", str_replace("S.a", "S.A", str_replace("Informacao", "Informação", str_replace("S.A.udade", "Saudade", str_replace(" Da ", " da ", str_replace(" Do ", " do ", str_replace(" Dos ", " dos ", str_replace(" Das ", " das ", str_replace(" De ", " de ", str_replace("S/a", "S/A", str_replace(" E ", " e ", str_replace(" O ", " o ", str_replace("Ltda.", "LTDA.", str_replace("Av ", "Avenida ", str_replace("Est ", "Estrada ", str_replace("R ", "Rua ", ucwords(strtolower($string)))))))))))))))))))))))))));

	return $campo;
}

function acentuacao($string){
    return preg_replace(array("/(á|à|ã|â|ä)/","/(Á|À|Ã|Â|Ä)/","/(é|è|ê|ë)/","/(É|È|Ê|Ë)/","/(í|ì|î|ï)/","/(Í|Ì|Î|Ï)/","/(ó|ò|õ|ô|ö)/","/(Ó|Ò|Õ|Ô|Ö)/","/(ú|ù|û|ü)/","/(Ú|Ù|Û|Ü)/","/(ñ)/","/(Ñ)/"),explode(" ","a A e E i I o O u U n N"),$string);
}

function estrutura($assunto, $mensagem) {
	$html = "
		<div style='padding: 50px 70px 50px 70px; color: #FFF; background: #F1F1F1'>
			<table width='100%' border='0' cellpadding='0' cellspacing='0' style='box-shadow: 0 0 30px rgba(204,204,204, 0.57);'>
				<tr>
					<td align='center' width='20%' style='background: #FFF; padding: 10px'>
						<img src='http://coopera.pe.hu/assets/img/bid-track-solid-ico.png' alt='Bid & Track'>
					</td>
					<td style='background: #FFF; color: #000; padding-left: 50px; padding: 20px;'>
						<span style='font-size: 27px'>".$assunto."</span><br><br>".
						$mensagem
					."<br><br>
					<hr style='border: 0; height: 1px; background-color: #EAEAEA;'>
					<span style='color: #CCC'>".date('H:i')." ".diasemana(date("Y-m-d"), 'curto')." — contato@coopera.pe.hu</span>
					<hr style='border: 0; height: 1px; background-color: #EAEAEA;'>
					Abraço,<br>
					Equipe Bid & Track.
					</td>
				</tr>
			</table>
			<br>
			<span style='color:#999'>
				<a href='".base_url()."' style='color:#999'>".SYSTEM_NAME."</a>
			</span>
		</div>
		";
	return $html;
}
?>