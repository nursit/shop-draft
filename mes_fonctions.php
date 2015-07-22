<?php

function affiche_prix($valeur,$decimales=2,$devise="EUR"){

	$devise_dir = 'right';
	switch ($devise) {
		case 'EUR':
			$devise_display = "&nbsp;€";
			break;
		case 'USD':
			$devise_display = "$";
			$devise_dir = 'left';
			break;
		default:
			$devise_display = str_replace(' ','&nbsp;',$devise);
			break;
	}

	$devise = '<span itemprop="priceCurrency" content="'.attribut_html(trim($devise)).'">'.$devise_display.'</span>';
	$price = '<span itemprop="price" content="'.attribut_html($valeur).'">'.sprintf("%.{$decimales}f",$valeur).'</span>';
	if ($devise_dir!=='right'){
		return $devise.$price;
	}
	return $price.$devise;
}

function filtre_affiche_monnaie_dist($valeur,$decimales=2,$unite=true){
	if ($unite===true) $devise="EUR"; else $devise=$unite;
	return affiche_prix($valeur,$decimales,$devise);
}


function shop_titre_etape($etape){
	return _T('shop:titre_etape_'.$etape);
}

function shop_liste_etapes($id_panier){
	static $lesetapes = array();
	$etapes = array('panier','qui','commande','livraison','paiement');
	if (!$id_panier) return $etapes;
	if (isset($lesetapes["$id_panier"]))
		return $lesetapes["$id_panier"];

	if ($id_auteur = intval(sql_getfetsel('id_auteur','spip_paniers','id_panier='.intval($id_panier)))){
		$etapes = array_diff($etapes,array('qui'));
	}

	$items = sql_allfetsel("*","spip_paniers_liens","id_panier=".intval($id_panier));
	$livrable = false;
	foreach($items as $item){
		$table = table_objet_sql($item['objet']);
		$primary = id_table_objet($item['objet']);
		$objet = sql_fetsel("*",$table,"$primary=".intval($item['id_objet']));
		if (!isset($objet['immateriel']) OR !$objet['immateriel']){
			$livrable = true;
			break;
		}
	}
	if (!$livrable){
		$etapes = array_diff($etapes,array('livraison'));
	}

	return $lesetapes["$id_panier"] = $etapes;
}