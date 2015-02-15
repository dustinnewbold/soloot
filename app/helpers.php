<?php

function lootToLink($idstring) {
	$id = (int)$idstring;
	$params = explode(':', $idstring);
	$bonuses = array_splice($params, 12);
	$bonusString = implode($bonuses, ':');
	return 'item=' . $id . '&bonus=' . $bonusString;
}