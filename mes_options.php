<?php
define('_DIR_PLUGINS_SUPPL', _DIR_RACINE.'squelettes/plugins/');

function upgrade_produits(){
	$all = sql_allfetsel("*","spip_produits");

	include_once(_DIR_PLUGIN_SALE."sale_fonctions.php");
	foreach($all as $produit){

		#var_dump($produit);
		$set = array();
		if (function_exists('sale')){
			$set['texte'] = sale($produit['texte']);
			$set['texte'] = preg_replace(",</?p>\s*,ims","\n\n",$set['texte']);
			$set['texte'] = preg_replace(",<br>(\n+),ims","\\1",$set['texte']);
			$set['texte'] = trim($set['texte'])."\n";
		}
		$set['reference'] = trim($produit['reference']);
		if (!$set['reference']){
			$set['reference'] = 'P'.trim($produit['old_id']);
			#var_dump($set);
			#die();
		}
		if (strpos($produit['poids'],".")!==false){
			$set['poids'] = intval(round(floatval($produit['poids'])*1000));
		}
		#var_dump($set);
		sql_updateq("spip_produits",$set,'id_produit='.intval($produit['id_produit']));
	}

	sql_alter("table spip_produits CHANGE poids poids bigint(21) NOT NULL DEFAULT 0");
	die('ok?');
}