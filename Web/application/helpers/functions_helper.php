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
?>