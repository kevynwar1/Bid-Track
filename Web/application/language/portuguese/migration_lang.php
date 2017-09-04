<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$lang['migration_none_found'] 			= 'Nenhuma migration encontrada.';
$lang['migration_not_found'] 			= 'Nenhuma migration foi encontrada com o número da versão: %s.';
$lang['migration_sequence_gap'] 		= 'Existe uma lacuna no migration na seqüência próximo número da versão: %s.';
$lang['migration_multiple_version']		= 'Há várias migrations com o mesmo número de versão: %s.';
$lang['migration_class_doesnt_exist']	= 'A classe de migration "%s não foi encontrada.';
$lang['migration_missing_up_method']	= 'A classe de migration %s não tem o método "up".';
$lang['migration_missing_down_method']	= 'A classe de migration %s não tem o método "down".';
$lang['migration_invalid_filename']		= 'A migration %s tem um nome de arquivo inválido.';