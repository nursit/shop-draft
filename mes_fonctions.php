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
